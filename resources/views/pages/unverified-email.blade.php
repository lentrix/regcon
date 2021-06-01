@extends('base')

@section('content')
    <h3>Unable to Login</h3>
    <div class="alert alert-warning">
        Our records indicate that you have successfully submitted your
        registration. However, your email address was not validated yet.
        Please check your email [{{$user->email}}] and click on the
        corresponding link to validated your email. If you don't see
        a verification email in your inbox, please check your Spam.<br>
        <a href="{{url('/')}}" class="btn btn-primary">
            &nbsp;&nbsp;&nbsp;
            <i class="fa fa-login"></i>
            Login
            &nbsp;&nbsp;&nbsp;
        </a>
        <br>
        Still, no verification email found? <br>
        {!! Form::open(['url'=>'resend-email-verification', 'method'=>'post']) !!}

        {!! Form::hidden('user_id', $user->id) !!}

        <button class="btn btn-success" type="submit">
            Resend Email Verification
        </button>

        {!! Form::close() !!}
    </div>
@endsection
