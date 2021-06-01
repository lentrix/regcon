@extends('base')

@section('content')

<?php $pt = $user->participation(\App\Convention::getActive()->id); ?>

@if($pt)
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Participation Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::model($pt, ['url'=>"admin/participation",'method'=>'put']) !!}
            <div class="modal-body">
                {!! Form::hidden("id", $pt->id) !!}
                <div class="form-group">
                    {!! Form::label('amount_paid', null) !!}
                    {!! Form::text('amount_paid', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('payment_channel', null) !!}
                    {!! Form::text('payment_channel', null, ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endif

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
                    <img src="{{$user->imgUrl}}" alt="Profile Picture" class="profile-pic">
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
                @if($pt)
                    <div class="card">
                        <div class="card-body bg-info text-white">
                            {{$user->fname}} is registered as a {{$pt->role}}!
                        </div>
                    </div>
                    <table class="table table-striped mt-2">
                        <tr><th>Participation Role</th><td>{{$pt->role}}</td></tr>
                        <tr>
                            <th>Amount Paid</th>
                            <td>
                                {{$pt->amount_paid}}
                            </td>
                        </tr>
                        <tr>
                            <th>Payment Channel</th>
                            <td>
                                {{$pt->payment_channel}}
                            </td>
                        </tr>
                        <tr><th>Accepted by</th><td>{{$pt->accepted_by}}</td></tr>
                    </table>
                    <div class="form-group">
                        <button type="button" class="btn btn-info btn-sm float-right"
                                title="Set amount paid" data-toggle="modal" data-target="#editModal">
                            <i class="fa fa-edit"></i> Edit
                        </button>
                    </div>
                @else
                    This user is not registered to the current
                    Regional Convention.
                    <hr>

                    {!! Form::open(['url'=>'admin/participation/add', 'method'=>'post']) !!}

                    {!! Form::hidden('user_id', $user->id) !!}

                    <div class="form-group">
                        {!! Form::label('role', "Register $user->fname as..") !!}
                        {!! Form::select('role', [
                            'participant'=>'Regular Participant',
                            'sponsor' => 'Sponsor Representative',
                            'presentor' => 'Presentor'
                        ], null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fa fa-check"></i> Register User
                        </button>
                    </div>

                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
</div>
<hr>

<h2>Participation History</h2>
<div class="row">

</div>
@endsection
