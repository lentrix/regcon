@extends('base')

@section('content')
<div class="modal fade" id="passwordRecoveryModal" tabindex="-1" aria-labelledby="passwordRecoveryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="passwordRecoveryModalLabel">Password Recovery</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>'forgot-password', 'method'=>'post']) !!}
        <div class="modal-body">
          Have you forgotten your password? <br>
          <div class="form-group">
              {!! Form::label('email', "What is your email?") !!}
              {!! Form::email('email', null, ['class'=>'form-control']) !!}
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Recover Password</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>

    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h3>Login Form</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['url'=>'/login','method'=>'post']) !!}

                    <div class="form-group">
                        {!! Form::label('email', "Email",['class'=>'form-label']) !!}
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
                    <p>
                        Forgot password?<br>
                        <button type="button" class="btn btn-secondary"  data-toggle="modal" data-target="#passwordRecoveryModal">Click here</button>
                    </p>
                </div>
            </div>
        </div>
    </div>

@stop
