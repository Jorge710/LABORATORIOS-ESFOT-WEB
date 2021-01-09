<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <strong><label for="libro_id" class="col-lg-3 control-label requerido">Equipos:</label></strong>
                            
                            <select name="equipment_id" class="form-control" style="width: 100%;" id="nameid" required>
                                <option></option>
                                @foreach($equipos_para_prestamo as $d)
                                    <option value="{{$d->id}}">( {{$d->code_locations}}-{{$d->code_areas}}-{{$d->code_systems}}-{{$d->code}} ) -{{$d->name}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <strong><label class="requerido">Nombre del estudiante:</label></strong>
                            <input type="text" id="max_equiPrest_nomb" class="form-control" name="name" placeholder="Nombre" aria-describedby="emailHelp" value="{{ isset($equipoPrestamo->name ) ? $equipoPrestamo->name :old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <div class="form-group{{$errors->has('faculty')?' has-error':''}}">
                                <strong><label for="" class="requerido">Facultad:</strong>
                                <select name="faculty" class="form-control" style="width: 100%;" id="nameiddos" required>
                                    <option value="">---- Seleccione una Facultad ----</option>
                                        <option value="ESFOT">ESFOT</option>
                                        <option value="Ciencias">Ciencias</option>
                                        <option value="Facultad de Ciencias Administrativas">Facultad de Ciencias Administrativas</option>
                                        <option value="Facultad de Ingeniería Civil y Ambiental">Facultad de Ingenier&iacute;a Civil y Ambiental</option>
                                        <option value="Facultad de Ingeniería Eléctrica y Electrónica">Facultad de Ingenier&iacute;a El&eacute;ctrica y Electr&oacute;nica</option>
                                        <option value="Facultad de Geología y Petróleos">Facultad de Geolog&iacute;a y Petr&oacute;leos</option>
                                        <option value="Facultad de Ingeniería Mecánica">Facultad de Ingenier&iacute;a Mec&aacute;nica</option>
                                        <option value="Facultad de Ingeniería Química y Agroindustria">Facultad de Ingenier&iacute;a Qu&iacute;mica y Agroindustria</option>
                                        <option value="Facultad de Ingeniería de Sistemas">Facultad de Ingenier&iacute;a de Sistemas</option>
                                        <option value="Departamento de Formación Básica (DFB)">Departamento de Formaci&oacute;n Básica (DFB)</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <strong><label class="requerido">Carrera:</label></strong>
                            <input type="text" id="max_equiPrest_career" class="form-control" name="career" aria-describedby="emailHelp" value="{{ isset($equipoPrestamo->career ) ? $equipoPrestamo->career :old('career') }}" required>
                        </div>
                        <div class="form-group">
                            <strong><label for="exampleInputEmail1" class="requerido">Email:</label></strong>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ isset($equipoPrestamo->email ) ? $equipoPrestamo->email :old('email') }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <strong>Observaci&oacute;n:</strong><small class="text-muted">(Opcional)</small>
                        <textarea id="max_equiPrest_observacion" name="loan_observation" rows="3" class="form-control">{{ isset($equipoPrestamo->loan_observation ) ? $equipoPrestamo->loan_observation :old('loan_observation') }}</textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        @if ($Modo=='crear')
                            @include('includes.button-form-crear')
                            <a href="{{route('equiposprestamos.index')}}" class="btn btn-block btn-danger">Cancelar</a>
                        @else
                            <button type="submit" class="btn btn-block btnEditar">Editar</button>
                        @endif
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>
                </div>
            </div>
        </div>
    </div>
</div>