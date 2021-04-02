@extends('base')

@section('content')

<h1>PSITE-7 Election Facility</h1>

@if($conv->election_status=='nomination')

    @include("elections._nomination")

@endif

@endsection
