@extends("theme.$theme.layout")
@section('titulo') 
Editar Equipo 
@endsection
@section('contenido')
@section("scripts")
<script src="{{asset("assets/pages/scripts/admin/equipos/crear.js")}}" type="text/javascript" defer></script>
@endsection
<div class="container" id="cabeceraForm">
    <div class="row">
        <div class="col-lg-12 margin-tb" style="margin-top: 20px;">
            <div class="pull-left">
                <h2>Editar equipo</h2>
            </div>
            <div class="pull-right">
                
            </div>
        </div>
    </div>
    <br>
</div>
@include('includes.mensaje-error')
<div class="container" id="formEstilo">
    <form action="{{route('equipos.update',$equipo->id)}}" id="form-general" class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_method" value="PUT">
        @include('equipos.form',['Modo'=>'editar'])       
    </form>
</div>
@endsection


