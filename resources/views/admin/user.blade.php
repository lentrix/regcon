@extends('base')

@section('content')
    <div class="row">
        <div class="col-md-7">
            <h1>
                Administration | Manage User
            </h1>
        </div>
        <div class="col-md-5">
            <nav aria-label="breadcrumb" style="float: right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Admin</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/admin/users')}}">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage User</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h3>User Profile</h3>
                </div>
                <div class="card-body">
                    <div style="width: 100%; display:flex; margin-bottom: 20px">
                        <img src="{{$user->imgUrl()}}" alt="Profile Picture" class="profile-pic">
                    </div>
                    <table class="table table-striped table-sm">
                        <tr><th>Name</th><td>{{$user->lname}}, {{$user->fname}}</td></tr>
                        <tr><th>Institution</th><td>{{$user->school}}</td></tr>
                        <tr><th>Designation</th><td>{{$user->designation}}</td></tr>
                        <tr><th>Email</th><td>{{$user->email}}</td></tr>
                        <tr><th>Phone Number</th><td>{{$user->phone}}</td></tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h3>Participation Details</h3>
                </div>
                <div class="card-body">
                    This user is not registered to the current
                    Regional Convention.
                </div>
            </div>
        </div>
    </div>
    <hr>

    <h2>Participation History</h2>
    <div class="row">

    </div>
@endsection
