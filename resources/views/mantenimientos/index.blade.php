@extends("theme.$theme.layout")
@section('titulo') 
Tareas Historial
@endsection
@section('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <h2>Listado de los mantenimientos</h2>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    </div>
</div>
<br>
{{-- EXPORTAR POR FECHA --}}
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{ route('mantenimientos.search')}}" method="get">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">        
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="" class="requerido">
                                        Fecha inicio: 
                                        <i class="fa fa-question-circle iconoAyuda" 
                                            data-toggle="tooltip" 
                                            data-placement="top" 
                                            title="Es el punto de inicio del intervalo para realizar el filtro de la b&uacute;squeda."></i>
                                        </label><br>
                                    <input id="datefield" type="date" data-date-format="YYYY MMMM DD" name="from" style="width: 50%;" value="{{ isset($searchingVals) ? $searchingVals['from'] : '' }}" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="" class="requerido">
                                        Fecha fin: 
                                        <i class="fa fa-question-circle iconoAyuda" 
                                            data-toggle="tooltip" 
                                            data-placement="top" 
                                            title="Es el punto fin del intervalo para realizar el filtro de la b&uacute;squeda."></i>
                                    </label><br>
                                    <span><?php echo  date('d-m-Y')?></span>
                                </div>
                            </div>
                            <br>
                            {{-- <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <strong>
                                        <label for="" class="requerido">
                                            Pasante: 
                                            <i class="fa fa-question-circle iconoAyuda" 
                                                data-toggle="tooltip" 
                                                data-placement="top" 
                                                title="Es cu&aacute;ndo el equipo puede ser reemplado o reparado inmediatamente."></i>
                                        </label>
                                    </strong>
                                    <select name="id_pasante" class="form-control">
                                        <option value="null"></option>
                                        @foreach ($pasantes as $item)
                                            <option value="{{$item->recipient_id}}">{{$item->commissioned}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <br>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <button type="submit" class="btn btn-block btn-success"><i class="fas fa-search"></i> Buscar</button>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- EXPORTAR POR FECHA Y PASANTE --}}
<div class="row">
    <div class="col-lg-12">
        @include('includes.mensaje-error') 
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    @can('report.download')
                    <form class="form-horizontal" role="form" method="get" action="{{ route('mantenimientos.pdfexport') }}">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{$searchingVals['from']}}" name="from" />
                        <input type="hidden" value="{{$searchingVals['to']}}" name="to" />
                        <button type="submit" class="btn btn-block btn-danger">
                            <i class="fas fa-file-pdf"></i> Exportar a PDF
                        </button>
                    </form>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive" id="formEstilo">
                            @if (count($mensajes_historial) > 0)
                            <table class="table table-hover" id="tabla-data">
                                <thead>
                                    <tr>
                                        <th>C&oacute;digo</th>
                                        <th>Equipo</th>
                                        <th>Persona a cargo del mantenimiento</th>
                                        <th>Fecha enviado</th>
                                        <th>Fecha realizado</th>
                                        <th colspan="3">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($mensajes_historial as $data)
                                <tr>
                                    <td>{{$data->code_locations}}-{{$data->code_areas}}-{{$data->code_systems}}-{{$data->code}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->commissioned}}</td>
                                    <td>{{$data->created_at}}</td>
                                    <td
                                        @isset($data->maintenance_date)
                                            style="background:#7cf356;"
                                        @else
                                            style="background: #f37556;"
                                        @endisset
                                        >{{$data->maintenance_date ?? 'Pendiente'}}</td>
                                    <td>
                                        @can('mantenimientos.show')
                                            <button type="button" 
                                                class="btn btn-block btnVer" 
                                                data-toggle="modal" 
                                                data-target="#devolverEquipo{{$data->id}}"
                                                >Ver
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" 
                                                id="devolverEquipo{{$data->id}}" 
                                                tabindex="-1" 
                                                role="dialog" 
                                                aria-labelledby="exampleModalLabel" 
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">({{$data->code_locations}}-{{$data->code_areas}}-{{$data->code_systems}}-{{$data->code}}) {{$data->name}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                                <img src="{{asset("storage").'/'.$data->image_equipment}}" width="300" class="img-thumbnail img-fluid" alt="img_equipo">
                                                            </div>
                                                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                                <div class="card" style="width: 100%;">
                                                                    <div class="card-header" style="background: cadetblue;">
                                                                        <label for=""><strong><em>T&aacute;rea</em></strong></label>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <p style="text-align: justify;">{{$data->body}}</p>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="card" style="width: 100%;">
                                                                    <div class="card-header" style="background: cadetblue;">
                                                                        <label for=""><strong><em>Novedad de la T&aacute;rea Realizada</em></strong></label>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <p style="text-align: justify;">{{$data->maintenance_report}}</p>
                                                                    </div>
                                                                </div>
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
                                    {{-- <td>
                                        @can('mantenimientos.destroy')
                                            <form action="{{route('mantenimientos.destroy',$data->id)}}" method="post" role="form">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-block btn-danger" onclick="return confirm('Estas seguro de eliminar el mensaje? Si elimina el mensaje se eliminara definitivamente.')"><i class="fa fa-trash"></i>Eliminar</button>
                                            </form>
                                        @endcan
                                    </td> --}}
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                                {{-- <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    <label for="">No hay registros de mantenimientos.</label>
                                </div> --}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <nav>
                    {{$mensajes_historial->appends(request()->query())->links()}}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection