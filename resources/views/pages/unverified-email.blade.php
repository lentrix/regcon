@extends('base')

@section('content')
    <h3>Unable to Login</h3>
    <div class="alert alert-warning">
        Our records indicate that you have successfully submitted your
        registration. However, your email address was not validated yet.
        Please check your email [{{$user->email}}] and click on the
        corresponding link to validated your email. <br>
        <a href="{{url('/')}}" class="btn btn-primary">
            &nbsp;&nbsp;&nbsp;
            <i class="fa fa-login"></i>
            Login
            &nbsp;&nbsp;&nbsp;
        </a>
    </div>
@endsection
