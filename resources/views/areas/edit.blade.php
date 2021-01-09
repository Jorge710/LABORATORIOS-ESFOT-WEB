@extends("theme.$theme.layout")
@section('titulo') Editar &Aacute;rea @endsection
@section("scripts")
<script src="{{asset("assets/pages/scripts/admin/areas/crear.js")}}" type="text/javascript" defer></script>
@endsection
@section('contenido')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('areas.index') }}">&Aacute;reas</a></li>
              <li class="breadcrumb-item active" aria-current="page">Editar &aacute;rea - {{$area->code}}</li>
            </ol>
          </nav>
    </div>
</div>
@include('includes.mensaje-error')
<div class="container" id="formEstilo">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form action="{{route('areas.update',$area->id)}}" id="form-general" class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="_method" value="PUT">
                @include('areas.form',['Modo'=>'editar']) 
            </form>
        </div>
    </div>
</div>
@endsection


