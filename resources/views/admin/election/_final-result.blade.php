<h3>PSITE-7 Election Final Result</h3>

<div class="row">
    <div class="col-md-6">
        @foreach($results as $index=>$result)
        <div class="card mb-2">
            <div class="card-body d-flex">
                <?php $user = $result['user']; ?>
                <img src="{{$user->imgUrl}}" alt="Profile Picture" style="height: 70px">
                <div class="ml-3 flex-grow-1" style="line-height: 110%">
                    <strong>{{$user->lname}}, {{$user->fname}}</strong> <br>
                    {{$user->school}} <br>
                    <div style="font-size: 1.5em; margin-top: 10px; font-weight: bold">
                        {{$result['votes']}} votes.
                    </div>
                </div>
                @if($index<$result['numOfWinners'])
                <div style="font-size: 2.0em; color: green">
                    <i class="fa fa-check"></i>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
