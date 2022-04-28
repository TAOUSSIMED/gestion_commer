@extends('base')
@section('contenue')
 <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Ajouter une Bon de Livraison</button>
<table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>
							 <th><input type="checkbox" id="check-all" class="flat" name="check"></th>
						  </th>
              <th>Numero de Ligne</th>
                          <th>Coté</th>
                          <th>Facture</th>
                          <th>Reference deBon de Commande</th>
                          <th>Date </th>
                          <th>Fournisseur</th>
                          
                        </tr>
                      </thead>


                      <tbody>
                      @foreach ($livraisons as $dev)
                        <tr>
                          <td>
							 <th><a href="/bon_commande/{{$dev->id}}"><input type="checkbox" id="check-all" class="flat"  name="check"  ></a></th>
						  </td>
              <td>{{$A+=1}}</td>
                          <td><a href="/bon_livraison/{{$dev->id}}">{{$dev->id}}  </a></td>
                          <td>{{$dev->facture_id}}</td>
                          <td>{{$dev->rbc}}</td>
                          <td>{{$dev->date}}</td>
                          <td>{{$dev->société}}</td>
                          
                          <td> <a href="/bon_livraison/modifie/{{$dev->id}}"><i class="fa fa-edit"></i> Modifier</a></td>
                          <td> <a onclick="return confirm('Are you sure , you want to delete this Bon de Livraison  : {{$dev->id}} ?')", href="/bon_livraison/supprimer/{{$dev->id}}"><i class="fa fa-trash"></i> Supprimer</a></td>
                          <td> <a href="/pdf_livraison/{{$dev->id}}"><i class="fa fa-file-pdf-o"></i> Imprimer</a></td>
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
        <h4 class="modal-title">Ajouter une Bon de Livraison</h4>
      </div>
      <div class="modal-body">
      <form action = "/bon_livraison/create" method = "post" class="form-horizontal form-label-left">
@csrf <!-- {{ csrf_field() }} -->

<div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Facture</label>
                        
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        
                          <select class="form-control" name="facture">
                           @foreach ($factures as $fac)
                            <option value="{{$fac->id}}">{{$fac->id}}</option>
                            @endforeach
                          </select>
                          
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Reference de Bon de Commande</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Reference de Bon de Commande" name="rbc">
                        </div>
                    </div>
<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12">Date</label>
                    <fieldset>
                          <div class="control-group">
                            <div class="controls">
                              <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="First Name" aria-describedby="inputSuccess2Status" name="date" data-date-format="yyyy-mm-dd">
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                <span id="inputSuccess2Status" class="sr-only">(success)</span>
                              </div>
                            </div>
                          </div>
                        </fieldset>
</diV>
<div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Client</label>
                        
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
      <div class="modal-footer">
       
      </div>
    </div>

  </div>
</div>
                    </div>
                </div>
              </div>

@endsection          