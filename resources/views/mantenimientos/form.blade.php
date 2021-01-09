<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <strong><label for="" class="requerido">C&oacute;digo del Sistema: <i class="fa fa-question-circle iconoAyuda" data-toggle="tooltip" data-placement="top" title="Es el identificador del Sistema."></i></label></strong>
        <select name="systems_id" class="form-control" required style="width: 100%;" id="nameiddos">
            <option value="">-- Seleccione una opci&oacute;n --</option>
            @if ($Modo=='crear')
                @foreach($systems as $item)
                    <option value="{{$item->id}}">{{$item->code}}-{{$item->name}}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>