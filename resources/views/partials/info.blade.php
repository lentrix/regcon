@if($message = Session::get('Info'))
    <div class="alert alert-info">
        {{$message}}
    </div>
@endif
