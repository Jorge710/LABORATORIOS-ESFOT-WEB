@extends("theme.$theme.layout")
@section('titulo') Roles @endsection
@section('contenido')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>Listado de roles</h2>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        @include('includes.mensaje-success')
        @include('includes.mensaje-error')
        <div class="card">
            <div class="card-header">
                <span>El sistema web cuenta con los siguientes roles</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>Cargo</th>
                                        <th>Descripci&oacute;n</th>
                                        <th colspan="3">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                    <tr>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->description}}</td>
                                        <td width="10px">
                                            @can('roles.edit')
                                                <a href="{{route('roles.edit', $role->id)}}" class="btn btn-block btnEditar"><i class="fa fa-edit">Editar</i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        {{ $roles->render()}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
@endsection