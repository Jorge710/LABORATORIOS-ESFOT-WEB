@extends("theme.$theme.layout")
@section('titulo') 
Equipos Prestados 
@endsection
@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/prestamoEquipos/crear.js")}}" type="text/javascript" defer></script>
@endsection
@section('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <h2>Listado de los equipos prestados</h2>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        @can('equiposprestamos.create')
            <a class="btn btn-block btnCrear" href="{{ route('equiposprestamos.create') }}">
                <i class="fa fa-plus-circle" style="font-size:20px;color:white;"></i>
                Nuevo registro de prestamo
            </a>
        @endcan
        @can('equiposprestamos.create')
        <a class="btn btn-block btn-secondary" href="{{ route('equiposprestamos.historial') }}">
            <i class="far fa-file-alt" style="font-size:20px;color:white;"></i>
            Historial de los registro de prestamo
        </a>
        @endcan
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        @include('includes.mensaje-success')
        @include('includes.mensaje-error')
        <div class="card">
            <div class="card-header">
                <span>En la siguiente tabla se muestran todos los equipos que aún no son devueltos.</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive" id="tab_scroll">
                            @if (count($equipment) > 0)
                            <table class="table table-condensed table-hover">
                                <thead>
                                    <th>Imagen</th>
                                    <th>Equipo</th>
                                    <th>Prestado por</th>
                                    <th>Prestado a</th>
                                    <th>Facultad</th>
                                    <th>Carrera</th>
                                    <th>Fecha prestamo</th>
                                    <th>Observaci&oacute;n</th>
                                    <th colspan="3">Opciones</th>                        
                                </thead>
                                <tbody>
                                @foreach ($equipment as $data)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{asset("storage").'/'.$data->image_equipment}}" 
                                            width="70px" 
                                            class="img-thumbnail img-fluid" 
                                            alt="img_equipo">
                                    </td>
                                    <td>({{$data->code_locations}}-{{$data->code_areas}}-{{$data->code_systems}}-{{$data->code}})</td>
                                    <td>{{$data->lent_by}}</td>
                                    <td>{{$data->equi_prestamo_name}}</td>
                                    <td>{{$data->faculty}}</td>
                                    <td>{{$data->career}}</td>
                                    <td>{{$data->loan_date}}</td>
                                    <td style="text-align: justify;">{{$data->loan_observation}}</td>
                                    <td>
                                        @can('equiposprestamos.index')
                                        <button type="button" 
                                            class="btn btn-block btnVer" 
                                                data-toggle="modal" 
                                                data-target="#devolverEquipo{{$data->id}}"
                                            >Devolver
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" 
                                            id="devolverEquipo{{$data->id}}" 
                                            tabindex="-1" 
                                            role="dialog" 
                                            aria-labelledby="modalDevolverEquipo" 
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">({{$data->code_locations}}-{{$data->code_areas}}-{{$data->code_systems}}-{{$data->code}})-{{$data->name}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4>Devolver equipo</h4>
                                                        <form action="{{route('equiposprestamos.update',$data->id)}}" id="form-general" class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
                                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                            <input type="hidden" name="_method" value="PUT">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="form-group" style="text-align: left">
                                                                    <strong><label for="" class="requerido">Equipo:</label></strong>
                                                                    <select name="id" class="form-control" required>
                                                                        <option value="{{$data->id}}">{{$data->code}}-{{$data->name}}</option>
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                    <br>
                                                                    <img src="{{asset("storage").'/'.$data->image_equipment}}" 
                                                                        style="width:auto;height:200px;" 
                                                                        class="img-thumbnail img-fluid" 
                                                                        alt="img_equipo">
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                    <div class="form-group" style="text-align: left">
                                                                    <strong><label for="" class="requerido">Observaci&oacute;n:</label></strong>
                                                                    <textarea id="max_equiPrest_observacion" name="observation_return" rows="5" class="form-control">{{ isset($data->observation_return ) ? $data->observation_return :'' }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <div style="float: right">
                                                                        <button type="submit" class="btn btn-block btnVer">Devolver</button>  
                                                                        <button type="button" class="btn btn-block btn-danger" data-dismiss="modal">Cancelar</button>     
                                                                    </div>
                                                                </div>  
                                                            </div>    
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                                <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    <label for="">No hay equipos prestados dirijase al bot&oacute;n de  "Nuevo registro"</label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                
            </div>
        </div>
    </div>
</div>
@endsection


  
  