@extends("theme.$theme.layout")
@section('titulo') 
Crear Laboratorio 
@endsection
@section("scripts")
    <script src="{{asset('assets/pages/scripts/admin/localizaciones/crear.js')}}" type="text/javascript" defer></script>
@endsection
@section('contenido')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('localizaciones.index')}}">Laboratorios</a></li>
              <li class="breadcrumb-item active" aria-current="page">Crear Laboratorio</li>
            </ol>
        </nav>
    </div>
</div>
@include('includes.mensaje-error')
<div class="container">
    <form action="{{ route('localizaciones.store')}}" id="form-general" class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        @include('localizaciones.form',['Modo'=>'crear'])              
    </form>
</div>
@endsection
