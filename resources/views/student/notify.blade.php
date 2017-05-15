@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-warning">
                <div class="panel-heading">Notifications</div>
                <div class="panel-body">
                    @if(Session::has('status'))
                    <div class='alert-success' style="padding: 10px;">{{Session::get('status')}}</div>
                    @endif
               <?php $dps= \ttu\Department::Paginate(2);?>
                    @foreach($dps as $dp)
                       <div class="panel panel-warning">
                <div class="panel-heading">{{$dp->department}}</div>
                <div class="panel-body">
                 <?php $nots= \ttu\Notice::all()->where('dp',$dp->id);?>
                    @if($nots->count()>0)
                    @foreach($nots as $not)
                    <div class="blockquote">{{$not->notice}}</div>
                    <hr>
                    @endforeach
                    
                    @else
                    <div class="alert-success" style="padding: 15px;">No Notifications Available</div>
                    @endif
               
                </div>
            </div>
                    @endforeach
                    {{$dps->links()}}
                </div>
            </div>
        </div>
    </di
</div>

@endsection