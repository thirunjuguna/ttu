@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
                                @if(Session::has('status'))
                    <div class='alert-success' style="padding: 10px">{{Session::get('status')}}</div>
                    <br>
                    @endif
            <div class="panel panel-default">
                <div class="panel-heading">Departments  <a href="#"
                                                             data-toggle="modal" 
                                                             data-target="#adddp" 
                                                             class='btn btn-warning btn-sm'>Add Department</a></div>
                <div class="panel-body">

                    <?php $dps= \ttu\Department::orderBy('id','desc')->Paginate(10);?>
                    <div class='table-responsive'>
                        @if($dps->count()>0)
                        <table class='table table-hover table-striped'>
                            <tr>
                                <td>#</td>
                                <td>Department</td>
                                <td></td>
                                <td></td>
                            </tr>
                           @foreach($dps as $dp)
                                                       <tr>
                                <td>#{{$dp->id}}</td>
                                <td>{{$dp->department}}</td>
                                     <td><a href="#" 
                                             data-toggle="modal" 
                                                             data-target="#dep{{$dp->id}}"
                                                             class="btn btn-warning">Edit</a>
                                     <div id="dep{{$dp->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Department</h4>
      </div>
        <form 
            action="{{url('admin/edit/department')}}"
            method="POST">
            {{csrf_field()}}
            <input name='id' type="hidden" value='{{$dp->id}}'/>
      <div class="modal-body">
          <label>Department</label>
          <input required name="dp"
                 type="text" value="{{$dp->department}}"
                 class="form-control" />
          
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
                                     </td>
                                 <td><a href="{{url('admin/department/dp/'.$dp->id.'/delete')}}" class="btn btn-danger">Delete</a></td>
                            
                            </tr>
                           @endforeach
                        </table>
                     {{$dps->links()}}
                        @else
                        <div class='alert-success' style="padding: 10px;">No Departments Available</div>
                        @endif
                    </div>
               </div>
            </div>
        </div>
</div>
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Office Departments  <a href="#"
                                                             data-toggle="modal" 
                                                             data-target="#addminidp" 
                                                             class='btn btn-warning btn-sm'>Add Office</a></div>
                <div class="panel-body">
                    <?php $dps= \ttu\Minidepartment::orderBy('id','desc')->Paginate(10);?>
                    <div class='table-responsive'>
                        @if($dps->count()>0)
                         <table class='table table-hover table-striped'>
                             <tr>
                                <td>#</td>
                                <td>Department</td>
                                <td>Office Department</td>
                                <td></td>
                                <td></td>
                            </tr>
                           @foreach($dps as $dp)
                                                       <tr>
                                <td>#{{$dp->id}}</td>
                                <td>{{\ttu\Department::all()
                                            ->find($dp->dp_id)
                                            ->department}}</td>
                                <td>{{$dp->department}}</td>
                                <td><a href="#" class="btn btn-warning" data-toggle="modal" 
                                                             data-target="#office{{$dp->id}}" >Edit</a>
                                                                            <div id="office{{$dp->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Office Department</h4>
            </div>
            <form 
                action="{{url('admin/edit/minidepartment')}}"
                method="POST">
                {{csrf_field()}}
                <div class="modal-body">
                    <input name='id' type="hidden" value='{{$dp->id}}'/>
                    <label>Department</label>
                    <?php $ds = \ttu\Department::all()->sortBy('department'); ?>
                    <select class='form-control' name='department'>
                        @foreach($ds as $d)
                        <option @if($d->id==$dp->department) selected @endif value='{{$d->id}}'>{{$d->department}}</option>
                        @endforeach
                    </select>
                    <label>office</label>
                    <input required name="dp" type="text" value='{{$dp->department}}' class="form-control" />

                </div>
                <div class="modal-footer">
                    <button type="submit" 
                            class="btn btn-default" >Save </button>
 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
</div>
                                </td>
                                 <td><a href="{{url('admin/department/minidp/'.$dp->id.'/delete')}}" class="btn btn-danger">Delete</a></td>
                           
           </tr>
                           @endforeach
                        </table>
                      {{$dps->links()}}
                        @else
                        <div class='alert-success' style="padding: 10px;">No Office Departments Available</div>
                        @endif
                    </div>
                    <br> <br> <br>
               </div>
            </div>
        </div>
</div>
</div>
@endsection
<div id="adddp" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Department</h4>
      </div>
        <form 
            action="{{url('admin/add/department')}}"
            method="POST">
            {{csrf_field()}}
            
      <div class="modal-body">
          <label>Department</label>
          <input required name="dp" type="text" class="form-control" />
          
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
<div id="addminidp" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Office Department</h4>
      </div>
        <form 
            action="{{url('admin/add/minidepartment')}}"
            method="POST">
            {{csrf_field()}}
            
      <div class="modal-body">
          <label>Department</label>
          <?php $dps=\ttu\Department::all()->sortBy('department');?>
          <select class='form-control' name='department'>
              @foreach($dps as $dp)
              <option value='{{$dp->id}}'>{{$dp->department}}</option>
              @endforeach
          </select>
          <label>office</label>
          <input required name="dp" type="text" class="form-control" />
          
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