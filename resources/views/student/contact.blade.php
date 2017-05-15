@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-warning">
                <div class="panel-heading"><i class="fa fa-comments-o"></i> Contact</div>
                <div class="panel-body">
                 
                    <div class="overflow-y" style="height:250px;overflow-y:scroll; ">
                         @if($messages->count()>0)
                         @foreach($messages as $message)
                         @if($message->from_!=auth()->user()->id && $message->to_==auth()->user()->id)
                         <div class="alert-warning" style="padding: 10px;radius:7px;
                              -moz-border-radius: 7px;-webkit-border-radius: 7px;"><i class="fa fa-user"></i>FROM {{\ttu\Department::all()->find($message->dp)->department}} Department <br><i class="fa fa-comments-o"></i> {{$message->message}}<br><i class="fa fa-timer"></i> {{$message->created_at}}</div>
                             <br>
                         @else
                         <div class="alert-danger" style="padding: 10px;radius:7px;
                             -moz-border-radius: 7px;-webkit-border-radius: 7px;"><i class="fa fa-user"></i>TO {{\ttu\Department::all()->find($message->dp)->department}} Department <br><i class="fa fa-comments-o"></i> {{$message->message}}<br>{{$message->created_at}}</div>
                             <br>
                         @endif
                         @endforeach
                          
                         
                             @else
                                     <div class="alert-danger" style="padding: 10px;radius:7px;
                             -moz-border-radius: 7px;-webkit-border-radius: 7px;">No Messages Available</div>
                             @endif
                    </div>
                    <br>
                    <form class="form-horizontal" action="{{url('student/send/message')}}" method="POST">
                       {{csrf_field()}} 
                       <input name="from_" value="{{auth()->user()->id}}" type="hidden"/>
                        <?php $mini= \ttu\Department::all();?>
                        <label>Select Department</label>
                     
                        <select id="department" class='form-control' name='department'>
                          @foreach($mini as $min)
                            <option value='{{$min->id}}'>{{$min->department}}</option>
                            @endforeach
                        </select>
                     
                     <div class='academics hide'>
                     <label>Office</label>
                               <?php $mini= \ttu\Minidepartment::all();
                               $userdp= auth()->user();?>
                              <select class='form-control' name='office'>
                          @foreach($mini as $min)
                            <option @if($min->id==$userdp->minidp) selected @endif value='{{$min->id}}'>{{$min->department}}</option>
                            @endforeach
                        </select>
                             </div>
                     
                        <label>Message</label>
                       <textarea class="form-control" name="message" required placeholder="Enter Messaege"></textarea>
                       <br>
                       <button class="btn btn-warning btn-sm">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
  <script>
  
      
      
        var dp=$("#department option:selected").val();
        
       if(dp!='1'){
         
            $('.academics').addClass('hide'); 
        
       }else{
           $('.academics').removeClass('hide'); 
          
       }
     
    $('#department').on('change',function(){
         var dp=$("#department option:selected").val();
        
       if(dp=='1'){
          $('.academics').removeClass('hide'); 
        
       }else{
            $('.academics').addClass('hide'); 
          
       }
    });
    </script>
@endsection