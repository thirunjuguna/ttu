<?php

namespace ttu\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Input;

class Department extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    public function edit_department(){
    $dp=\ttu\Department::all()->find(Input::get('id'));
    $dp->department= Input::get('dp');
    $dp->save();
    return redirect()
            ->back()
            ->with('status','Saved successfully');
}
public function notifications(){
        $notices= \ttu\Notice::orderBy('id','desc')
                ->where('dp',auth()->user()->department)
                ->paginate(15);
        return view('department.notification')->with('notices',$notices);
    }
public function bulk(){
        return view('department.bulk');
    }
public function messages(){
        if(auth()->user()->minidp!=''){
             $messages= \ttu\Message::where('dp',auth()->user()->department)
                     ->where('from_','!=',auth()->user()->id)
                     ->where('minidp',auth()->user()->minidp)->where('status','unread')
                     ->paginate(15);
        }else{
             $messages= \ttu\Message::where('dp',auth()->user()->department)
                     ->where('from_','!=',auth()->user()->id)
                     ->where('status','unread')
                     ->paginate(15);
        }
     
    return view('department.message')->with('messages',$messages);
}
public function addclaim(){
    return view('department.addclaim');
}
public function postcourse() {
        ///
        \ttu\Course::create([
            'mini_dp_id' => auth()->user()->minidp,
            'course' => \Illuminate\Support\Facades\Input::get('course')]);
        return redirect()->back()->with('status', 'Course added successfully');
    }



public function savecourse() {
        $course = \ttu\Course::all()
                ->find(\Illuminate\Support\Facades\Input::get('id'));
        $course->course = \Illuminate\Support\Facades\Input::get('course');
        $course->save();
        return redirect()->back()
                        ->with('status', 'Course updated successfully');
    }
