@extends('base')

@section('contenue')

 <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Ajouter une Facture</button>
<table id="example" class="table table-striped table-bordered bulk_action" >
                      <thead>
                        <tr>
                          <th>
							 <th><input type="checkbox" id="check-all" class="flat" name="check"></th>
						  </th>
              <th>Numero de Ligne</th>
                          <th>Coté</th>
                          <th>Reference Bon de Livraison</th>
                          <th>Reference Bon de Commande</th>
                          <th>Taux TVA</th>
                          <th>Client</th>
                          
                        </tr>
                      </thead>


                      <tbody>
                      @foreach ($factures as $fac)
                        <tr>
                          <td>
							 <th><a href="/facture/{{$fac->id}}"><input type="checkbox" id="check-all" class="flat"  name="check"  ></a></th>
						  </td>
              <td>{{$A+=1}}</td>
                          <td><a href="/facture/{{$fac->id}}">{{$fac->id}}  </a></td>
                          <td>{{$fac->RBL}}</td>
                          <td>{{$fac->RBC}}</td>
                          <td>{{$fac->tva}}%</td>
                          <td>{{$fac->société}}</td>
                          
                          <td> <a href="/facture/modifie/{{$fac->id}}"><i class="fa fa-edit"></i> Modifier</a></td>
                          <td> <a onclick="return confirm('Are you sure , you want to delete this devis : {{$fac->id}} ?')", href="/facture/supprimer/{{$fac->id}}"><i class="fa fa-trash"></i> Supprimer</a></td>
                          <td> <a href="/pdf_facture/{{$fac->id}}"><i class="fa fa-file-pdf-o"></i> Imprimer</a></td>
                        </tr>
                        <tr>
                        @endforeach 
                      </tbody>
                    </table>
                     <div class="content">
          @yield('contenue2')
                    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ajouter une facture</h4>
      </div>
      <div class="modal-body">
      <form action = "/facture/create/" method = "post" class="form-horizontal form-label-left">
@csrf <!-- {{ csrf_field() }} -->
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Reference Bon de Livraison</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Reference Bon de Livraison" name="RBL">
                        </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Reference Bon de Commande</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Reference Bon de Commande" name="RBC">
                        </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> Taux TVA</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="TVA" name="tva" value=20>
                        </div>
                </div>
                <div class="form-group">

<label class="control-label col-md-3 col-sm-3 col-xs-12">Fournisseur</label>

<div class="col-md-9 col-sm-9 col-xs-12">

  <select class="form-control" name="cl_fous">
   @foreach ($client as $cli)
    <option value="{{$cli->id}}">{{$cli->société}}</option>
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
      
    </div>

  </div>
</div>
@endsection