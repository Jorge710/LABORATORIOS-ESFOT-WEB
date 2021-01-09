@extends("theme.$theme.layout")
@section('titulo') 
Editar Roles 
@endsection
@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/localizaciones/crear.js")}}" type="text/javascript" defer></script>
@endsection
@section('contenido')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
              <li class="breadcrumb-item active" aria-current="page">Editar Rol</li>
            </ol>
          </nav>
    </div>
</div>
@include('includes.mensaje-error')
<hr>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <form action="{{route('roles.update',$role->id)}}" id="form-general" class="form-horizontal" method="post" role="form" autocomplete="off">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="_method" value="PUT">  
                            <br>
                            <div class="form-group">
                                <label for="name" class="requerido"><strong>Nombre del rol:</strong></label><br>
                                <span>@isset($role->name){{ $role->name }}@endisset</span><br>
                            </div>
                            <div class="form-group">
                                <label for="name"><strong>Descripci&oacute;n: </strong></label><span class="text-muted"> (Opcional)</span>
                                <textarea id="max_equ_funcion" name="description"  rows="3" placeholder="Descripci&oacute;n" class="form-control" value="{{ old('description') }}" required>@isset($role->description){{ $role->description }}@endisset</textarea>
                            </div>
                            <hr>
                            <h3>Asignar Permisos</h3>
                            <hr>
                            <div class="accordion" id="accordionExample">
                                {{-- PERMISOS USUARIOS Y ROLES --}}
                                <div class="card">
                                    <div class="card-header" id="headingUsuario">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" 
                                            type="button" data-toggle="collapse" 
                                            data-target="#collapseUsuario" 
                                            aria-expanded="false" 
                                            aria-controls="collapseUsuario">
                                            Usuarios & Roles de Usuario                                            
                                            <i class="fas fa-caret-down float-right"></i>
                                        </button>
                                    </h2>
                                    </div>
                                    <div id="collapseUsuario" class="collapse" aria-labelledby="headingUsuario" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <ul class="list-unstyled">
                                                    @foreach ($permissions_usuarios as $permission)
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" @if($role->permissions->contains($permission->id)) checked=checked @endif>
                                                                {{ $permission->name }}
                                                                <em>({{ $permission->description }})</em>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- PERMISOS LOCALIZACIONES --}}
                                <div class="card">
                                    <div class="card-header" id="headingLocalizaciones">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" 
                                            type="button" data-toggle="collapse" 
                                            data-target="#collapseLocalizaciones" 
                                            aria-expanded="false" 
                                            aria-controls="collapseLocalizaciones">
                                            Localizaciones                                            
                                            <i class="fas fa-caret-down float-right"></i>
                                        </button>
                                    </h2>
                                    </div>
                                    <div id="collapseLocalizaciones" class="collapse" aria-labelledby="headingLocalizaciones" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <ul class="list-unstyled">
                                                    @foreach ($permissions_localizaciones as $permission)
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" @if($role->permissions->contains($permission->id)) checked=checked @endif>
                                                                {{ $permission->name }}
                                                                <em>({{ $permission->description }})</em>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- LOCALIZACIONES AREAS --}}
                                <div class="card">
                                    <div class="card-header" id="headingAreas">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" 
                                            type="button" data-toggle="collapse" 
                                            data-target="#collapseAreas" 
                                            aria-expanded="false" 
                                            aria-controls="collapseAreas">
                                            &Aacute;reas
                                            
                                            <i class="fas fa-caret-down float-right"></i>
                                        </button>
                                    </h2>
                                    </div>
                                    <div id="collapseAreas" class="collapse" aria-labelledby="headingAreas" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <ul class="list-unstyled">
                                                    @foreach ($permissions_areas as $permission)
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" @if($role->permissions->contains($permission->id)) checked=checked @endif>
                                                                {{ $permission->name }}
                                                                <em>({{ $permission->description }})</em>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- PERMISOS SISTEMAS --}}
                                <div class="card">
                                    <div class="card-header" id="headingSistemas">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" 
                                            type="button" data-toggle="collapse" 
                                            data-target="#collapseSistemas" 
                                            aria-expanded="false" 
                                            aria-controls="collapseSistemas">
                                            Sistemas                                            
                                            <i class="fas fa-caret-down float-right"></i>
                                        </button>
                                    </h2>
                                    </div>
                                    <div id="collapseSistemas" class="collapse" aria-labelledby="headingSistemas" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <ul class="list-unstyled">
                                                    @foreach ($permissions_sistemas as $permission)
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" @if($role->permissions->contains($permission->id)) checked=checked @endif>
                                                                {{ $permission->name }}
                                                                <em>({{ $permission->description }})</em>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- PERMISOS EQUIPOS Y PRESTAMOS DE EQUIPOS --}}
                                <div class="card">
                                    <div class="card-header" id="headingEquipos">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" 
                                            type="button" data-toggle="collapse" 
                                            data-target="#collapseEquipos" 
                                            aria-expanded="false" 
                                            aria-controls="collapseEquipos">
                                            Equipos & Prestamo de Equipos                                            
                                            <i class="fas fa-caret-down float-right"></i>
                                        </button>
                                    </h2>
                                    </div>
                                    <div id="collapseEquipos" class="collapse" aria-labelledby="headingEquipos" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <ul class="list-unstyled">
                                                    @foreach ($permissions_equipos as $permission)
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" @if($role->permissions->contains($permission->id)) checked=checked @endif>
                                                                {{ $permission->name }}
                                                                <em>({{ $permission->description }})</em>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- PERMISOS ELEMENTOS --}}
                                <div class="card">
                                    <div class="card-header" id="headingElementos">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" 
                                            type="button" data-toggle="collapse" 
                                            data-target="#collapseElementos" 
                                            aria-expanded="false" 
                                            aria-controls="collapseElementos">
                                            Elementos                                            
                                            <i class="fas fa-caret-down float-right"></i>
                                        </button>
                                    </h2>
                                    </div>
                                    <div id="collapseElementos" class="collapse" aria-labelledby="headingElementos" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <ul class="list-unstyled">
                                                    @foreach ($permissions_elementos as $permission)
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" @if($role->permissions->contains($permission->id)) checked=checked @endif>
                                                                {{ $permission->name }}
                                                                <em>({{ $permission->description }})</em>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- PERMISOS CRITICIDADES --}}
                                <div class="card">
                                    <div class="card-header" id="headingCriticidades">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" 
                                            type="button" data-toggle="collapse" 
                                            data-target="#collapseCriticidades" 
                                            aria-expanded="false" 
                                            aria-controls="collapseCriticidades">
                                            Criticidades                                            
                                            <i class="fas fa-caret-down float-right"></i>
                                        </button>
                                    </h2>
                                    </div>
                                    <div id="collapseCriticidades" class="collapse" aria-labelledby="headingCriticidades" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <ul class="list-unstyled">
                                                    @foreach ($permissions_criticidades as $permission)
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" @if($role->permissions->contains($permission->id)) checked=checked @endif>
                                                                {{ $permission->name }}
                                                                <em>({{ $permission->description }})</em>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- PERMISOS ENVIAR NOTIFICACIONES --}}
                                <div class="card">
                                    <div class="card-header" id="headingMessages">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" 
                                            type="button" data-toggle="collapse" 
                                            data-target="#collapseMessages" 
                                            aria-expanded="false" 
                                            aria-controls="collapseMessages">
                                            Enviar mensaje de Notificación
                                            
                                            <i class="fas fa-caret-down float-right"></i>
                                        </button>
                                    </h2>
                                    </div>
                                    <div id="collapseMessages" class="collapse" aria-labelledby="headingMessages" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <ul class="list-unstyled">
                                                    @foreach ($permissions_messages as $permission)
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" @if($role->permissions->contains($permission->id)) checked=checked @endif>
                                                                {{ $permission->name }}
                                                                <em>({{ $permission->description }})</em>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- PERMISOS DESCARGAR ARCHIVOS --}}
                                <div class="card">
                                    <div class="card-header" id="headingReportdownload">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" 
                                            type="button" data-toggle="collapse" 
                                            data-target="#collapseReportdownload" 
                                            aria-expanded="false" 
                                            aria-controls="collapseReportdownload">
                                            Descarga de Archivos                                            
                                            <i class="fas fa-caret-down float-right"></i>
                                        </button>
                                    </h2>
                                    </div>
                                    <div id="collapseReportdownload" class="collapse" aria-labelledby="headingReportdownload" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <ul class="list-unstyled">
                                                    @foreach ($permissions_reportdownload as $permission)
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" @if($role->permissions->contains($permission->id)) checked=checked @endif>
                                                                {{ $permission->name }}
                                                                <em>({{ $permission->description }})</em>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- PERMISOS ACTUALIZAR PAGINA DE INICIO --}}
                                <div class="card">
                                    <div class="card-header" id="headingActualizarPaginaInicio">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" 
                                            type="button" data-toggle="collapse" 
                                            data-target="#collapseActualizarPaginaInicio" 
                                            aria-expanded="false" 
                                            aria-controls="collapseActualizarPaginaInicio">
                                            Actualizar P&aacute;gina de Inicio                                            
                                            <i class="fas fa-caret-down float-right"></i>
                                        </button>
                                    </h2>
                                    </div>
                                    <div id="collapseActualizarPaginaInicio" class="collapse" aria-labelledby="headingActualizarPaginaInicio" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <ul class="list-unstyled">
                                                    @foreach ($permissions_page as $permission)
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" @if($role->permissions->contains($permission->id)) checked=checked @endif>
                                                                {{ $permission->name }}
                                                                <em>({{ $permission->description }})</em>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- PERMISOS MANTENIMIENTOS --}}
                                <div class="card">
                                    <div class="card-header" id="headingMantenimiento">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" 
                                            type="button" data-toggle="collapse" 
                                            data-target="#collapseMantenimiento" 
                                            aria-expanded="false" 
                                            aria-controls="collapseMantenimiento">
                                            Mantenimientos
                                            
                                            <i class="fas fa-caret-down float-right"></i>
                                        </button>
                                    </h2>
                                    </div>
                                    <div id="collapseMantenimiento" class="collapse" aria-labelledby="headingMantenimiento" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <ul class="list-unstyled">
                                                    @foreach ($permissions_mantenimientos as $permission)
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" @if($role->permissions->contains($permission->id)) checked=checked @endif>
                                                                {{ $permission->name }}
                                                                <em>({{ $permission->description }})</em>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <button type="submit" class="btn btn-block btnEditar">Editar</button>
                                    <a href="{{route('roles.index')}}" class="btn btn-block btn-danger">Cancelar</a>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


