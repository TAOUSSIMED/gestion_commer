@extends('base')

@section('contenue')
<form>
@csrf <!-- {{ csrf_field() }} -->




<table class="table">
                      <thead>
                        <tr>
                        <th>Numero de Ligne</th>
                        <th>Coté</th>
                        <th>Nom produit </th>
                        <th>Famille </th>
                        <th>Description</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($produits as $pro)
                        <tr>
                        <td>{{ $A+=1 }}</td>
                        <td>{{ $pro->id }}</td>
                        <td>{{ $pro->nom}}</td>
                        <td><a href="/produit/{{ $pro->categorie_id}}">{{ $pro->categorie_id}}</a></td>
                        <td>{{ $pro->description}}</td>
                        <td> <a href="/produit/modifier/{{$pro->id}}"><i class="fa fa-edit"></i> Modifier</a></td>
                        <td> <a onclick="return confirm('Are you sure?')"href="/produit/supprimer/{{$pro->id}}"><i class="fa fa-trash"></i> Supprimer</a></td>
                        
                        </tr>
                      </tbody>
                      @endforeach
                    </table>
</form>
@endsection
