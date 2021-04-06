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
                <li class="breadcrumb-item active" aria-current="page">Create Raffle Item</li>
            </ol>
        </nav>
    </div>
</div>

<h3>Create Raffle Item</h3>

<div class="row">
    <div class="col-md-6">
        {!! Form::open(['url'=>'/admin/raffles/new-item', 'method'=>'post']) !!}

        <div class="form-group">
            {!! Form::label('itemName', 'Item Name') !!}
            {!! Form::text('itemName', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('sponsor', null) !!}
            {!! Form::text('sponsor', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('qty', 'Quantity') !!}
            {!! Form::text('qty', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary float-right">
                <i class="fa fa-check"></i> Create Raffle Item
            </button>
        </div>

        {!! Form::close() !!}
    </div>
</div>

@endsection
