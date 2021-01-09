<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        @include('includes.mensaje-success')
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <strong>
                            <label for="" class="requerido">C&oacute;digo: 
                                <i class="fa fa-question-circle iconoAyuda" 
                                    data-toggle="tooltip" 
                                    data-placement="top" 
                                    title="Es el identificador del laboratorio consta de 1 a 9 caracteres alfanumérico."></i>
                            </label>
                        </strong>
                        <input type="text" id="max_loc_id" name="code" class="form-control" placeholder="C&oacute;digo"  value="{{ isset($location->code) ? $location->code:old('code') }}" required>
                        <small id="emailHelp" class="form-text text-muted">El c&oacute;digo consta entre 1 - 9 caracteres alfanum&eacute;rico.</small>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <strong><label for="" class="requerido">Nombre:</label></strong>
                        <input type="text" id="max_loc_name" name="name" class="form-control" placeholder="Nombre" value="{{ isset($location->name) ? $location->name:old('name') }}" required>
                    </div>  
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <strong>Descripci&oacute;n: 
                        <i class="fa fa-question-circle iconoAyuda" 
                            data-toggle="tooltip" 
                            data-placement="top" 
                            title="Es la ubicación del laboratorio"></i>
                        </strong><small class="text-muted">(Opcional)</small>
                        <textarea type="text" id="max_loc_description" name="description" rows="3" class="form-control" placeholder="Descripci&oacute;n">{{ isset($location->description) ? $location->description:old('description') }}</textarea>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <strong>Tel&eacute;fono: </strong><small class="text-muted">(Opcional)</small><br>
                        <input type="text" class="form-control enteros" id="max_loc_telephone" name="telephone" class="form-control" placeholder="(593)123456789" value="{{ isset($location->telephone) ? $location->telephone:old('telephone') }}">
                        <br>
                        <br>
                        <strong>Ext: </strong><small class="text-muted">(Opcional)</small><br>
                        <input type="text" class="form-control enteros" id="max_loc_extencion" name="ext" class="form-control" placeholder="1234" value="{{ isset($location->ext) ? $location->ext:old('ext') }}">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <strong><label for="">Imagen:</label></strong><small class="text-muted">(Opcional)</small>
                        @if (isset($location->imagen))
                            <br>
                            <img src="{{asset("storage").'/'.$location->imagen}}" width="200" class="img-thumbnail img-fluid" alt="img_laboratorio">
                            <br>
                        @endif
                        
                        @if ($Modo=='crear')
                            <input type="file" name="image_locations"  class="form-control" placeholder="Imagen">
                        @else
                            <input type="file" name="image_locations"  class="form-control" placeholder="Imagen">
                        @endif
                        <small id="emailHelp" class="form-text text-muted">Imagenes en formato .jpeg, .png, .jpg y de peso m&aacute;ximo de 2MB.</small>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        @if ($Modo=='crear')
                            @include('includes.button-form-crear')
                            <a href="{{route('localizaciones.index')}}" class="btn btn-block btn-danger">Cancelar</a>
                        @else
                            <button type="submit" class="btn btn-block btnEditar">Editar</button>
                            <a href="{{route('localizaciones.index')}}" class="btn btn-block btn-danger">Cancelar</a>
                        @endif
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>
                </div>
            </div>
        </div>
    </div>
</div>