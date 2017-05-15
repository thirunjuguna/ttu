@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-warning">
                <div class="panel-heading">Approval Requests</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        @if($requests->count()>0)
                        <table class="table">
                            <tr>
                                <td>#</td>
                                <td>Level</td>
                                <td>First Name</td>
                                <td>Last Name</td>
                                <td>Mobile</td>
                                <td>Department</td>
                                <td></td>
                             
                           
                            </tr>
                            @foreach($requests as $student)
                            <?php $dp= \ttu\Department::all()->find($student->department);?>
                             <tr>
                                <td>#{{$student->id}}</td>
                                <td>{{strtoupper($student->level)}}</td>
                                <td>{{strtoupper($student->first_name)}}</td>
                                <td>{{strtoupper($student->last_name)}}</td>
                                <td>{{$student->mobile}}</td>
                                <td>
                                    {{$dp->department}}
                                </td>
                                
                                <td><a href="{{url('admin/approve/'.$student->id.'/id')}}" class="btn btn-success">Approve</a></td>
                               
                           
                            </tr>
                            @endforeach
                        </table>
                        {{$requests->links()}}
                        @else
                        <div class="alert-success" style="padding: 10px;">No requests found</div>
                        @endif
                         <br> <br>
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection