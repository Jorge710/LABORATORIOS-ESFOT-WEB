@extends("theme.$theme.layout")
@section('titulo') 
Editar elementos 
@endsection
@section('contenido')
@section("scripts")
    <script src="{{asset("assets/pages/scripts/admin/elementos/crear.js")}}" type="text/javascript" defer></script>
@endsection
<div class="container" id="cabeceraForm">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar elemento</h2>
            </div>
            <div class="pull-right">
                
            </div>
        </div>
    </div>
</div>
@foreach ($elements as $elements)
    
@endforeach
@include('includes.mensaje-error')
<div class="container" id="formEstilo">
    <form action="{{route('elementos.update',$elements->id)}}" id="form-general" class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_method" value="PUT">
        @include('elementos.form',['Modo'=>'editar']) 
    </form>
</div>
@endsection


