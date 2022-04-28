
@extends('base')
@section('contenue')
@foreach($cli_fous as $cf)
<form action = "/client_fournisseur/accepted/{{$cf->id}}" method = "post" class="form-horizontal form-label-left">
@csrf <!-- {{ csrf_field() }} -->

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Société</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Société" name="société" value="{{$cf->société}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="ABC@example.com" name="email"value="{{$cf->email}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tel</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="06xxxxxxxx" name="Tel" value="{{$cf->Tel}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">ICE</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="ICE" name="ice" value="{{$cf->ice}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Adresse</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea class="form-control" rows="3" placeholder="Adresse" name="adresse" >{{$cf->adresse}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Type</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control" name="type">
                            <option >{{$cf->type}}</option>
                            <option >...........</option>
                            <option value="Client">Client</option>
                            <option value="Fournisseur">Fournisseur</option>
                            <option value="Prospect">Prospect</option>
                          </select>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="button" onclick="window.location='/client_fournisseur'"class="btn btn-primary">Cancel</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>   

</form>
@endforeach
@endsection