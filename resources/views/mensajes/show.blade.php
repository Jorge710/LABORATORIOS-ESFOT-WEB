@extends("theme.$theme.layout")
@section('contenido')
<h3>Mantenimiento - Equipo</h3>
<hr>
<div class="container">
    @foreach ($tarea_mensajes as $data)
    @endforeach
    <div class="row" id="contentBodyEquipo">
        <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12">            
            <strong>Nombre:</strong><br><br>
            {{$data->name}}
        </div>
        <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12">
            <strong>C&oacute;digo:</strong><br><br>
            @foreach ($informacion_equipo as $item)
            {{$item->loc_id}}-{{$item->area_id}}-{{$item->sist_id}}
            @endforeach
            -{{$data->code}}
        </div>       
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="card" style="width: 100%;">
                <div class="card-header" id="cabeceraForm">
                    <strong>T&aacute;rea</strong>
                </div>
                <div class="card-body">
                    <p>{{$data->body}}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <img src="{{asset("storage").'/'.$item->image_equipment}}" width="300" class="img-thumbnail img-fluid" alt="img_equipo">
        </div>
    </div>
    <br>
    <h3>ELEMENTOS</h3>
    <hr>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive" id="tab_scroll">
                @if (count($informacion_elemento) > 0)
                <table class="table table-condensed table-hover">
                    <thead>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Imagen</th>
                        <th>Tipo Fallo</th>
                        <th>Clasificaci&oacute;n</th>
                        {{-- <th>Frecuencia</th> --}}
                        <th>Opciones</th>
                    </thead>
                    @foreach ($informacion_elemento as $elements)
                    <tr>
                        <td>{{$elements->elem_nomb}}</td>
                        <td>{{$elements->number_of}}</td>
                        <td><img src="{{asset("storage").'/'.$elements->elem_img}}" width="100" class="img-thumbnail img-fluid" alt="img_equipo"></td>
                        <td>{{$elements->elem_tipoFallo}}</td>
                        <td>{{$elements->clasificacion}}</td>
                        {{-- <td>{{$elements->elem_fre}}</td> --}}
                        <td>
                            @can('elementos.show')
                            <button type="button" 
                                class="btn btn-block btnVer" 
                                data-toggle="modal" 
                                data-target="#verElemento{{$elements->elem_id}}"
                                >Ver
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" 
                                id="verElemento{{$elements->elem_id}}" 
                                tabindex="-1" 
                                role="dialog" 
                                aria-labelledby="exampleModalLabel" 
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                {{$elements->elem_nomb}}
                                                <br>
                                                <img src="{{asset("storage").'/'.$elements->elem_img}}" width="50px;" alt="img_elemento">
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="text-align: left;">
                                            <strong>Cantidad: </strong></label>{{$elements->number_of}}
                                            <br><br><strong>Descripci&oacute;n: </strong><br>{{$elements->elem_descrp}}
                                            <br><br><strong>Funci&oacute;n: </strong><br>{{$elements->elem_func}}
                                            <br><br><strong>Descripci&oacute;n Fallo: </strong><br>{{$elements->elem_descFallo}}
                                            <br><br><strong>Tipo De Fallo: </strong>{{$elements->elem_tipoFallo}}
                                            <br><br><strong>Modo de Fallo: </strong><br>{{$elements->failMode}}
                                            <br><br><strong>Clasificaci&oacute;n: </strong>{{$elements->clasificacion}}
                                            <br><br><strong>Actividad: </strong><br>{{$elements->maintenanceActivity}}
                                            {{-- <br><br><strong>Frecuencia: </strong>{{$elements->elem_fre}} --}}
                                            <br><br><strong>Tarea: </strong><br>{{$elements->maintenanceTask}}
                                            <br><br><strong>Mejora: </strong><br>{{$elements->improvements}}
                                        </div>
                                    </div>
                                    <div class="modal-footer">    
                                    </div>
                                </div>
                            </div>
                        @endcan
                        </td>
                    </tr>
                    @endforeach
                </table>
                @else
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <label for="">Este equipo no tiene elementos registrados.</label>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection