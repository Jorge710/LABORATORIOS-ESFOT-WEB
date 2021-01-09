@extends("theme.$theme.layout")
@section('titulo')
    Editar criticidad
@endsection
@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/criticidades/crear.js")}}" type="text/javascript" defer></script>
@endsection
@section('contenido')
<div class="container" id="cabeceraForm">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar el an&aacute;lisis de la criticidad del equipo</h2>
            </div>
            <div class="pull-right">   
            </div>
        </div>
    </div>
</div>
@include('includes.mensaje-error')
<div class="container" id="formEstilo">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form action="{{route('criticidades.update',$criticalities->id)}}" id="form-general" class="form-horizontal" method="post" role="form" autocomplete="off">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="_method" value="PUT">
                @include('criticidades.form',['Modo'=>'editar']) 
            </form>
        </div>
    </div>
</div>
@endsection


