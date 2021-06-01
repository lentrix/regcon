@if(count($errors->all())>0)
    <ul class="alert alert-danger">
        @foreach($errors->all() as $err)
        <li>{{$err}}</li>
        @endforeach
    </ul>
@endif

@if($message = Session::get('Error'))
    <div class="alert alert-danger">
        {!!$message!!}
    </div>
@endif
