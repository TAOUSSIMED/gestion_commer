@extends('bon_commande_view')
@section('contenue2')
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal1">Ajouter une ligne de Bon de Commande</button>
<table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>
							 <th><input type="checkbox" id="check-all" class="flat" name="check"></th>
						  </th>
              <th>Numero de Ligne</th>
                          <th>Coté</th>
                          <th>Nom du Produit</th>
                          <th>Quantite</th>
                          <th>Prix Ht</th>
                          <th>Bon de Commande </th>
                          
                        </tr>
                      </thead>


                      <tbody>
                      @foreach ($ligneboncommandes as $dev)
                        <tr>
                          <td>
							 <th><input type="checkbox" id="check-all" class="flat" value="{{$dev->id}}" name="check"  ></th>
						  </td>
              <td>{{$B+=1}}</td>
                          <td>{{$dev->id}}</td>
                          <td>{{$dev->nom}}</td>
                          <td>{{$dev->quantite}}</td>
                          <td>{{$dev->prixht}}</td>
                          <td>{{$dev->bon_commande_id}}</td>
                          <td> <a href="/ligne_bon_commande/modifie/{{$dev->id}}"><i class="fa fa-edit"></i> Modifier</a></td>
                          <td> <a onclick="return confirm('Are you sure , you want to delete this ligne du bon de commande : {{$dev->id}} ?')", href="/ligne_bon_commande/supprimer/{{$dev->id}}"><i class="fa fa-trash"></i> Supprimer</a></td>
                          
                        </tr>
                        <tr>
                        @endforeach 
                      </tbody>
                    </table>
                    <!-- Modal -->
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ajouter une ligne de Bon de Commande</h4>
      </div>
      <div class="modal-body">
      <form action = "/ligne_bon_commande/create/" method = "post" class="form-horizontal form-label-left">
@csrf <!-- {{ csrf_field() }} -->

<div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nom du Produit</label>
                        
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        
                          <select class="form-control" name="produit">
                           @foreach ($produit as $prod)
                            <option value="{{$prod->id}}">{{$prod->nom}}</option>
                            @endforeach
                          </select>
                          
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Quantite</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Quantite" name="quantite">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Prix ht</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Prix hors taxe" name="prixht">
                        </div>
                    </div>
                    
                
                <div class="form-group">

<label class="control-label col-md-3 col-sm-3 col-xs-12">Numero de Bon de Commande</label>

<div class="col-md-9 col-sm-9 col-xs-12">

  <select class="form-control" name="boc">
   @foreach ($boncommandes as $dev)
    <option value="{{$dev->id}}">{{$dev->id}}</option>
    @endforeach
  </select>
  
</div>
</div>
                
<div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                <div> 
</form>
      </div>
      <div class="modal-footer">
       
      </div>
    </div>

  </div>
</div>
                    </div>
                </div>
              </div>
@endsection                    