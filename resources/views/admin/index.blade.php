@extends('base')

@section('content')

<h1>Administration | Main Page</h1>
<hr>

<div class="row">
    @include('admin.sidemenu')

    <div class="col-md-5">
        <h2>
            <a href="{{url('/admin/convention/create')}}"
                class="btn btn-primary btn-sm" title="Create Convetion">
                <i class="fa fa-plus"></i>
            </a>
            Conventions
        </h2>
        <table class="table table-sm table-striped">
        @foreach($conventions as $conv)
            <tr><th>Title</th><td>{{$conv->title}}</td></tr>
            <tr><th>Hosted by</th><td>{{$conv->host_school}}</td></tr>
            <tr><th>Convention Chair</th><td>{{$conv->chairman}}</td></tr>
            <tr><th>Schedule</th><td>{{$conv->schedule}}</td></tr>
            <tr><th>Status</th>
                <td>
                    {{$conv->convention_status}}
                    @if($conv->convention_status=='inactive')
                        <a href='{{url("/admin/convention/activate/$conv->id")}}'
                                class="btn btn-sm btn-success float-right">
                            <i class="fa fa-check"></i> Activate
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </table>
    </div>
    <div class="col-md-4">
        @if($activeConv)
            <h2>Election Phase: {{$activeConv->election_status}}</h2>
            {!! Form::open(['url'=>'/admin/election/status','method'=>'post']) !!}

            <div class="form-group">
                {!! Form::label('election_status', "Change Election Phase") !!}
                {!! Form::select('election_status', [
                    'pending'=>'Pending',
                    'nomination'=>'Nomination State',
                    'confirmation'=>'Confirmation State',
                    'election'=>'Election Proper',
                    'result'=>'Final Result'
                ], $activeConv->election_status, ['class'=>'form-control','placeholder'=>'Select phase']) !!}
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Change Election Phase
                </button>
            </div>

            {!! Form::close() !!}
        @endif
    </div>
</div>

@endSection
