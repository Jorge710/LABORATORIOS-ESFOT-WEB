@extends("theme.$theme.layout")
@section('titulo') 
Crear Sistemas 
@endsection
@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/areas/crear.js")}}" type="text/javascript" defer></script>
    <script src="{{asset("assets/pages/scripts/admin/sistemas/crear.js")}}" type="text/javascript" defer></script>
@endsection
@section('contenido')
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('sistemas.index') }}">Sistemas</a></li>
              <li class="breadcrumb-item active" aria-current="page">Crear sistema</li>
            </ol>
        </nav>
    </div>
</div>
@include('includes.mensaje-error')
<div class="container">
    <form action="{{ route('sistemas.store')}}" id="form-general" class="form-horizontal" method="post" autocomplete="off">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        @include('sistemas.form',['Modo'=>'crear'])
    </form>
</div>
@endsection