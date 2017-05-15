@extends('layouts.app')

@section('content')
<div class="container">
      
    <div class="row">
      <div class="col-md-12 col-md-offset-0">
          
            <div class="panel panel-warning">
                <div class="panel-heading">Notifications <button 
                        class="btn btn-warning btn-sm" data-target="#new_not"
                        data-toggle="modal">New Notification</button></div>
               
               
                <div class="panel-body">
                    @if(session()->has('status'))
                    <div class='alert-success' style="padding:10px;">{{session()->get('status')}}</div>
              
                <br>@endif
                    @if($notices->count()>0)
                    @foreach($notices as $notice)
                
      <div class="col-md-12 col-md-offset-0">
          
            <div class="panel panel-warning">
                <div class="panel-heading">Created {{$notice->created_at}} <a href="{{url('department/notification/'.$notice->id.'/delete')}}" class="btn btn-danger btn-sm">Delete</a></div>
               
               
                <div class="panel-body">
                        {{$notice->notice}}
             </div>
            </div>
        </div>
    
                    
                    @endforeach
                    {{$notices->links()}}
                    @else
                     <div class='alert-success' style="padding:10px;">No Notifications Available</div>
                   
                    @endif
             </div>
            </div>
        </div>
    </div>
</div>
                                 <div id="new_not" class="modal fade" role="dialog">
  <div class="modal-dialog">
 <!-- Modal content--><div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Notification</h4>
      </div>
        <form action="{{url('add/new/not')}}" method="POST">
            {{csrf_field()}}
      <div class="modal-body">
         
         
          <label>Notification Message</label>
          <textarea class="form-control" required name="message" rows="5"></textarea>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning">Save Notification</button>
        
      </div>
        </form>
    </div>
 </div>
</div> 
@endsection