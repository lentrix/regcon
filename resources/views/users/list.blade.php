@extends('base')

@section('content')
    <h2>List of Participants</h2>
    <div class="alert alert-info">
        There are {{count($users)}} participants.
        @if(auth()->user()->role=='admin')
        <div class="float-right">
            <a href="{{url('/admin/download-participants')}}" class="btn btn-secondary btn-sm">
                Download .CSV file
            </a>
        </div>
        @endif
    </div>
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
