@extends('base')

@section('contenue')
    
<a href="/client_fournisseur/insert">Ajouter client ou fournisseur</a>
<table class="table" >
    <thead>
      <tr>
        <th>ID</th>
        <th>Société</th>
        <th>Email</th>
        <th>Tel</th>
        <th>ICE</th>
        <th>Adresse</th>
        <th>Type</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($cli_fous as $client)
      <tr>
      <td>{{ $client->id }}</td>
      <td>{{ $client->société}}</td>
      <td>{{ $client->email }}</td>
      <td>{{ $client->Tel }}</td>
      <td>{{ $client->ice}}</td>
      <td>{{ $client->adresse}}</td>
      <td>{{ $client->type}}</td>
      <td> <a href="/client_fournisseur/modifie/{{$client->id}}"><i class="fa fa-edit"></i></a></td>
      <td> <a onclick="return confirm('Are you sure?')" href="/client_fournisseur/supprimer/{{$client->id}}"><i class="fa fa-trash"></i></a></td>
     
      


      </tr>
      @endforeach
    </tbody>
  </table>
@endsection