@extends("theme.$theme.layout")
@section('titulo') Crear &Aacute;rea @endsection
@section("scripts")
<script src="{{asset("assets/pages/scripts/admin/areas/crear.js")}}" type="text/javascript" defer></script>
@endsection
@section('contenido')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('areas.index') }}">&Aacute;reas</a></li>
              <li class="breadcrumb-item active" aria-current="page">Crear &aacute;rea</li>
            </ol>
          </nav>
    </div>
</div>
@include('includes.mensaje-error')
<div class="container" id="formEstilo">
    <form action="{{ route('areas.store')}}" id="form-general" class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">        
        @include('areas.form',['Modo'=>'crear']) 
    </form>
</div>
@endsection

