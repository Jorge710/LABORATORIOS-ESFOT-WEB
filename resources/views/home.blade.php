@extends("theme.$theme.layout")
@section('contenido')
{{-- información general --}}
@can('localizaciones.index')
<h5>Informaci&oacute;n general <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Informaci&oacute;n general del estado de los registros en el sistema web."></i></h5>
<hr>
@endcan
<div class="container">
    <div class="row">
        @can('localizaciones.index')
        <div class="col-lg-3 col-6 smallCard">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$locations_number}}</h3>
                    <p>Laboratorios registrados</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('localizaciones.index') }}" class="small-box-footer">
                    M&aacute;s informaci&oacute;n 
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        @endcan
        @can('areas.index')
        <div class="col-lg-3 col-6 smallCard">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$areas_number}}</h3>
    
                    <p>&Aacute;reas registradas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('areas.index') }}" class="small-box-footer">M&aacute;s informaci&oacute;n <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endcan
        @can('users.index')
        <div class="col-lg-3 col-6 smallCard">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$users_number}}</h3>
    
                    <p>Usuarios Registrados</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">M&aacute;s informaci&oacute;n <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endcan
        @can('users.index')
        <div class="col-lg-3 col-6 smallCard">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$user_inactivos_total}}</h3>
    
                    <p>Usuarios inactivos</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">M&aacute;s informaci&oacute;n <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endcan
    </div>
</div>
{{-- tareas de mantenimiento --}}
@can('mantenimientos.index')
    <h5>Tareas de mantenimiento 
        <i class="fa fa-question-circle iconoAyuda" 
            data-toggle="tooltip" 
            data-placement="top" 
            title="Tareas de mantenimiento pendientes.">
        </i>
    </h5>
<hr>
@endcan
<div class="row">
    @can('mantenimientos.index')
    <div class="col-lg-3 col-6 smallCard">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$mensajes_pendientes_number}}</h3>
                <p>Mantenimientos pendientes</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('mantenimientos.index') }}" class="small-box-footer">M&aacute;s informaci&oacute;n <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endcan
</div>
{{-- lista de tareas por hacer --}}
@can('mantenimientos.index')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="ion ion-clipboard mr-1"></i>
            Lista de los equipos enviados para realizar el mantenimiento. 
        </h3>
        <div class="card-tools">
            <ul class="pagination pagination-sm">
                {{$mensajes_historial->render()}}
            </ul>
        </div>
    </div>
    <div class="card-body">
        <ul class="todo-list" data-widget="todo-list">
            @if (count($mensajes_historial) > 0)
            @foreach ($mensajes_historial as $data)
            <li>
                <!-- drag handle -->
                <span class="handle">
                    <i class="fas fa-ellipsis-v">({{$data->code_locations}}-{{$data->code_areas}}-{{$data->code_systems}}-{{$data->code}})</i>
                    <i class="fas fa-ellipsis-v"></i>
                </span>
                <!-- text -->
                <span class="text">{{$data->name}}</span>
                <!-- Emphasis label -->
                <small class="badge badge-warning">
                    <i class="far fa-clock"></i>
                    Fecha enviado: {{$data->created_at}}
                </small>
                <!-- General tools such as edit or delete-->
                <div class="tools">
                    @can('equipos.show')
                        <a href="{{route('equipos.show', Crypt::encrypt($data->equipment_id))}}" 
                            class="btn btn-block btnVer">Ver
                        </a>
                    @endcan
                </div>
            </li>
            @endforeach
            @else
                <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    <label for="">No hay tareas pendientes.</label>
                </div>
            @endif
        </ul>
    </div>
    <div class="card-footer clearfix">
        <a href="{{ route('mantenimientos.index') }}" class="small-box-footer">
            M&aacute;s informaci&oacute;n 
            <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
</div>
@endcan
<hr>
{{-- total equipos por laboratorio --}}
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h5>Total de equipos por laboratorios 
            <i class="fa fa-question-circle iconoAyuda" 
                data-toggle="tooltip" 
                data-placement="top" 
                title="Es el n&uacute;mero total de equipos registrados en cada laboratorio.">
            </i>
        </h5>
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <h5 class="card-title"><em></em></h5>
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);
              
                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Laboratorios', 'Total de equipos:'],  
                                @foreach ($totalEquiposxLaboratorio_chart as $equiposLaboratorio)
                                ['{{ $equiposLaboratorio->LABORATORIO}}', {{$equiposLaboratorio->COUNT_LABORATORIO}}],
                                @endforeach 
                        ]);
              
                        var options = {
                            chart: {
                            title: 'Laboratorios',
                            subtitle: 'Escuela de Formación de Tecnológos',
                            }
                        };
              
                        var chart = new google.charts.Bar(document.getElementById('columnchartTotalEquipos'));
              
                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <p class="card-text"><div id="columnchartTotalEquipos"></div></p>
                <a href="{{ route('sistemas.index') }}" class="small-box-footer">M&aacute;s informaci&oacute;n <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>
<hr>
{{-- total de equipos prestados --}}
@can('equiposprestamos.index')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h5>Equipos prestados 
            <i class="fa fa-question-circle iconoAyuda" 
                data-toggle="tooltip" 
                data-placement="top" 
                title="Estado actual de los equipos que a&uacute;n no han sido devueltos.">
            </i>
        </h5>
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <h5 class="card-title"><em></em></h5>
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);
              
                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Laboratorios', 'Total'],  
                            @foreach ($totalEquiposPrestadosxLaboratorio_chart as $equiposPrestadosLaboratorio)
                                ['{{ $equiposPrestadosLaboratorio->EQUI_PRESTADO_LABORATORIO}}', {{$equiposPrestadosLaboratorio->COUNT_EQUI_PRESTADO_LABORATORIO}}],
                            @endforeach
                        ]);
              
                        var options = {
                            chart: {
                            title: 'Laboratorios',
                            subtitle: 'Escuela de Formación de Tecnológos',
                            }
                        };
                
                        var chart = new google.charts.Bar(document.getElementById('columnchartEquiposPrestados'));
                
                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
              
                <p class="card-text"><div id="columnchartEquiposPrestados"></div></p>
                <a href="{{ route('equiposprestamos.index') }}" class="small-box-footer">M&aacute;s informaci&oacute;n <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>
@endcan
@endsection
