<?php

namespace ttu\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Input;

class GeneralController extends Controller
{
    //
    
    
public function root_path () {
    return redirect('login');
}
public function user_guide(){
     return view('user_guide');
 }
 public function account_set(){
   $level= \Illuminate\Support\Facades\Input::get('level'); 
   $mobile= "254".substr(\Illuminate\Support\Facades\Input::get('mobile'),1);
   if($level=="STUDENT"){
       $reg= \Illuminate\Support\Facades\Input::get('reg');
       if($reg==""){
           return redirect()->back()->with('status','Please enter the registration number');
       }
   $minidepartment= \Illuminate\Support\Facades\Input::get('minidepartment');
    $course= \Illuminate\Support\Facades\Input::get('course');
   $yos= \Illuminate\Support\Facades\Input::get('yos');
   $user= \ttu\User::all()->find(auth()->user()->id);
   $user->level=$level;
   $user->reg=$reg;
   $user->mobile=$mobile;
   $user->department=$minidepartment;
   $user->course=$course;
   $user->yos=$yos;
   $user->complete=1;
   $user->save();
   }else{
      $department= \Illuminate\Support\Facades\Input::get('department'); 
       $user= \ttu\User::all()->find(auth()->user()->id);
   $user->level=$level;
 
   $user->mobile=$mobile;
   $user->department=$department;
  
   $user->complete=1;
   $user->status=0;
   $user->save();
   }
 // $sms=new SmsController();
  //$message="Hello ".auth()->user()->first_name." ,welcome to ttu clearnce.We embrace ICT at solving day-today challenges"
  $sms->SendSms($mobile, $message);
  
  return redirect('/home');
   
}
public function mini_dp(){
    $cs= \ttu\Course::all()
            ->where('mini_dp_id', \Illuminate\Support\Facades\Input::get('dp'));
    $courses=[];
    foreach ($cs as $c){
        $option="<option value='".$c->id."'>".$c->course."</option>";
        array_push($courses, $option);
    }
    return implode($courses);
}
public function save_profile(){
    $user= \ttu\User::all()->find(auth()->user()->id);
    $user->first_name= \Illuminate\Support\Facades\Input::get('first_name');
    $user->last_name= Input::get('last_name');
    $user->mobile= Input::get('mobile');
    $user->save();
    return redirect()->back()->with('status','Profile have been saved successfully');
}
public function edit_mini(){
    $mini= \ttu\Minidepartment::all()
            ->find(Input::get('id'));
    $mini->dp_id= Input::get('department');
    $mini->department= Input::get('dp');
    $mini->save();
    return redirect()->back()->with('status','Saved Successfully');
}
public function register(){
   $first_name= \Illuminate\Support\Facades\Input::get('first_name');
   $last_name= \Illuminate\Support\Facades\Input::get('last_name');
   $email= \Illuminate\Support\Facades\Input::get('email');
   $password= \Illuminate\Support\Facades\Input::get('password');
   $password_confirm= \Illuminate\Support\Facades\Input::get('password_confirm');
   
   ///////////////////
   //match paass
    ///
      $data=[
               'first_name'=>$first_name,
               'last_name'=>$last_name,
               'email'=>$email,
       'password'=> bcrypt($password),
          'level'=>''
       
               ];  
      
               \ttu\User::create($data);
               ///login user
               \Illuminate\Support\Facades\Auth::attempt(['email'=>$email,'password'=>$password]);
               return redirect()->to('account/setup');

           
}
public function mpesa(){
        ////this function gets the variable from kopokopo
    $data= \Illuminate\Support\Facades\Input::json()->all();
    ///generate verify code
    $gen_code= rand(1000,9999);
    \globalfg\Transaction::create([
        'sender'=>substr($data['sender_phone'],1),
        'to_'=>'',
        'amount'=>$data['amount'],
        'status'=>'0',
        'code'=>$gen_code
      ]);
          ////send verify code to sender
         $sms=new SmsController();
         $sms->SendSms(substr($data['sender_phone'],1),'Hello '.$data['first_name'].',your clearance account MPESA payment verifcation code is '.$gen_code);
    return 'sent';
}
}
