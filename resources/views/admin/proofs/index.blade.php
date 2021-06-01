@extends('base')


@section('content')

<div class="modal fade" id="verifyModal" tabindex="-1" aria-labelledby="verifyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="verifyModalLabel">Verify Proof of Payment</h5>
          <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['method'=>'post','id'=>'form']) !!}
        <div class="modal-body">
            <h5>Verify Payment</h5>
            <p>Confirm verification of the following proof of payment.</p>
            <table class="table table-striped">
                <tr><td>Name</td><td><span id="user-name"></span></td></tr>
                <tr><td>School</td><td><span id="school"></span></td></tr>
                <tr><td>Amount Paid</td><td><span id="amount"></span></td></tr>
                <tr><td>Payment Channel</td><td><span id="channel"></span></td></tr>
            </table>
            <input type="hidden" name="user_id" id="user_id">
            <input type="hidden" name="amount" id="amount-input">
            <input type="hidden" name="channel" id="channel-input">
            <img alt="proof of payment" id="proof-image" style="width: 100%">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Verify Payment</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>

<div class="row">
    <div class="col-md-5 offset-md-7">
        <nav aria-label="breadcrumb" style="float: right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Proofs of Payment</li>
            </ol>
        </nav>
    </div>
</div>

@if(count($unverified)>0)
    <h4>Unverified Proofs of Payment</h4>
    <table class="table table-strip">
        <tr>
            <th>User</th>
            <th>Institution</th>
            <th>Amount Paid</th>
            <th>Payment Channel</th>
            <th>Date submitted</th>
        </tr>
        @foreach($unverified as $upr)
        <tr>
            <td>{{$upr->user->lname}}, {{$upr->user->fname}}</td>
            <td>{{$upr->user->school}}</td>
            <td>{{$upr->payment_amount}}</td>
            <td>{{$upr->payment_channel}}</td>
            <td>
                {{$upr->created_at->toFormattedDateString()}}
                <button
                    class="btn btn-secondary btn-sm float-right verify"
                    data-proof-id="{{$upr->id}}"
                    data-user-id="{{$upr->user->id}}"
                    data-user-name="{{$upr->user->lname}}, {{$upr->user->fname}}"
                    data-school="{{$upr->user->school}}"
                    data-amount="{{$upr->payment_amount}}"
                    data-channel="{{$upr->payment_channel}}">
                    <i class="fa fa-check-square"></i> Verify
                </button>
            </td>
        </tr>
        @endforeach
    </table>
@endif

@if(count($verified)>0)
    <h4>Verified Proofs of Payment</h4>
    <table class="table table-strip">
        <tr>
            <th>User</th>
            <th>Institution</th>
            <th>Amount Paid</th>
            <th>Payment Channel</th>
            <th>Date submitted</th>
        </tr>
        @foreach($verified as $upr)
        <tr>
            <td>{{$upr->user->lname}}, {{$upr->user->fname}}</td>
            <td>{{$upr->user->school}}</td>
            <td>{{$upr->payment_amount}}</td>
            <td>{{$upr->payment_channel}}</td>
            <td>
                {{$upr->created_at->toFormattedDateString()}}
            </td>
        </tr>
        @endforeach
    </table>
@endif


@endsection


@section('scripts')

<script>
    $(document).ready(function(){
        $(".verify").click(function(){
            var userId = $(this).data('user-id')
            var userName = $(this).data('user-name')
            var school = $(this).data('school')
            var amount = $(this).data('amount')
            var channel = $(this).data('channel')
            var proofId = $(this).data('proof-id')

            $("#user-name").text(userName)
            $("#user_id").val(userId)
            $("#school").text(school)
            $("#amount").text(amount)
            $("#amount-input").val(amount)
            $("#channel").text(channel)
            $("#channel-input").val(channel)
            $("#form").attr('action', '/admin/verify-proof/' + proofId)
            $("#proof-image").attr('src','/upload/proofs/' + proofId + ".jpg")

            $("#verifyModal").modal('show')
        })

        $(".close-modal").click(function(){
            $("#verifyModal").modal('hide')
        })
    })
</script>

@endsection
