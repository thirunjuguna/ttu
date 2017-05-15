@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">About</div>
                <div class="panel-body">
                    @if(Session::has('status'))
                    <div class='alert-success' style="padding: 10px;">{{Session::get('status')}}</div>
                    @endif
                    <p>Clearance is a web-based data driven clearance systems 
                        that helps ease in clearing higher learning institutions</p>
                    <p>&copy; Clearance 2017</p>
                </div>
            </div>
        </div>
    </di
</div>

@endsection