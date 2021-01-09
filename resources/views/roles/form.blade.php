<div class="form-group">
    <label for="name">Nombre</label>
    <input name="name" type="text" value="@isset($role->name){{ $role->name }}@endisset" class="form-control">
</div>
<div class="form-group">
    <label for="name">Slug</label>
    <input name="slug" type="text" value="@isset($role->name){{ $role->slug }}@endisset" class="form-control">
</div>
<div class="form-group">
    <label for="name">Descripci&oacute;n</label>
    <input name="description" type="text" value="@isset($role->description){{ $role->description }}@endisset" class="form-control">
</div>
<hr>
<h3>Lista de Permisos Especiales</h3>
<div class="form-group">
    <label><input type="radio" name="special" value="all-access">Acceso Total</label>
    <br>
    <label><input type="radio" name="special" value="no-access">Ningún acceso <em>(Usuario Suspendido)</em></label>
</div>
<hr>
<h3>Lista de Permisos</h3>
<div class="form-group">
    <ul class="list-unstyled">
        @foreach ($permissions as $permission)
            <li>
                <label>
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                    {{ $permission->id }} - {{ $permission->name }}
                    <em>({{ $permission->description }})</em>
                </label>
            </li>
        @endforeach
    </ul>
</div>
<button type="submit" class="btn btn-primary">Guardar</button>
<a href="{{route('roles.index')}}" class="btn btn-danger">Cancelar</a>