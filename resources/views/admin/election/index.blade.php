@extends('base')

@section('content')

<div class="row">
    <div class="col-md-7">
        <h1>Election Manager</h1>
    </div>
    <div class="col-md-5">
        <nav aria-label="breadcrumb" style="float: right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Election</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-md-5">
        @if(isset($activeConv))
            <h3>Election Phase: {{$activeConv->election_status}}</h3>
            {!! Form::open(['url'=>'/admin/election/status','method'=>'post']) !!}

            <div class="form-group">
                {!! Form::label('election_status', "Change Election Phase") !!}

                <div class="input-group">
                    {!! Form::select('election_status', [
                        'pending'=>'Pending',
                        'nomination'=>'Nomination State',
                        'confirmation'=>'Confirmation State',
                        'election'=>'Election Proper',
                        'result'=>'Final Result'
                    ], $activeConv->election_status, ['class'=>'form-control','placeholder'=>'Select phase']) !!}


                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            Change Phase
                        </button>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        @endif
    </div>
</div>

<hr>

@if(isset($activeConv) && $activeConv->election_status=="nomination")

    @include("admin.election._nomination")

@endif

@endsection
