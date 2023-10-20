<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <style>
    .center {
      text-align: center;
    }

    .logo {
      height: 70px;
      width: 180px;
    }

    .contenedor {
      margin-left: 78%;
      margin-top: -7%;
    }

    .cabecera {
      background-color: black;
      color: white;
      text-align: center;
    }

    .table {
      text-align: center;
      font-size: 16px;
      border-collapse: collapse;
      width: 100%;
      border: 2px solid black;
    }

    .table td,
    .table th {
      padding: 0.9rem 0.6rem;
      border: 2px solid black;
    }
  </style>
</head>

<body>

  <img class="logo"
    src="img/brand/logo_visitasMPP.png"
    alt="logo visitas">



  <p class="contenedor">
    Fecha de creación: {{ date('Y-m-d') }} Hora: {{ date('h:i:s a') }}
  </p>
  <hr>
  <h1 class="center">Registro de Visitas </h1>
  <h3 class="center">Del {{ Carbon\Carbon::parse($startDate)->format('d/m/y') }} al
    {{ Carbon\Carbon::parse($endDate)->format('d/m/y') }}</h3>

  @if ($naturalVisits->count() !== 0)
    <h2>Personas Naturales</h2>
    <table class="table">
      <thead class="cabecera">
        <tr>
          <th scope="col">Asunto</th>
          <th scope="col">Estado</th>
          <th scope="col">Nombre del visitante</th>
          <th scope="col">DNI</th>
          <th scope="col">Fecha</th>
          <th class="text-center"
            scope="col">Hora de inicio y<br>Hora final</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($naturalVisits as $visit)
          <tr>
            <td scope="row">{{ $visit->subject }}</td>
            <td>{{ $visit->status }}</td>
            <td>{{ $visit->name }}</td>
            <td>{{ $visit->dni }}</td>
            <td>{{ Carbon\Carbon::parse($visit->start_date)->format('d/m/y') }}</td>
            <td>{{ Carbon\Carbon::parse($visit->start_date)->format('H:i') }} -
              {{ Carbon\Carbon::parse($visit->end_date)->format('H:i') }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif

  @if ($legalVisits->count() !== 0)
    <h2>Personas Juridicas</h2>
    <table class="table">
      <thead class="cabecera">
        <tr>
          <th scope="col">Asunto</th>
          <th scope="col">Estado</th>
          <th scope="col">Nombre del visitante</th>
          <th scope="col">RUC</th>
          <th scope="col">Fecha</th>
          <th class="text-center"
            scope="col">Hora de inicio y<br>Hora final</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($legalVisits as $visit)
          <tr>
            <td scope="row">{{ $visit->subject }}</td>
            <td>{{ $visit->status }}</td>
            <td>{{ $visit->name }}</td>
            <td>{{ $visit->ruc }}</td>
            <td>{{ Carbon\Carbon::parse($visit->start_date)->format('d/m/y') }}</td>
            <td>{{ Carbon\Carbon::parse($visit->start_date)->format('H:i') }} -
              {{ Carbon\Carbon::parse($visit->end_date)->format('H:i') }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
</body>

</html>
