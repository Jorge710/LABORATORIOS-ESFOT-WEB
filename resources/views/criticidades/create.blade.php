@extends("theme.$theme.layout")
@section('titulo') 
Crear criticidad 
@endsection
@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/equipos/crear.js")}}" type="text/javascript" defer></script>
@endsection
@section('contenido')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('sistemas.index') }}">Sistemas</a></li>
              <li class="breadcrumb-item"><a href="{{ route('sistemas.show', Crypt::encrypt($buscarID_equipo->systems_id))}}">Listado de equipos</a></li>
              <li class="breadcrumb-item"><a href="{{ route('equipos.show', Crypt::encrypt($buscarID_equipo->id))}}">Ver informaci&oacute;n del equipo - {{$buscarID_equipo->codigo}}</a></li>
              <li class="breadcrumb-item active" aria-current="page">Crear criticidad</li>
            </ol>
          </nav>
    </div>
</div>
@include('includes.mensaje-error')
<div class="container" id="formEstilo">
    <form action="{{ route('criticidades.store')}}" id="form-general" class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        @include('criticidades.form',['Modo'=>'crear'])           
    </form>
</div>
@endsection

