<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tickets</title>
</head>
<body>
    <table>
      <tr>
        <th>id</th>
        <th>usuario</th>
        <th>correo</th>
        <th>estado</th>
      </tr>
      <tr>

      @foreach($tickets as $t)
      <td>{{ $t ->id }}</td>
      <td>{{ $t -> nombre_usuario }} </td>
      <td>{{ $t-> correo_usuario }}</td>
      <td>{{ $t-> estado }}</td>
      @endforeach
    </tr>
  </table>
</body>
</html>
