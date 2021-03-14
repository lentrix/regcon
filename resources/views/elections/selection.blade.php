@extends('base')

@section('content')

<h2>PSITE-7 Officer's Election (Selection)</h2>

@if($user->role=='admin' || $user->role=='moderator')

<div id="main-app">
    <main-app phase="selection"></main-app>
</div>

@else

<div class="alert alert-info">
    <p>
        At this point the election committee members are going
        through the list of nominees to determine which ones are
        qualified to be a Candidate. <br>
        Please visit this page again when the election phase commences. Thank you!
    </p>
</div>

@endif

@endsection
