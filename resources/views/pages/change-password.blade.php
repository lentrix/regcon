@extends('base')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card mt-3">
            <div class="card-header">
                <h3>Change Password</h3>
            </div>
            {!! Form::open(['url'=>'/change-password','method'=>'post']) !!}
            <div class="card-body">
                {!! Form::hidden('user_id', $user->id) !!}
                <div class="form-group">
                    {!! Form::label("password", "New Password*",['class'=>'form-label']) !!}
                    {!! Form::password("password", ["class"=>"form-control"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("password_confirmation", "Confirm New Password*",['class'=>'form-label']) !!}
                    {!! Form::password("password_confirmation", ["class"=>"form-control"]) !!}
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Change Password</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
