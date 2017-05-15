@extends('layouts.app')

@section('content')
<div class="container">
      
    <div class="row">
      <div class="col-md-12 col-md-offset-0">
          
            <div class="panel panel-warning">
                <div class="panel-heading">Bulk Messaging</div>
              
               
                <div class="panel-body">
                    @if(session()->has('status'))
                    <div class='alert-success' style="padding: 10px;">{{session()->get('status')}}</div>
                    @endif
                    <form action="{{url('department/send/bulk')}}" method="POST">
                        {{csrf_field()}}
                        <?php 
                        if(auth()->user()->minidp==''){
                        $courses= \ttu\Course::all();}
                        else{
                             $courses= \ttu\Course::all()->where('mini_dp_id',auth()->user()->minidp);
                        }
?>
                        <label>Course
                        </label>
                        <select class="form-control" name="course">
                            <option class="all">All Courses</option>
                           @foreach($courses as $course)
                           <option value="{{$course->id}}">{{$course->course}}</option>
                            @endforeach
                        </select>
                        <label>Year of Study</label>
                        <select class="form-control" name="year">
                            <option value="all">All Years</option>
                            <option value="1">Year 1</option>
                             <option value="2">Year 2</option>
                              <option value="3">Year 3</option>
                               <option value="4">Year 4</option>
                                <option value="5">Year 5</option>
                        </select>
                        <label>Message</label>
                        <textarea class="form-control" name="message" rows="5"></textarea>
                        <br><button type="submit" class="btn btn-warning btn-sm">Send Message
                        </button>
                    </form>
             </div>
            </div>
        </div>
    </div>
</div>
@endsection