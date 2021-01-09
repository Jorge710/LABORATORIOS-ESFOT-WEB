<table>
    <thead>
        <tr>
            <th style="background:#a29d7a;">ID1</th>
            <th style="background:#a29d7a;">ID2</th>
            <th style="background:#a29d7a;">ID3</th>
            <th style="background:#a29d7a;">ID4</th>
            <th style="background:#a29d7a;">Nombre</th>
            <th style="background:#a29d7a;">Asignación Criticidad</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($equipment as $data)
        <tr>
            <td>{{$data->locations_code}}</td>
            <td>{{$data->area_code}}</td>
            <td>{{$data->systems_code}}</td>
            <td>{{$data->code}}</td>
            <td>{{$data->name}}</td>
            <td>{{$data->assign_criticality}}</td>
        </tr>
        @endforeach
    </tbody>
</table>