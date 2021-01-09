@extends("theme.$theme.layout")
@section('titulo') 
Laboratorios 
@endsection
@section('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <h2>Listado de laboratorios</h2>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @can('localizaciones.create')
                <a class="btn btn-block btnCrear" href="{{ route('localizaciones.create') }}" title="Crear un ">
                    <i class="fa fa-plus-circle" style="font-size:20px;color:white;"></i>
                    Nuevo registro 
                </a>
            @endcan 
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('localizaciones.search')}}" method="get">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <select name="tipo" class="form-control" required>
                                <option value="">Buscar</option>
                                <option value="code" 
                                    @if (old('tipo')== "code" || request('tipo')== "code")
                                        {{'selected'}}
                                    @endif
                                >C&oacute;digo</option>
                                <option value="name"
                                    @if (old('tipo')== "name" || request('tipo')== "name")
                                        {{'selected'}}
                                    @endif
                                >Laboratorio</option>
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
        @include('includes.mensaje-success')
        @include('includes.mensaje-error')
        <div class="card">
            <div class="card-header">
                <span for="">En la siguiente tabla se presentan los laboratorios que est&aacute;n a su cargo.</span><br>
                <span>Si no encuentra el laboratorio en la lista solicite al administrador que se le <strong>asigne un laboratorio</strong>.</span>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col text-center">
                        <a href="{{route('localizaciones.index')}}" 
                            class="btn btn-outline-dark btn-sm ml-1 mr-1">
                            <i class="fas fa-filter"></i>Todos
                        </a>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            @if (count($locations) > 0)
                            <table class="table table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th width="10px"><b>C&oacute;digo</b></th>
                                        <th>Laboratorio</th>
                                        <th>Imagen</th>
                                        <th colspan="3">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($locations as $location)
                                    <tr>
                                        <td>{{$location->code}}</td>
                                        <td>{{$location->name}}</td>
                                        <td>
                                            @if (isset($location->image_locations))
                                                <img src="{{asset("storage").'/'.$location->image_locations}}" 
                                                    width="70px" 
                                                    class="img-thumbnail img-fluid" 
                                                    alt="img_laboratorio">
                                            @else
                                                <img src="{{asset("/img/edesfotweb.jpg")}}"  
                                                    class="img-fluid" 
                                                    alt="img_laboratorio" 
                                                    width="70px">
                                            @endif
                                        </td>
                                        <td>
                                            @can('localizaciones.show')
                                                <button type="button" 
                                                    class="btn btn-block btnVer" 
                                                    data-toggle="modal" 
                                                    data-target="#verLocalizacion{{$location->id}}"
                                                    title="Ver Laboratorio"
                                                    >Ver
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" 
                                                    id="verLocalizacion{{$location->id}}" 
                                                    tabindex="-1" 
                                                    role="dialog" 
                                                    aria-labelledby="modalVerLocalizacion" 
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="modalVerLocalizacion">{{$location->name}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                    @if (isset($location->image_locations))
                                                                        <img src="{{asset("storage").'/'.$location->image_locations}}" 
                                                                            style="width:auto;height:200px;" 
                                                                            class="img-fluid" 
                                                                            alt="img_laboratorio">
                                                                    @else
                                                                        <img src="{{asset("/img/edesfotweb.jpg")}}"  
                                                                            class="img-fluid" 
                                                                            alt="logo" 
                                                                            style="width:auto;height:200px;">
                                                                    @endif
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="text-align: left">
                                                                    <label for=""><strong>Descripci&oacute;n:</strong></label><br>
                                                                    <p style="text-align: justify;">{{$location->description}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <label for=""><strong>Tel&eacute;fono:</strong></label>
                                                            {{$location->telephone}} -
                                                            <label for=""><strong>Ext:</strong></label>
                                                            {{$location->ext}}
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endcan
                                        </td>
                                        <td>
                                            @can('localizaciones.edit')
                                                <a href="{{route('localizaciones.edit', Crypt::encrypt($location->id))}}" 
                                                    class="btn btn-block btnEditar"
                                                    title="Editar Laboratorio"
                                                    >
                                                    Editar
                                                </a>
                                            @endcan
                                        </td>
                                        <td>
                                            @can('localizaciones.destroy')
                                                <form action="{{route('locaclizaciones.destroy',$location->id)}}" method="post" role="form">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" 
                                                    class="btn btn-block btn-danger" onclick="return confirm('Estas seguro de eliminar {{$location->name}}?')"
                                                    title="Eliminar Laboratorio"
                                                    >
                                                    Eliminar
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                                <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    <label for="">No hay laboratorios registrados.</label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <span class="text-muted float-right">Total: {{$locations->total()}}</span>
                <nav>
                    {{$locations->appends(request()->query())->links()}}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection