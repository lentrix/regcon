@extends('base')

@section('content')

<h1>Unauthorized Access</h1>
<div class="alert alert-danger">
    <strong>Sorry! You are not authorized to access this page.</strong> <br>
    Only the committee is allowed access beyond this point. <br><br>
    <a href="{{url('/')}}" class="btn btn-success lg">
        Go to Dashboard
    </a>
</div>

@endsection
