@extends("theme.$theme.layout")
@section('titulo') 
Equipos 
@endsection
@section('contenido')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('sistemas.index') }}">Sistemas</a></li>
              <li class="breadcrumb-item active" aria-current="page">Listado de equipos</li>
            </ol>
        </nav>
    </div>
</div>
@include('includes.mensaje-error')
@include('includes.mensaje-success')
<br>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
            Registros de los equipos del sistema - {{$buscarID_sistema->code}} 
            <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Listado de los sistemas registrados en el SITEMA WEB."></i>
        </a>
    </li>
    @can('equipos.create')
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
            Crear un equipo en el sistema - {{$buscarID_sistema->code}} 
            <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Formulario para el registro de un nuevo equipo que estara localizado en el sistema seleccionado actualmente."></i>
        </a>
    </li>
    @endcan
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <p>En la siguiente tabla se listan todos los equipos registrados en el sistema <strong>{{$buscarID_sistema->code}}</strong></p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive" id="tab_scroll">
                                    @if (count($systems) > 0)
                                    <table class="table table-condensed table-hover">
                                        <thead>
                                            <tr>
                                                <th>Laboratorio</th>
                                                <th>&Aacute;rea</th>
                                                <th>Sistema</th>
                                                <th>Equipo</th>
                                                <th>Nombre</th>
                                                <th>Imagen</th>
                                                <th>Frecuencia</th>
                                                <th colspan="3">Opciones</th>
                                            </tr>
                                        </thead>  
                                        <tbody>                  
                                        @foreach ($systems as $system)
                                        <tr>
                                            <td>{{$system->loc_code}}</td>
                                            <td>{{$system->area_code}}</td>
                                            <td>{{$system->sist_code}}</td>
                                            <td>{{$system->equi_code}}</td>
                                            <td>{{$system->equi_name}}</td>
                                            <td>
                                                <img src="{{asset("storage").'/'.$system->equi_imagen}}" 
                                                    width="70px" 
                                                    class="img-thumbnail img-fluid" 
                                                    alt="img_equipo">
                                            </td>
                                            <td>{{$system->equi_frecuencia}}</td>
                                            <td>
                                                @can('equipos.show')
                                                    <a href="{{route('equipos.show', Crypt::encrypt($system->equi_id))}}" 
                                                        class="btn btn-block btnVer"
                                                        title="Ver equipo"
                                                        >Ver
                                                    </a>
                                                @endcan
                                            </td>
                                            <td>
                                                @can('equipos.edit')
                                                    <a href="{{route('equipos.edit', Crypt::encrypt($system->equi_id))}}" 
                                                        class="btn btn-block btnEditar"
                                                        title="Editar equipo"
                                                        >Editar
                                                    </a>
                                                 @endcan
                                            </td>
                                            <td>
                                                @can('equipos.destroy')
                                                    <form action="{{route('equipos.destroy',$system->equi_id)}}" method="post" role="form"> 
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" 
                                                            class="btn btn-block btn-danger" 
                                                            onclick="return confirm('Estas seguro de eliminar {{$system->equi_name}}?')"
                                                            title="Eliminar equipo"
                                                            >Eliminar
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
                                            <label for="">No hay equipos registrados en este sistema.</label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    @can('equipos.create')
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <br>
        <form action="{{ route('equipos.store')}}" id="form-general" class="form-horizontal" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            @include('equipos.form',['Modo'=>'crear'])
        </form>
    </div>
    @endcan
</div>
@endsection