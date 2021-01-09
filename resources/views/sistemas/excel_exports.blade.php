<table>
    <thead>
        <tr>
            <th style="background:#a29d7a;">ID1</th>
            <th style="background:#a29d7a;">ID2</th>
            <th style="background:#a29d7a;">ID3</th>
            <th style="background:#a29d7a;">Nombre</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($systems as $data)
        <tr>
            <td>{{$data->code_locations}}</td>
            <td>{{$data->code_area}}</td>
            <td>{{$data->code}}</td>
            <td>{{$data->name}}</td>
        </tr>
        @endforeach
    </tbody>
</table>