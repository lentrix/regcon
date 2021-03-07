@extends('base')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Registration Form</h3>
            </div>
            <div class="card-body">
                {!! Form::open(['url'=>'/register', 'method'=>'post']) !!}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('email', 'Email',['class'=>'form-label']) !!}
                            {!! Form::email('email', null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('lname', 'Last Name',['class'=>'form-label']) !!}
                            {!! Form::text('lname', null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('fname', 'First Name',['class'=>'form-label']) !!}
                            {!! Form::text('fname', null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('school', 'School/Company',['class'=>'form-label']) !!}
                            {!! Form::text('school', null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('designation', 'Designation',['class'=>'form-label']) !!}
                            {!! Form::text('designation', null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('phone', 'Mobile Number',['class'=>'form-label']) !!}
                            {!! Form::text('phone', null, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('password', 'Password',['class'=>'form-label']) !!}
                            {!! Form::password('password', ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password_confirmation', 'Confirm Password',['class'=>'form-label']) !!}
                            {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <button class="btn btn-lg btn-primary float-right">
                                <i class="fa fa-check"></i>
                                Register
                            </button>
                        </div>
                        <p>
                            Already have an account? <br>
                            <a href="{{url('/')}}" class="btn btn-success">
                                &nbsp;&nbsp;&nbsp;
                                <i class="fa fa-sign-in"></i>
                                Login
                                &nbsp;&nbsp;&nbsp;
                            </a>
                        </p>
                    </div>
                </div>


                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>


@stop
