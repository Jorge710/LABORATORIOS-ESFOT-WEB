@extends("theme.$theme.layout")
@section('titulo') 
Reportes 
@endsection
@section('contenido')
<div class="row">  
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <h2>Listado de reportes</h2>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    </div>
</div>
<hr>
<div class="row">
    @can('sistemas.index')
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="card" style="width: 18rem; margin: auto;">
            <div class="card-body">
                @can('report.download')
                    <a class="btn btn-block btn-success" href="{{ route('sistemas.excelexport') }}">
                        Sistemas Export Excel  
                        <i class="fas fa-file-excel" style="font-size:20px;"></i>
                    </a>
                @endcan
            </div>
        </div>
    </div>
    @endcan
    @can('equipos.index')
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="card" style="width: 18rem; margin: auto;">
            <div class="card-body">
                @can('report.download')
                    <a class="btn btn-block btn-success" href="{{ route('equipos.excelexport') }}">
                        Equipos Export Excel  
                        <i class="fas fa-file-excel" style="font-size:20px;"></i>
                    </a>
                @endcan
            </div>
        </div>
    </div>
    @endcan
</div>
<br>
<div class="row">
    @can('criticidades.index')
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="card" style="width: 18rem; margin: auto;">
            <div class="card-body">
                @can('report.download')
                    <a class="btn btn-success btn-block" href="{{ route('criticidades.excelexport') }}">
                        Criticidades Export Excel  
                        <i class="fas fa-file-excel" style="font-size:20px;"></i>
                    </a>
                @endcan
            </div>
        </div>
    </div>
    @endcan
    @can('users.index')
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="card" style="width: 18rem; margin: auto;">
            <div class="card-body">
                @can('report.download')
                    <a class="btn btn-block btn-success" href="{{ route('users.excelexport') }}">
                        Usuarios Export Excel  
                        <i class="fas fa-file-excel" style="font-size:20px;"></i>
                    </a>
                @endcan
            </div>
        </div>
    </div>
    @endcan
</div>
<br>
{{-- <div class="container">
    <span>Para los siguientes reportes es necesario ir al m&oacute;dulo para seleccionar el rango de fechas.</span>
    <br>
    <br>
</div> --}}
<div class="row">
    @can('equiposprestamos.index')
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <!-- small box -->
        <div class="small-box bg-success" style="width: 18rem; margin: auto;">
            <div class="inner">
                <h3></h3>
                <p>Equipos Prestados</p>
            </div>
            <div class="icon">
                <i class="fas fa-people-carry"></i>
            </div>
            <a href="{{ route('equiposprestamos.historial') }}" class="small-box-footer">Ir al m&oacute;dulo <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endcan
    @can('mantenimientos.index')
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <!-- small box -->
        <div class="small-box bg-success" style="width: 18rem; margin: auto;">
            <div class="inner">
                <h3></h3>
                <p>Mantenimientos</p>
            </div>
            <div class="icon">
                <i class="fas fa-tools"></i>
            </div>
            <a href="{{ route('mantenimientos.index') }}" class="small-box-footer">Ir al m&oacute;dulo <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endcan
    @can('users.index')
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        {{-- <div class="card" style="width: 18rem; margin: auto;">
            <div class="card-body">
                @can('report.download')
                    <a class="btn btn-block btn-success" href="{{ route('users.excelexport') }}">
                        Mantenimientos Export Excel  
                        <i class="fas fa-file-excel" style="font-size:20px;"></i>
                    </a>
                @endcan
            </div>
        </div> --}}
    </div>
    @endcan
</div>
<br>
<div class="row">
    
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    </div>
</div>
@endsection