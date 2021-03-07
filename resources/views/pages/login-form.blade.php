@extends('base')

@section('content')

    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h3>Login Form</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['url'=>'/login','method'=>'post']) !!}

                    <div class="form-group">
                        {!! Form::label('email', "User Name",['class'=>'form-label']) !!}
                        {!! Form::text('email', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', "Password",['class'=>'form-label']) !!}
                        {!! Form::password('password', ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        <button class="btn btn-lg btn-primary float-right">
                            &nbsp;&nbsp;&nbsp;
                            <i class="fa fa-sign-in"></i>
                            Login&nbsp;&nbsp;&nbsp;
                        </button>
                    </div>

                    <p>
                        No account yet? <br>
                        <a href="{{url('/register')}}" class="btn btn-success">
                            <i class="fa fa-check"></i>
                            Register Now!
                        </a>
                    </p>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@stop
