@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible" data-auto-dismiss="3000">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><Strong>X</Strong></button>
        <p>{{$message}}</p>
    </div>        
@endif
