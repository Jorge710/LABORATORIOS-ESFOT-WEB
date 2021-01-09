@extends("theme.$theme.layout")
@section('titulo') 
Crear Mantenimiento 
@endsection
@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/equipos/crear.js")}}" type="text/javascript" defer></script>
@endsection
@include('includes.mensaje-error')
@include('includes.mensaje-success')
@section('contenido')
    <div class="container" id="cabeceraForm">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                        <label for=""><em>MODULO EQUIPOS</em></label><br>
                        <label for=""><em><h2>Registrar un Equipo &oacute; Planta Did&aacute;ctica Tecnol&oacute;gica</h2></em></label>
                        @include('includes.mensaje-error') 
                </div> 
                <div class="pull-right">
                    
                </div>          
            </div>
        </div>
    </div>
    <div class="container" id="formEstilo">
        <form action="{{ route('equipos.store')}}" id="form-general" class="form-horizontal" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            @include('mantenimiento.form',['Modo'=>'crear'])            
        </form>
    </div>
@endsection

