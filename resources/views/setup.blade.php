@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Account SETUP</div>

                <div class="panel-body">
                    @if(Session::has('status'))
                    <div class='alert-success' style="padding: 10px;">{{Session::get('status')}}</div>
                    @endif
                    <form class='form-horizontal' action='{{url('account/set')}}' method="POST">
                        {{csrf_field()}}
                        <label> Please Select account type</label>
                        <select 
                            class='form-control' 
                            name='level' id="level">
                            <option>STUDENT</option>                            
                            <option>DEPARTMENT</option>
                        </select>
                        <label>Mobile</label>
                       
                        <input name="mobile" class="form-control" type="text"
                               required placeholder="0714876995"  maxlength="10" minlength="10"/>
                        <div class='student'>
                            <label>Registration no.</label>
                            <input name="reg" class='form-control' placeholder="TUO1-SC211-0134/2013" />
                          <label>Department</label>
                          <?php $dps= \ttu\Minidepartment::all();?>
                            <select 
                            class='form-control'   id='minidepartment'
                            name='minidepartment'>
                                @foreach($dps as $dp)
                            <option value="{{$dp->id}}">{{$dp->department}}</option> 
                            @endforeach
                            
                        </select>
                            <label>Course</label>
                            <?php $cs= \ttu\Course::all();?>
                        <select 
                            class='form-control' 
                            name='course' id="course">
                          
                        </select>
                       <label>Year of Study</label>
                       <input name='yos' class="form-control"  type="number" min='1' value="1"/>
                        
                    
                        </div>
                        <div class="department">
                             <label>Department</label>
                             <?php $dps= \ttu\Department::all();?>
                        <select 
                            class='form-control' 
                            name='department'>
                            @foreach($dps as $dp)
                            <option value="{{$dp->id}}">{{$dp->department}}</option> 
                            @endforeach
                        </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-warning">Proceed</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  
       var level=$('#level option:selected').val();
      
       $("#minidepartment").on('change',function(){
            var dp=$("#minidepartment option:selected").val();
           $.ajax({
                      type: 'GET',
                      //dataType: 'json',
                      url: '/mini/dp/',
                      data: {dp:dp},
                      success: function (resp) {
                            //$('#course').html('');
                          $('#course').html(resp);
                         
                             ///alert(resp);                              
                      }

                 });
       });
        var dp=$("#minidepartment option:selected").val();
        $.ajax({
                      type: 'GET',
                      //dataType: 'json',
                      url: '/mini/dp/',
                      data: {dp:dp},
                      success: function (resp) {
                        // $('#course').html('');
                          $('#course').html(resp);
                         
                                                           
                      }

                 });
       if(level=='STUDENT'){
          $('.student').removeClass('hide'); 
          $('.department').addClass('hide');
       }else{
            $('.student').addClass('hide'); 
          $('.department').removeClass('hide'); 
       }
    $('#level').on('change',function(){
          var level=$('#level option:selected').val();
       if(level=='STUDENT'){
          $('.student').removeClass('hide'); 
          $('.department').addClass('hide');
       }else{
            $('.student').addClass('hide'); 
          $('.department').removeClass('hide'); 
       }
    });
    </script>
@endsection
