<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use DB;
class commandeviewcontroller extends Controller
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
        $lboc = DB::table('ligne_bon_commandes')->join('produits','ligne_bon_commandes.produit_id','=','produits.id')
        ->join('bon_commandes','ligne_bon_commandes.bon_commande_id','=','bon_commandes.id')
        ->select('ligne_bon_commandes.*','produits.nom')->where('bon_commandes.id', '=', $id)->get();
        $dev = DB::table('bon_commandes')->join('cl_fous','bon_commandes.cl_fous_id','=','cl_fous.id')
        ->select('bon_commandes.*','cl_fous.société')->where('bon_commandes.id', '=', $id)->get();
        $lboca = DB::table('ligne_bon_commandes')->join('produits','ligne_bon_commandes.produit_id','=','produits.id')
        ->join('bon_commandes','ligne_bon_commandes.bon_commande_id','=','bon_commandes.id')
        ->select('ligne_bon_commandes.*','produits.nom')->where('bon_commandes.id', '=', $id)->sum(\DB::raw('ligne_bon_commandes.quantite * ligne_bon_commandes.prixht'));
        $A=0;
        foreach($dev as $client)
        {
        $ouput ='
        <div class="header">
        <img src="assets/images/DELTA.JPG"  width="180" height="80">
        <div class="header-right">
        <div style="float:right">
        
        </div>
        
        </div>
        <table  width="100%" style="border-collapse:collapse;border=5px;" >
        <thead>
          <tr>
          <th style="border:1px solid ;padding=6px;width="100%"">Commande  N  </th>
            <th style="border:1px solid ;padding=6px;width="100%"">Date  </th>
            <th style="border:1px solid ;padding=6px;width="100%"">Société  </th>
            
            
            
           
          </tr>
        </thead>
        
        <tr>
        <td style="border:1px solid ;padding=6px;">'.$client->id .'</td>
        <td style="border:1px solid ;padding=6px;">'.$client->date .' </td>
        <td style="border:1px solid ;padding=6px;">'.$client->société .'</td>
        </tr>
        </table> <br></br>
        <br></br>
        <br></br>
      </div>
        ';}
        $ouput .=' 
       
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
       
        
            
                foreach($lboc as $client)
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
            <td   style="border:3px solid ;padding=6px;width="10%""><center>'.round($lboca).'</center></td>
            
            </tr>
        ';
        $ouput .='        
          <tr>
            <td  colspan=5  style="border:3px solid ;padding=6px;width="100%""> <center>    Taux TVA 20%  </center>  </td>
            <td  style="border:3px solid ;padding=6px;width="100%""> <center> '.round($lboca * 0.2 ,2).'</center></td>
            
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

    public function gen()
    {
        $dev = DB::table('bon_commandes')->join('cl_fous','bon_commandes.cl_fous_id','=','cl_fous.id')
        ->select('bon_commandes.*','cl_fous.société')->get();
        $client=DB::select('select * from cl_fous');
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        $A=0;
        return view('boc_general',['devis'=>$dev , 'client'=>$client , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3 , 'A'=>$A]);
    }
    public function index()
    {
        $dev = DB::table('bon_commandes')->join('cl_fous','bon_commandes.cl_fous_id','=','cl_fous.id')->where('type','=','fournisseur')
        ->select('bon_commandes.*','cl_fous.société')->get();
        $client=DB::table('cl_fous')->where('type','=','fournisseur')->get();
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        $A=0;
        return view('bon_commande_view',['devis'=>$dev , 'client'=>$client, 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3,'A'=>$A ]);
    }
    public function index2()
    {
        $A=0;
        $dev = DB::table('bon_commandes')->join('cl_fous','bon_commandes.cl_fous_id','=','cl_fous.id')->where('type','=','client')->orwhere('type','=','prospect')
        ->select('bon_commandes.*','cl_fous.société')->get();
        $client=DB::table('cl_fous')->where('type','=','client')->orwhere('type','=','prospect')->get();
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        $A=0;
        return view('bon_commandevente',['devis'=>$dev , 'client'=>$client, 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3 ,'A'=>$A ]);
    }
    public function find($id)
    {
       
        $boc = DB::table('bon_commandes')->join('cl_fous','bon_commandes.cl_fous_id','=','cl_fous.id')
        ->select('bon_commandes.*','cl_fous.société')->get();
        $client=DB::table('cl_fous')->where('type','=','fournisseur')->get();
        $lboc = DB::table('ligne_bon_commandes')->join('produits','ligne_bon_commandes.produit_id','=','produits.id')
        ->join('bon_commandes','ligne_bon_commandes.bon_commande_id','=','bon_commandes.id')
        ->select('ligne_bon_commandes.*','produits.nom')->where('bon_commandes.id', '=', $id)->get();
        $ligne=DB::select('select * from bon_commandes');
        $lign=DB::select('select * from produits');
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        $A=0;
        $B=0;
        return view('bon_commande_acc',['ligneboncommandes'=>$lboc , 'devis'=>$boc ,'client'=>$client , 'produit'=>$lign , 'boncommandes'=>$ligne, 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3 , 'A'=>$A , 'B'=>$B ]);
        
    }
    public function insert(Request $request){
        $validator = Validator::make($request->all(), [
            
            'devis' => 'bail|required|integer',
        ]);
 
        $id = $request->input('id');
        $cl_fous = $request->input('cl_fous');
        $devis = $request->input('devis');
        $date = date('Y-m-d' , strtotime($request->input('date')));
        $modepaiement = $request->input('modepaiement');
        $statut = $request->input('statut');
       
 
        if ($validator->fails()) {
            return redirect('/erreur');
        }
        else{
            $data=array( 'id'=>$id , 'cl_fous_id'=>$cl_fous ,'devis'=>$devis, 'date'=>$date , 'modepaiement'=>$modepaiement,'statut'=>$statut );
        DB::table('bon_commandes')->insert($data);
        return back();
        }
    }
        
        
        /*echo"record inserted successfully.<br/>";
        echo ' list clients <a href="/client_fournisseur">click here </a> ';*/
       
        
       
        
    
    
    public function insertt(Request $request){
        $validator = Validator::make($request->all(), [
            
            'quantite' => 'bail|required|integer',
            'prixht' => 'bail|required|integer',
        ]);
        $id = $request->input('id');
        $produit = $request->input('produit');
        $quantite = $request->input('quantite');
        $prixht = $request->input('prixht');
        $devis = $request->input('boc');
        if ($validator->fails()) {
            return redirect('/erreur');
        }
        else{
        $data=array( 'id'=>$id , 'produit_id'=>$produit , 'quantite'=>$quantite , 'prixht'=>$prixht,'bon_commande_id'=>$devis );
        DB::table('ligne_bon_commandes')->insert($data);
        /*echo"record inserted successfully.<br/>";
        echo ' list clients <a href="/client_fournisseur">click here </a> ';*/
        return back();
        }
    }
    public function modifie($id)
    {
        
        $dev = DB::table('bon_commandes')->join('cl_fous','bon_commandes.cl_fous_id','=','cl_fous.id')->where('bon_commandes.id' , '=' , $id)
        ->select('bon_commandes.*','cl_fous.société')->get();
        $client=DB::table('cl_fous')->get();
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        
        return view('bon_commande_modifier',['devis'=>$dev , 'client'=>$client, 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3]);

    }
    public function modifie2($id)
    {
        $devi = DB::table('ligne_bon_commandes')->join('produits','ligne_bon_commandes.produit_id','=','produits.id')
        
        ->select('ligne_bon_commandes.*','produits.nom')->where('ligne_bon_commandes.id', '=', $id)->get();
        $ligne=DB::select('select * from bon_commandes');
        $lign=DB::select('select * from produits');
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");

        return view('bon_commande_acc_modifie',['ligneboncommandes'=>$devi , 'boncommandes'=>$ligne , 'produit'=>$lign , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3]);
    }
    public function modifier($id , Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'devis' => 'bail|required|integer',
        ]);
        $société = $request->input('cl_fous');
        $devis = $request->input('devis');
        $date =date('Y-m-d' , strtotime($request->input('date')));  
        $modepaiement = $request->input('modepaiement');
        $statut = $request->input('statut');
        if ($validator->fails()) {
            return redirect('/erreur');
        }
        else{

        $affected = DB::table('bon_commandes')
              ->where('id', $id)
              ->update(['cl_fous_id' =>$société ,'devis'=>$devis , 'date'=>$date , 'modepaiement'=>$modepaiement ,  'statut'=>$statut ]);
              return redirect('/bon_commande');     }
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
        $boc = $request->input('boc');
        if ($validator->fails()) {
            return redirect('/erreur');
        }
        else{

        $affected = DB::table('ligne_bon_commandes')
              ->where('id', $id)
              ->update(['produit_id' =>$produit , 'quantite'=>$quantite , 'prixht'=>$prixht , 'bon_commande_id'=>$boc  ]);
               return redirect('/bon_commande');;      
        }
    }
    public function destroy($id)
    {
        $bon =  DB::table('bon_commandes')->where('id', '=', $id);
        $bo = $bon->first();
        $bon->delete();
    
        return back();
    }
    public function destroy2($id)
    {
        $lboc =  DB::table('ligne_bon_commandes')->where('id', '=', $id);
        $de = $lboc->first();
        $lboc->delete();
    
        return back();
    }
}
