@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-warning">
                <div class="panel-heading">Transactions</div>
                <div class="panel-body">
                    <div class="table-responsive">
                      @if($trans->count()>0)
                      <table class="table">
                          <tr>
                              <td>#</td>
                              <td>Sender</td>
                              <td>To</td>
                              <td>Amount</td>
                              <td>Status</td>
                              <td>Action</td>
                          </tr>
                          
                          @foreach($trans as $tran)
                           <tr>
                              <td>#{{$tran->id}}</td>
                              <td>{{$tran->sender}}</td>
                              <td>{{$tran->to_}}</td>
                              <td>{{$tran->amount}}</td>
                              @if($tran->status==1)
                              <td>Expired</td>
                              @else
                              <td>Active</td>
                              @endif
                              @if($tran->status==1)
                              <td>Expired</td>
                              @else
                              <td><a href='{{url('admin/resend/'.$tran->id.'/code')}}' 
                                     class="btn btn-danger
                                     btn-sm">Resend Code</a></td>
                              @endif
                             
                          </tr>
                          @endforeach
                      </table>
                   {{$trans->links()}}
                      @else
                      <div class='alert-success' style="padding: 10px;">No Transactions</div>
                      @endif
                    </div>
                     <br> <br>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
