@extends('base')

@section('contenue')
<form action = "/pdf_produit" method = "post" action ="/action_page.php" >
@csrf <!-- {{ csrf_field() }} -->
<button type="submit" class="btn btn-info btn-lg" >Imprimer Liste des Produits </button>
</form>
<form action = "/rechercher/" method = "post" action ="/action_page.php" >
@csrf <!-- {{ csrf_field() }} -->
<div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for..." name="rechercher">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="submit">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
</form>

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Ajouter un Produit</button>


<script>
 
</script>
<div class="table-responsive" id="OKK">
                      <table class="table table-striped jambo_table bulk_action" id="okk">
                        <thead>
                          <tr class="headings">
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">Numero de Ligne </th>
                            <th class="column-title">Coté </th>
                            <th class="column-title">Nom Produit </th>
                            <th class="column-title">Famille </th>
                            <th class="column-title">Description </th>
                            <th class="column-title"> </th>
                            <th class="column-title"> </th>
                           
                            
                          </tr>
                        </thead>

                        <tbody>
                        @foreach ($produits as $pro)
                          <tr class="even pointer">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" ">{{ $A+=1 }}</td>
                            <td class=" ">{{ $pro->id }}</td>
                            <td class=" ">{{ $pro->nom}} </td>
                            <td class=" "><a href="/produit/{{ $pro->categorie_id}}">{{ $pro->libellé}}</a></td>
                            <td class=" ">{{ $pro->description}}</td>
                            <td class=" "><a  data-toggle="modal" href="/produit/modifier/{{$pro->id}}"><i class="fa fa-edit"></i> Modifier</a></td>
                            <td class="a-right a-right "><a onclick="return confirm('Are you sure?')" href="/produit/supprimer/{{$pro->id}}"><i class="fa fa-trash"></i> Supprimer</a></td>
                            @endforeach
                            
                            </td>
                          </tr>
                          
                         
                        </tbody>

                      </table>
                                            
 <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ajouter un Produit</h4>
      </div>
      <div class="modal-body">
      <form action = "/produit/create/" method = "post" class="form-horizontal form-label-left">
@csrf <!-- {{ csrf_field() }} -->

<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nom du produit</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Nom du produit" name="nom">
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Famille</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control" name="famille">
                          @foreach ($categories as $cat)
                            <option value="{{ $cat->id}}">{{ $cat->libellé}}</option>
                          @endforeach
                            
                          </select>
                        </div>
                      </div>

<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Description <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea class="form-control" rows="3" placeholder="Description" name="description"></textarea>
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
      </div>
      <div class="modal-footer">
       
      </div>
    </div>

  </div>
</div>
                    </div>
                </div>
              
              

@endsection
