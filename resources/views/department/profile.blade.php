@extends('layouts.app')

@section('content')
<div class="container">
      
    <div class="row">
      <div class="col-md-12 col-md-offset-0">
           <h2 style='color:#255625;'>{{strtoupper($student->first_name)}} {{strtoupper($student->last_name)}} </h2>
            <h4 style='color:#255625;'>{{strtoupper($student->reg)}}</h4>
         
                @if($years->count()>0)
                
                @foreach($years as $year)
                <?php $re= ttu\Remark::all()->where('year',$year->id);?>
               
                <br>
                 <div class="col-md-12 col-md-offset-0">
          
            <div class="panel panel-warning">
                <div class="panel-heading">YEAR {{strtoupper($year->year)}} SEMESTER {{strtoupper($year->semester)}} </div>
               <div class="panel-body">
               
               
                @foreach($remarks as $remark)
                <?php $dp= \ttu\Department::all()
                        ->find($remark->dp);?>
                @if($year->id==$remark->year)
                  <div class="col-md-12 col-md-offset-0">
                      @if($remark->status==1)
            <div class="panel panel-success">
                @else
                            <div class="panel panel-danger">
                @endif
                <div class="panel-heading">{{strtoupper($year->year)}} SEMESTER {{strtoupper($year->semester)}} </div>
                <div class="panel-body">
                  @if($remark->status==1)
                  <div class='alert-success' style="padding: 10px;">CLEARED</div>
                @else
                <h5>{{$dp->department}}</h5>
                <h5>Date {{$remark->created_at}}</h5>   
                <h5>Fine {{$remark->price}} KES</h5>
                <p>{{$remark->remark}}</p>
                @endif
                </div>
            </div>
        </div>
                @endif
                
                @endforeach
               @if($re->count()==0)
                  <div class="alert-success" 
                       style="padding: 10px;">Cleared</div>
               @endif
             </div>
            </div>
        </div>
                     
                @endforeach
                @else
                <div class="alert-success" style="padding: 10px;">No Data available</div>
                @endif
                
                {{$years->links()}}
             </div>
           
    </div>
</div>
@endsection