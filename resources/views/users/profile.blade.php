@extends("theme.$theme.layout")
@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/usuarios/crear.js")}}" type="text/javascript" defer></script>
@endsection
@section('titulo')
    Perfil
@endsection
@section('contenido')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>Perfil</h2>
    </div>
</div>
<hr>
@include('includes.mensaje-error')
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            {{-- formulario avatar --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Avatar</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('users.updateAvatar', $user->id) }}" id="form-general" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                @if (isset($user->avatar))
                                    <br>
                                    <img src="{{asset("storage").'/'.$user->avatar}}" width="100" class="img-thumbnail img-fluid" alt="img_equipo">
                                    <br>
                                @else
                                    <img src="{{asset("/img/user_default.png")}}"  
                                        class="img-thumbnail img-fluid" 
                                        alt="img_user" 
                                        width="100">
                                @endif
                                <div class="form-group">
                                    <input type="file" name="avatar"  class="form-control" placeholder="Avatar">
                                </div>
                                <button type="submit" class="btn btn-block btn-primary">Actualizar avatar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- formulario contraseña --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Cambiar Contraseña</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('users.updatePassword', Crypt::encrypt($user->id)) }}" id="form-general" method="post">
                    
                                @csrf
                                <div class="form-group row">
                                    <label for="old_password" class="col-md-12 col-form-label text-md-left requerido">{{ __('Contraseña Actual:') }}</label>
                                    
                                    <div class="col-md-12">
                                        <input type="password" name="old_password" class="form-control" id="old_password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-12 col-form-label text-md-left requerido">{{ __('Nueva Contraseña:') }}</label>
                        
                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-12 col-form-label text-md-left requerido">{{ __('Confirmar Nueva Contraseña:') }}</label>
                        
                                    <div class="col-md-12">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"> <br>
                                        <button type="submit" class="btn btn-primary btn-block">Actualizar contraseña</button>
                                    </div>
                                </div>               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- lado izq --}}
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            {{-- formulario datos personales --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Datos Personales</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('users.updateDatosUsuario', $user->id) }}" id="form-general" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
    
                                <div class="form-group">
                                    <strong><label for="ci" class="requerido">C&eacute;dula:</label></strong>
                                    <input id="max_user_id" class="form-control enteros" name="ci" type="text" value="@isset($user->ci){{ $user->ci }}@endisset" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <strong><label for="name" class="requerido">Nombre(s):</label></strong>
                                    <input name="name" type="text" id="max_user_nombre" value="@isset($user->name){{ $user->name }}@endisset" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <strong><label for="lastname" class="requerido">Apellido(s):</label></strong>
                                    <input name="lastname" type="text" id="max_user_apellido" value="@isset($user->lastname){{ $user->lastname }}@endisset" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <strong><label for="email" class="requerido">Email:</label></strong><br>
                                    <span>@isset($user->email){{ $user->email }}@endisset</span><br>
                                    @foreach (Auth::user()->getRelationRoleUser() as $role)
                                    @if ($role->slug != 'administrador')
                                        <span class="text-muted">(Si necesita actualizar su email comuniquese con el administrador)</span>
                                        {{-- <input name="email" type="text" value="@isset($user->email){{ $user->email }}@endisset" class="form-control" required> --}}
                                    @endif
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-block btn-primary">Actualizar datos personales</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


  
  