@extends('base')
@section('contenue')
@foreach($lignefactures as $dev)
<form action = "/ligne_facture/accepted/{{$dev->id}}" method = "post" class="form-horizontal form-label-left">
@csrf <!-- {{ csrf_field() }} -->

<div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nom du Produit</label>
                        
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        
                          <select class="form-control" name="produit">
                          @foreach ($produit as $prod)
                          <option value="{{$prod->id}}">{{$dev->nom}}</option>
                          <option value="Aucune">.........</option>
                           
                            <option value="{{$prod->id}}">{{$prod->nom}}</option>
                            @endforeach
                          </select>
                          
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Quantite</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Quantite" name="quantite" value="{{$dev->quantite}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Prix ht</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Prix hors taxe" name="prixht"value="{{$dev->prixht}}">
                        </div>
                    </div>
                    
                
                <div class="form-group">

<label class="control-label col-md-3 col-sm-3 col-xs-12">Numero de Facture</label>

<div class="col-md-9 col-sm-9 col-xs-12">

  <select class="form-control" name="facture">
  <option value="{{$dev->facture_id}}">{{$dev->facture_id}}</option>
  <option value="Aucune">..........</option>
   @foreach ($factures as $devi)
    <option value="{{$devi->id}}">{{$devi->id}}</option>
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