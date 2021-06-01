@extends('base')

@section('content')

<h1>Raffle Draw</h1>
<hr>

<div class="row">
    <div class="col-md-6">
        @if(count($myWin)>0)
        <div class="alert alert-success">
            <h4>Congratulations!!!</h4>
            <p>
                You won the following...
                <ul>
                    @foreach($myWin as $win)
                    <li><strong>{{$win->raffleItem->itemName}}</strong> sponsored by {{$win->raffleItem->sponsor}}</li>
                    @endforeach
                </ul>
            </p>
        </div>
        @endif
    </div>
    <div class="col-md-6">
        <h3>List of Winners</h3>
        <ul class="list-group">
            @foreach($drawWinners as $winner)
            <li class="list-group-item">
                <strong>{{$winner->lname}}, {{$winner->fname}}</strong> of {{$winner->school}} <br>
                won {{$winner->itemName}} sponsored by {{$winner->sponsor}}
            </li>
            @endforeach
        </ul>
    </div>
</div>

@endsection
