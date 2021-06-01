@extends('base')

@section('content')

<h1>Create Convention</h1>

<div class="row">

    <div class="col-md-6">
        {!! Form::open(['url'=>'/admin/convention', 'method'=>'post']) !!}

        <div class="form-group">
            {!! Form::label('title', "Title") !!}
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('host_school', "Hosted by") !!}
            {!! Form::text('host_school', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('chairman', "Convention Chair") !!}
            {!! Form::text('chairman', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('venue', "Venue") !!}
            {!! Form::text('venue', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('schedule', "Schedule") !!}
            {!! Form::text('schedule', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('theme', "Theme") !!}
            {!! Form::text('theme', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> Create Convention
            </button>
        </div>

        {!! Form::close() !!}
    </div>

</div>

@endsection
