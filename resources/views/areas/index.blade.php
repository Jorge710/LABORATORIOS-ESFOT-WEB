@extends("theme.$theme.layout")
@section('titulo') 
&Aacute;reas 
@endsection
@section('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <h2>Listado de &aacute;reas</h2>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        @can('areas.create')
            <a class="btn btn-block btnCrear" href="{{ route('areas.create') }}">
                <i class="fa fa-plus-circle" style="font-size:20px;color:white;"></i>
                Nuevo registro
            </a>
        @endcan
    </div>
</div>
<br>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('areas.search')}}" method="get">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <select name="tipo" class="form-control" required>
                                <option value="">Buscar</option>
                                <option value="code"
                                    @if (old('tipo')== "code" || request('tipo')== "code")
                                        {{'selected'}}
                                    @endif
                                >&Aacute;rea</option>
                                <option value="name"
                                    @if (old('tipo')== "name" || request('tipo')== "name")
                                        {{'selected'}}
                                    @endif
                                >Nombre</option>
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
            <div class="card-header"></div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col text-center">
                        <a href="{{route('areas.index')}}" class="btn btn-outline-dark btn-sm ml-1 mr-1">
                            <i class="fas fa-filter"></i> Todos
                        </a>
                    </div> 
                </div>
                <div class="row">        
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            @if (count($areas) > 0)
                            <table class="table table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th width="10px">Laboratorio</th>
                                        <th><b>&Aacute;rea</b></th>
                                        <th>Nombre</th>
                                        <th>Imagen</th>
                                        <th colspan="3">Opciones</th>
                                    </tr>
                                </thead> 
                                <tbody>                   
                                @foreach ($areas as $area)
                                <tr>
                                    <td>{{$area->code_loc}}</td>              
                                    <td>{{$area->code}}</td>
                                    <td>{{$area->name}}</td>
                                    <td>
                                        @if (isset($area->image_areas))
                                            <img src="{{asset("storage").'/'.$area->image_areas}}" 
                                                width="70px" 
                                                class="img-thumbnail img-fluid" 
                                                alt="img_area">
                                        @else
                                            <img src="{{asset("/img/edesfotweb.jpg")}}"  
                                                class="img-thumbnail img-fluid" 
                                                alt="logo" 
                                                width="70px">
                                        @endif
                                    </td>
                                    <td>
                                        @can('areas.show')
                                            <button type="button" 
                                                class="btn btn-block btnVer" 
                                                data-toggle="modal" 
                                                data-target="#verArea{{$area->id}}"
                                                title="Ver área"
                                                >Ver
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" 
                                                id="verArea{{$area->id}}" 
                                                tabindex="-1" 
                                                role="dialog" 
                                                aria-labelledby="modalVerArea" 
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="modalVerArea">{{$area->name}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                @if (isset($area->image_areas))
                                                                    <img src="{{asset("storage").'/'.$area->image_areas}}" 
                                                                        style="width:auto;height:200px;" 
                                                                        class="img-thumbnail img-fluid" 
                                                                        alt="img_area">
                                                                @else
                                                                    <img src="{{asset("/img/edesfotweb.jpg")}}"  
                                                                        class="img-fluid" 
                                                                        alt="logo" 
                                                                        style="width:auto;height:200px;">
                                                                @endif
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="text-align: left">
                                                                <label for=""><strong>Descripci&oacute;n:</strong></label><br>
                                                                <p style="text-align: justify;">{{$area->description}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <label for=""><strong>Laboratorio:</strong></label>
                                                            {{$area->code_loc}} 
                                                            <label for=""><strong>&Aacute;rea:</strong></label>
                                                            {{$area->code}}
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('areas.edit')
                                            <a href="{{route('areas.edit', Crypt::encrypt($area->id))}}" 
                                                class="btn btn-block btnEditar"
                                                title="Editar área"
                                                >
                                                Editar
                                            </a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('areas.destroy')
                                            <form action="{{route('areas.destroy',$area->id)}}" method="post" role="form">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" 
                                                    class="btn btn-block btn-danger" 
                                                    onclick="return confirm('Estas seguro de eliminar {{$area->name}}?')"
                                                    title="Eliminar área"
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
                                    <label for="">No hay &aacute;reas registradas.</label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <span class="text-muted float-right">Total: {{$areas->total()}}</span>
                <nav>
                    {{$areas->appends(request()->query())->links()}}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection