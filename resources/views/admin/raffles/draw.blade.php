@extends('base')

@section('content')

<div class="row">
    <div class="col-md-7">
        <h1>Raffle Manager</h1>
    </div>
    <div class="col-md-5">
        <nav aria-label="breadcrumb" style="float: right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Admin</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/raffles')}}">Raffles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Raffle Draw</li>
            </ol>
        </nav>
    </div>
</div>

<div id="app">
    <draw></draw>
</div>

@endsection

@section('scripts')

<script src='{{mix("js/app.js")}}'></script>

@endsection
