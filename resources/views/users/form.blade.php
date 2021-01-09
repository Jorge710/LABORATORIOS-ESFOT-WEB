@extends("theme.$theme.layout")
@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/usuarios/crear.js")}}" type="text/javascript" defer></script>
@endsection
@section('contenido')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
              <li class="breadcrumb-item active" aria-current="page">Editar Usuario</li>
            </ol>
          </nav>
    </div>
</div>
@include('includes.mensaje-error')
<hr>
<div class="row">
    <div class="col-lg-5">
        {{-- FORMULARIO ACTUALIZAR DATOS PERSONALES --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informaci&oacute;n del usuario</h3>
                <div class="card-tools">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{ route('users.update', $user->id) }}" id="form-general" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="ci" class="requerido">C&eacute;dula:</label>
                                <input name="ci" id="max_user_id" type="text" value="@isset($user->ci){{ $user->ci }}@endisset" class="form-control enteros" required>
                            </div>
                            <div class="form-group">
                                <label for="name" class="requerido">Nombre(s):</label>
                                <input name="name" type="text" id="max_user_nombre" value="@isset($user->name){{ $user->name }}@endisset" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="requerido">Apellido(s):</label>
                                <input name="lastname" type="text" id="max_user_apellido" value="@isset($user->lastname){{ $user->lastname }}@endisset" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="requerido">Email:</label>
                                <input name="email" type="text" value="@isset($user->email){{ $user->email }}@endisset" class="form-control" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" class="btn btn-block btnEditar">Actualizar datos personales</button>
                                    <a href="{{route('users.index')}}" class="btn btn-block btn-danger">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- LADO DERECHO --}}
    @can('roles.edit')
    <div class="col-lg-7">
        {{-- FORMULARIO ACTUALIZAR ROLES --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de roles</h3>
                <div class="card-tools">
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('users.updateRol', $user->id) }}" id="form-general" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <ul>
                            @foreach ($roles as $role)
                                <li style="list-style:none;">
                                    <label>
                                        <input type="radio" name="roles[]" value="{{ $role->id }}" @if($user->roles->contains($role->id)) checked=checked @endif>
                                        {{ $role->name }}
                                        ({{ $role->description }})
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button type="submit" class="btn btn-block btnEditar">Actualizar rol</button>
                            <a href="{{route('users.index')}}" class="btn btn-block btn-danger">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan
</div>

<div class="row">
    <div class="col-lg-12">
        {{-- FORMAULARIO ASIGNAR LABORATORIO --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de laboratorios</h3>
                <div class="card-tools">
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('users.updateASignacionLaboratorio', $user->id) }}" id="form-general" method="post">
                    @method('PUT')
                    @csrf
                    @foreach ($locations as $location)
                        <li style="list-style:none;">
                            <label>
                                <input type="checkbox" name="locations[]" value="{{ $location->id }}" @if($user->locations->contains($location->id)) checked=checked @endif>
                                    {{ $location->name }}
                                    ({{ $location->description }})
                            </label>
                        </li>
                    @endforeach
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <button type="submit" class="btn btn-block btnEditar">Actualizar asignaci&oacute;n</button>
                            <a href="{{route('users.index')}}" class="btn btn-block btn-danger">Cancelar</a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection