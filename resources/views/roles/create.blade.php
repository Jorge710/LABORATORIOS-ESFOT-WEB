@extends("theme.$theme.layout")
@section('titulo') Crear Roles @endsection
@section("scripts")
    <script src="{{asset('assets/pages/scripts/admin/localizaciones/crear.js')}}" type="text/javascript" defer></script>
@endsection
@section('contenido')
    <div class="container" id="cabeceraForm">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h3>Nuevo Rol</h3>
                    @include('includes.mensaje-error')
                </div>
                <div class="pull-right">

                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <form action="{{ route('roles.store')}}" id="form-general" class="form-horizontal" method="post" autocomplete="off">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            @include('roles.form')                
        </form>
    </div>
@endsection
