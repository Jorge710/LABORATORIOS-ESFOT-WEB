@extends("theme.$theme.layout")
@section('titulo') 
Historial equipos prestados 
@endsection
@section('contenido')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('equiposprestamos.index') }}">Equipos prestados</a></li>
              <li class="breadcrumb-item active" aria-current="page">Historial de equipos prestados</li>
            </ol>
          </nav>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <h2>Historial equipos prestados</h2>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <form action="{{ route('equiposprestamos.searchHistorial')}}" method="get">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">        
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="" class="requerido">Fecha inicio: <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Es el punto de inicio del intervalo para realizar el filtro de la b&uacute;squeda."></i></label><br>
                                    <input id="datefield" type="date" data-date-format="YYYY MMMM DD H:i:s" name="from" style="width: 50%;" value="{{ isset($searchingVals) ? $searchingVals['from'] : '' }}" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <label for="" class="requerido">Fecha fin: <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Es el punto fin del intervalo para realizar el filtro de la b&uacute;squeda."></i></label><br>
                                    <span><?php echo  date('d-m-Y')?></span>
                                    {{-- <label for="" class="requerido">Fecha Fin: <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Es el punto fin del intervalo para realizar el filtro de la b&uacute;squeda."></i></label><br>
                                    <input type="date" data-date-format="YYYY MMMM DD" name="to" style="width: 50%;" value="{{ isset($searchingVals) ? $searchingVals['to'] : '' }}" required> --}}
                                </div>
                            </div>
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
<div class="row">
    <div class="col-lg-12">
        @include('includes.mensaje-error')
        @include('includes.mensaje-success')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    
                </h3>
                <div class="card-tools">
                    @can('report.download')
                    <form class="form-horizontal" role="form" method="get" action="{{ route('equiposprestamos.pdfexport') }}">
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
                        <div class="table-responsive" id="tab_scroll">
                            @if (count($equipment) > 0)
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Equipo</th>
                                        <th>Prestado por</th>
                                        <th>Fecha prestamo</th>
                                        <th>Fecha devolución</th>
                                        <th>Recibido por</th>
                                        <th colspan="3">Opciones</th>
                                    </tr>
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
                                        <td>{{$data->loan_date}}</td>
                                        <td
                                            @if (isset($data->return_date))
                                                style="background:#6ef97d;"}}
                                            @else
                                                style="background: #f96e70;"
                                            @endif
                                        >{{$data->return_date ?? 'Pendiente'}}</td>
                                        <td>{{$data->received_by ?? 'Pendiente'}}</td>
                                        <td>
                                            @can('equiposprestamos.index')
                                                <button type="button" 
                                                    class="btn btn-block btnVer" 
                                                    data-toggle="modal" 
                                                    data-target="#devolverEquipo{{$data->equi_id}}"
                                                    >Estado
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" 
                                                    id="devolverEquipo{{$data->equi_id}}"
                                                    >
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">{{$data->name}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <!-- Timelime example  -->
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <!-- The time line -->
                                                                        <div class="timeline">
                                                                            <!-- timeline item -->
                                                                            <div>
                                                                                <i class="fas fa-envelope bg-blue"></i>
                                                                                <div class="timeline-item">
                                                                                <span class="time"><i class="fas fa-clock"></i>Fecha prestamo: {{$data->loan_date}}</span>
                                                                                {{-- <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3> --}}
            
                                                                                <div class="timeline-body">
                                                                                    <div class="content form-group" style="text-align: left">
                                                                                        <p><strong>Prestado por:</strong> {{$data->lent_by}}</p>
                                                                                        <p><strong>Prestado a:</strong> {{$data->equi_prestamo_name}}</p>
                                                                                        <p><strong>Facultad:</strong> {{$data->faculty}}</p>
                                                                                        <p><strong>Carrera:</strong> {{$data->career}}</p>
                                                                                        <p><strong>Observaciones:</strong> {{$data->loan_observation}}</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="timeline-footer">
                                                                                </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- END timeline item -->
                                                                            <!-- timeline item -->
                                                                            <div>
                                                                                <i class="fas fa-envelope bg-blue"></i>
                                                                                <div class="timeline-item">
                                                                                <span class="time"><i class="fas fa-clock"></i>Fecha Devoluci&oacute;n: {{$data->return_date ?? 'Pendiente'}}</span>
                                                                                {{-- <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3> --}}
            
                                                                                <div class="timeline-body">
                                                                                    <div class="content form-group" style="text-align: left">
                                                                                        <p><strong>Prestado por:</strong> {{$data->lent_by}}</p>
                                                                                        <p><strong>Prestado a:</strong> {{$data->equi_prestamo_name}}</p>
                                                                                        <p><strong>Facultad:</strong> {{$data->faculty}}</p>
                                                                                        <p><strong>Carrera:</strong> {{$data->career}}</p>
                                                                                        <p><strong>Observaciones:</strong> {{$data->observation_return ?? 'Pendiente'}}</p>
                                                                                        <p><strong>Recibido por:</strong> {{$data->received_by ?? 'Pendiente'}}</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="timeline-footer">
                                                                                </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- END timeline item -->
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.col -->
                                                                </div>
                                                              </div>
                                                              <!-- /.timeline -->
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
                                    <label for="">No hay registros del historial de los equipos prestados.</label>
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


  
  