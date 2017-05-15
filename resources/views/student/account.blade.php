@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-warning">
                <div class="panel-heading">{{strtoupper(auth()->user()->reg)}}</div>
                <div class="panel-body">
                    <p><span class="label label-primary">{{\ttu\Course::all()->find(auth()->user()->course)->course}}</span>&nbsp;
                       
                            &nbsp;<span class="label label-primary"> {{\ttu\Minidepartment::all()->find(auth()->user()->department)->department}}</span>
                        
                   </span> &nbsp; <span class="label label-success">BALANCE {{auth()->user()->balance}} KES</span>
                &nbsp;<button data-target="#clear_cert" data-toggle="modal" style="margin-top: 2px;" class="btn btn-warning btn-sm">Request Clearance</button>
                    </p>
                </div>
            </div>
        </div>
        @foreach($records as $record)
      @if($record->status==1)
                     <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-success">
                <div class="panel-heading">{{\ttu\Year::all()->find($record->year)->year}}&nbsp;SEMESTER {{\ttu\Year::all()->find($record->year)->semester}} 
                 </div>
                <div class="panel-body">
                    <span class='label label-success' style="padding: 10px;"><i class="fa fa-check"></i> CLEARED ALL DEPARTMENTS</span>
                       </div>
            </div>
        </div>
                   @else
                       <?php $remarks= \ttu\Remark::where('remarks.record',$record->id)
                               ->join('records','records.id','remarks.record')
                               ->join('departments','departments.id','remarks.dp')
                               ->select('remarks.id','remarks.remark','remarks.price'
                                       ,'remarks.status','remarks.dp','departments.department'
                                       ,'remarks.minidp','remarks.paid','remarks.created_at')
                               ->get();?>
          
                
                      <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-danger">
                <div class="panel-heading">{{\ttu\Year::all()->find($record->year)->year}}&nbsp;SEMESTER {{\ttu\Year::all()->find($record->year)->semester}} 
           </div>
                <div class="panel-body"> 
                    @foreach($remarks as $remark)
                    @if($remark->minidp=='')
                    <?php $minidp='';?>
                    @else
                   <?php $m=\ttu\Minidepartment::all()->find($remark->minidp);
                   $minidp=$m->department;
                   ?>
                    
                    @endif
                     <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-danger">
                <div class="panel-heading">{{$remark->department}} {{$minidp}}</div>
                <div class="panel-body">
                  
                   <table class='table table-bordered'>
                        <tr>
                           <td>{{$remark->remark}}</td>
                      
                          
                       </tr>
                   </table>
                   <div class='table-responsive'>
                   <table class='table table-bordered'>
                        <tr>
                           <td>Amount</td>
                      
                           <td>Status</td>
                           <td>Date Reported</td>
                           <td>Semester</td>
                           <td>Academic Year</td>
                       </tr>
                       <tr>
                           <td><span class='label label-primary'>{{$remark->price}} KSH</span></td>
                      
                           <td> @if($remark->paid==1) <span class='label label-success'>Paid</span>  @else <span class='label label-danger'>Not Paid</span> 
                               <a class="btn btn-success btn-sm" href="{{url('student/'.$remark->id.'/pay/claim')}}">Clear Now!</a>@endif</td>
                           <td>{{$remark->created_at}}</td>
                           <td>SEMESTER {{\ttu\Year::all()->find($record->year)->semester}}</td>
                           <td>{{\ttu\Year::all()->find($record->year)->year}}</td>
                       </tr>
                   </table>
                   </div>
                       </div>
            </div>
        </div>
                    @endforeach
                       </div>
            </div>
        </div>
                    @endif
             
        @endforeach
        <div class="container">
                  
        {{$records->links()}}
         
        </div>
        <br><br><br>
    </div>
</div>
<div id="clear_cert" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Request Clearance Certificate</h4>
      </div>
        <form 
            action="{{url('student/request/cert/')}}"
            method="POST">
            {{csrf_field()}}
    <div class="modal-body">
        <?php $years= \ttu\Year::all()->sortByDesc('status');;?>
          <label>Select Year</label>
          <select class="form-control" name="year">
              
              @foreach($years as $year)
              <option value="{{$year->id}}">{{$year->year}} Semester {{$year->semester}}</option>
              @endforeach
          </select>
      </div>
      <div class="modal-footer">
               <button type="submit" 
                       class="btn btn-warning btn-sm" >Request</button>
     
        <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
      </div>
        </form>
    </div>

  </div>
</div>
@endsection