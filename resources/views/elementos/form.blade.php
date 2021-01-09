<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                @section("scripts")
                <script src="{{asset("assets/pages/scripts/admin/elementos/crear.js")}}" type="text/javascript" defer></script>
                @endsection
                <div class="row">
                    {{-- lado izq --}}
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <strong><label for="" class="requerido">Equipo:</label></strong>
                                <select name="equipment_id"  class="form-control" required>
                                    <option value="">---- Seleccione un Equipo ----</option>
                                    @if ($Modo=='crear')
                                        <option value="{{$buscarID_equipo['id']}}">{{$buscarID_equipo['code']}} - {{$buscarID_equipo['name']}}</option>
                                    @else
                                        @foreach ($infoEquipos as $item)
                                        <option 
                                            value="{{$item->id}}"
                                            @if ($item->id === $elements->equipment_id)
                                                selected                                            
                                            @endif 
                                        >
                                            {{$item->code}} - {{$item->name}}
                                        </option>
                                        @endforeach
                                    @endif                
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <strong><label for="" class="requerido">Nombre:</label></strong>
                                <input type="text" id="max_elem_nomb" 
                                    name="name" 
                                    class="form-control" 
                                    placeholder="Nombre" 
                                    value="{{ isset($elements->name ) ? $elements->name :old('name') }}"  required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <strong><label for="" class="requerido">Cantidad:</label></strong><br>
                                <input type="text" id="max_elem_cantidad"
                                    name="number_of" 
                                    class="form-control enteros" 
                                    placeholder="Cantidad" 
                                    value="{{ isset($elements->number_of ) ? $elements->number_of :old('number_of') }}" required>
                            </div>
                        </div>
                        <br>
                        <div class="row"> 
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <strong><label for="" class="requerido">Imagen:</label></strong><br>        
                                @if (isset($elements->image_elements))
                                <br>
                                <img src="{{asset("storage").'/'.$elements->image_elements}}" 
                                    width="100" 
                                    class="img-thumbnail img-fluid" 
                                    alt="img_elemento">
                                <br>
                                @else
                                    <img src="{{asset("/img/no_imagen.png")}}" 
                                    width="100" 
                                    class="img-thumbnail img-fluid" 
                                    alt="img_elemento">
                                @endif
                                @if ($Modo=='crear')
                                    <input type="file" 
                                        name="image_elements" 
                                        class="form-control" 
                                        placeholder="Imagen" required>
                                @else
                                    <input type="file" 
                                        name="image_elements" 
                                        class="form-control" 
                                        placeholder="Imagen">
                                @endif
                                <small id="emailHelp" class="form-text text-muted">Imagenes en formato .jpeg, .png, .jpg y de peso m&aacute;ximo de 2MB.</small>
                            </div>                    
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <strong>
                                    <label for="" class="requerido">Descripci&oacute;n: 
                                        <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Es la descripción de las carácteristicas del elemento."></i>
                                    </label>
                                </strong>
                                <textarea type="text" id="max_elem_descrp" name="description" rows="3" placeholder="Descripci&oacute;n" class="form-control" required>{{ isset($elements->description ) ? $elements->description :old('description') }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row"> 
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <strong>
                                    <label for="" class="requerido">Funci&oacute;n: 
                                        <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="La función que cumple el elemento en el equipo."></i>
                                    </label>
                                </strong>
                                <textarea type="text" id="max_elem_func" name="function" rows="3" placeholder="Funci&oacute;n" class="form-control" required>{{ isset($elements->function ) ? $elements->function :old('function') }}</textarea>
                            </div>
                        </div>
                    </div>
                    {{-- lado derecho --}}
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <strong>
                                    <label for="" class="requerido">Descripci&oacute;n de fallo: 
                                        <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Es la descripción de las posibles fallos que puedan ocurrir a un elemento. Ejemplo: Los contactos de los reles no conmutan."></i>
                                    </label>
                                </strong>
                                <textarea type="text" id="max_elem_descrpFallo" name="faultDescription" rows="3" placeholder="Descripci&oacute;n de Fallo" class="form-control" required>{{ isset($elements->faultDescription ) ? $elements->faultDescription :old('faultDescription') }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group{{$errors->has('typefailures_id')?' has-error':''}}">
                                    <strong>
                                        <label for="" class="requerido">Tipo de fallo: 
                                            <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Existen dos tipos de fallos el primero es el functional ocasionada por una falla interna del equipo mientras el fallo técnico es cuando el usuario realiza una mala maniobra al equipo."></i>
                                        </label>
                                    </strong>
                                    <select name="typefailures_id" class="form-control" required>
                                        <option value="">---- Seleccione un tipo de fallo ----</option>
                                        @if ($Modo=='crear')   
                                            @foreach ($type_failures as $item)
                                                <option value="{{$item['id']}}">{{$item['id']}} - {{$item['name']}}</option>
                                            @endforeach
                                        @else
                                            @foreach ($type_failures as $item)
                                                <option 
                                                    value="{{$item['id']}}"
                                                    @if ($item->id === $elements->typefailures_id)
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
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <strong>
                                    <label for="" class="requerido">Modo de fallo: 
                                        <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Es la descripción del por qué se ocasiono el fallo. Ejemplo: Cortocircuito en los conectores."></i>
                                    </label>
                                </strong>
                                <textarea type="text" id="max_elem_failMode" name="failMode" rows="3" placeholder="Modo de Fallo" class="form-control" required>{{ isset($elements->failMode ) ? $elements->failMode :old('failMode') }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <strong>
                                    <label for="" class="requerido">Clasificaci&oacute;n: 
                                        <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="La clasificación A EVITAR es cuando de alguna manera se evita que ocurra el fallo mientra que la clasificación de A AMORTIGUAR es cuando de alguna manera se puede desminuir la intensidad del fallo."></i>
                                    </label>
                                </strong>
                                <select name="classifications_id" class="form-control" required>
                                <option value="">---- Seleccione una clasificaci&oacute;n ----</option>
                                @if ($Modo=='crear')   
                                    @foreach ($classifications as $item)
                                        <option value="{{$item['id']}}">{{$item['id']}} - {{$item['name']}}</option>
                                    @endforeach
                                @else
                                    @foreach ($classifications as $item)
                                        <option 
                                            value="{{$item['id']}}"
                                            @if ($item->id === $elements->classifications_id)
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
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <strong>
                                    <label for="" class="requerido">Actividad: 
                                        <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Toma de decisiones para la elección de la operación a aplicar para resolver un problema."></i>
                                    </label>
                                </strong>
                                <textarea type="text" id="max_elem_actividad" name="maintenanceActivity" rows="3" placeholder="Actividad" class="form-control" required>{{ isset($elements->maintenanceActivity ) ? $elements->maintenanceActivity :old('maintenanceActivity') }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <strong>
                                    <label for="" class="requerido">Tarea: 
                                        <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Son los pasos a seguir para resolver el problema en base a la toma de desición en la actividad."></i>
                                    </label>
                                </strong>
                                <textarea type="text" id="max_elem_tarea" name="maintenanceTask" rows="3" placeholder="Tarea" class="form-control" required>{{ isset($elements->maintenanceTask ) ? $elements->maintenanceTask :old('maintenanceTask') }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <strong>Mejoras:</strong> <span class="text-muted">(Opcional)</span>
                                <textarea type="text" id="max_elem_mejoras" name="improvements" rows="3" placeholder="Mejoras" class="form-control">{{ isset($elements->improvements ) ? $elements->improvements :old('improvements') }}</textarea>
                            </div>
                        </div>
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