@extends('layouts.app')

@section('content')
<div class="container">
      
    <div class="row">
      <div class="col-md-12 col-md-offset-0">
            <h2 style='color:#255625;'>Administrator</h2>
            <h4 style='color:#255625;'>logged in as <span class="label label-primary">{{auth()->user()->first_name}}</span></h4>
            <div class="panel panel-warning">
                <div class="panel-heading">STUDENTS</div>
               
                <div class="panel-body">
                     <div class="table-responsive">
                      
                     <br>
                <form >
                    <table class="table table-borderless">
                        <tr>
                            <td> <label>Regno.</label></td>
                            <td> <label>Course</label></td>
                            <td>  <label>Year</label></td>
                            <td></td>
                        </tr>
                           <tr>
                            <td>  <input name="reg" class="form-control" placeholder="TU01-SC211-0134/2013"/>
                   </td>
                            <td> <select name="course" class="form-control">
                        @foreach($courses as $course)
                        <option value="{{$course->id}}">{{$course->course}}</option>
                        @endforeach
                    </select></td>
                            <td>  <select name="year" class="form-control">
                        <option value="1">Year 1</option>
                         <option value="2">Year 2</option>
                          <option value="3">Year 3</option>
                           <option value="4">Year 4</option>
                            <option value="5">Year 5</option>
                    </select></td>
                            <td> <button class="btn btn-warning" name='sort' type="submit">Sort</button></td>
                            
                        </tr>
                    </table>
                   
                   
                   
                </div>
                   
                   
                </form>
                     
                     <!------------>
                     @if($students->count()>0)
                     <div class="table-responsive">
                         <table class="table">
                             <tr>
                                 <td>#reg</td>
                                 <td>Name</td>
                                 <td>YoS</td>
                                 <td>Course</td>
                                 <td>Mobile</td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                             </tr>
                             @foreach($students as $student)
                               <tr>
                                 <td>{{strtoupper($student->reg)}}</td>
                                 <td>{{strtoupper($student->first_name)}} {{strtoupper($student->last_name)}}</td>
                                 <td>{{strtoupper($student->yos)}} year</td>
                                 <td>{{strtoupper($student->course)}}</td>
                                 <td>{{strtoupper($student->mobile)}}</td>
                                 <td><button data-toggle="modal" data-target="#student{{$student->id}}claim" class="btn btn-primary btn-sm">Add Claim</button></td>
                                 <td><button  data-toggle="modal" data-target="#student{{$student->id}}chat" class="btn btn-primary btn-sm">Send Message</button></td>
                                 <td><a href="{{url('/department/account/'.base64_encode($student->id).'/view/profile')}}"
                                        class="btn btn-warning btn-sm">View Profile</a></td>
                                           <div id="student{{$student->id}}chat" class="modal fade" role="dialog">
  <div class="modal-dialog">
 <!-- Modal content--><div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Send Message</h4>
      </div>
        <form action="{{url('/send/message')}}" method="POST">
            {{csrf_field()}}
            <input name='to_' type="hidden" value='{{$student->id}}'/>
      <div class="modal-body">
          <label>Message type</label>
          <select class="form-control" name="msg_type" >
              <option>DIRECT MESSAGE</option>
              <option>SMS</option>
          </select>
          <br>
          <label>Message</label>
          <textarea class="form-control" name="message" rows="5"></textarea>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Send Message</button>
        
      </div>
        </form>
    </div>
 </div>
</div>                                     <div id="student{{$student->id}}claim" class="modal fade" role="dialog">
  <div class="modal-dialog">
 <!-- Modal content--><div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Record Claim</h4>
      </div>
        <form action="{{url('record/claim/student')}}" method="POST">
            {{csrf_field()}}
      <div class="modal-body">
         
          <input name='student' class='form-control' type="hidden"  value="{{$student->id}}"/>
          <label>Fine(KES)</label>
          <input name="fine" class="form-control" required placeholder="10" type="number" min="1"/>
          <label>Remark</label>
          <textarea required class="form-control" name="remark" rows="5"></textarea>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Record</button>
       
      </div>
        </form>
    </div>
 </div>
</div>
                             </tr>
                             @endforeach
                         </table>
                         {{$students->links()}}
                     </div>
            @else
            <div class='alert-success' style="padding: 10px;">No students found</div>
            @endif
             </div>
            </div>
        </div>
    </div>
</div>
@endsection