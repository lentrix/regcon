@extends('base')

@section('content')

<h1>Election Manager</h1>

<div class="row">
    <div class="col-md-5">
        @if($activeConv)
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


@endsection
