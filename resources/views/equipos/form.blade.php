<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                @section("scripts")
                    <script src="{{asset('assets/pages/scripts/admin/equipos/crear.js')}}" type="text/javascript" defer></script>
                    <script src="{{asset("assets/pages/scripts/admin/elementos/crear.js")}}" type="text/javascript" defer></script>
                @endsection
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        @include('includes.mensaje-success')
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <strong>
                                    <label for="" class="requerido">C&oacute;digo del sistema: 
                                        <i class="fa fa-question-circle iconoAyuda" 
                                            data-toggle="tooltip" 
                                            data-placement="top" 
                                            title="Es el identificador del sistema."></i>
                                    </label>
                                </strong>
                                <select name="systems_id" class="form-control" required style="width: 100%;" id="nameiddos">
                                    <option value="">-- Seleccione una opci&oacute;n --</option>
                                    @if ($Modo=='crear')
                                        @foreach($sistemas_select_form as $item)
                                            <option value="{{$item->id}}">{{$item->code}}-{{$item->name}}</option>
                                        @endforeach
                                    @else
                                        @foreach($systems as $item)
                                            <option 
                                                value="{{$item->id}}"
                                                @if ($item->id === $equipo->systems_id)
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
                        <br>
                        <div class="row">   
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <strong>
                                    <label for="" class="requerido">
                                        C&oacute;digo equipo: 
                                        <i class="fa fa-question-circle iconoAyuda" 
                                            data-toggle="tooltip" 
                                            data-placement="top" 
                                            title="Es el identificador del equipo consta de 1 a 9 caracteres."></i>
                                    </label>
                                </strong>
                                <input type="text" id="max_equ_id" name="code" class="form-control" placeholder="" value="{{ isset($equipo->code ) ? $equipo->code :old('code') }}" required>    
                                <small id="emailHelp" class="form-text text-muted">El c&oacute;digo consta entre 1 - 9 caracteres alfanum&eacute;rico.</small>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-10 col-sm-12 col-xs-12">
                                <strong><label for="" class="requerido">Nombre:</label></strong>
                                <input type="text" id="max_equ_name" name="name" class="form-control" placeholder="Nombre" value="{{ isset($equipo->name ) ? $equipo->name :old('name') }}" required>        
                            </div>                    
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group{{$errors->has('function')?' has-error':''}}">
                                    <strong><label for="" class="requerido">Funci&oacute;n: <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Es la informaci&oacute;n sobre para que va a servir este equipo al sistema."></i></label></strong>
                                    <textarea id="max_equ_function" cols="30" name="function"  rows="3" placeholder="Funci&oacute;n" class="form-control" value="{{ old('function') }}" required>{{ isset($equipo->function ) ? $equipo->function :old('function') }}</textarea>
                                    <span class="text-danger">{{$errors->first('function')}}</span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group{{$errors->has('description')?' has-error':''}}">
                                    <strong><label for="" class="requerido">Descripci&oacute;n: <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Es una descripci&oacute;n breve sobre las caracteristicas del equipo."></i></label></strong>
                                    <textarea id="max_equ_description" cols="30" name="description" rows="3" placeholder="Descripci&oacute;n" class="form-control" value="{{ old('description') }}" required>{{ isset($equipo->description ) ? $equipo->description :old('description') }}</textarea>
                                    <span class="text-danger">{{$errors->first('description')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group{{$errors->has('recommendation')?' has-error':''}}">
                                    <strong>
                                        <label for="" class="requerido">
                                            Recomendaci&oacute;n: 
                                            <i class="fa fa-question-circle iconoAyuda" 
                                                data-toggle="tooltip" 
                                                data-placement="top" 
                                                title="Recomendaciones para el buen uso del equipo."></i>
                                        </label>
                                    </strong>
                                    <textarea id="max_equ_recommendation" cols="30" name="recommendation"  rows="3" placeholder="Recomendaci&oacute;n" class="form-control" value="{{ old('recommendation') }}" required>{{ isset($equipo->recommendation ) ? $equipo->recommendation :old('recommendation') }}</textarea>
                                    <span class="text-danger">{{$errors->first('recommendation')}}</span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group{{$errors->has('maintenance')?' has-error':''}}">
                                    <strong>
                                        <label for="" class="requerido">
                                            Mantenimiento: 
                                            <i class="fa fa-question-circle iconoAyuda" 
                                                data-toggle="tooltip" 
                                                data-placement="top" 
                                                title="Mantenimiento general del equipo Ejm: Limpieza en los conectores."></i>
                                        </label>
                                    </strong>
                                    <textarea id="max_equ_maintenance" cols="30" name="maintenance"  rows="3" placeholder="Mantenimiento" class="form-control" value="{{ old('maintenance') }}" required>{{ isset($equipo->maintenance ) ? $equipo->maintenance :old('maintenance') }}</textarea>
                                    <span class="text-danger">{{$errors->first('maintenance')}}</span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <strong><label for="" class="requerido">Imagen:</label></strong>
                                @if (isset($equipo->image_equipment))
                                    <br>
                                    <img src="{{asset("storage").'/'.$equipo->image_equipment}}" width="200" class="img-thumbnail img-fluid" alt="img_equipo">
                                    <br>
                                @endif
                                
                                @if ($Modo=='crear')
                                    <input type="file" name="image_equipment"  class="form-control" placeholder="Imagen" required>
                                @else
                                    <input type="file" name="image_equipment"  class="form-control" placeholder="Imagen">
                                @endif
                                <small id="emailHelp" class="form-text text-muted">Imagenes en formato .jpeg, .png, .jpg y de peso m&aacute;ximo de 2MB.</small>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group{{$errors->has('maintenance_frequency_id')?' has-error':''}}">
                                    <strong>
                                        <label for="" class="requerido">
                                            Frecuencia de mantenimiento: 
                                            <i class="fa fa-question-circle iconoAyuda" 
                                                data-toggle="tooltip" 
                                                data-placement="top" 
                                                title="Es la frecuencia de mantenimiento sugerido."></i>
                                        </label>
                                    </strong>
                                    <select name="maintenance_frequency_id" class="form-control" required>
                                        <option value="">---- Seleccione una frecuencia ----</option>
                                        @if ($Modo=='crear')   
                                            @foreach ($maintenance_frequency as $item)
                                                <option value="{{$item['id']}}">{{$item['id']}} - {{$item['name']}}</option>
                                            @endforeach
                                        @else
                                            @foreach ($maintenance_frequency as $item)
                                                <option 
                                                    value="{{$item['id']}}"
                                                    @if ($item->id === $equipo->maintenance_frequency_id)
                                                        selected                                            
                                                    @endif 
                                                >
                                                    {{$item['id']}} - {{$item['name']}}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>                
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <strong><label for="" class="requerido">Ficha t&eacute;cnica:</label></strong>
                        <br>
                        <label for="">{{ isset($equipo->datasheet ) ? $equipo->datasheet :'' }}</label>
                        
                        @if ($Modo=='crear')
                        <input type="file" name="datasheet"  class="form-control" placeholder="Ficha" required>
                        @else
                        <input type="file" name="datasheet"  class="form-control" placeholder="Ficha">
                        @endif
                        <small id="emailHelp" class="form-text text-muted">Solo en formato PDF peso m&aacute;ximo de 2MB.</small>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <strong>Manual: </strong><small class="text-muted">(Opcional)</small>
                        <br>
                        <label for="">{{ isset($equipo->handbook ) ? $equipo->handbook :'' }}</label>
                        <input type="file" name="handbook"  class="form-control" placeholder="handbook">
                        <small id="emailHelp" class="form-text text-muted">Solo en formato PDF peso m&aacute;ximo de 2MB.</small>
                    </div>
                </div>
                
                <br>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        @if ($Modo=='crear')
                            @include('includes.button-form-crear')
                            <a href="{{route('sistemas.index')}}" class="btn btn-block btn-danger">Cancelar</a>
                        @else
                            <button type="submit" class="btn btn-block btnEditar">Editar</button>
                            <a href="{{route('sistemas.index')}}" class="btn btn-block btn-danger">Cancelar</a>
                        @endif
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>
                </div>
            </div>
        </div>
    </div>
</div>