@extends('base')

@section('headers')

<style>
.candidate-box {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    margin-bottom: 20px;
    background-color: #e6e6e6;
}

.candidate-pic {
    width: 100px;
    height: 100px;
}

.candidate-info {
    line-height: 100%;
    flex-grow: 3;
    padding-left: 10px;
}

.vote-count {
    font-size: 2em;
    text-align:center;
    width: 100px;
    height: 100px;
    background-color: #444544;
    line-height: 100px;
    color: yellow;
}
</style>

@endsection

@section('content')

<h2>Election Results</h2>
<div class="row">
    <div class="col-md-6">
        @foreach($results as $result)

        <div class="candidate-box">
            <img src="{{$result['candidate']->imgUrl}}" alt="" class="candidate-pic">
            <div class="candidate-info">
                <strong>{{$result['candidate']->lname}}, {{$result['candidate']->fname}}</strong><br>
                <i>{{$result['candidate']->designation}}</i><br>
                {{$result['candidate']->school}}
            </div>
            <div class="vote-count">
                {{$result['count']}}
            </div>
        </div>

        @endforeach
    </div>
</div>

@endsection
