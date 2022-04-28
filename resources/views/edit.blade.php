<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@foreach ($clients as $client)
      <tr>
      <td><input type="text" value="{{ $client->nom}}"></td>
      <td><input type="text" value="{{ $client->prenom}}"></td>
      


      </tr>
@endforeach

</body>
</html>