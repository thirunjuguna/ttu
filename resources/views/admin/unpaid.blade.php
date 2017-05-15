@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Payment Reports <a href="{{url('/admin/finance/report/')}}" class='btn btn-warning btn-sm'>Paid Claims</a></div>
                <div class="panel-body">
                    <div class="table-responsive">
                     @if($paid->count()>0)
                     <h4> Total Amount Unpaid {{\ttu\Remark::all()->where('paid',0)->where('status','0')->sum('price')}} KSH</h4>
                     <table class="table">
                         <tr>
                             <td>#</td>
                             <td>Student</td>
                             <td>Fine</td>
                             <td>Department</td>
                             <td>Reported at</td>
                             <td>Status</td>
                         </tr>
                         @foreach($paid as $p)
                         <tr>
                             <td>#{{$p->id}}</td>
                             @if($p->record=='')
                               <td>{{strtoupper($p->reg)}}</td>
                             @else
                           <?php $record= \ttu\Record::all()->find($p->record)->user_id;
                           $user= \ttu\User::all()->find($record)->reg;?>
                              <td>{{strtoupper($user)}}</td>
                             @endif
                             <td>{{$p->price}} KSH</td>
                             <?php $d= \ttu\Department::all()->find($p->dp);?>
                             <td>{{$d->department}}</td>
                             <td>{{$p->created_at}}</td>
                             @if($p->status=='1')
                               <td><span class="label label-success">Cleared</span></td>
                            
                             @else
                             <td><span class="label label-warning">Not Cleared</span></td>
                             @endif
                             
                         </tr>
                         @endforeach
                         
                     </table>
                     {{$paid->links()}}
                     @else
                     <div class="alert-success" style="padding: 10px;">No Unpaid Claims</div>
                     @endif
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection