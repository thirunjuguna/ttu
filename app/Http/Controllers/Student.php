<?php
namespace ttu\Http\Controllers;
use Illuminate\Http\Request;

class Student extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
//    //
//    public function about(){
//        if(auth()->check()){
//         if(auth()->user()->complete==0){
//            return redirect()->to('/account/setup');
//        }
//        }
//          if(auth()->user()->minidp==''){
//                 return redirect()->to('student/settings');
//            }
//    return view('about');  
//}
    public function verify_payment(){
        $code= \Illuminate\Support\Facades\Input::get('code');
        $trans= \ttu\Transaction::all()->where('code',$code)->where('status',0);
        if($trans->count()>0){
            //there
            $tran= \ttu\Transaction::all()->where('code',$code)->where('status',0)->first();
            $user= \ttu\User::all()->find(auth()->user()->id);
            $user->balance=intval($user->balance)+intval($tran->amount);
            $user->save();
            $tran->status=1;
            $tran->to_=auth()->user()->reg;
            $tran->save();
             return redirect()->back()->with('status','Your account balance has been recharged');
        }else{
            return redirect()->back()->with('status','The payment verification code if not valid.Try again');
        }
    }
public function payment(){
     if(auth()->check()){
     if(auth()->user()->complete==0){
            return redirect()->to('/account/setup');
     }}
       if(auth()->user()->minidp==''){
                 return redirect()->to('student/settings');
            }
    return view('payment');
}
    public function pay_claim($id){
        //
       $remark= \ttu\Remark::all()->find($id);
        if($remark->record==''){
            \ttu\Record::create(['user_id'=> auth()->user()->id,
                'year'=>$remark->year,
                'status'=>0]);
            $r= \ttu\Record::all()->last();
            $remark= \ttu\Remark::all()->find($id);
            $remark->record=$r->id;
            $remark->save();
          
        }
          if(intval($remark->price)>intval(auth()->user()->balance)){
                //less money
                return redirect()->to('payment')->with('status','You do not have enough balance please top up');
            }else{
                ///go on
                $user= \ttu\User::all()->find(auth()->user()->id);
                $user->balance=intval(auth()->user()->balance)-intval($remark->price);
                $sms=new SmsController();
                $message="Hello ".$user->first_name.",".$remark->price." KSH has been deducted from you account to paid for a fine on clearance portal.Thank you";
                $sms->SendSms($user->mobile,$message);
                $user->save();
                $remark= \ttu\Remark::all()->find($id);
                $remark->paid=1;
                $remark->status=0;
                $remark->save();
                ////
                $rems= \ttu\Remark::all()->where('id',$remark->record);
                if($rems->count()>0){
                    ///
                    $rem= \ttu\Remark::all()->find($remark->record);
                    $rem->status=1;
                    $rem->save();
                }
            }
            return redirect()->back()->with('status',$message);
    }
    public function sendMessage(){
        $from_= \Illuminate\Support\Facades\Input::get('from_');
        $department= \Illuminate\Support\Facades\Input::get('department');
        $office= \Illuminate\Support\Facades\Input::get('office');
        if(!isset($_POST['office'])){
            $to_=$department;
        }else{
            $to_=$office;
                    
        }
        ////the insert to db
        \ttu\Message::create([
            'dp'=>$department,
            'minidp'=>$office,
            'from_'=>$from_,
            'to_'=>$to_,
            'message'=> \Illuminate\Support\Facades\Input::get('message')]);
        ////
        return redirect()->back()->with('status','Message has been sent successfully');
        
    }
    public  function account(){
        $dp=new Department();
        $dp->year_Checker();
        ///
         if(auth()->user()->minidp==''){
                 return redirect()->to('student/settings');
            }
            
            //////////////////
            //////////////////
            $records= \ttu\Record::all()
                    ->where('user_id',auth()->user()->id);
            if($records->count()==0){
                ///create
                $years= \ttu\Year::all();
                foreach ($years as $year){
                    //create record
                    \ttu\Record::create(['user_id'=>auth()->user()->id,
                        'year'=>$year->id,
                        'status'=>'1']);
                }
            }
            
            ////check is all years 
            //are present in records
            $myrecords= \ttu\Record::all()->where('user_id', auth()->user()->id);
            $m=[];
            foreach ($myrecords as $my){
                array_push($m,intval($my->year));
            }
           // return $m;
            //////////////
          $years= \ttu\Year::all()->whereNotIn('id',$m);
          if($years->count()>0){
              foreach ($years as $year){
                    //create record
                    \ttu\Record::create(['user_id'=>auth()->user()->id,
                        'year'=>$year->id,
                        'status'=>'1']);
                }
          }
          //records
          //remarks
          $records= \ttu\Record::orderBy('status','asc')
                  ->where('user_id',auth()->user()->id)->Paginate(4);
        return view('student.account')
                ->with('records',$records);
    }
    public function contact(){
       if(auth()->user()->minidp==''){
                 return redirect()->to('student/settings');
            }
            
           $messages= \ttu\Message::orderBy('id','desc')->where('to_',auth()->user()->id)
                    ->orwhere('from_',auth()->user()->id)->get();
            return view('student.contact')->with('messages',$messages);
    }
    public function notify(){
          if(auth()->user()->minidp==''){
                 return redirect()->to('student/settings');
            }
            return view("student.notify");
    }

