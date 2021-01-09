@extends("theme.$theme.layout")
@section("scripts")
    <script src="{{asset('assets/pages/scripts/admin/paginaInicio/crear.js')}}" type="text/javascript" defer></script>
@endsection
@section('contenido')
@foreach ($inicioEditar as $pagina)
        
@endforeach
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="pull-left">
            <h2>Editar P&aacute;gina Inicio</h2>
        </div>
        <div class="pull-right">
            
        </div>
    </div>
</div>
@include('includes.mensaje-success')
@include('includes.mensaje-error')
<br>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        {{-- formulario mission vision --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('editar-pagina-inicio.update',$pagina->id)}}" id="form-general" class="form-horizontal" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="requerido"><strong>Misi&oacute;n</strong></label>
                                        <textarea type="text" id="max_inicioPag_mision" name="mission" rows="5" placeholder="Misi&oacute;n" class="form-control" required>{{ isset($pagina->mission ) ? $pagina->mission :'' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="requerido"><strong>Visi&oacute;n</strong></label>
                                        <textarea type="text" id="max_inicioPag_vision" name="vision" rows="5" placeholder="Visi&oacute;n" class="form-control" required>{{ isset($pagina->vision ) ? $pagina->vision :'' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <br>
                            <div class="form-group">
                                <div class="pull-right">
                                    @can('page.edit')
                                        <button type="submit" class="btn btn-block btn-primary">Actualizar Misión & Visión</button>
                                    @endcan
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- formulario slider --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('editar-pagina-inicio.update',$pagina->id)}}" id="form-general" class="form-horizontal" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            
                            <h3>Slider (Carrusel)</h3>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <strong><label for="" class="requerido">Imagen:</label></strong>
                                    @if (isset($pagina->sliderImage1))
                                        <br>
                                        <img src="{{asset("storage").'/'.$pagina->sliderImage1}}" width="200" class="img-thumbnail img-fluid" alt="img_equipo">
                                        <br>
                                    @endif
                                    <input type="file" name="sliderImage1"  class="form-control" placeholder="Imagen">
                                    <small id="emailHelp" class="form-text text-muted">Peso m&aacute;ximo 2MB</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <strong><label for="" class="requerido">Imagen:</label></strong>
                                    @if (isset($pagina->sliderImage2))
                                        <br>
                                        <img src="{{asset("storage").'/'.$pagina->sliderImage2}}" width="200" class="img-thumbnail img-fluid" alt="img_equipo">
                                        <br>
                                    @endif
                                    <input type="file" name="sliderImage2"  class="form-control" placeholder="Imagen">
                                    <small id="emailHelp" class="form-text text-muted">Peso m&aacute;ximo 2MB</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <strong><label for="" class="requerido">Imagen:</label></strong>
                                    @if (isset($pagina->sliderImage3))
                                        <br>
                                        <img src="{{asset("storage").'/'.$pagina->sliderImage3}}" width="200" class="img-thumbnail img-fluid" alt="img_equipo">
                                        <br>
                                    @endif
                                    <input type="file" name="sliderImage3"  class="form-control" placeholder="Imagen">
                                    <small id="emailHelp" class="form-text text-muted">Peso m&aacute;ximo 2MB</small>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="pull-right">
                                    @can('page.edit')
                                        <button type="submit" class="btn btn-block btn-primary">Actualizar Slider</button>
                                    @endcan
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- lado derecho --}}
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        {{-- formulario email --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('editar-pagina-inicio.update',$pagina->id)}}" id="form-general" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <strong><label for="email" class="requerido">Email:</label></strong>
                                <input name="email" type="text" value="@isset($pagina->email){{ $pagina->email }}@endisset" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary">Actualizar Email</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- formulario galeria --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('editar-pagina-inicio.update',$pagina->id)}}" id="form-general" class="form-horizontal" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            
                            <h3>Galeria</h3>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <strong><label for="" class="requerido">Imagen:</label></strong>
                                    @if (isset($pagina->image1))
                                        <br>
                                        <img src="{{asset("storage").'/'.$pagina->image1}}" width="200" class="img-thumbnail img-fluid" alt="img_equipo">
                                        <br>
                                    @endif
                                    <input type="file" name="image1"  class="form-control" placeholder="Imagen">
                                    <small id="emailHelp" class="form-text text-muted">Peso m&aacute;ximo 2MB</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <strong><label for="" class="requerido">Imagen:</label></strong>
                                    @if (isset($pagina->image2))
                                        <br>
                                        <img src="{{asset("storage").'/'.$pagina->image2}}" width="200" class="img-thumbnail img-fluid" alt="img_equipo">
                                        <br>
                                    @endif
                                    <input type="file" name="image2"  class="form-control" placeholder="Imagen">
                                    <small id="emailHelp" class="form-text text-muted">Peso m&aacute;ximo 2MB</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <strong><label for="" class="requerido">Imagen:</label></strong>
                                    @if (isset($pagina->image3))
                                        <br>
                                        <img src="{{asset("storage").'/'.$pagina->image3}}" width="200" class="img-thumbnail img-fluid" alt="img_equipo">
                                        <br>
                                    @endif
                                    <input type="file" name="image3"  class="form-control" placeholder="Imagen">
                                    <small id="emailHelp" class="form-text text-muted">Peso m&aacute;ximo 2MB</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <strong><label for="" class="requerido">Imagen:</label></strong>
                                    @if (isset($pagina->image4))
                                        <br>
                                        <img src="{{asset("storage").'/'.$pagina->image4}}" width="200" class="img-thumbnail img-fluid" alt="img_equipo">
                                        <br>
                                    @endif
                                    <input type="file" name="image4"  class="form-control" placeholder="Imagen">
                                    <small id="emailHelp" class="form-text text-muted">Peso m&aacute;ximo 2MB</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <strong><label for="" class="requerido">Imagen:</label></strong>
                                    @if (isset($pagina->image5))
                                        <br>
                                        <img src="{{asset("storage").'/'.$pagina->image5}}" width="200" class="img-thumbnail img-fluid" alt="img_equipo">
                                        <br>
                                    @endif
                                    <input type="file" name="image5"  class="form-control" placeholder="Imagen">
                                    <small id="emailHelp" class="form-text text-muted">Peso m&aacute;ximo 2MB</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <strong><label for="" class="requerido">Imagen:</label></strong>
                                    @if (isset($pagina->image6))
                                        <br>
                                        <img src="{{asset("storage").'/'.$pagina->image6}}" width="200" class="img-thumbnail img-fluid" alt="img_equipo">
                                        <br>
                                    @endif
                                    <input type="file" name="image6"  class="form-control" placeholder="Imagen">
                                    <small id="emailHelp" class="form-text text-muted">Peso m&aacute;ximo 2MB</small>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="pull-right">
                                    @can('page.edit')
                                        <button type="submit" class="btn btn-block btn-primary">Actualizar Galeria</button>
                                    @endcan
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection