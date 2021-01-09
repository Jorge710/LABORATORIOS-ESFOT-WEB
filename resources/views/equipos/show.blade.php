@extends("theme.$theme.layout")
@section('titulo') 
Equipos 
@endsection
@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/elementos/crear.js")}}" type="text/javascript" defer></script>
@endsection
@section('contenido')   
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('sistemas.index') }}">Sistemas</a></li>
              <li class="breadcrumb-item"><a href="{{ route('sistemas.show', Crypt::encrypt($buscarID_equipo->systems_id))}}">Listado de equipos</a></li>
              <li class="breadcrumb-item active" aria-current="page">Ver informaci&oacute;n del equipo - {{$buscarID_equipo->code}}</li>
            </ol>
          </nav>
    </div>
</div>
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Información General</a>
        <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Criticidad</a>
        <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Elementos</a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    {{-- TAB INFORMACIÓN EQUIPO --}}
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                @foreach ($informacion_equipo as $item)
                                <h2 style="text-align: center"><strong>{{$item->loc_nomb}}</strong></h2>
                                <h3 style="text-align: center"><strong>&Aacute;rea de {{$item->area_nomb}}</strong></h3>
                                <h4 style="text-align: center"><strong>{{$item->sist_nomb}}</strong></h4>
                                @endforeach
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12"></div>
                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">            
                                <strong>Equipo:</strong>
                                {{$buscarID_equipo->name}}
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                <strong>C&oacute;digo Equipo:</strong>
                                    @foreach ($informacion_equipo as $item)
                                        {{$item->loc_id}}-{{$item->area_id}}-{{$item->sist_id}}
                                    @endforeach
                                    -{{$buscarID_equipo->code}}
                            </div>       
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12"></div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                <img src="{{asset("storage").'/'.$buscarID_equipo->image_equipment}}" width="350" class="img-thumbnail img-fluid" alt="img_equipos">
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                @can('messages.create')
                                    @if ($buscarID_equipo->in_maintenance == 'NO')
                                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                                            Notificar Mantenimiento <i class="fa fa-tools" style="font-size:20px;color:white;"></i>
                                        </button>
                                    @endif
                                @endcan
                                <br>
                                <br>
                                <strong>Descripci&oacute;n:</strong><br>
                                    {{$buscarID_equipo->description}}
                                    <br>
                                    <br>
                                <strong>Funci&oacute;n:</strong><br>
                                    {{$buscarID_equipo->function}}
                                    <br>
                                    <br>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-condensed table-hover">
                                                <thead>
                                                    <th>Documentaci&oacute;n Equipo</th>
                                                </thead>                    
                                                <tr>
                                                    <td>
                                                        @can('datasheet.download')
                                                            <a href="{{route('download_fichaTecnica',$buscarID_equipo->id)}}" 
                                                                class="btn btn-success">
                                                                Download Ficha <i class="fa fa-file-pdf-o" style="font-size:20px;color:white;"></i>
                                                            </a>
                                                        @endcan
                                                        @can('equipmentmanual.download')
                                                            <a href="{{route('download_Manual',$buscarID_equipo->id)}}" 
                                                                class="btn btn-success">
                                                                Download Manual <i class="fa fa-file-pdf-o" style="font-size:20px;color:white;"></i>
                                                            </a>
                                                        @endcan
                                                    </td>
                                                </tr>                
                                            </table>
                                        </div>
                                    </div>                    
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <strong>Recomendaci&oacute;n:</strong><br>
                                {{$buscarID_equipo->recommendation}}
                            </div>
                            <div class="col-lg-6 col-md-16 col-sm-12 col-xs-12">
                                <strong>Mantenimiento:</strong><br>
                                {{$buscarID_equipo->maintenance}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- TAB CRITICIDAD --}}
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12"></div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                @can('criticidades.create')
                                    @if ($buscarID_equipo->assign_criticality == 'DISPONIBLE')
                                    <a class="btn btn-block btnCrear" href="{{ route('criticidades.create',$buscarID_equipo->id) }}">
                                        <i class="fa fa-plus-circle" style="font-size:20px;color:white;"></i>
                                        Nuevo registro
                                    </a>
                                    @endif
                                @endcan             
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    @if (count($informacion_criticidad) > 0)
                                    <table class="table table-striped table-bordered table-condensed table-hover">
                                        <thead>
                                            <th>Frecuencia</th>
                                            <th>Impacto Operacional</th>
                                            <th>Flexibilidad</th>
                                            <th>Costo Mantenimiento</th>
                                            <th>Impacto Seguridad</th>
                                            <th>Consecuencias</th>
                                            <th>Total</th>
                                            <th><strong>CRITICIDAD</strong></th>
                                            <th>Disponibilidad</th>
                                            <th>Modelo Mantenimiento</th>
                                        </thead>
                                        <tbody>  
                                        @foreach ($informacion_criticidad as $criticality)
                                          <tr>
                                            <td style="background:#a29d7a;">{{$criticality->crit_fre}}</td>
                                            <td>{{$criticality->operationalImpact}}</td>
                                            <td>{{$criticality->flexibility}}</td>
                                            <td>{{$criticality->maintenanceCost}}</td>
                                            <td>{{$criticality->impactToSafety}}</td>
                                            <td style="background:#a29d7a;">{{$criticality->consequences}}</td>
                                            <td>{{$criticality->total}}</td>
                                            <td
                                                @if ($criticality->total < 20)
                                                    style="background:green;"
                                                @elseif ($criticality->total >20 && $criticality->total < 35)
                                                    style="background: #e7cc11;"
                                                @else
                                                    style="background: red;"
                                                @endif
                                            ></td>
                                            <td>{{$criticality->crit_disponibilidad}}</td>
                                            <td>{{$criticality->crit_maintenance_model}}</td>
                                            <td>
                                                @can('criticidades.edit')
                                                    <a href="{{route('criticidades.edit',$criticality->crit_id)}}" class="btn btn-sm"><i class="fa fa-edit" style="font-size:20px;color:blue;"></i></a>
                                                @endcan
                                            </td>
                                          </tr>
                                        @endforeach 
                                        </tbody>               
                                    </table>
                                    @else
                                        <div class="alert alert-warning">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                            <label for="">No a realizado un an&aacute;lisis de la criticidad para este equipo dirijase al bot&oacute;n "Nuevo registro".</label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <img src="{{asset("/img/diagrama_mtto.jpg")}}" width="400px;" class="img-thumbnail img-fluid" alt="img_diagrama_mtto">
                                    </div>
                                </div>
                            </div> 
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <img src="{{asset("/img/tbl_criticidad.jpg")}}" class="img-thumbnail img-fluid" alt="img_tbl_criticidad">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>
    {{-- TAB ELEMENTOS --}}
    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12"></div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                @can('elementos.create')
                                    <a class="btn btn-block btnCrear" href="{{ route('elementos.create', $buscarID_equipo->id) }}">
                                        <i class="fa fa-plus-circle" style="font-size:20px;color:white;"></i>
                                        Nuevo registro
                                    </a>
                                @endcan             
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive" id="tab_scroll">
                                    @if (count($informacion_elemento) > 0)
                                    <table class="table table-condensed table-hover">
                                        <thead>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Imagen</th>
                                            <th colspan="3">Opciones</th>
                                        </thead>
                                        <tbody>
                                        @foreach ($informacion_elemento as $elements)
                                        <tr>
                                            <td>{{$elements->elem_nomb}}</td>
                                            <td>{{$elements->number_of}}</td>
                                            <td>
                                                <img src="{{asset("storage").'/'.$elements->elem_img}}" 
                                                    width="70px" 
                                                    class="img-thumbnail img-fluid" 
                                                    alt="img_equipo">
                                            </td>
                                            <td>
                                                @can('elementos.show')
                                                    <button type="button" 
                                                        class="btn btn-block btnVer" 
                                                        data-toggle="modal" 
                                                        data-target="#verElemento{{$elements->elem_id}}"
                                                        title="Ver elemento"
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
                                            <td>
                                                @can('elementos.edit')
                                                    <a href="{{route('elementos.edit',$elements->elem_id)}}" 
                                                        class="btn btn-block btnEditar"
                                                        title="Editar elemento"
                                                        >
                                                        Editar
                                                    </a>
                                                 @endcan
                                            </td>
                                            <td>
                                                @can('elementos.destroy')
                                                    <form action="{{route('elementos.destroy',$elements->elem_id)}}" method="post" role="form">
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" 
                                                            class="btn btn-block btn-danger" 
                                                            onclick="return confirm('Estas seguro de eliminar?')"
                                                            title="Eliminar elemento"
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
                                            <label for="">No hay elementos registrados para este equipo dirijase al bot&oacute;n "Nuevo".</label>
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
</div>
    
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Enviar una notificaci&oacute;n de mantenimiento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('messages.store')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 25px;">
                        <label for="">Usuario:</label>
                        <select name="recipient_id" class="form-control" required>
                            <option value="">---- Selecciona el usuario ----</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->uID}}">({{ $user->uNOMB }} {{ $user->uAPELLIDO }}) - Pasante del laboratorio: {{ $user->code }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <br>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label for="">ID4 - Equipo &oacute; planta did&aacute;ctica tecnol&oacute;gica:</label>
                        <select name="equipment_id" class="form-control">
                            <option value="{{$buscarID_equipo->id}}">{{$buscarID_equipo->code}}</option>
                        </select>
                    </div>
                </div>
                
                <br>
                <br>
                <label for="">Mensaje de notificación (mantenimiento):</label>
                <div class="form-group">
                    <textarea name="body" class="form-control" placeholder="Escribe aqui tu mensaje" required></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block">Enviar</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection