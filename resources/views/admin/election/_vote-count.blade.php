

<h3>Current Vote Count</h3>

<div class="row">
    <div class="col-md-6">

        @foreach($candidates as $candidate)

        <div class="card mb-2">
            <div class="card-body d-flex">
                <?php $user = $candidate->participant->user; ?>
                <img src="{{$user->imgUrl}}" alt="Profile Picture" style="height: 70px">
                <div class="ml-3" style="line-height: 110%">
                    <strong>{{$user->lname}}, {{$user->fname}}</strong> <br>
                    {{$user->school}} <br>
                    <div style="font-size: 1.5em; margin-top: 10px; font-weight: bold">
                        {{$candidate->countVotes()}} votes.
                    </div>
                </div>
            </div>
        </div>

        @endforeach

    </div>
</div>
