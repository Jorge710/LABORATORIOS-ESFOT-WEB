@extends("theme.$theme.layout")
@section('titulo') 
Sistemas 
@endsection
@section('contenido')
<div class="row">  
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <h2>Listado de sistemas</h2>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        @can('sistemas.create')
            <a class="btn btn-block btnCrear" href="{{ route('sistemas.create') }}">
                <i class="fa fa-plus-circle" style="font-size:20px;color:white;"></i>
                Nuevo registro
            </a>
        @endcan
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('sistemas.search')}}" method="get">
                    <div class="input-group">
                        <div class="input-group-prepend">        
                            <select name="tipo" class="form-control" required>
                                <option value="">Buscar</option>
                                <option value="name"
                                    @if (old('tipo')== "name" || request('tipo')== "name")
                                        {{'selected'}}
                                    @endif
                                >Nombre</option>
                                <option value="code"
                                    @if (old('tipo')== "code" || request('tipo')== "code")
                                        {{'selected'}}
                                    @endif
                                >Sistema</option>
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
        @include('includes.mensaje-error')
        @include('includes.mensaje-success')
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col text-center">
                        <a href="{{route('sistemas.index')}}" class="btn btn-outline-dark btn-sm ml-1 mr-1"><i class="fas fa-filter"></i> Todos</a>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            @if (count($systems) > 0)
                            <table class="table table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>Laboratorio</th>
                                        <th>&Aacute;rea</th>
                                        <th>Sistema</th>
                                        <th>Nombre</th>
                                        <th colspan="3">Opciones</th>
                                    </tr>
                                </thead> 
                                <tbody>   
                                    @foreach ($systems as $system)
                                    <tr>
                                        <td>{{$system->loc_code}}</td>
                                        <td>{{$system->area_code}}</td>
                                        <td>{{$system->sist_code}}</td>
                                        <td>{{$system->name}}</td>
                                        <td>
                                            @can('sistemas.show')
                                                <a href="{{route('sistemas.show',Crypt::encrypt($system->id))}}" 
                                                    class="btn btn-block btnVer"
                                                    title="Ver equipos"
                                                    >Ver los equipos
                                                </a>
                                            @endcan
                                        </td>
                                        <td>
                                            @can('sistemas.edit')
                                                <a href="{{route('sistemas.edit',Crypt::encrypt($system->id))}}" 
                                                    class="btn btn-block btnEditar"
                                                    title="Editar sistema"
                                                    >
                                                    Editar
                                                </a>
                                            @endcan
                                        </td>
                                        <td>
                                            @can('sistemas.destroy')
                                                <form action="{{route('sistemas.destroy',Crypt::encrypt($system->id))}}" method="post" role="form">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" 
                                                        class="btn btn-block btn-danger" 
                                                        onclick="return confirm('Estas seguro de eliminar {{$system->name}}?')"
                                                        title="Eliminar sistema"
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
                                    <label for="">No hay sistemas registrados.</label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <span class="text-muted float-right">Total: {{$systems->total()}}</span>
                <nav>
                    {{$systems->appends(request()->query())->links()}}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection