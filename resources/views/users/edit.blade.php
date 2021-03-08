@extends('base')

@section('content')

<div class="row">

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3>Edit Profile</h3>
            </div>
            <div class="card-body">
                {!! Form::model($user, ['url'=>"/user/edit/$user->id", 'method'=>'post']) !!}

                <div class="form-group">
                    {!! Form::label('lname', "Last Name*", ['class'=>'form-label']) !!}
                    {!! Form::text('lname', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('fname', "First Name*", ['class'=>'form-label']) !!}
                    {!! Form::text('fname', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('phone', "Phone Number", ['class'=>'form-label']) !!}
                    {!! Form::text('phone', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('designation', "Designation*", ['class'=>'form-label']) !!}
                    {!! Form::text('designation', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('school', "School/Organization*", ['class'=>'form-label']) !!}
                    {!! Form::text('school', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-lg" type="submit">
                        <i class="fa fa-save"></i> Update Profile
                    </button>
                    <a href="{{url('/')}}" class="btn btn-success btn-lg">Cancel</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

</div>

@endsection
