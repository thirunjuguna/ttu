<?php

namespace ttu\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
         
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $dp=new Department();
        $dp->year_Checker();
        //////////////
        if(auth()->user()->complete==0){
            return redirect()->to('/account/setup');
        }elseif(auth()->user()->level=='STUDENT'){
            return redirect()->to('student/account');
        }elseif(auth()->user()->level=='DEPARTMENT'){
            if(auth()->user()->status==0){
                auth()->logout();
                return redirect('login')
                        ->with('status','Hello, your account '
                                . 'is not yet verified by the administrator');
            }
            //////////////
         
            /////////////////////////////
            if(auth()->user()->minidp==''){
                 return redirect()->to('department/settings');
            }
            /////
          
            return redirect()->to('department/account');
        }elseif (auth()->user()->level=="ADMIN") {
              return redirect()->to('administrator/account');
        }
        
        
        
        
    }
    public function setup(){
        $dp=new Department();
        $dp->year_Checker();
        return view('setup');
    }
}
