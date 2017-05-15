@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if(Session::has('status'))
            <div class='alert-success' style="padding: 10px;">
                {{Session::get('status')}}
            </div>
            <br>
            @endif
          
        </div>
    </div>
       <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-warning">
                <div class="panel-heading">My Profile</div>
                <div class="panel-body">
                    <form action='{{url('/save/profile')}}' 
                          method="POST">
                        {{csrf_field()}}
                      
                        <label>First name</label>
                        <input name="first_name" class="form-control" value="{{auth()->user()->first_name}}"/>
                    <label>Last name</label>
                        <input name="last_name" class="form-control" value="{{auth()->user()->last_name}}"/>
                    <label>Mobile</label>
                        <input name="mobile" class="form-control" value="{{auth()->user()->mobile}}"/>
                        <br>
                        <button type='submit' class='btn btn-warning btn-sm'>Save Changes</button>
                    </form>
             </div>
            </div>
        </div>
    </div>
</div>
    
@endsection

