<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <strong><label for="" class="requerido">Equipo:</label></strong>
                                <select name="equipment_id"  class="form-control" required>
                                @if ($Modo=='crear')
                                    @foreach ($equipment as $equipment)
                                        <option value="{{$equipment->id}}">{{$equipment->code}} - {{$equipment->name}}</option>
                                    @endforeach
                                @else
                                    @foreach ($equipment_select as $item)
                                    <option 
                                        value="{{$item->id}}"
                                        @if ($item->id === $criticalities->equipment_id)
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
                                <div class="form-group{{$errors->has('frequency')?' has-error':''}}">
                                    <strong><label for="" class="requerido">Frecuencia de fallas: <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Es el n&uacute;mero de fallas al año."></i></strong>
                                    <select name="frequency" id="valor5" class="form-control" required>
                                        <option value="">---- Seleccione una frecuencia ----</option>
                                        @if ($Modo=='crear')
                                            <option value="1">1-Excelente (menos de 2)</option>
                                            <option value="2">2-Buena (1 falla)</option>
                                            <option value="3">3-Media (1 a 2 fallas)</option>
                                            <option value="4">4-Baja (m&aacute;s de 2 fallas)</option>
                                        @else
                                            <option value="1" @if ($criticalities->frequency == '1') selected='selected' @endif>1-Excelente</option>
                                            <option value="2" @if ($criticalities->frequency == '2') selected='selected' @endif>2-Buena</option>
                                            <option value="3" @if ($criticalities->frequency == '3') selected='selected' @endif>3-Media</option>
                                            <option value="4" @if ($criticalities->frequency == '4') selected='selected' @endif>4-Baja</option>
                                        @endif 
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group{{$errors->has('operationalImpact')?' has-error':''}}">
                                    <strong><label for="" class="requerido">Impacto operacional: <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Es cu&aacute;ndo el equipo ocaciona afactaciones en la parte laboral del sistema."></i></label></strong>
                                    <select name="operationalImpact" id="valor1" class="form-control" required>
                                        <option value="">---- Seleccione el impacto operacional ----</option>
                                        @if ($Modo=='crear')
                                        <option value="1">1-Ninguna afectaci&oacute;n</option>
                                        <option value="3">3-Impacto al inventario o calidad</option>
                                        <option value="5">5-Para del sistema o afecta a otros</option>
                                        <option value="8">8-Perdida Grave</option>  
                                        @else
                                        <option value="1" @if ($criticalities->operationalImpact == '1') selected='selected' @endif>1-Ninguna Afectaci&oacute;n</option>
                                        <option value="3" @if ($criticalities->operationalImpact == '3') selected='selected' @endif>3-Impacto al Inventario o Calidad</option>
                                        <option value="5" @if ($criticalities->operationalImpact == '5') selected='selected' @endif>5-Para del Sistema o Afecta a Otros</option>
                                        <option value="8" @if ($criticalities->operationalImpact == '8') selected='selected' @endif>8-Perdida Grave</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group{{$errors->has('flexibility')?' has-error':''}}">
                                    <strong><label for="" class="requerido">Flexibilidad operacional: <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Es cu&aacute;ndo el equipo puede ser reemplado o reparado inmediatamente."></i></label></strong>
                                    <select name="flexibility" id="valor2" class="form-control" required>
                                        <option value="">---- Seleccione la flexibilidad operacional ----</option>
                                        @if ($Modo=='crear')
                                        <option value="1">1-Funci&oacute;n de respuesto disponible</option>
                                        <option value="2">2-Hay Opci&oacute;n de respuesto compartido/bodega</option>
                                        <option value="3">3-No hay opci&oacute;n de respuesto</option>
                                        @else
                                        <option value="1" @if ($criticalities->flexibility == '1') selected='selected' @endif>1-Funci&oacute;n de Respuesto Disponible</option>
                                        <option value="2" @if ($criticalities->flexibility == '2') selected='selected' @endif>2-Hay Opci&oacute;n de Respuesto Compartido/Bodega</option>
                                        <option value="3" @if ($criticalities->flexibility == '3') selected='selected' @endif>3-No Hay Opci&oacute;n de Respuesto</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group{{$errors->has('maintenanceCost')?' has-error':''}}">
                                    <strong><label for="" class="requerido">Costo de mantenimiento: <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Es el costo total por la reparaci&oacute;n del equipo."></i></label></strong>
                                    <select name="maintenanceCost" id="valor3" class="form-control" required>
                                        <option value="">---- Seleccione un costo de mantenimiento ----</option>
                                        @if ($Modo=='crear')
                                        <option value="1">1-Menor a $100</option>
                                        <option value="2">2-Mayor a $100</option>   
                                        @else
                                        <option value="1" @if ($criticalities->maintenanceCost == '1') selected='selected' @endif>1-Menor a $100</option>
                                        <option value="2" @if ($criticalities->maintenanceCost == '2') selected='selected' @endif>2-Mayor a $100</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group{{$errors->has('impactToSafety')?' has-error':''}}">
                                    <strong><label for="" class="requerido">Impacto a la seguridad: <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Es cu&aacute;ndo el usuario esta utilizando el equipo parcialmente dañado por una prolongada duraci&oacute;n de tiempo y estas pueden generar afectaciones al usuario."></i></label></strong>
                                    <select name="impactToSafety" id="valor4" class="form-control" required>
                                        <option value="">---- Seleccione el impacto ----</option>
                                        @if ($Modo=='crear')
                                        <option value="1">1-No hay daños</option>
                                        <option value="2">2-Causa molestias</option>
                                        <option value="3">3-Genera fatiga visual</option>
                                        <option value="5">5-Afecta a instalaciones causando daños severos</option>
                                        <option value="8">8-Afecta la seguridad</option>
                                        @else
                                        <option value="1" @if ($criticalities->impactToSafety == '1') selected='selected' @endif>1-No Hay Daños</option>
                                        <option value="2" @if ($criticalities->impactToSafety == '2') selected='selected' @endif>2-Causa Molestias</option>
                                        <option value="3" @if ($criticalities->impactToSafety == '3') selected='selected' @endif>3-Genera Fatiga Visual</option>
                                        <option value="5" @if ($criticalities->impactToSafety == '5') selected='selected' @endif>5-Afecta a Instalaciones Causando Daños Severos</option>
                                        <option value="8" @if ($criticalities->impactToSafety == '8') selected='selected' @endif>8-Afecta la Seguridad</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <strong><label for="" class="requerido">Consecuencias: <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Es el resultado del (Impacto operacional por la flexibility Operacional) m&aacute;s el costo de mantenimiento y m&aacute;s el impacto a la seguridad."></i></label></strong><br>
                                <input type="text" name="consequences" id="consecuencias" required>        
                            </div> 
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <strong><label for="" class="requerido">Total criticidad equipo:</label></strong><br>
                                <input type="text" name="total" id="criticidadEquipo" required>        
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button id="calcular" type="submit" style="width: 100%; margin-top: 10px;" class="btn btn-success">calcular</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <img src="{{asset("/img/diagrama_mtto.jpg")}}"  class="img-fluid" alt="img_diagrama_mtto">
                            </div>
                        </div>
                        <br>
                        <label for="">Dependiendo del Grafico y el resultado de la <u>CRITICIDAD DEL EQUIPO</u> determine la disponibilidad y modelo de mantenimiento del equipo</label>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group{{$errors->has('maintenance_model_id')?' has-error':''}}">
                                    <strong><label for="" class="requerido">Modelo Mantenimiento:</label></strong>
                                    <select name="maintenance_model_id" class="form-control" required>
                                        <option value="">---- Seleccione el modelo ----</option>
                                        @if ($Modo=='crear')
                                        @foreach ($maintenance_model as $item)
                                            <option value="{{$item['id']}}">{{$item['id']}}-{{$item['name']}}</option>
                                        @endforeach
                                        @else
                                        @foreach ($maintenance_model as $item)
                                            <option 
                                                value="{{$item['id']}}"
                                                @if ($item->id === $criticalities->maintenance_model_id)
                                                    selected                                            
                                                @endif 
                                                >
                                                {{$item['id']}}-{{$item['name']}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group{{$errors->has('availabilities_id')?' has-error':''}}">
                                    <strong><label for="" class="requerido">Disponibilidad:</label></strong>
                                    <select name="availabilities_id" class="form-control" required>
                                        <option value="">---- Seleccione la disponibilidad ----</option>
                                        @if ($Modo=='crear')
                                        @foreach ($availabilities as $item)
                                            <option value="{{$item['id']}}">{{$item['id']}}-{{$item['name']}}</option>
                                        @endforeach
                                        @else
                                        @foreach ($availabilities as $item)
                                            <option 
                                                value="{{$item['id']}}"
                                                @if ($item->id === $criticalities->availabilities_id)
                                                    selected                                            
                                                @endif
                                                >{{$item['id']}}-{{$item['name']}}
                                            </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12"></div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            @include('includes.button-form-crear')
                            <a href="{{route('sistemas.index')}}" class="btn btn-block btn-danger">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>