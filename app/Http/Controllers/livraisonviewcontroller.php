<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class livraisonviewcontroller extends Controller
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
        $lbol = DB::table('ligne_livraisons')->join('produits','ligne_livraisons.produit_id','=','produits.id')
        ->join('bon_livraisons','ligne_livraisons.bon_livraison_id','=','bon_livraisons.id')
        ->select('ligne_livraisons.*','produits.nom')->where('bon_livraisons.id', '=', $id)->get();
        $livr = DB::table('bon_livraisons')->join('cl_fous','bon_livraisons.cl_fous_id','=','cl_fous.id')
        ->select('bon_livraisons.*','cl_fous.société')->where('bon_livraisons.id', '=', $id)->get();
        $lboli = DB::table('ligne_livraisons')->join('produits','ligne_livraisons.produit_id','=','produits.id')
        ->join('bon_livraisons','ligne_livraisons.bon_livraison_id','=','bon_livraisons.id')
        ->select('ligne_livraisons.*','produits.nom')->where('bon_livraisons.id', '=', $id)->count('ligne_livraisons.id');
       $A=0;
       
        foreach($livr as $client)
        {
        $output='
        
       
        <div class="header">
        <img src="assets/images/DELTA.JPG"  width="180" height="80">
        <div class="header-right">
        <div style="float:right">
        
        </div>
        
        </div>
      </div>
      <div >
        <table  width="100%" style="border-collapse:collapse;border=5px;" >
      <th style="border:1px solid ;padding=6px;width="100%"">'.$client->société.' </th>
      </table>
      <br></br>
      <br></br>
      <br></br>
      </div>
      
      <div>
      
      </div>
      
      <table  width="100%" style="border-collapse:collapse;border=5px;" >
      <thead>
        <tr>
        <th style="border:1px solid ;padding=6px;width="100%"">Date </th>
          <th style="border:1px solid ;padding=6px;width="100%"">Reference BC </th>
          <th style="border:1px solid ;padding=6px;width="100%"">Reference BL </th>
          
          
         
        </tr>
      </thead>
      
      <tr>
      <td style="border:1px solid ;padding=6px;">'.$client->date .'</td>
      <td style="border:1px solid ;padding=6px;">'.$client->rbc .' </td>
      <td style="border:1px solid ;padding=6px;">'.$client->id .' </td>
      </tr>
      </table>
      <br></br>
      <br></br>
      <br></br>
        
        <h3 align="left">   </h3>
        <h3 align="left">   </h3>
        <h3 align="right">  </h3>
        <h3 align="right">   </h3>';}
        $output .=' 
        <table  width="100%" style="border-collapse:collapse;border=5px;" >
    <thead>
      <tr>
      <th style="border:1px solid ;padding=6px;width="100%"">Numero de Ligne</th>
        <th style="border:1px solid ;padding=6px;width="100%"">Coté</th>
        <th style="border:1px solid ;padding=6px;width="100%"">Nom du Produit</th>
        <th style="border:1px solid ;padding=6px;width="100%"">Quantite</th>
        
       
      </tr>
    </thead>
        
        ';
        
       
        
              
       
              
        foreach($lbol as $client)
        {

            
            $output .='
            
            
            <tr>
            
      <td style="border:1px solid ;padding=6px;">'.($A+=1 ).'</td>
      <td style="border:1px solid ;padding=6px;">'.$client->id .'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->nom.'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->quantite .'</td>
      
      
      </tr>
            ';
        }
        $output .='</table>';
        
        return $output;
    }
    public function index()
    {
        $livr = DB::table('bon_livraisons')->join('cl_fous','bon_livraisons.cl_fous_id','=','cl_fous.id')
        ->select('bon_livraisons.*','cl_fous.société')->get();
        $client=DB::select('select * from cl_fous');
        $facture=DB::select('select * from factures');
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        $A=0;
        return view('bon_livraison_view',['livraisons'=>$livr , 'client'=>$client , 'factures'=>$facture , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3 ,'A'=>$A]);
    }
    public function index2()
    {
        $livr = DB::table('bon_livraisons')->join('cl_fous','bon_livraisons.cl_fous_id','=','cl_fous.id')
        ->select('bon_livraisons.*','cl_fous.société')->where('type','=','fournisseur')->get();
        $client=DB::table('cl_fous')->where('type','=','fournisseur')->get();
        $facture=DB::select('select * from factures');
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        $A=0;
        return view('bon_livraison_achats',['livraisons'=>$livr , 'client'=>$client , 'factures'=>$facture , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3 ,'A'=>$A]);
    }
    public function index3()
    {
        $livr = DB::table('bon_livraisons')->join('cl_fous','bon_livraisons.cl_fous_id','=','cl_fous.id')
        ->select('bon_livraisons.*','cl_fous.société')->where('type','=','client')->orwhere('type','=','prospect')->get();
        $client=DB::table('cl_fous')->where('type','=','client')->orwhere('type','=','prospect')->get();
        $facture=DB::select('select * from factures');
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        $A=0;
        return view('bon_livraison_ventes',['livraisons'=>$livr , 'client'=>$client , 'factures'=>$facture, 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3 ,'A'=>$A ]);
    }
    public function find($id)
    {
       
        $livr = DB::table('bon_livraisons')->join('cl_fous','bon_livraisons.cl_fous_id','=','cl_fous.id')
        ->select('bon_livraisons.*','cl_fous.société')->get();
        $client=DB::table('cl_fous')->where('type','=','client')->get();
        $facture=DB::select('select * from factures');
        $lbol = DB::table('ligne_livraisons')->join('produits','ligne_livraisons.produit_id','=','produits.id')
        ->join('bon_livraisons','ligne_livraisons.bon_livraison_id','=','bon_livraisons.id')
        ->select('ligne_livraisons.*','produits.nom')->where('bon_livraisons.id', '=', $id)->get();
        $ligne=DB::select('select * from bon_livraisons');
        $lign=DB::select('select * from produits');
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
      $A=0;$B=0;
        return view('bon_livraison_acc',['lignebonlivraisons'=>$lbol , 'factures'=>$facture,'livraisons'=>$livr, 'client'=>$client , 'produit'=>$lign , 'bonlivraisons'=>$ligne , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3 , 'A'=>$A , 'B'=>$B]);
        
    }
    public function insert(Request $request){
        $validator = Validator::make($request->all(), [
            
            'rbc' => 'bail|required|numeric',
        ]);
 
        $id = $request->input('id');
        $facture = $request->input('facture');
        $rbc = $request->input('rbc');
        $date = date('Y-m-d' , strtotime($request->input('date')));
        $client = $request->input('cl_fous');
        
       
 
        if ($validator->fails()) {
            return redirect('/erreur');
        }
        else{
            $data=array( 'id'=>$id , 'facture_id'=>$facture ,'rbc'=>$rbc, 'date'=>$date , 'cl_fous_id'=>$client );
        DB::table('bon_livraisons')->insert($data);
        return back();
        }
    }
    public function insertt(Request $request){
        $validator = Validator::make($request->all(), [
            
            'quantite' => 'bail|required|numeric',
            
        ]);
        $id = $request->input('id');
        $produit = $request->input('produit');
        $quantite = $request->input('quantite');
        $bol = $request->input('bol');
        if ($validator->fails()) {
            return redirect('/erreur');
        }
        else{
        $data=array( 'id'=>$id , 'produit_id'=>$produit , 'quantite'=>$quantite , 'bon_livraison_id'=>$bol );
        DB::table('ligne_livraisons')->insert($data);
        /*echo"record inserted successfully.<br/>";
        echo ' list clients <a href="/client_fournisseur">click here </a> ';*/
        return back();
        }
    }
    public function destroy($id)
    {
        $livr =  DB::table('bon_livraisons')->where('id', '=', $id);
        $ca = $livr->first();
        $livr->delete();
    
        return back();
    }
    public function destroy2($id)
    {
        $lboc =  DB::table('ligne_livraisons')->where('id', '=', $id);
        $de = $lboc->first();
        $lboc->delete();
    
        return back();
    }
    public function modifie($id)
    {
        
        
        $livr = DB::table('bon_livraisons')->join('cl_fous','bon_livraisons.cl_fous_id','=','cl_fous.id')->where('bon_livraisons.id' , '=' , $id)
        ->select('bon_livraisons.*','cl_fous.société')->get();
        $client=DB::table('cl_fous')->get();
        $facture=DB::select('select * from factures');
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        return view('bon_livraison_modifier',['livraisons'=>$livr , 'client'=>$client , 'factures'=>$facture , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3 ]);
        
        

    }
    public function modifie2($id)
    {
        $devi = DB::table('ligne_livraisons')->join('produits','ligne_livraisons.produit_id','=','produits.id')
        
        ->select('ligne_livraisons.*','produits.nom')->where('ligne_livraisons.id', '=', $id)->get();
        $ligne=DB::select('select * from bon_livraisons');
        $lign=DB::select('select * from produits');
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");

        return view('bon_livraison_acc_modifie',['lignelivraisons'=>$devi , 'bonlivraisons'=>$ligne , 'produit'=>$lign  , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3]);
    }
    public function modifier($id , Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'rbc' => 'bail|required|numeric',
        ]);
       
        $facture = $request->input('facture');
        $rbc = $request->input('rbc');
        $date = date('Y-m-d' , strtotime($request->input('date')));
        $client = $request->input('cl_fous');
        if ($validator->fails()) {
            return redirect('/erreur');
        }
        else{
        $affected = DB::table('bon_livraisons')
              ->where('id', $id)
              ->update(['facture_id' =>$facture , 'rbc'=>$rbc , 'date'=>$date , 'cl_fous_id'=>$client]);
              return redirect('/bon_livraison');      }

    }
    public function modifier2($id , Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'quantite' => 'bail|required|numeric',
            
        ]);
        $produit = $request->input('produit'); 
        $quantite = $request->input('quantite');
        $bol = $request->input('bol');
        if ($validator->fails()) {
            return redirect('/erreur');
        }
        else{

        $affected = DB::table('ligne_livraisons')
              ->where('id', $id)
              ->update(['produit_id' =>$produit , 'quantite'=>$quantite , 'bon_livraison_id'=>$bol  ]);
              return redirect('/bon_livraison');      
        }
    }

}
