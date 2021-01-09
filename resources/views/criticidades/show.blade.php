@extends("theme.$theme.layout")
@section('titulo') Criticidades @endsection
@section('contenido')
@foreach ($criticidades as $criticidades)
    
@endforeach
<div class="row" id="contentHeadEquipo">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <strong><h2>{{$criticidades->equipos_id}}</h2></strong>
        <strong><h2>{{$criticidades->nomb_equipo}}</h2></strong>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"><a href="{{route('criticidades.index')}}" class="btn btn-primary"><- Anterior</a></div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <strong>Frecuencia:</strong>
            {{$criticidades->frecuencia}}
            <br>
            <strong>Impacto operacional:</strong>
            {{$criticidades->impactoOper}}
            <br>
            <strong>Flexibilidad:</strong>
            {{$criticidades->flexibilidad}}
            <br>
            <strong>Costo Mantenimiento:</strong>
            {{$criticidades->costoMito}}
            <br>
            <strong>Impacto Seguridad:</strong>
            {{$criticidades->impactSegMa}}
            <br>
            <strong>Consecuencias:</strong>
            {{$criticidades->consecuencias}}
            <br>
            <strong>Total:</strong>
            {{$criticidades->total}}
            <p
                @if ($criticidades->total < 20)
                    style="background:green;"
                @elseif ($criticidades->total >20 && $criticidades->total < 35)
                    style="background: #e7cc11;"
                @else
                    style="background: red;"
                @endif
                >
                    CRITICIDAD DEL EQUIPO
            </p>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <img src="../img/tbl_criticidad.jpg" class="img-fluid" alt="img_tbl_criticidad">
        </div>
    </div>
</div>
@endsection