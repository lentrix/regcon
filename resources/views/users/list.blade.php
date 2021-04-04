@extends('base')

@section('content')
    <h2>List of Participants</h2>

    <div class="participants-list-container">

        @foreach($users as $user)

        <div class="participants-list-box">
            <img src='{{$user->imgUrl}}' alt="pic" class="participant-list-img">
            <div class="info">
                <strong>{{$user->fname}} {{$user->lname}}</strong><br>
                {{$user->email}} | <i>{{$user->designation}}</i><br>
                {{$user->school}}
            </div>
        </div>

        @endforeach

    </div>
@endsection
