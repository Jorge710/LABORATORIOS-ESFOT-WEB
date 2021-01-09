@extends("theme.$theme.layout")
@section('titulo')
    Editar Usuario
@endsection
@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/usuarios/crear.js")}}" type="text/javascript" defer></script>
@endsection
@section('contenido')
@include('includes.mensaje-error')
<div class="container">
    <form action="{{route('users.update',$user->id)}}" id="form-general" class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_method" value="PUT">
        @include('users.form')                
    </form>
</div>
@endsection


