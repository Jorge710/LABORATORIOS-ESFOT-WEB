@extends("theme.$theme.layout")
@section('titulo')
    Usuarios
@endsection
@section("scripts")
<script src="{{asset("assets/pages/scripts/admin/usuarios/editar.js")}}" type="text/javascript" defer></script>
@endsection
@section('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <h2>Listado de usuarios</h2>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        @can('users.create') 
            <a href="{{ route('users.create') }}" class="btn btn-block btnCrear">
                <i class="fa fa-user-plus" style="font-size:20px;color:white;"></i>
                Nuevo registro
            </a>
        @endcan
    </div>
</div>
<hr>
@include('includes.mensaje-success')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('users.search')}}" method="get">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <select name="tipo" class="form-control" required>
                                <option value="">Buscar</option>
                                <option value="lastname"
                                    @if (old('tipo')== "lastname" || request('tipo')== "lastname")
                                        {{'selected'}}
                                    @endif
                                >Apellido(s)</option>
                                <option value="cargo"
                                    @if (old('tipo')== "cargo" || request('tipo')== "cargo")
                                        {{'selected'}}
                                    @endif
                                >Cargo</option>
                                <option value="ci"
                                    @if (old('tipo')== "ci" || request('tipo')== "ci")
                                        {{'selected'}}
                                    @endif
                                >Cédula</option>
                                <option value="email"
                                    @if (old('tipo')== "email" || request('tipo')== "email")
                                        {{'selected'}}
                                    @endif
                                >Email</option>
                                <option value="name"
                                    @if (old('tipo')== "name" || request('tipo')== "name")
                                        {{'selected'}}
                                    @endif
                                >Nombre(s)</option>                                
                            </select>
                        </div>
                        <input name="buscarpor" class="form-control" type="search" value="{{ isset($searchingVals) ? $searchingVals['buscarpor'] : '' }}" placeholder="Buscar..." aria-label="Search">
                        <button class="btn btn-dark" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    En la siguiente table se listan todos los usuarios registrados y su estado en ACTIVO. 
                </h3>
                <div class="card-tools">
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col text-center">
                        <a href="{{route('users.index')}}" 
                            class="btn btn-outline-dark btn-sm ml-1 mr-1">
                            <i class="fas fa-filter"></i> 
                            Todos
                        </a>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            @if (count($users_list) > 0)
                            <table class="table table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th width="10px">C&eacute;dula</th>
                                        <th>Foto</th>
                                        <th>Apellido(s)</th>
                                        <th>Nombre(s)</th>
                                        <th>Email</th>
                                        <th>Estado</th>
                                        <th>Cargo</th>
                                        <th colspan="3">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($users_list as $user)
                                <tr>
                                    <td>{{$user->ci}}</td>
                                    <td>
                                        @if (isset($user->avatar))
                                        <img src="{{asset("storage").'/'.$user->avatar}}" 
                                            class="img-thumbnail img-fluid" 
                                            alt="img_user"
                                            width="100"
                                            >
                                        @else
                                            <img src="{{asset("/img/user_default.png")}}"  
                                                class="img-thumbnail img-fluid" 
                                                alt="img_user" 
                                                width="100">
                                        @endif
                                    </td>
                                    <td>{{$user->lastname}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>   
                                        @foreach ($user->getRelationRoleUser() as $role)
                                        <small 
                                            @if ($role->pivot->state == 'ACTIVO')
                                                class="badge badge-success"
                                            @else
                                                class="badge badge-danger"
                                            @endif 
                                            style="font-size: 12px;">
                                            {{$role->pivot->state}}
                                        </small>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($user->getRelationRoleUser() as $role)
                                            {{$role->name}}
                                        @endforeach
                                    </td>                
                                    <td width='10px'>
                                        @can('users.show')
                                        <button type="button" 
                                            class="btn btn-block btnVer" 
                                            data-toggle="modal" 
                                            data-target="#verUsuario{{$user->id}}"
                                            title="Ver Usuario"
                                            style="margin: auto;"
                                            >Ver
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" 
                                            id="verUsuario{{$user->id}}" 
                                            tabindex="-1" 
                                            role="dialog" 
                                            aria-labelledby="modalVerUsuario" 
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalVerUsuario">Usuario</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                @if (isset($user->avatar))
                                                                    <img src="{{asset("storage").'/'.$user->avatar}}" 
                                                                        style="width:auto;height:200px;" 
                                                                        class="img-thumbnail img-fluid" 
                                                                        alt="img_user">
                                                                @else
                                                                    <img src="{{asset("/img/user_default.png")}}"  
                                                                        class="img-fluid" 
                                                                        alt="logo" 
                                                                        style="width:auto;height:200px;">
                                                                @endif
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-left" style="text-align: left">
                                                                <label><strong>C&eacute;dula: </strong></label> {{ $user->ci}}<br>
                                                                <label><strong>Nombre(s): </strong></label> {{ $user->name}}<br>
                                                                <label><strong>Apellido(s): </strong></label> {{ $user->lastname}}<br>
                                                                <label><strong>Email: </strong></label> {{ $user->email}}<br>
                                                                <label><strong>Cargo: </strong></label>
                                                                @foreach ($user->getRelationRoleUser() as $role)
                                                                    {{$role->name}}
                                                                @endforeach
                                                                <br>
                                                                <label><strong>Estado: </strong></label>
                                                                @foreach ($user->getRelationRoleUser() as $role)
                                                                <small 
                                                                    @if ($role->pivot->state == 'ACTIVO')
                                                                        class="badge badge-success"
                                                                    @else
                                                                        class="badge badge-danger"
                                                                    @endif 
                                                                    style="font-size: 12px;">
                                                                    {{$role->pivot->state}}
                                                                </small>
                                                                @endforeach<br>                                                         
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endcan
                                    </td>
                                    <td width="10px">
                                        @can('users.edit')
                                        @if (Auth::user()->id != $user->id)
                                        @foreach ($user->getRelationRoleUser() as $role)
                                            @if ($role->pivot->state == 'ACTIVO')
                                                <a href="{{route('users.edit', Crypt::encrypt($user->id))}}" 
                                                    class="btn btn-block btnEditar"
                                                    title="Editar Usuario"
                                                    >Editar
                                                </a>
                                            @else
                                                <form action="{{route('users.activar',$user->id)}}" method="get" role="form">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-block btn-warning" 
                                                        onclick="return confirm('Estas seguro de activar al usuario {{ $user->name}} {{ $user->lastname}}?')">
                                                        Activar
                                                    </button>
                                                </form>
                                            @endif
                                        @endforeach
                                        @endif
                                        @endcan
                                    </td>
                                    <td width="10px">
                                        @can('users.destroy')
                                        @if (Auth::user()->id != $user->id)
                                        @foreach ($user->getRelationRoleUser() as $role)
                                            @if ($role->pivot->state != 'INACTIVO')
                                                @if ($role->slug != "director(a)" && $role->slug != "administrador")
                                                    <form action="{{route('users.destroy',$user->id)}}" method="post" role="form">
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" 
                                                            class="btn btn-block btn-danger" 
                                                            onclick="return confirm('Estas seguro de desactivar al usuario {{ $user->name}} {{ $user->lastname}}?')"
                                                            title="Desactivar temporalmente al usuario"
                                                            >
                                                            Desactivar
                                                        </button>
                                                    </form>
                                                @endif
                                            @else
                                                <form action="{{route('users.destroy_all',$user->id)}}" method="post" role="form">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-block btn-danger" 
                                                        onclick="return confirm('Estas seguro de eliminar Completamente el Usuario:  {{ $user->name}} {{ $user->lastname}}?')">
                                                        Eliminar</button>
                                                </form>
                                            @endif
                                        @endforeach
                                        @endif
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                                <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    <label for="">No hay usuarios registrados.</label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <span class="text-muted float-right">Total: {{$users_list->total()}}</span>
                <nav>
                    {{$users_list->appends(request()->query())->links()}}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection