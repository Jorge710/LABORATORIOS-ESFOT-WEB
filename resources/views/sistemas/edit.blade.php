@extends("theme.$theme.layout")
@section('titulo') 
Editar Sistema 
@endsection
@section('contenido')
@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/sistemas/crear.js")}}" type="text/javascript" defer></script>
@endsection
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('sistemas.index') }}">Sistemas</a></li>
              <li class="breadcrumb-item active" aria-current="page">Editar sistema - {{ $systems->code }}</li>
            </ol>
        </nav>
    </div>
</div>
@include('includes.mensaje-error')
<div class="container" id="formEstilo">
    <form action="{{route('sistemas.update',$systems->id)}}" id="form-general" class="form-horizontal" method="post" role="form" autocomplete="off">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_method" value="PUT">        
        @include('sistemas.form',['Modo'=>'editar'])        
    </form>
</div>
@endsection


