<table>
    <thead>
        <tr>
            <th style="background:#a29d7a;">ci</th>
            <th style="background:#a29d7a;">Apellido</th>
            <th style="background:#a29d7a;">Nombre</th>
            <th style="background:#a29d7a;">E-mail</th>
            <th style="background:#a29d7a;">Cargo</th>
            <th style="background:#a29d7a;">Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{$user->ci}}</td>
                <td>{{$user->lastname}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->nameRol}}</td>
                <td>{{$user->state}}</td>
            </tr>
        @endforeach
    </tbody>
</table>