@extends('base')

@section('content')

<div class="row">
    <div class="col-md-7">
        <h1>
            Administration | Users
        </h1>
    </div>
    <div class="col-md-5">
        <nav aria-label="breadcrumb" style="float: right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
        </nav>
    </div>
</div>

<div class="float-left">
    {!! Form::open(['url'=>'/admin/users','method'=>'get']) !!}

    <div class="input-group input-group-sm">
        {!! Form::text('search_key', null, ['class'=>'form-control','placeholder'=>'Search User']) !!}
        <div class="input-group-append">
            <button class="btn btn-primary">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>

    {!! Form::close() !!}
</div>

<div class="float-right">
    <ul class="pagination pagination-sm">
        <li class="page-item {{$currentPage==1?'disabled':''}}">
            <a href='{{url("/admin/users?page=1")}}' class="page-link" title="First Page">
                <i class="fa fa-angle-double-left"></i>
            </a>
        </li>
        <li class="page-item {{$currentPage==1?'disabled':''}}" title="Previous Page">
            <a href='{{url("/admin/users?page=$prevPage")}}'
                    class="page-link">
                <i class="fa fa-angle-left"></i>
            </a>
        </li>
        @for($i=1; $i<=$users->lastPage(); $i++)
        <li class="page-item {{$currentPage==$i?'active':''}}">
            <a href='{{url("/admin/users?page=$i")}}'
                    class="page-link" aria-current="{{$currentPage==$i?'true':'false'}}">
                {{$i}}
            </a>
        </li>
        @endfor
        <li class="page-item {{$currentPage==$lastPage?'disabled':''}}" title="Next Page">
            <a href='{{url("/admin/users?page=$nextPage")}}'
                    class="page-link">
                <i class="fa fa-angle-right"></i>
            </a>
        </li>
        <li class="page-item {{$currentPage==$lastPage?'disabled':''}}" title="Last Page">
            <a href='{{url("/admin/users?page=$lastPage")}}' class="page-link">
                <i class="fa fa-angle-double-right"></i>
            </a>
        </li>
    </ul>
</div>

<table class="table table-bordered table-sm table-striped">
    <thead>
        <tr>
            <th>Last Name</th>
            <th>First Name</th>
            <th>School &amp; Designation</th>
            <th>
                Status
                <span class="badge badge-info" title="Registration status on the current convention">
                    <i class="fa fa-question"></i>
                </span>
            </th>
            <th class="text-center">
                <i class="fa fa-cog"></i>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->lname}}</td>
            <td>{{$user->fname}}</td>
            <td style="line-height: 100%">
                <strong>{{$user->school}}</strong> <br>
                <i style="font-size: 0.95em">{{$user->designation}}</i>
            </td>
            <td>
                @if($user->currentParticipation)
                <i class="fa fa-check text-success"></i>
                @endif
            </td>
            <td class="text-center">
                <a href='{{url("/admin/user/$user->id")}}' class="btn btn-dark btn-sm" title="Manage this user">
                    <i class="fa fa-cog"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
