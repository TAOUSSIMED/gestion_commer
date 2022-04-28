<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
class factureviewcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert($id));
        $pdf->getDOMPDF()->set_option("enable_php",true);
        $pdf->setPaper('a4','landscape');
        return $pdf->stream();
    }
    public function convert($id)
    {
        $fac = DB::table('ligne_factures')->join('produits','ligne_factures.produit_id','=','produits.id')
        ->join('factures','ligne_factures.facture_id','=','factures.id')
        ->select('ligne_factures.*','produits.nom')->where('factures.id', '=', $id)->get();
        $facture = DB::table('factures')->join('cl_fous','factures.cl_fous_id','=','cl_fous.id')
        ->select('factures.*','cl_fous.société')->where('factures.id','=',$id)->get();
        $lboca = DB::table('ligne_factures')->join('produits','ligne_factures.produit_id','=','produits.id')
        ->join('factures','ligne_factures.facture_id','=','factures.id')
        ->select('ligne_factures.*','produits.nom')->where('factures.id', '=', $id)->sum(\DB::raw('ligne_factures.quantite * ligne_factures.prixht'));
        $A=0;
        
        foreach($facture as $client)
        {
        $ouput ='
        <div class="header">
        <img src="assets/images/DELTA.JPG"  width="180" height="80">
        <div class="header-right">
        <div style="float:right">
        
        </div>
        
        </div>
      </div>
      <table  width="100%" style="border-collapse:collapse;border=5px;" >
      <thead>
        <tr>
        <th style="border:1px solid ;padding=6px;width="100%"">Facture N  </th>
          <th style="border:1px solid ;padding=6px;width="100%"">Reference BC </th>
          <th style="border:1px solid ;padding=6px;width="100%"">Reference BL </th>
          <th style="border:1px solid ;padding=6px;width="100%""> Société </th>
          
          
         
        </tr>
      </thead>
      
      <tr>
      <td style="border:1px solid ;padding=6px;">'.$client->id .'</td>
      <td style="border:1px solid ;padding=6px;">'.$client->RBC .' </td>
      <td style="border:1px solid ;padding=6px;">'.$client->RBL .' </td>
      <td style="border:1px solid ;padding=6px;">'.$client->société .'</td>
      </tr>
      </table> <br></br>
      <br></br>
      <br></br>
        ';}
        $ouput .=' 
        <div>
        <h3 >      </h3>
        <h3 >        </h3>

        </div>
        <table  width="100%" style="border-collapse:collapse;border=5px;" >
    <thead>
      <tr>
      <th style="border:1px solid ;padding=6px;width="100%"">Numero de Ligne</th>
        <th style="border:1px solid ;padding=6px;width="100%"">Coté</th>
        <th style="border:1px solid ;padding=6px;width="100%"">Nom du Produit</th>
        <th style="border:1px solid ;padding=6px;width="100%"">Quantite</th>
        <th style="border:1px solid ;padding=6px;width="100%"">Prix Ht</th>
        <th style="border:1px solid ;padding=6px;width="100%"">Total HT</th>
       
      </tr>
    </thead>
        
        ';
       
        foreach($fac as $client)
        {
            $ouput .='
            <tr>
            <td style="border:1px solid ;padding=6px;">'.($A+=1 ).'</td>
      <td style="border:1px solid ;padding=6px;">'.$client->id .'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->nom.'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->quantite .'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->prixht .'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->quantite * $client->prixht.'</td>
      
      </tr>
            ';
        }
        $ouput .='  <tr>     
        <td  colspan=5  style="border:3px solid ;padding=6px;width="10%""><center>Total Montant Hors Taxes</center></td>
        <td   style="border:3px solid ;padding=6px;width="10%""><center>'.round($lboca , 2).'</center></td>
        
        </tr>
    ';
    $ouput .='        
      <tr>
        <td  colspan=5  style="border:3px solid ;padding=6px;width="100%""> <center>    Taux TVA 20%  </center>  </td>
        <td  style="border:3px solid ;padding=6px;width="100%""> <center> '.round($lboca * 0.2,2).'</center></td>
        
      </tr>
   
    ';
    $ouput .='        
    <tr>
      <td  colspan=5  style="border:3px solid ;padding=6px;width="100%""> <center>    Montant Total Toute Taxe Comprise (En DHS)  </center>  </td>
      <td  style="border:3px solid ;padding=6px;width="100%""> <center> '.round($lboca +($lboca * 0.2) , 2).'</center></td>
      
    </tr>
 
  ';
        $ouput .='</table>';
        return $ouput;
    }
    public function index()
    {
        $facture = DB::table('factures')->join('cl_fous','factures.cl_fous_id','=','cl_fous.id')
        ->select('factures.*','cl_fous.société')->get();
        $client= DB::table("cl_fous")->get();
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        $A=0;
        return view('facture_view',['factures'=>$facture ,'client'=>$client, 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3 , 'A'=>$A ]);
    }
    public function find($id)
    {
        $facture = DB::table('factures')->join('cl_fous','factures.cl_fous_id','=','cl_fous.id')
        ->select('factures.*','cl_fous.société')->get();
        $fac = DB::table('ligne_factures')->join('produits','ligne_factures.produit_id','=','produits.id')
        ->join('factures','ligne_factures.facture_id','=','factures.id')
        ->select('ligne_factures.*','produits.nom')->where('factures.id', '=', $id)->get();
        $lign=DB::select('select * from produits');
        $client= DB::table("cl_fous")->get();
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        $A=0;$B=0;
        return view('facture_acc',['factures'=>$facture ,'client'=>$client, 'lignefactures'=>$fac , 'produit'=>$lign , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3 , 'A'=>$A , 'B'=>$B ]);
    }

    public function insert(Request $request){
        $validator = Validator::make($request->all(), [
            
            'RBL' => 'bail|required|integer',
            'RBC' => 'bail|required|integer',
            'tva' => 'bail|required|integer',

        ]);
        $id = $request->input('id');
        $rbl = $request->input('RBL');
        $rbc = $request->input('RBC');
        $tva = $request->input('tva');
        $client = $request->input('cl_fous');
        if ($validator->fails()) {
            return redirect('/erreur');
        }
        else{
        $data=array( 'id'=>$id , 'RBL'=>$rbl , 'RBC'=>$rbc , 'tva'=>$tva , 'cl_fous_id'=>$client );
        DB::table('factures')->insert($data);
        /*echo"record inserted successfully.<br/>";
        echo ' list categories <a href="/categorie">click here </a> ';*/
        return back();
        }
    
    }
    public function insertt(Request $request){
        $validator = Validator::make($request->all(), [
            
            'quantite' => 'bail|required|integer',
            'prixht' => 'bail|required|integer',
        ]);
        $id = $request->input('id');
        $produit = $request->input('produit');
        $quantite = $request->input('quantite');
        $prixht = $request->input('prixht');
        $facture = $request->input('facture');
        if ($validator->fails()) {
            return redirect('/erreur');
        }
        else{
        $data=array( 'id'=>$id , 'produit_id'=>$produit , 'quantite'=>$quantite , 'prixht'=>$prixht,'facture_id'=>$facture );
        DB::table('ligne_factures')->insert($data);
        /*echo"record inserted successfully.<br/>";
        echo ' list clients <a href="/client_fournisseur">click here </a> ';*/
        return back();
        }
    
    }
    public function modifie($id)
    {
        
        $fact =  DB::table('factures')->join('cl_fous','factures.cl_fous_id','=','cl_fous.id')->where('factures.id', '=', $id)->get();
        $client=DB::table('cl_fous')->get();
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        
        return view('facture_modifier',['factures'=>$fact ,'client'=>$client, 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3  ]);

    }
    public function modifie2($id)
    {
        $devi = DB::table('ligne_factures')->join('produits','ligne_factures.produit_id','=','produits.id')
        
        ->select('ligne_factures.*','produits.nom')->where('ligne_factures.id', '=', $id)->get();
        $ligne=DB::select('select * from factures');
        $lign=DB::select('select * from produits');
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");

        return view('facture_acc_modifie',['lignefactures'=>$devi , 'factures'=>$ligne , 'produit'=>$lign  , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3]);
    }
    public function modifier($id , Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'RBL' => 'bail|required|numeric',
            'RBC' => 'bail|required|numeric',
            'tva' => 'bail|required|numeric',

        ]); 
        $rbl = $request->input('RBL');
        $rbc =$request->input('RBC');
        $tva = $request->input('tva');
       $client= $request->input('cl_fous');
       
        if ($validator->fails()) {
            return redirect('/erreur');
        }
        else{
        $affected = DB::table('factures')
              ->where('id', $id)
              ->update(['RBL' =>$rbl , 'RBC'=>$rbc , 'tva'=>$tva , 'cl_fous_id'=>$client   ]);
              return redirect('/facture');     }
    }
    public function modifier2($id , Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'quantite' => 'bail|required|integer',
            'prixht' => 'bail|required|integer',
        ]);
        $produit = $request->input('produit'); 
        $quantite = $request->input('quantite');
        $prixht = $request->input('prixht');
        $facture = $request->input('facture');
        
        if ($validator->fails()) {
            return redirect('/erreur');
        }
        else{
        $affected = DB::table('ligne_factures')
              ->where('id', $id)
              ->update(['produit_id' =>$produit , 'quantite'=>$quantite , 'prixht'=>$prixht , 'facture_id'=>$facture  ]);
              return redirect('/facture');      }
    }
    public function destroy($id)
    {
        $fact =  DB::table('factures')->where('id', '=', $id);
        $ca = $fact->first();
        $fact->delete();
    
        return back();
    }
    public function destroy2($id)
    {
        $fact =  DB::table('ligne_factures')->where('id', '=', $id);
        $de = $fact->first();
        $fact->delete();
    
        return back();
    }
}
