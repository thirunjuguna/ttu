@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            @if(Session::has('status'))
            <div class='alert-success' style="padding: 10px;">
                {{Session::get('status')}}
            </div>
            <br>
            @endif
            <div class="panel panel-warning">
                <div class="panel-heading">Department Settings</div>
                <div class="panel-body">
                    <form action='{{url('department/save')}}' 
                          method="POST">
                        {{csrf_field()}}
                        <?php $mini= \ttu\Department::all();?>
                        <label>Select Department</label>
                        @if($type=="student" || $type=="department")
                          <select id="department" class='form-control' name='department'>
                         
                            <option value='1'>ACADEMICS</option>
                            
                        </select>
                        @else
                        <select id="department" class='form-control' name='department'>
                          @foreach($mini as $min)
                            <option value='{{$min->id}}'>{{$min->department}}</option>
                            @endforeach
                        </select>
                        @endif
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
                        <label>Current Academic year</label>
                        <input name="current_year" class="form-control" value="{{\ttu\Year::all()->first()->year}}"/>
                        <br>
                        <button type='submit' class='btn btn-warning btn-sm'>Save Settings</button>
                    </form>
             </div>
            </div>
        </div>
    </div>
       <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-warning">
                <div class="panel-heading">My Profile</div>
                <div class="panel-body">
                    <form action='{{url('/save/profile')}}' 
                          method="POST">
                        {{csrf_field()}}
                      
                        <label>First name</label>
                        <input name="first_name" class="form-control" value="{{auth()->user()->first_name}}"/>
                    <label>Last name</label>
                        <input name="last_name" class="form-control" value="{{auth()->user()->last_name}}"/>
                    <label>Mobile</label>
                        <input name="mobile" class="form-control" value="{{auth()->user()->mobile}}"/>
                        <br>
                        <button type='submit' class='btn btn-warning btn-sm'>Save Changes</button>
                    </form>
                    <br>
             </div>
            </div>
        </div>
    </div>
</div>
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

