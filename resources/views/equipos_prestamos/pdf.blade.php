<html>
    <head>
        <!-- CSS only -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <style>
            .header{background:#eee;color:#444;border-bottom:1px solid #ddd;padding:10px;}
            h1 small{display:block;font-size:16px;color:#888;}
            table{width:100%;}
            .text-right{text-align:right;}
            td{
                font-size: 10px;
                text-align: center;
                padding-top: 0px;
                padding-bottom: 0px;
                height: 20px;
            }
            thead{background: skyblue; text-align: center;}
        </style>
        
    </head>
    <body>
        <div class="header">
            <h3>
                Reporte de equipos prestados 
            </h3>
            <br>
                <small>
                    Fecha de emisión del reporte: <?php
                    $mytime = Carbon\Carbon::now();
                    echo $mytime->toDateTimeString();
                    ?>
                </small>
            
        </div>
        
        <table class="table table-striped table-bordered table-hover" id="tabla-data">
            <thead>
                <tr>
                    <th>Equipo</th>
                    {{-- <th>Equipo</th> --}}
                    <th>Prestado por</th>
                    <th>Prestado a</th>
                    <th>email</th>
                    <th>Facultad</th>
                    <th>Carrera</th>
                    <th>Fecha prestamo</th>
                    <th>Fecha devolución</th>
                    <th>Recibido por</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($equipment as $data)
                <tr>
                    <td>({{$data->code_locations}}-{{$data->code_areas}}-{{$data->code_systems}}-{{$data->code}})</td>
                    {{-- <td>{{$data->name}}</td> --}}
                    <td>{{$data->lent_by}}</td>
                    <td>{{$data->equi_prestamo_name}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->faculty}}</td>
                    <td>{{$data->career}}</td>
                    <td>{{$data->loan_date}}</td>
                    <td
                        @if (isset($data->return_date))
                            style="background:#6ef97d;"}}
                        @else
                            style="background: #f96e70;"
                        @endif
                        >
                        {{$data->return_date ?? 'Pendiente'}}
                    </td>
                    <td>{{$data->received_by ?? 'Pendiente'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
</html>