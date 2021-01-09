@extends("theme.$theme.layout")
@section('titulo') 
Prestar Equipos 
@endsection
@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/prestamoEquipos/crear.js")}}" type="text/javascript" defer></script>
@endsection
@section('contenido')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('equiposprestamos.index') }}">Equipos prestados</a></li>
              <li class="breadcrumb-item active" aria-current="page">Prestar un equipo</li>
            </ol>
          </nav>
    </div>
</div>
@include('includes.mensaje-error')
<div class="container" id="formEstilo">
    <form action="{{ route('equiposprestamos.store')}}" id="form-general" class="form-horizontal" method="post" autocomplete="off">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        @include('equipos_prestamos.form',['Modo'=>'crear'])
    </form>
</div>
@endsection

