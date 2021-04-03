@extends('base')

@section('content')

<h1>PSITE-7 Election Facility</h1>

@if($conv!=null && $conv->election_status=='nomination')
    <div id="app">
        <nomination></nomination>
    </div>
@endif

@if($conv!=null && $conv->election_status=='election')
    <div id="app">
        <election></election>
    </div>
@endif

@endsection

@section('scripts')

<script src='{{mix("js/app.js")}}'></script>

@endsection
