@extends('base')
@section('contenue')
@foreach($devis as $dev)
<form action = "/bon_commande/accepted/{{$dev->id}}" method = "post" class="form-horizontal form-label-left">
@csrf <!-- {{ csrf_field() }} -->

<div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fournisseur</label>
                        
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        
                          <select class="form-control" name="cl_fous">
                          <option value="{{$dev->id}}">{{$dev->société}}</option>
                          <option value="Aucune">.........</option>
                           @foreach ($client as $cli)
                            <option value="{{$cli->id}}">{{$cli->société}}</option>
                            @endforeach
                          </select>
                          
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Devis</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Devis" name="devis"value="{{$dev->devis}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="date"value="{{$dev->date}}">
                        </div>
                    </div>
<div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Mode de Paiement</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" placeholder="Statut" name="modepaiement"value="{{$dev->modepaiement}}">
                        <label class="radio-inline"><input type="radio" name="modepaiement"  value="Virement">Virement </label>
                    <label class="radio-inline"><input type="radio" name="modepaiement"value="Cheque" >Cheque </label>
                          
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Statut</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Statut" name="statut"value="{{$dev->statut}}">
                        
                        
                        <label class="radio-inline"><input type="radio" name="statut"  value="envoyé">Envoyé </label>
                    <label class="radio-inline"><input type="radio" name="statut"value="recu" >Reçu </label>
                    <label class="radio-inline"><input type="radio" name="statut"value="validé" >Validé </label>
                    </div>
                    </div>
                    
                <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button type="button" onclick="window.location='/bon_commande'"class="btn btn-primary">Cancel</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                <div> 
                

</form>
@endforeach
@endsection