@if($convention)
<div class="d-flex justify-content-between align-items-stretch">
    <div class="alert alert-info mb-0" style="width:48%;">
        You are not yet registered as a participant to the
        {{$convention->title}}. If you have already made payment,
        please fill up the following form to verify your payment of the convention
        fee so that we can add you to the list of participants. Thank you!
    </div>
    <div class="card" style="width: 49%">
        <div class="card-header bg-info">
            <h5>Proof of Payment</h5>
        </div>
        <div class="card-body">
            {!! Form::open(['url'=>'/submit-proof-of-payment','enctype'=>'multipart/form-data']) !!}

            <div class="form-group">
                {!! Form::label('payment_amount', "Amount Paid") !!}
                {!! Form::text('payment_amount', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('payment_channel', "Payment Channel") !!}
                {!! Form::text('payment_channel', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('file', 'Proof of payment') !!}
                {!! Form::file('file',['style'=>'display:block']) !!}
            </div>

            <div class="form-group">
                <button class="btn btn-primary">
                    &nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;
                </button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endif
