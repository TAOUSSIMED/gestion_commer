@extends('base')
@section('contenue')
@foreach($livraisons as $dev)
<form action = "/bon_livraison/accepted/{{$dev->id}}" method = "post" class="form-horizontal form-label-left">
@csrf <!-- {{ csrf_field() }} -->

<div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Facture</label>
                        
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        
                          <select class="form-control" name="facture">
                          <option value="{{$dev->facture_id}}">{{$dev->facture_id}}</option>
                          <option value="Aucune">.........</option>
                           @foreach ($factures as $fac)
                            <option value="{{$fac->id}}">{{$fac->id}}</option>
                            @endforeach
                          </select>
                          
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Reference de Bon de Commande</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="RBC" name="rbc"value="{{$dev->rbc}}">
                        </div>
                    </div>
<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12">Date</label>
                    <fieldset>
                          <div class="control-group">
                            <div class="controls">
                              
                            <input type="text" class="form-control" placeholder="Statut" name="date"value="{{$dev->date}}">
                              <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                              
                                <input type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="First Name" aria-describedby="inputSuccess2Status" name="date" >
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                <span id="inputSuccess2Status" class="sr-only">(success)</span>
                              </div>
                            </div>
                          </div>
                        </fieldset>
</diV>

                    <div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12">client</label>
                        
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
                <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button type="button" onclick="window.location='/bon_livraison'"class="btn btn-primary">Cancel</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                <div> 
                

</form>
@endforeach
@endsection