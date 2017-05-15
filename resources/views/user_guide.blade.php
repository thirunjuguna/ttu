@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">User Guide</div>
                <div class="panel-body">
                    @if(Session::has('status'))
                    <div class='alert-success' style="padding: 10px;">{{Session::get('status')}}</div>
                    @endif
                    <p>Below is a guide on how to register how an account with online clearance</p>
                    <h4>STEP 1.</h4>
                    <p>Click register on the menu</p>
                    <img src="{{url('1.png')}}"  width="100%"/>
                     <h4>STEP 2.</h4>
                    <p>Fill in your detail and Click register</p>
                    <img src="{{url('2.png')}}"  width="100%"/>
                     <h4>STEP 3.</h4>
                    <p>Complete your account setup and click proceed</p>
                    <img src="{{url('3.png')}}"  width="100%"/>
                     <h4>STEP 4.</h4>
                    <p>Finally updated your department details and Click save changes</p>
                    <img src="{{url('4.png')}}"  width="100%"/>
                </div>
            </div>
        </div>
    </di
</div>

@endsection
