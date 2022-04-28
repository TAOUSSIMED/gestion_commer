@extends('base')
@section('contenue')
@foreach($factures as $fac)
<form action = "/facture/accepted/{{$fac->id}}" method = "post" class="form-horizontal form-label-left">
@csrf <!-- {{ csrf_field() }} -->
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Reference Bon de Livraison</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Reference Bon de Livraison" name="RBL" value="{{$fac->RBL}}">
                        </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Reference Bon de Commande</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Reference Bon de Commande" name="RBC"value="{{$fac->RBC}}">
                        </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> Taux TVA</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="TVA" name="tva" value="{{$fac->tva}}">
                        </div>
                </div>
                <div class="form-group">

<label class="control-label col-md-3 col-sm-3 col-xs-12">Client</label>

<div class="col-md-9 col-sm-9 col-xs-12">

  <select class="form-control" name="cl_fous">
  <option value="{{$fac->id}}">{{$fac->société}}</option>
  <option value="Aucune">.........</option>
   @foreach ($client as $cli)
    <option value="{{$cli->id}}">{{$cli->société}}</option>
    @endforeach
  </select>
  
</div>
</div>

                <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button type="button" onclick="window.location='/facture'"class="btn btn-primary">Cancel</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                <div> 
                

</form>
@endforeach
@endsection