public function settings(){
     if(auth()->user()->complete==0){
            return redirect()->to('/account/setup');
        }
        $type="student";
        return view('department.settings')
                ->with('type',$type);
    }
public function resendCode(){
        
        $rand= rand(1000,9999999);
        $user= \ttu\User::all()->find(auth()->user()->id);
        $user->verify_code=$rand;
        $user->save();
        $message='Hello '. auth()->user()->name.' your verification code is '.$rand;
        $sms=new SmsController();
        $sms->SendSms(auth()->user()->mobile, $message);
        return redirect()->back();
    }
 public function verfiy_mobile(){
        $code= \Illuminate\Support\Facades\Input::get('code');
        
        if(\Illuminate\Support\Facades\Auth::user()->verify_code==$code){
           $user= \ttu\User::all()->find(auth()->user()->id);
           $user->verify_status=1;
           $user->save();
           return redirect()->back()->with('status','Thank you, '.$user->mobile.' Mobile'
                   . ' number has been verified');
        }
         return redirect()->back()->with('status_status','Verification code is invalid.Resend the code again');
    }
 public function request_certificate(){
        ////request certificate
        $year= \Illuminate\Support\Facades\Input::get('year');
   
        $records= \ttu\Record::all()
                ->where('user_id',auth()->user()->id)
                ->where('year',$year);
        $re=[];
        foreach ($records as $record){
          //  $remark= \ttu\Remark::all()->where($key, $record)
            array_push($re, intval($record->id));
        }
        ///////////
        
         $remarks= \ttu\Remark::all()->whereIn('record', $re);
        $rem=[];
        foreach ($remarks as $remark){
            array_push($rem, intval($remark->id));
        }
        //////
        
        $remarks= \ttu\Remark::all()
                ->where('reg', auth()->user()->reg)
                ->where('year',$year);
        foreach ($remarks as $remark){
            ///
            if(!in_array($rem, $remark->id)){
                 array_push($rem, intval($remark->id));
            }
        }
        //////////////////////////////
        $remarks= \ttu\Remark::all()->whereIn('id',$rem);
        $year= \ttu\Year::all()->find($year);
      $html= $this->my_html($remarks, $year);
        $name= strtoupper(auth()->user()->first_name).'_'.strtoupper(auth()->user()->last_name);
        return $this->my_pdf($html,$name);
        }
  private function my_pdf($html,$name){
         //$dom=new Dompdf\Dompdf();
          // $don=new \Dompdf\Dompdf();
           $dom=new \Dompdf\Dompdf();
           $dom->loadHtml($html);
           $dom->setPaper('A4','portrait');
           $dom->render();
          
           $dom->stream($name.'.pdf');
    }
  private function my_html($remarks,$year){
      $course= \ttu\Course::all()->find(auth()->user()->course)->course;
      $yos=strtoupper('YEAR '.auth()->user()->yos);
      $minidp= \ttu\Minidepartment::all()->find(auth()->user()->minidp)->department;
      $lists=[];
      $dps= \ttu\Department::all();
      $re=[];
       foreach($remarks as $remark){
           array_push($re, intval($remark->dp));
       }
       $count=1;
      foreach ($dps as $dp){
       
          if($remarks->count()>0){
              //remarks there
              if(in_array($dp->id,$re)){
                  ///there
                  
                  //pick for this department
                  $add=$count;
                  foreach($remarks as $remark){
                      if($add!=$count){
                          $count++;
                      }
                      if($remark->dp==$dp->id){
                          if($remark->status==1){
                            
                              //cleared
                            $html="<div>"
                         . "<table style='width:100%;border:1px solid black;' >"
                      . "<tr style='width:100%;border:1px solid black;'>"
                         . "<td>".$count.".".strtoupper($dp->department)." DEPARTMENT</td>"
                     ."<td></td>"
                          ."</tr>"
                                      ."<tr style='margin:0px;border:1px solid black;'>"
                         . "<td>CHARGES:<span  style='padding:10px;'>NONE</span></td>"  
                            ."<td></td>"
                          ."</tr>"
                          ."<tr style='width:100%;border:1px solid black;'>"
                         . "<td>REMARKS:<span  style='padding:10px;'>CLEARED</span></td>"
                     ."<td></td>"
                          ."</tr>"
                         
                      
                         . "</table>"
                         . "<br>"
                         
                         ."<hr style='margin:0px;'>"
                         . "<br>"
                         . "</div>";
               array_push($lists,$html); 
                          }else{
                              //not cleared
                              $html="<div>"
                         . "<table style='width:100%;border:1px solid black;' >"
                      . "<tr style='margin:0px;'>"
                         . "<td>".$add.".".strtoupper($dp->department)." DEPARTMENT</td>"
                     ."<td></td>"
                          ."</tr>"
                          
                        
                                      ."<tr style='margin:0px;'>"
                                      . "<td>FINE: ".$remark->price." KSH</td>"
                                      . "</tr>"
                          ."<tr style='margin:0px;'>"        
                         . "<td>REMARKS:<span  style='padding:10px;'>NOT CLEARED</span></td>"
                     ."<td></td>"
                          ."</tr>"
                         
                      
                         . "</table>"
                         ."<br/>"
                         ."<hr style='margin:0px;'>"
                                       ."<br/>"
                         . "</div>";
               array_push($lists,$html); 
                          }
                      }
                      $add++;
                  }
                 
              }else{
                 $html="<div>"
                         . "<table style='width:100%;border:1px solid black;' >"
                      . "<tr style='width:100%;border:1px solid black;'>"
                         . "<td>".$count.".".strtoupper($dp->department)." DEPARTMENT</td>"
                     ."<td></td>"
                          ."</tr>"
                                      ."<tr style='margin:0px;border:1px solid black;'>"
                         . "<td>CHARGES:<span  style='padding:10px;'>NONE</span></td>"  
                            ."<td></td>"
                          ."</tr>"
                          ."<tr style='width:100%;border:1px solid black;'>"
                         . "<td>REMARKS:<span  style='padding:10px;'>CLEARED</span></td>"
                     ."<td></td>"
                          ."</tr>"
                         
                      
                         . "</table>"
                         . "<br>"
                         
                         ."<hr style='margin:0px;'>"
                         . "<br>"
                         . "</div>";
               array_push($lists,$html); 
              }
            
          }else{
              ///cleared all
                 $html="<div>"
                         . "<table style='width:100%;border:1px solid black;' >"
                      . "<tr style='width:100%;border:1px solid black;'>"
                         . "<td>".$count.".".strtoupper($dp->department)." DEPARTMENT</td>"
                     ."<td></td>"
                          ."</tr>"
                                      ."<tr style='margin:0px;border:1px solid black;'>"
                         . "<td>CHARGES:<span  style='padding:10px;'>NONE</span></td>"  
                            ."<td></td>"
                          ."</tr>"
                          ."<tr style='width:100%;border:1px solid black;'>"
                         . "<td>REMARKS:<span  style='padding:10px;'>CLEARED</span></td>"
                     ."<td></td>"
                          ."</tr>"
                         
                      
                         . "</table>"
                         . "<br>"
                         
                         ."<hr style='margin:0px;'>"
                         . "<br>"
                         . "</div>";
               array_push($lists,$html);
          }
         $count++;
      }
        return '<!DOCTYPE html>
            
 <html>
    <head>
    
        <title>Clearance Certificate</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="margin:0;">
       <h5 style="margin:0;text-align:right">F-2-59-2-1-'.auth()->user()->id.'</h5>
        <h4 style="margin:0;text-align:center">TAITA TAVETA UNIVERSITY</h4>
        <h5 style="margin:1;text-align:center">CLEARANCE '.$year->year.' ACADEMIC YEAR</h5>
        <h5 style="margin:0;text-align:center">GOVERNMENT-SPONSORED STUDENTS YEAR '.auth()->user()->yos.' SEMESTER '.$year->semester.'</h5>
            <hr>
            <h5 style="margin:0;text-align:center"><u>To be printed  and a copy surrendered to the student\'s registry</u></h5>
            
           <table style="margin:0; width:100%;" class="table table-bordered" >
                <tr style="margin:0;">
                <td> Name of Student: <span style="border-bottom:1px dashed #000;">&nbsp;'.strtoupper(auth()->user()->first_name).''
                . '&nbsp;'.strtoupper(auth()->user()->last_name).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                <td>  Reg No.<span style="border-bottom:1px dashed #000;">&nbsp;'. strtoupper(auth()->user()->reg).' &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;</span></td>
                </tr>
                </table>
                 <table style="margin:0;" class="table table-bordered">
                <tr style="margin:0;">
                <td>Course:<span style="border-bottom:1px dashed #000;">'.strtoupper($course).'&nbsp;&nbsp;</span></td>
                <td>Year :<span style="border-bottom:1px dashed #000;">.'.$yos.'&nbsp;&nbsp;</span></td>
                <td>Semester:<span style="border-bottom:1px dashed #000;">.'.strtoupper('semester '.$year->semester).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>
                </table>
                 <table style="margin:0; width:100%;" class="table table-bordered">
                <tr style="margin:0; width:100%;">
                <td style="width:40%;">Academic year:<span style="border-bottom:1px dashed #000;">'.$year->year.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                <td style="width:25%;">Department:<span style="border-bottom:1px dashed #000;">'.$minidp.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                <td style="width:35%;">Date:<span style="border-bottom:1px dashed #000;">'.date('d-m-Y').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                </tr>
                </table>
                <hr>
 '. implode($lists).'
        <p style="margin:0px;">Copy to</p>
         <p style="margin:0px;">The Registrar(ARO)</p>
         <p style="margin:0px;">The student should securely retain one copy of dully completed form</p>
         <hr>
       
         <p style="margin:0px;text-align:center;font:italic;">Home of Ideas</p>
       
</div>
    </body>
</html>';
        
    }
    
}
