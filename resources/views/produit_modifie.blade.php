
@extends('base')
@section('contenue')
@foreach ($produits as $pro)
<form action = "/produit/accepted/{{$pro->id}}" method = "post" class="form-horizontal form-label-left">
@csrf <!-- {{ csrf_field() }} -->

<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nom du produit</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Nom du produit" name="nom"value="{{$pro->nom}}">
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Famille</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control" name="famille">
                          <option>{{ $pro->libellé}}</option>
                          <option>...........</option>
                          @foreach ($categories as $cat)
                            <option>{{ $cat->libellé}}</option>
                          @endforeach
                            
                          </select>
                        </div>
                      </div>

<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Description <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea class="form-control" rows="3" placeholder="Description" name="description"value="{{$pro->description}}">{{$pro->description}}</textarea>
                        </div>
</div>
<div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button type="button" onclick="window.location='/produit'"class="btn btn-primary">Cancel</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

</form>
@endforeach
@endsection