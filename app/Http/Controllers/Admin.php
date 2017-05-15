<?php

namespace ttu\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class Admin extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function account(){
        return redirect('admin/students');
    }
    public function delete_dp_admin($type,$id){
    //type minidp/dp
    if($type=='dp'){
        //check
        $users= \ttu\User::all()->where('department',$id);
   if($users->count()==0){
       $dp= \ttu\Department::all()->find($id)->delete();
       return redirect()->back()->with('status','Deleted successfully');
   }else{
       return redirect()->back()->with('status','Could not be deleted');
   }
        }else{
        //minidp
           //dp_id
            $users= ttu\User::all()->where('minidp',$id);
            if($users->count()>0){
                return redirect()
                        ->back()
                        ->with('status','Could not be deleted');
            }else{
                $d= \ttu\Minidepartment::all()
                        ->find($id)->delete();
                 return redirect()->back()->with('status','Deleted successfully');
            }
    }
    
}
    public function students(){
       
        if(isset($_GET['reg'])){
//reg=&course=1&year=1
//$this->year_Checker();
//
  $reg= Input::get('reg');
  $course= Input::get('course');
  $year= Input::get('year');
if($_GET['reg']==''){
    //course
    //year
    
            $students = \ttu\User::orderBy('users.id', 'desc')
                   // ->where('users.department', auth()->user()->department)
                   // ->where('users.minidp', auth()->user()->minidp)
                    //->where('reg', strtolower($reg))
                    ->where('users.course',$course)
                    ->where('users.yos',$year)
                    ->where('users.level', 'STUDENT')
                    ->join('departments', 'departments.id', 'users.department')
                    ->join('minidepartments', 'minidepartments.dp_id', 'users.minidp')
                    ->join('courses', 'courses.id', 'users.course')
                    ->select('users.id', 'users.reg', 'users.mobile', 'users.first_name', 'users.last_name', 'courses.course', 'users.yos', 'departments.department', 'minidepartments.department AS office')
                    ->Paginate(10);
        
        
} else {
    //reg
     //course
    //year
    //get the students
    
            $students = \ttu\User::orderBy('users.id', 'desc')
                    //->where('users.department', auth()->user()->department)
                    ///->where('users.minidp', auth()->user()->minidp)
                    ->where('users.reg', strtolower($reg))
                    ->where('users.course',$course)
                    ->where('users.yos',$year)
                    ->where('users.level', 'STUDENT')
                    ->join('departments', 'departments.id', 'users.department')
                    ->join('minidepartments', 'minidepartments.dp_id', 'users.minidp')
                    ->join('courses', 'courses.id', 'users.course')
                    ->select('users.id', 'users.reg', 'users.mobile', 'users.first_name', 'users.last_name', 'courses.course', 'users.yos', 'departments.department', 'minidepartments.department AS office')
                    ->Paginate(10);
        

}

        }else{
           //get the students
     
            $students = \ttu\User::orderBy('users.id', 'desc')
                    //->where('users.department', auth()->user()->department)
                    //->where('users.minidp', auth()->user()->minidp)
                    ->where('users.level', 'STUDENT')
                    ->join('departments', 'departments.id', 'users.department')
                    ->join('minidepartments', 'minidepartments.dp_id', 'users.minidp')
                    ->join('courses', 'courses.id', 'users.course')
                    ->select('users.id', 'users.reg', 'users.mobile', 'users.first_name', 'users.last_name', 'courses.course', 'users.yos', 'departments.department', 'minidepartments.department AS office')
                    ->Paginate(10);
        
 
            
        }
                ////
        // return $students;
        //get courses
        // $userdb= \ttu\Userdp::all()->where('user_id',auth()->user()->id)->first();
        $courses = \ttu\Course::all();
        //
        return view('admin.students')
                        ->with('courses', $courses)
                        ->with('students', $students);
      
    }
    public function add_office(){
        ///check
        $mn= \ttu\Minidepartment::all()->where('department', strtoupper(\Illuminate\Support\Facades\Input::get('dp')));
  if($mn->count()==0){
      //create
      $office= strtoupper(\Illuminate\Support\Facades\Input::get('dp'));
      $dp= \Illuminate\Support\Facades\Input::get('department');
      \ttu\Minidepartment::create(['dp_id'=>$dp,
          'department'=> strtoupper($office)]);
      return redirect()->back()->with('status','The office added successfully');
  }else{
      return redirect()->back()->with('status','The office already exists');
  }
        }
    public function add_department(){
        //check
        $dps= \ttu\Department::all()->where('department', strtoupper(\Illuminate\Support\Facades\Input::get('dp')));
        if($dps->count()==0){
            
        \ttu\Department::create(['department'=> strtoupper(\Illuminate\Support\Facades\Input::get('dp'))]);
     return redirect()->back()->with('status','Department added successfully');
        
        }else{
        return redirect()->back()->with('status','Department already exists');
    }    
        
    }
    public function departments(){
        return view('admin.departments');
    }

    public function year_status($year){
        $y= \ttu\Year::all()->find($year);
        $y->status=1;
        $y->save();
        
        $years= \ttu\Year::all()->where('id','!=',$year);
        foreach ($years as $yy){
            $yyy= \ttu\Year::all()->find($yy->id);
            $yyy->status=0;
            $yyy->save();
        }
        return redirect()->back();
    }
    public function settings(){
        return view('admin.settings');
    }
    public function years(){
        
        return view('admin.years');
    }
    public function approve_save($id){
        $user= \ttu\User::all()->find($id);
        $user->status=1;
        $user->save();
        return redirect()->back();
    }
    public function transactions(){
        $trans= \ttu\Transaction::orderBy('id','decs')->paginate(15);
        return view('admin.transactions')->with('trans',$trans);
    }
public function resend_code($id){
    $tr= \ttu\Transaction::all()->find($id);
    $rand= rand(1000,9999);
    $sms=new SmsController();
    $message='Hello,your clearance account MPESA '
            . 'payment verifcation code is '.$rand;
    $sms->SendSms($tr->sender, $message);
    $tr->code=$rand;
    $tr->save();
    return redirect()->back();
}
    public function post_year(){
        ///
        ////check
        $years= \ttu\Year::all()
                ->where('year', \Illuminate\Support\Facades\Input::get('year'))
                ->where('semester',\Illuminate\Support\Facades\Input::get('semester'));
        if($years->count()==0){
        \ttu\Year::create(['year'=> \Illuminate\Support\Facades\Input::get('year'),
            'semester'=> \Illuminate\Support\Facades\Input::get('semester'),
            'status'=>0]);
        return redirect()->back()->with('status','added successfully');
        }else{
            return redirect()->back()->with('status','The year is availble available');
        }
    }
    public function requests(){
        $requests= \ttu\User::orderBy('id','desc')
                ->where('status','0')->paginate(15);
        return view('admin.requests')->with('requests',$requests);
    }
    public function unpaid(){
         $paid= \ttu\Remark::orderBy('id','desc')->where('paid',0)->where('status','0')->paginate(15);
    
          return view('admin.unpaid')->with('paid',$paid);
    }
    public function report()
    {
       $paid= \ttu\Remark::orderBy('id','desc')->where('paid',0)->where('status','1')->paginate(15);
       // $unpaid= \ttu\Remark::orderBy('id','desc')->where('paid',0)->where('status','0')->get();
 return view('admin.report')->with('paid',$paid);//->with('unpaid',$unpaid);       
    }
}