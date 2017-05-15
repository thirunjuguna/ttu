@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-warning">
                <div class="panel-heading">Courses <a href="#" data-toggle="modal" 
                                                      data-target="#addcourse" class="btn btn-warning btn-sm">Add Course</a></div>
                <div class="panel-body">
                    @if(Session::has('status'))
                    <div class='alert-success' style="padding: 10px;">{{Session::get('status')}}</div>
                    @endif
                    <table class="table">
                        <tr>
                            <td>#</td>
                            <td>Course</td>
                            <td>Actions</td>
                        </tr>
                        @foreach($courses as $course)
                          <tr>
                            <td>#{{$course->id}}</td>
                            <td>{{$course->course}}</td>
                            <td>
                              <button data-toggle="modal" 
                                                      data-target="#courseedit{{$course->id}}" class="btn btn-primary btn-sm">Edit</button>
                                  <!-- Modal -->
<div id="courseedit{{$course->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Course</h4>
      </div>
        <form 
            action="{{url('department/add/course/changes')}}"
            method="POST">
            {{csrf_field()}}
            <input name="id" type="hidden" value="{{$course->id}}"/>
      <div class="modal-body">
          <label>Course</label>
          <input required name="course" type="text" class="form-control" value="{{$course->course}}"/>
      </div>
      <div class="modal-footer">
               <button type="submit" 
                       class="btn btn-default" >Save Course</button>
     
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
        </form>
    </div>

  </div>
</div>
                         </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </di
</div>
    <!-- Modal -->
<div id="addcourse" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Course</h4>
      </div>
        <form 
            action="{{url('department/add/course')}}"
            method="POST">
            {{csrf_field()}}
      <div class="modal-body">
          <label>Course</label>
          <input required name="course" type="text" class="form-control"/>
      </div>
      <div class="modal-footer">
               <button type="submit" 
                       class="btn btn-default" >Submit Course</button>
     
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
        </form>
    </div>

  </div>
</div>
@endsection