@extends('base')

@section('content')

<div class="row">
    <div class="col-md-7">
        <h1>
            Administration | Bulk Mailer
        </h1>
    </div>
    <div class="col-md-5">
        <nav aria-label="breadcrumb" style="float: right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Bulk Mailer</li>
            </ol>
        </nav>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-md-7">
        {!! Form::open(['/admin/bulk-mail', 'method'=>'post']) !!}

        <div class="form-group">
            {!! Form::label('recipient', 'Select Recipient') !!}
            {!! Form::select('recipient', [
                'all' => 'All Users',
                'nonparticipants' => 'Non-participants',
                'participants' => 'Participants'
            ], null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('subject', 'Subject') !!}
            {!! Form::text('subject', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('message', 'Message') !!}
            {!! Form::textarea('message', null, ['class'=>'form-control','id'=>'message', 'rows'=>7]) !!}
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Send Mail</button>
        </div>
        {!! Form::close() !!}

    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
CKEDITOR.replace( 'message' );
</script>
@endsection
