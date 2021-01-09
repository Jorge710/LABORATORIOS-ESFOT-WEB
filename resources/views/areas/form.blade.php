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
                        <div class="form-group{{$errors->has('locations_id')?' has-error':''}}">
                            <strong><label for="" class="requerido">Laboratorio: <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Es el identificador del laboratorio que est&aacute;n a su cargo."></i></label></strong>
                            <select name="locations_id"  class="form-control" style="width: 100%;" id="nameid" required>
                                <option value=""></option>
                                @if ($Modo=='crear')
                                    @foreach ($locations as $item)
                                        <option value="{{$item->id}}">{{$item->code}}-{{$item->name}}</option>
                                    @endforeach
                                @else
                                    @foreach ($locations as $item)
                                    <option 
                                        value="{{$item->id}}"
                                        @if ($item->id === $area->locations_id)
                                            selected                                            
                                        @endif 
                                    >
                                        {{$item->code}}-{{$item->name}}
                                    </option>
                                    @endforeach
                                @endif 
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <strong><label for="" class="requerido">C&oacute;digo &aacute;rea: <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Es el identificador del &aacute;rea consta de 1 a 9 caracteres."></i></label></strong>
                        <input type="text" id="max_id" name="code" class="form-control" placeholder="C&oacute;digo" value="{{ isset($area->code) ? $area->code:old('code') }}" required>
                        <small id="emailHelp" class="form-text text-muted">El c&oacute;digo consta entre 1 - 9 caracteres alfanum&eacute;rico.</small>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <strong><label for="" class="requerido">Nombre:</label></strong>
                        <input type="text" id="max_name" name="name" class="form-control" placeholder="Nombre" value="{{ isset($area->name) ? $area->name:old('name') }}" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <strong><label for="" class="requerido">Descripci&oacute;n: </label></strong>
                        <textarea name="description" id="max_description" rows="5" placeholder="Descripci&oacute;n" class="form-control" required>{{ isset($area->description) ? $area->description:old('description') }}</textarea>
                    </div> 
                </div> 
                <br>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <strong><label for="">Imagen:</label></strong><small class="text-muted">(Opcional)</small>
                        @if (isset($area->imagen))
                            <br>
                            <img src="{{asset("storage").'/'.$area->image_areas}}" width="200" class="img-thumbnail img-fluid" alt="img_area">
                            <br>
                        @endif            
                        @if ($Modo=='crear')
                            <input type="file" name="image_areas"  class="form-control" placeholder="Imagen">
                        @else
                            <input type="file" name="image_areas"  class="form-control" placeholder="Imagen">
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
                            <a href="{{route('areas.index')}}" class="btn btn-block btn-danger">Cancelar</a>
                        @else
                            <button type="submit" class="btn btn-block btnEditar"><i class="fa fa-edit"></i>Editar</button>
                            <a href="{{route('areas.index')}}" class="btn btn-block btn-danger">Cancelar</a>
                        @endif    
                    </div>  
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>  
                </div> 
            </div>
        </div>
    </div>
</div>