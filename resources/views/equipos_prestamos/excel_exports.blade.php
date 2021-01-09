<table>
    <thead>
        <tr>
            <th style="background:#a29d7a;">ID4</th>
            <th style="background:#a29d7a;">Equipo</th>
            <th style="background:#a29d7a;">Prestado por</th>
            <th style="background:#a29d7a;">Prestado a</th>
            <th style="background:#a29d7a;">email</th>
            <th style="background:#a29d7a;">Facultad</th>
            <th style="background:#a29d7a;">Carrera</th>
            <th style="background:#a29d7a;">Fecha prestamo</th>
            <th style="background:#a29d7a;">Fecha devolución</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($equipos as $data)
        <tr>
            <td>{{$data->equi_id}}</td>
            <td>{{$data->equi_nombre}}</td>
            <td>{{$data->user_prestado_por}}</td>
            <td>{{$data->user_prestado_a}}</td>
            <td>{{$data->email}}</td>
            <td>{{$data->facultad}}</td>
            <td>{{$data->carrera}}</td>
            <td>{{$data->fecha_prestamo}}</td>
            <td>{{$data->fecha_devolucion}}</td>
        </tr>
        @endforeach
    </tbody>
</table>