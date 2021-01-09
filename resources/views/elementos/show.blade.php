@extends("theme.$theme.layout")
@section('titulo') Elementos @endsection
@section('contenido')    
<div class="container">
    <h2>Elemento:  <span style="color:blue;">{{ $elementos->nombre }}</span></h2>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            @foreach ($elem as $elements)
                <img src="{{asset("storage").'/'.$elements->elem_img}}" width="400" class="img-thumbnail img-fluid" alt="img_elemento"> <br>
            @endforeach
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            @foreach ($elem as $elements)
                <strong>Cantidad: </strong></label><p><em>{{$elements->cantidad}}
                <br><strong>Descripci&oacute;n:</strong>{{$elements->elem_descrp}}
                <br><strong>Funci&oacute;n:</strong>{{$elements->elem_func}}
                <br><strong>Descripci&oacute;n Fallo</strong>{{$elements->elem_descFallo}}
                <br><strong>Tipo De Fallo: </strong>{{$elements->elem_tipoFallo}}
                <br><strong>Modo de Fallo:</strong>{{$elements->mdoFallo}}
                <br><strong>Clasificaci&oacute;n: </strong>{{$elements->clasificacion}}
                <br><strong>Actividad:</strong>{{$elements->actividad}}
                <br><strong>Frecuencia: </strong>{{$elements->elem_fre}}
                <br><strong>Tarea:</strong>{{$elements->tarea}}
                <br><strong>Mejora:</strong>{{$elements->mejoras}}
            @endforeach
        </div>
    </div>
</div>
@endsection