@extends('base')
@section('contenue')
<form action = "/categorie/create/" method = "post" class="form-horizontal form-label-left">
@csrf <!-- {{ csrf_field() }} -->
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Libellé</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="libellé" name="libellé">
                        </div>
                </div>


                <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="button" onclick="window.location='/categorie'" class="btn btn-primary" >Cancel</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                <div> 
                

</form>
@endsection