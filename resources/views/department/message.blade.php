@extends('layouts.app')

@section('content')
<div class="container">
      
    <div class="row">
      <div class="col-md-12 col-md-offset-0">
          
            <div class="panel panel-warning">
                <div class="panel-heading">Messages Inbox</div>
               
               
                <div class="panel-body">
                    @if($messages->count()>0)
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>#</td>
                                <td>From</td>
                                <td>Status</td>
                                <td>Action</td>
                                <td>Created _at</td>
                            </tr>
                    @foreach($messages as $message)
                    <?php $student= \ttu\User::all()->find($message->from_);?>
                      <tr>
                                <td>#{{$message->id}}</td>
                                <td>{{strtoupper($student->reg)}}</td>
                                <td><span class="label label-success">unread</span></td>
                                <td><a href="#" data-target="#reply{{$message->id}}" data-toggle="modal">View Message</a></td>
                                
                                <td>{{$message->created_at}}</td>
                                 <div id="reply{{$message->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
 <!-- Modal content--><div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Send Message</h4>
      </div>
        <form action="{{url('send/message')}}" method="POST">
            {{csrf_field()}}
      <div class="modal-body">
          <input name="to_" type="hidden" value="{{$message->from_}}"/>
          <input name="id" type="hidden" value="{{$message->id}}"/>
          <p>{{$message->message}}</p>
          <label>Message type</label>
          <select class="form-control" name="msg_type" >
              <option>DIRECT MESSAGE</option>
             
          </select>
          <br>
          <label>Message</label>
          <textarea class="form-control" required name="message" rows="5"></textarea>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning">Send Message</button>
        
      </div>
        </form>
    </div>
 </div>
</div>  
                            </tr>
                    @endforeach
                        </table>
                        {{$messages->links()}}
                    </div>
                    @else
                    <div class="alert-success" style="padding: 10px;">No Messages  Available</div>
                    @endif
             </div>
            </div>
        </div>
    </div>
</div>
@endsection

  