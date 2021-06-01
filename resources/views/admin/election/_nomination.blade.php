<div class="row">
    <div class="col-md-5">
        <h3>List of Nominees</h3>
        @foreach($nominees as $nominee)
            <?php $user = $nominee->user; ?>
            <div class="card mb-2">
                <div class="card-body bg-light p-2">
                    <img src="{{$user->imgUrl}}" style="width: 80px;" alt="Profile Pic" class="float-left" >
                    <div style="display: inline-block; margin-left: 10px; line-height: 110%">
                        <strong style="font-size: 1.3em">{{$user->lname}}, {{$user->fname}}</strong> <br>
                        {{$user->designation}}, <br>
                        <i>{{$user->school}}</i> <br>
                        <div class="text-info">
                            Response:
                            <span style="text-transform: uppercase">
                                {{$nominee->nomination_response ? $nominee->nomination_response : 'No response'}}
                            </span>
                            @if($nominee->nomination_response && $nominee->nomination_response=="accepted")
                            {!! Form::open(['url'=>'/admin/election/add-candidate', 'method'=>'post','class'=>'mt-1']) !!}
                                {!! Form::hidden('participant_id', $nominee->id) !!}
                                <button class="btn btn-primary btn-sm" type="submit">Elevate to Candidate</button>
                            {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-md-5 offset-md-2">
        <h3>List of Official Candidates</h3>

        @foreach($candidates as $candidate)

            <?php $user = $candidate->participant->user; ?>

            <div class="card mb-2">
                <div class="card-body bg-light p-2">
                    <img src="{{$user->imgUrl}}" style="width: 80px;" alt="Profile Pic" class="float-left" >
                    <div style="display: inline-block; margin-left: 10px; line-height: 110%">
                        <strong style="font-size: 1.3em">{{$user->lname}}, {{$user->fname}}</strong> <br>
                        {{$user->designation}}, <br>
                        <i>{{$user->school}}</i> <br>
                        {!! Form::open(['url'=>'/admin/election/revoke-candidate','method'=>'post','class'=>'mt-2']) !!}

                            {!! Form::hidden('candidate_id', $candidate->id) !!}

                            <button class="btn btn-danger btn-sm" type="submit">
                                <i class="fa fa-ban"></i> Revoke Candidacy
                            </button>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        @endforeach
    </div>
</div>
