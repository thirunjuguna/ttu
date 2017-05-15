@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{url('select2.css')}}" />
<script src="{{url('select2.min.js')}}"></script>
       
<div class="container">
      
    <div class="row">
      <div class="col-md-12 col-md-offset-0">
          
            <div class="panel panel-warning">
                <div class="panel-heading">Record Claim</div>
               
               
                <div class="panel-body">
                        @if(Session::has('status'))
                    <div class='alert-success' style="padding: 10px;">{{Session::get('status')}}</div>
                    @endif
                    <form action="{{url('post/claim')}}" method="POST">
                        {{csrf_field()}}
                        <label>
                            Student
                            </label>
                                <?php $students= \ttu\User::all()
                                        ->where('level','STUDENT');
                                      ?>
                                <select  class=" select2 form-control" 
                                         data-show-subtext="true" data-live-search="true"
                                         name="reg">
                                    @foreach($students as $student)
                                    <option value="{{$student->reg}}">{{strtoupper($student->reg)}}</option>
                                    @endforeach
                                </select>
                        <p>if reg is not found above enter below</p>
                        <input class="form-control" name="reg2" placeholder="tu01-sc211-0134/2013"/>
                        <label>Remark</label>
                        <textarea placeholder="Remark" name="remark" class="form-control" rows="5" required></textarea>
                        <label>Fine</label>
                        <input name="fine" placeholder="Fine" class="form-control" required type="number" min="1"/>
                        <br>
                        <button class="btn btn-warning" type="submit">Record Claim</button>
                    </form>
             </div>
            </div>
        </div>
    </div>
</div>
@endsection