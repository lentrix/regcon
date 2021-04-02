@extends('base')

@section('content')

<h1>Administration | Main Page</h1>
<hr>

<div class="row">
    @include('admin.sidemenu')

    <div class="col-md-9">
        <h2>
            <a href="{{url('/admin/convention/create')}}"
                class="btn btn-primary btn-sm" title="Create Convetion">
                <i class="fa fa-plus"></i>
            </a>
            Conventions
        </h2>
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Host School</th>
                    <th>Convention Chair</th>
                    <th>Schedule</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach($conventions as $conv)

            <tr>
                <td>{{$conv->title}}</td>
                <td>{{$conv->host_school}}</td>
                <td>{{$conv->chairman}}</td>
                <td>{{$conv->schedule}}</td>
                <td>
                    {{$conv->convention_status}}
                    @if($conv->convention_status=='inactive')
                        <a href='{{url("/admin/convention/activate/$conv->id")}}'
                                class="btn btn-sm btn-success float-right">
                            <i class="fa fa-check"></i> Activate
                        </a>
                    @endif
                </td>
            </tr>

            @endforeach
            </tbody>
        </table>
    </div>

</div>

@endSection
