@extends("theme.$theme.layout")
@section('titulo') 
Crear Usuarios 
@endsection
@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/usuarios/crear.js")}}" type="text/javascript" defer></script>
@endsection
@section('contenido')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
              <li class="breadcrumb-item active" aria-current="page">Crear Usuario</li>
            </ol>
          </nav>
    </div>
</div>
@include('includes.mensaje-error')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <form action="{{ route('users.store')}}" id="form-general" class="form-horizontal" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="ci" class="col-md-4 col-form-label text-md-right">Avatar <span class="text-muted">(Opcional)</span>:</label>
                                    
                                <div class="col-md-6">
                                    <input type="file" name="avatar"  class="form-control" placeholder="Avatar">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="ci" class="col-md-4 col-form-label text-md-right requerido">{{ __('Cédula:') }}</label>
                    
                                <div class="col-md-6">
                                    <input id="max_user_id" type="text" class="form-control enteros" name="ci" value="{{ old('ci') }}" required autocomplete="ci" autofocus>
                                    @error('ci')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right requerido">{{ __('Nombre(s):') }}</label>
                                <div class="col-md-6">
                                    <input id="max_user_nombre" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right requerido">{{ __('Apellido(s):') }}</label>
                                <div class="col-md-6">
                                    <input id="max_user_apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastaname" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right requerido">{{ __('E-Mail:') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                           
                            {{-- <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 style="text-align: center;">Lista de laboratorios</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <ul class="list-unstyled">
                                                    @foreach ($locations as $location)
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" name="locations[]" value="{{ $location->id }}">
                                                                {{ $location->id }} - {{ $location->name }}
                                                                <em>({{ $location->description }})</em>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br> --}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-block btnVer">
                                        {{ __('Guardar') }}
                                    </button>
                                    <a href="{{route('users.index')}}" class="btn btn-block btn-danger">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

