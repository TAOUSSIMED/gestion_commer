@extends('base')

@section('contenue')
<form action = "/pdf_fournisseur" method = "post" action ="/action_page.php" >
@csrf <!-- {{ csrf_field() }} -->
<button type="submit" class="btn btn-info btn-lg" >Imprimer Liste des Fournisseurs </button>
</form>
<form action = "/rechercher2/" method = "post" action ="/action_page.php" >
@csrf <!-- {{ csrf_field() }} -->
<div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for..." name="rechercher">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="submit">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
</form>
<form>
@csrf <!-- {{ csrf_field() }} -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal1">Ajouter client ou Fournisseur</button>
<table class="table" >
    <thead>
      <tr>
      <th>Numero de Ligne</th>
        <th>Coté</th>
        <th>Société</th>
        <th>Email</th>
        <th>Tel</th>
        <th>ICE</th>
        <th>Adresse</th>
        <th>Type</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($cl_fous as $client)
      <tr>
      <td>{{ $A+=1 }}</td>
      <td>{{ $client->id }}</td>
      <td>{{ $client->société}}</td>
      <td>{{ $client->email }}</td>
      <td>{{ $client->Tel }}</td>
      <td>{{ $client->ice}}</td>
      <td>{{ $client->adresse}}</td>
      <td>{{ $client->type}}</td>
      <td> <a href="/client_fournisseur/modifie/{{$client->id}}"><i class="fa fa-edit"></i> Modifier</a></td>
      <td> <a onclick="return confirm('Are you sure?')", href="/client_fournisseur/supprimer/{{$client->id}}"><i class="fa fa-trash"></i> Supprimer</a></td>
      


      </tr>
      @endforeach
    </tbody>
  </table>
  </form>
  

<!-- Modal -->
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ajouter client ou Fournisseur</h4>
      </div>
      <div class="modal-body">
      <form action = "/client_fournisseur/create/" method = "post" class="form-horizontal form-label-left">
@csrf <!-- {{ csrf_field() }} -->

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Société</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Société" name="société">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="ABC@example.com" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tel</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="06xxxxxxxx" name="Tel">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">ICE</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="ICE" name="ice">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Adresse</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea class="form-control" rows="3" placeholder="Adresse" name="adresse"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Type</label>
                    <label class="radio-inline"><input type="radio" name="type" checked value="Client">Client </label>
                    <label class="radio-inline"><input type="radio" name="type"value="Prospect" >Prospect </label>
                    <label class="radio-inline"><input type="radio" name="type"value="Fournisseur" >Fournisseur </label>
                    
                    

                    </div>
                    <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>    






                      


</form>
      </div>
      
    </div>

  </div>
</div>
  @endsection