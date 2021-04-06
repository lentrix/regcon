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
                <li class="breadcrumb-item active" aria-current="page">Raffles</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-md-5">
        <h3>
            Raffle Items
            <a href="{{url('/admin/raffles/new-item')}}"
                    class="btn btn-primary float-right" title="Add Raffle Item">
                <i class="fa fa-plus"></i>
            </a>
        </h3>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Sponsor</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>

                @foreach($raffleItems as $item)
                <tr>
                    <td>{{$item->itemName}}</td>
                    <td>{{$item->sponsor}}</td>
                    <td>
                        {{$item->qty}}
                        <a href='{{url("/admin/raffles/edit/$item->id")}}'
                                    class="btn btn-secondary btn-sm float-right"
                                    title="Edit this raffle item.">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div class="col-md-7">
        <h3>
            List of Winners
            <a href="{{url('/admin/raffles/draw')}}" class="btn btn-success float-right">
                <i class="fa fa-pie-chart"></i> Raffle Draw
            </a>
        </h3>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>Winner</th>
                    <th>School</th>
                    <th>Prize</th>
                    <th>Sponsor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($raffleDraws as $raffle)
                <tr>
                    <td>{{$raffle->lname}}, {{$raffle->fname}}</td>
                    <td>{{$raffle->school}}</td>
                    <td>{{$raffle->itemName}}</td>
                    <td>{{$raffle->sponsor}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
