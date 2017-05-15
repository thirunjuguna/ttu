@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-warning">
                <div class="panel-heading">Payment</div>
                <div class="panel-body">
                    @if(Session::has('status'))
                    <div class='alert-success' style="padding: 10px;">{{Session::get('status')}}</div>
                    <br>
                    @endif
                 
                   <img src="{{url('mpesa.png')}}" height="70"/>
            <p>1.Go to you MPESA menu</p>
              <p>2.Select lipa na MPESA</p>
                <p>3.Select Buy Goods and Services</p>
               <p>4.Enter TILL NUMBER 556555</p>
           <p>5.Enter the <b>amount eg.50</b> then you password</p>
                <p>You will receive a confirmation SMS with a verification code</p>
                    @if(Auth::guest())
                    @else
                    <form  class="form-inline" action="{{url('verify/payment')}}" method="POST">
                      {{csrf_field()}}
                        <input required placeholder="Enter verification Code" 
                               name="code" class="form-control"/><button style="margin: 2px;"
                               class="btn btn-warning">Verify</button>
                        
                    </form>
                    @endif
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection