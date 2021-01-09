<table>
    <thead>
        <tr>
            <th style="background:#a29d7a;">Laboratorio</th>
            <th style="background:#a29d7a;">&Aacute;rea</th>
            <th style="background:#a29d7a;">Sistema</th>
            <th style="background:#a29d7a;">Equipo</th>
            <th style="background:#a29d7a;">Nombre</th>
            <th style="background:#a29d7a;">Frecuencia</th>
            <th style="background:#a29d7a;">Impacto Operacional</th>
            <th style="background:#a29d7a;">Flexibilidad</th>
            <th style="background:#a29d7a;">Costo Mantenimiento</th>
            <th style="background:#a29d7a;">Impacto Seguridad</th>
            <th style="background:#a29d7a;">Consecuencias</th>
            <th style="background:#a29d7a;">Total</th>
            <th style="background:#a29d7a;">Criticidad</th>
            <th style="background:#a29d7a;">Disponinibilidad</th>
            <th style="background:#a29d7a;">Modelo Mantenimiento</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($criticalities as $criticality)
      <tr>
        <td>{{$criticality->locations_id}}</td>
        <td>{{$criticality->areas_id}}</td>
        <td>{{$criticality->sist_id}}</td>
        <td>{{$criticality->equipment_id}}</td>
        <td>{{$criticality->name}}</td>
        <td style="background:#a29d7a;">{{$criticality->frequency}}</td>
        <td>{{$criticality->operationalImpact}}</td>
        <td>{{$criticality->flexibility}}</td>
        <td>{{$criticality->maintenanceCost}}</td>
        <td>{{$criticality->impactToSafety}}</td>
        <td style="background:#a29d7a;">{{$criticality->consequences}}</td>
        <td>{{$criticality->total}}</td>
        <td
            @if ($criticality->total < 20)
                style="background:#39941f;"
            @elseif ($criticality->total >20 && $criticality->total < 35)
                style="background: #e7cc11;"
            @else
                style="background: #f9141e;"
            @endif
        ></td>
        <td>{{$criticality->crit_availabilities}}</td>
        <td>{{$criticality->crit_maintenance_model}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>