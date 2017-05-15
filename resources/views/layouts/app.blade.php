<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'clearance') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/app.js') }}"></script>
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <style>
   body{
      background-image:url({{url('bg.jpg')}});
      background-repeat: no-repeat;
        width:100%;
        opacity:0.9; 
        background-size:cover;
       
    }
   
    
</style>
</head>
<body >
     <!-- Fixed navbar -->
 @if(Auth::guest())
 <nav class="navbar navbar-default navbar-fixed-top" >
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed"  style="background-color:#255625 !important;"
                  data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span style="background-color:#fff !important;" class="icon-bar"></span>
            <span  style="background-color:#fff !important;" class="icon-bar"></span>
            <span  style="background-color:#fff !important;" class="icon-bar"></span>
          </button>
          <a style='color:#255625;' class="navbar-brand" href="/">Clearance</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav" style='color:#255625;'>
            <li ><a href="/" style='color:#255625;'><i class="fa fa-home"></i> Home</a></li>
<!--            <li><a href="/about" style='color:#255625;'><i class="fa fa-info"></i> About</a></li>-->
            <li><a href="/contact" style='color:#255625;'> <i class="fa fa-comments-o"></i> Contact</a></li>
             <li><a style='color:#255625;' href="{{url('/student/departments/notifications')}}"> <i class="fa fa-bell"></i>Notifications</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                            
                            <li><a style='color:#255625;' href="{{ route('register') }}">  <i class="fa fa-plus"></i> Register</a></li>
                             <li><a style='color:#255625;' href="/user_guide"> <i class="fa fa-users"></i> User Guide</a></li>
            <li><a style='color:#255625;' href="http://www.ttu.ac.ke"> <i class="fa fa-globe"></i> Main Site</a></li>
         
                        @else
                           <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                               
                        @endif
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
 @else
@if(auth()->user()->level=="DEPARTMENT")
@include('department.menu')
@elseif(auth()->user()->level=="STUDENT")
@include('student.menu')
@elseif(auth()->user()->level=="ADMIN")
<!-------admin---------->
@include('admin.menu')
@else
@include('student.menu')
@endif
 @endif
     <div id="app" style="padding-top:15px; ">
        

        @yield('content')
        <br>
    </div>
 <?php 
    if(Auth::check()){
         if(auth()->user()->complete!=0){
    	$msg = '';
      if(auth()->user()-> verify_status != 1){
       
              $status='';
          
          $msg='<div class="navbar navbar-default navbar-fixed-bottom">
        <div class="navbar-inner">
            <div class="container">
<div class="col-md-8 col-md-offset-3 centr">
                       <b> Your phone number('.auth()->user()->mobile.') is not yet verified.'.$status.' <a href="" 
                           data-toggle="modal" data-target="#phoneverify" > Click here</a> to verify.</b>
                       
</div>
</div>
        </div>
    </div>';
          ?>
        <div id="phoneverify" class="modal fade" role="dialog">
  <div class="modal-dialog">
 <!-- Modal content--><div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Verify your phone number</h4>
      </div>
        <form action="{{url('verify/mobile')}}" method="POST">
            {{csrf_field()}}
      <div class="modal-body">
          <label>Verification code</label>
          <input name='code' class='form-control' required placeholder="Verification Code"/>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Verify</button>
        <a href="{{url('resend/code/')}}" class="btn btn-danger">Resend Code</a>
      </div>
        </form>
    </div>
 </div>
</div>
                <?php
  }
       
      	
      echo $msg;
         }
    }
    
  ?>
    <!-- Scripts -->

</body>

</html>
