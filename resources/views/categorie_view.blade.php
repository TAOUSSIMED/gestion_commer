@extends('base')
@section('contenue')


<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Ajouter categorie</button>


<table class="table">
<thead>
      <tr>
      <th>Numero de Ligne</th>
        <th>ID</th>
        <th>Libellé</th>
        
      </tr>
    </thead>
    <tbody>
    @foreach ($categories as $cat)
      <tr>
      <td>{{ $A+=1 }}</td>
      <td>{{ $cat->id }}</td>
      <td>{{ $cat->libellé}}</td>
      
      <td> <a onclick="return confirm('Are you sure?')" href="/categorie/supprimer/{{$cat->id}}"><i class="fa fa-trash"></i> Supprimer</a></td>
      


      </tr>
      @endforeach
    </tbody>


</table>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ajouter une categorie</h4>
      </div>
      <div class="modal-body">
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