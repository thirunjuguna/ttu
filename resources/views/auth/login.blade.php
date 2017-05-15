@extends('layouts.app')

@section('content')

<div class="container start" >
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-warning">
                <div class="panel-heading">Login <i class="fa fa-user"></i></div>
                <div class="panel-body" >
                     @if(Session::has('status'))
                    <div class='alert-success' style="padding: 10px;">{{Session::get('status')}}</div>
                    @endif
                    <form class="form-horizontal " style="margin:5px;" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">Email </label>

                          
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Password </label>

                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        

                        <div class="form-group">
                            
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                               
                            </div>
                        </div>

                        <div class="form-group">
                            
                                <button type="submit" class="btn btn-warning">
                                  <i class="fa fa-arrow-right"></i>  Login
                                </button>

                                <a class="btn btn-link" style='color:#255625;' href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            <br>
                              <br>  
                            <p>For New Users click <a href='{{url('register')}}'> <i class="fa fa-plus"></i> here</a> to register</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
