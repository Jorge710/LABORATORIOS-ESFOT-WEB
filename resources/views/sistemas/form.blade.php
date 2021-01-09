<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group{{$errors->has('areas_id')?' has-error':''}}">
                                    <strong><label for="" class="requerido">C&oacute;digo del laboratorio y &aacute;rea: <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Es el identificador del laboratorio y del &aacute;rea donde va a estar localizado el sistema."></i></label></strong>
                                    <select name="areas_id" class="form-control" style="width: 100%;" id="nameid" required>
                                        <option value=""></option>
                                        @if ($Modo=='crear')
                                            @foreach ($areas as $item)
                                                <option value="{{$item->area_id}}">{{$item->loc_code}}-{{$item->area_code}}</option>
                                            @endforeach
                                        @else
                                            @foreach ($areas as $item)
                                            <option 
                                                value="{{$item->area_id}}"
                                                @if ($item->area_id === $systems->areas_id)
                                                    selected                                            
                                                @endif 
                                            >
                                            {{$item->loc_code}}-{{$item->area_code}}
                                            </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <strong><label for="" class="requerido">Nombre:</label></strong>
                                <input type="text" id="max_name_sist" name="name" class="form-control" placeholder="Nombre" value="{{ isset($systems->name ) ? $systems->name :old('name') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                <strong><label for="" class="requerido">C&oacute;digo sistema: <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Es el identificador del Sistema consta de 1 a 9 caracteres alfanumérico."></i></label></strong>
                                <input type="text" id="max_id_sist" name="code" class="form-control" placeholder="Código" value="{{ isset($systems->code ) ? $systems->code :old('code') }}" required>
                                <small id="emailHelp" class="form-text text-muted">El c&oacute;digo consta entre 1 - 9 caracteres alfanum&eacute;rico.</small>
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