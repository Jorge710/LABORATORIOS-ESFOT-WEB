@extends("theme.$theme.layout")
@section('titulo') Editar Equipos Prestados @endsection
@section('contenido')
@section("scripts")
    <script src="{{asset("assets/pages/scripts/equipo_prestamos/crear.js")}}" type="text/javascript" defer></script>
@endsection
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
            <div class="pull-left"></div>
            <div class="pull-right">
                <a href="{{route('equiposprestamos.index')}}" class="btn btn-primary"><- Anterior</a>
            </div>
        </div>
    </div>
    <br>
    @include('includes.mensaje-error')
    <form action="{{route('equiposprestamos.update',$equipoPrestamo->id)}}" id="form-general" class="form-horizontal" method="post" role="form" autocomplete="off">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_method" value="PUT">
        @include('equipos_prestamos.form',['Modo'=>'editar'])        
    </form>
</div>
@endsection


