@extends("theme.$theme.layout")
@section('titulo') 
Tareas 
@endsection
@section('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <h2>Listado de las mensajes</h2>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-12">
        @include('includes.mensaje-success')
        @include('includes.mensaje-error')
        <div class="card">
            <div class="card-header">
               
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive" id="tab_scroll">
                            @if (count($mensajes) > 0)
                            <table class="table table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>C&oacute;digo Equipo</th>
                                        <th>Nombre del Equipo</th>
                                        <th>Creado a las</th>
                                        <th>Fecha Realizado</th>
                                        <th colspan="3">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mensajes as $data)
                                    <tr>
                                        <td>{{$data->code_locations}}-{{$data->code_areas}}-{{$data->code_systems}}-{{$data->code}}</td>
                                        <td>{{$data->name}}</td>
                                        <td>{{$data->created_at}}</td>
                                        <td>{{$data->maintenance_date ?? 'Pendiente'}}</td>
                                        <td>
                                            @can('messages.show')
                                                <a href="{{route('messages.show',$data->id)}}" class="btn btn-block btn-info">Ver</a>
                                            @endcan
                                        </td>
                                        <td>
                                            @can('equipos.show')
                                                <button type="button" 
                                                    class="btn btn-block btnVer" 
                                                    data-toggle="modal" 
                                                    data-target="#devolverEquipo{{$data->id}}"
                                                    ><i class="fa fa-fw fa-reply-all"></i>Marcar Como Realizado
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" 
                                                    id="devolverEquipo{{$data->id}}" 
                                                    tabindex="-1" 
                                                    role="dialog" 
                                                    aria-labelledby="exampleModalLabel" 
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Equipo: {{$data->id}}-{{$data->name}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('messages.mantenimiento',$data->id)}}" id="form-general" class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
                                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                                <input type="hidden" name="_method" value="PUT">
                                                                {{-- <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="form-group" style="text-align: left">
                                                                            <strong><label for="" class="requerido">Equipo:</label></strong>
                                                                            <select name="id" class="form-control" required>
                                                                                <option value="{{$data->id}}">{{$data->code}}-{{$data->name}}</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br> --}}
                                                                <div class="row">
                                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                        <br>
                                                                        <img src="{{asset("storage").'/'.$data->image_equipment}}" style="width:auto;height:200px;" class="img-thumbnail img-fluid" alt="img_equipo">
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                        <div class="form-group" style="text-align: left">
                                                                            <strong><label for="" class="requerido">Observaci&oacute;n:</label></strong>
                                                                            <textarea id="max_equiPrest_observacion" name="maintenance_report" rows="5" class="form-control">{{ isset($data->maintenance_report ) ? $data->maintenance_report :'' }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                        <button type="submit" class="btn btn-block btnVer">Aceptar</button>  
                                                                        <button type="button" class="btn btn-block btn-danger" data-dismiss="modal">Cancelar</button>     
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
                                    <label for="">No hay tareas pendientes.</label>
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