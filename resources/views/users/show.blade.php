@extends("theme.$theme.layout")
@section('titulo') Usuarios @endsection
@section('contenido')
<div id="login_container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="margin-top: 100px; margin-bottom: 100px">
            <div class="card">
                <div class="card-header" id="styFormAuth">Informaci&oacute;n Usuario</div>

                <div class="card-body">
                    <p><strong>C&eacute;dula: </strong>{{ $user->ci}}</p>
                    <p><strong>Nombre: </strong>{{ $user->name}}</p>
                    <p><strong>Email: </strong>{{ $user->email}}</p>
                    <p><strong>Estado: </strong>{{ $user->estado}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection