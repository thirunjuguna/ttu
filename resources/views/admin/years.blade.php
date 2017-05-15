@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-warning">
                <div class="panel-heading">Academic Years <a href="#"
                                                             data-toggle="modal" 
                                                             data-target="#addyear" 
                                                             class='btn btn-warning btn-sm'>Add Year</a></div>
                <div class="panel-body">
                    <?php $years= \ttu\Year::orderBy('status','desc')->Paginate(15);?>
                    @if(Session::has('status'))
                    <div class='alert-success' style='padding: 10px;'>{{Session::get('status')}}</div>
                    @endif
                    <div class='table-responsive'>
                        @if($years->count()>0)
                    <table class='table'>
                        <tr>
                            <td>#</td>
                            <td>Year</td>
                            <td>Semester</td>
                            <td></td>
</tr>
@foreach($years as $year)
                       <tr>
                            <td>#{{$year->id}}</td>
                            <td>{{$year->year}}</td>
                            <td>{{$year->semester}}</td>
                            @if($year->status==0)
                            <td><a href="{{url('admin/'.$year->id.'/year')}}" 
                                   class='label label-danger'>Make ACTIVE </a></td>
                            @else
                             <td><a href="#" class='label label-success'>ACTIVE YEAR</a></td>
                             @endif
</tr>
@endforeach
                                </table>
                                        {{$years->links()}}
                        @else
                        <div class='alert-danger' style='padding:15px; '> No Academic years </div>
                        @endif
                        
                    </div>
                     <br> <br>
               </div>
            </div>
        </div>
    </di
</div>
@endsection
                    
                                  <!-- Modal -->
<div id="addyear" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Academic Year</h4>
      </div>
        <form 
            action="{{url('admin/add/year')}}"
            method="POST">
            {{csrf_field()}}
            
      <div class="modal-body">
          <label>Academic Year</label>
          <input required name="year" type="text" class="form-control" />
          <label>Semester</label>
          <select class='form-control' name='semester'>
              <option>1</option>
              <option>2</option>
          </select>
      </div>
      <div class="modal-footer">
               <button type="submit" 
                       class="btn btn-warning" >Save </button>
     
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
        </form>
    </div>

  </div>
</div>