public function account() {
        if (auth()->user()->minidp == '') {
            return redirect()->to('department/settings');
        }
        if(isset($_GET['reg'])){
//reg=&course=1&year=1
$this->year_Checker();
//
  $reg= Input::get('reg');
  $course= Input::get('course');
  $year= Input::get('year');
if($_GET['reg']==''){
    //course
    //year
      if (auth()->user()->minidp == '') {
            $students = \ttu\User::orderBy('reg', 'desc')
                    ->where('level', 'STUDENT')
                    //->where('reg', strtolower($reg))
                    ->where('course',$course)
                    ->where('year',$year)
                    ->Paginate(10);
        } else {
            $students = \ttu\User::orderBy('users.id', 'desc')
                    ->where('users.department', auth()->user()->department)
                    ->where('users.minidp', auth()->user()->minidp)
                   // ->where('reg', strtolower($reg))
                    ->where('users.course',$course)
                    ->where('users.yos',$year)
                    ->where('users.level', 'STUDENT')
                    ->join('departments', 'departments.id', 'users.department')
                    ->join('minidepartments', 'minidepartments.dp_id', 'users.minidp')
                    ->join('courses', 'courses.id', 'users.course')
                    ->select('users.id', 'users.reg', 'users.mobile', 'users.first_name', 'users.last_name', 'courses.course', 'users.yos', 'departments.department', 'minidepartments.department AS office')
                    ->Paginate(10);
        }
        
} else {
    //reg
     //course
    //year
    //get the students
        if (auth()->user()->minidp == '') {
            $students = \ttu\User::orderBy('reg', 'desc')
                    ->where('level', 'STUDENT')
                    ->where('reg', strtolower($reg))
                    ->where('course',$course)
                    ->where('year',$year)
                    ->Paginate(10);
        } else {
           $students = \ttu\User::orderBy('users.id', 'desc')
                    ->where('users.department', auth()->user()->department)
                    ->where('users.minidp', auth()->user()->minidp)
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

}

        }else{
           //get the students
        if (auth()->user()->minidp == '') {
            $students = \ttu\User::orderBy('reg', 'desc')->where('level', 'STUDENT')->Paginate(10);
        } else {
            $students = \ttu\User::orderBy('users.id', 'desc')
                    ->where('users.department', auth()->user()->department)
                    ->where('users.minidp', auth()->user()->minidp)
                    ->where('users.level', 'STUDENT')
                    ->join('departments', 'departments.id', 'users.department')
                    ->join('minidepartments', 'minidepartments.dp_id', 'users.minidp')
                    ->join('courses', 'courses.id', 'users.course')
                    ->select('users.id', 'users.reg', 'users.mobile', 'users.first_name', 'users.last_name', 'courses.course', 'users.yos', 'departments.department', 'minidepartments.department AS office')
                    ->paginate(15);
        }
 
            
        }
                ////
        // return $students;
        //get courses
        // $userdb= \ttu\Userdp::all()->where('user_id',auth()->user()->id)->first();
        $courses = \ttu\Course::all()->where('mini_dp_id', auth()->user()->minidp);
        //
        
        return view('department.account')
                        ->with('courses', $courses)
                        ->with('students', $students);
    }

public function courses() {
        if (auth()->user()->minidp == '') {
            return redirect()->to('department/settings');
        }
        $courses = \ttu\Course::orderBy('id', 'desc')
                        ->where('mini_dp_id', auth()->user()->minidp)->Paginate(15);
        return view('department.courses')->with('courses', $courses);
    }

public function settings() {
        $type = "department";
        if (auth()->user()->minidp == '' || auth()->user()->minido == '0') {
            return view("department.settings")
                            ->with('type', $type);
        } else {
            $department = \ttu\Department::all()->find(auth()->user()->minidp);
            return view("department.settings")
                            ->with('department', $department)
                            ->with('type', $type);
        }
    }
public function delete_not($id){
     \ttu\Notice::all()->find($id)->delete();
     return redirect()->back()->with('status','Notification has been deleted successfully');
 }
public function save_settings() {
        $user = \ttu\User::all()->find(auth()->user()->id);
        $user->department = \Illuminate\Support\Facades\Input::get('department');
        $user->minidp = \Illuminate\Support\Facades\Input::get('office');
        $user->save();

        return redirect('home');
    }
public function send_post_bulk(){
    $course= \Illuminate\Support\Facades\Input::get('course');
    $year= \Illuminate\Support\Facades\Input::get('year');
    $message= Input::get('message');
    if($course=='all' && $year=='all'){
        $users= \ttu\User::all()->where('level','STUDENT');
    }elseif($course=='all' && $year!='all'){
        ///all course but filter year
        $users=\ttu\User::all()->where('level','STUDENT')->where('yos',$year);
    }elseif($course!='all' && $year=='all'){
        ///filter course but all years
         $users=\ttu\User::all()->where('level','STUDENT')->where('course',$course);
    }else{
        ///filter course and year
          $users=\ttu\User::all()->where('level','STUDENT')
                  ->where('yos',$year)
                  ->where('course',$course);
    }
    if($users->count()>0){
        $sms=new SmsController();
                
        foreach($users as $user){
            $sms->SendSms($user->mobile, $message);
            
             \ttu\Message::create(['dp'=>auth()->user()->department,
                 'minidp'=>auth()->user()->minidp
        ,'from_'=>auth()->user()->id,'to_'=>$user->id,
         'message'=>$message,
         'status'=>'unread']);
        }
         return redirect()->back()->with('status','Message has been send Successfully');
    }else{
        return redirect()->back()->with('status','No student found under that filter');
    }
}
public function student_claim_post(){
    $fine= Input::get('fine');
    $remark= Input::get('remark');
    $student= Input::get('student');
    $student= \ttu\User::all()->find($student);
     $mobile=$student->mobile;
    $name=$student->first_name;
    ////check record table
    ///get year
    $year= \ttu\Year::all()->where('status',1)
            ->first()->id;
    $records= \ttu\Record::all()
            ->where('user_id',$student->id)
            ->where('year',$year);
    if($records->count()>0){
        $record= \ttu\Record::all()
            ->where('user_id',$student->id)
            ->where('year',$year)->first();
        $record->status=0;
        $record->save();
    }else{
        //create record
        \ttu\Record::create(['user_id'=>$student->id,
            'year'=>$year,
            'status'=>0]);
    }
    //we have reg
       $record_id= \ttu\Record::all()
            ->where('user_id',$student->id)
            ->where('year',$year)->first()->id;
       /////////////////
       \ttu\Remark::create(['record'=>$record_id,
           'price'=>$fine,
           'remark'=>$remark,
           'dp'=>auth()->user()->department,
           'minidp'=> auth()->user()->minidp,
           'year'=>$year,
           'status'=>0,
           'reg'=>'']);
       //////alert student
       $sms=new SmsController();
       $department= \ttu\Department::all()->find(auth()->user()->department);
       $message='Hello '.$name.', you have uncleared record with the '.$department->department.'  visit you clearance account to view the clearnce details';
       $sms->SendSms($mobile,$message);
       
       return redirect()->back()->with('status','Claim has been recorded successfully');
}
public function send_message(){
     $type= Input::get('msg_type');
     $to_=Input::get('to_');
     $message= Input::get('message');
     if($type="SMS"){
         $student= \ttu\User::all()->find($to_);
         $sms=new \ttu\Http\Controllers\SmsController();
         $sms->SendSms($student->mobile,$message);
     }else{
         if(isset($_POST['id'])){
              $m= \ttu\Message::all()->find(Input::get('id'));
     $m->status='read';
     $m->save();
         }
    
     
     }
     \ttu\Message::create(['dp'=>auth()->user()->department,'minidp'=>auth()->user()->minidp
        ,'from_'=>auth()->user()->id,'to_'=> Input::get('to_'),
         'message'=> Input::get('message'),
     'status'=>'unread']);
     return redirect()->back()->with('status','Message sent successfully');
 }
public function add_new_not(){
     $dp= auth()->user()->department;
     $notice= Input::get('message');
     \ttu\Notice::create(['dp'=>$dp,
         'notice'=>$notice]);
     return redirect()->back()->with('status','Notice has need created successfully');
 }
public function view_profile($id){
    $this->year_Checker();
     $id= base64_decode($id);
     $student= \ttu\User::all()->find($id);
     /////////////////////////////////////////
     $remarks=[];
     $records= \ttu\Record::all()->where('user_id',$id);
     if($records->count()>0){
         $recs=[];
         foreach ($records as $record){
             array_push($recs,$record->id);
         }
         ///////////////////////
        $myremarks= \ttu\Remark::all()->whereIn('record',$recs);
        foreach ($myremarks as $myremark){
            array_push($remarks,$myremark->id);
        }
     }
     //return $remarks;
     $recms= \ttu\Remark::all()->where('reg',$student->reg);
     foreach ($recms as $re){
         array_push($remarks, $re->id);
     }
    $remarks= \ttu\Remark::all()->whereIn('id', $remarks);
            
    $years= \ttu\Year::orderBy('status','desc')
            ->paginate(15);
    // $remarks= \ttu\Remark::all()->where('record', $records)
     
     ////////////////////////////
     return view('department.profile')
     ->with('student',$student)
             ->with('remarks',$remarks)
             ->with('years',$years);
 }
public function post_claim(){
     $reg= Input::get('reg');
     $reg2= Input::get('reg2');
     $remark= Input::get('remark');
     $fine= Input::get('fine');
     ////////////////
      $year= \ttu\Year::all()->where('status',1)
            ->first()->id;
    if($reg2!=''){
        // //check is the student is in the systems
        $students= \ttu\User::all()
                ->where('level','STUDENT')
                ->where('reg',$reg2);
        if($students->count()>0){
            //student present
            $student= \ttu\User::all()
                    ->where('level','STUDENT')
                    ->where('reg',$reg2)
                    ->first();
            if($student->reg!=''){
                $reg=$student->reg;
            }else{
                $reg=$reg2;
            }
        }else{
            ///student not there
            \ttu\Remark::create(['record'=>'NONE',
                'price'=>$file,
                'remark'=>$remark,
                'dp'=>auth()->user()->department,
                'minidp'=> auth()->user()->minidp,
                'year'=>$year,
                'status'=>0,
                'reg'=>$reg2]);
            return redirect()->back()->with('status','Claim has been recorded successfully');
        }
    }
        //reg2 empty
    $student=\ttu\User::all()
                    ->where('level','STUDENT')
                    ->where('reg',$reg)
                    ->first();
    $mobile=$student->mobile;
    $name=$student->first_name;
    ////check record table
    ///get year
    $year= \ttu\Year::all()->where('status',1)
            ->first()->id;
    $records= \ttu\Record::all()
            ->where('user_id',$student->id)
            ->where('year',$year);
    if($records->count()>0){
        $record= \ttu\Record::all()
            ->where('user_id',$student->id)
            ->where('year',$year)->first();
        $record->status=0;
        $record->save();
    }else{
        //create record
        \ttu\Record::create(['user_id'=>$student->id,
            'year'=>$year,
            'status'=>0]);
    }
    //we have reg
       $record_id= \ttu\Record::all()
            ->where('user_id',$student->id)
            ->where('year',$year)->first()->id;
       /////////////////
       \ttu\Remark::create(['record'=>$record_id,
           'price'=>$fine,
           'remark'=>$remark,
           'dp'=>auth()->user()->department,
           'minidp'=> auth()->user()->minidp,
           'year'=>$year,
           'status'=>0,
           'reg'=>'']);
       //////alert student
       $sms=new SmsController();
       $department= \ttu\Department::all()->find(auth()->user()->department);
       $message='Hello '.$name.', you have uncleared record with the '.$department.'  visit you clearnce account to view the clearnce details';
       $sms->SendSms($mobile,$message);
       
       return redirect()->back()->with('status','Claim has been recorded successfully');
    
 }

public function year_Checker(){
    ////pick users
   $users= \ttu\User::all()->where('level','STUDENT');
   $years= \ttu\Year::all();
   $years_id=[];
   foreach ($years as $year){
       array_push($years_id,intval($year->id));
   }
   $records_id_years=[];
    foreach ($users as $user){
    $records= \ttu\Record::all()->where('user_id',$user->id);
    foreach ($records as $record){
        array_push($records_id_years,intval($record->year));
    }
    
    /////////////
    foreach ($years_id as $id_year){
       if(!in_array($id_year,$records_id_years)){
           //return $id_year;
           ////record
           \ttu\Record::create(['user_id'=>$user->id,'year'=>$id_year,'status'=>1]);
       }
    }
    }
}
 
    }
