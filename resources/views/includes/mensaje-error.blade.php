@if (count($errors)>0)
    <div class="alert alert-danger alert-dismissible" data-auto-dismiss="3000" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif