<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class devisviewcontroller extends Controller
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
        $devi = DB::table('ligne_devis')->join('produits','ligne_devis.produit_id','=','produits.id')
        ->join('devis','ligne_devis.devis_id','=','devis.id')
        ->select('produits.nom','devis.*','ligne_devis.*')->where('devis.id', '=', $id)->get();
        $devis = DB::table('devis')->join('cl_fous','devis.cl_fous_id','=','cl_fous.id')
        ->select('devis.*','cl_fous.société')->where('devis.id', '=', $id)->get();
        $lboca = DB::table('ligne_devis')->join('produits','ligne_devis.produit_id','=','produits.id')
        ->join('devis','ligne_devis.devis_id','=','devis.id')
        ->select('produits.nom','devis.*','ligne_devis.*')->where('devis.id', '=', $id)->sum(\DB::raw('ligne_devis.quantite * ligne_devis.prixht'));
        $A=0;
       
        foreach($devis as $client)
        {
        $ouput ='
        <div class="header">
        <img src="assets/images/DELTA.JPG"  width="180" height="80">
        <div class="header-right">
        <div style="float:right">
        
        </div>
        
        </div>
      </div>
        <h3 align="center"style="color : #00bfff;"> Liste de ligne de Devis Numero '.$client->id .'  </h3>
        <h3 align="left"> DATE : '.$client->date .'  </h3>
        <h3 align="right"> Client : '.$client->société .'  </h3>';}
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
       
        foreach($devi as $client)
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
            <td   style="border:3px solid ;padding=6px;width="10%""><center>'.round($lboca ,2).'</center></td>
            
            </tr>
        ';
        $ouput .='        
          <tr>
            <td  colspan=5  style="border:3px solid ;padding=6px;width="100%""> <center>    Taux TVA 20%  </center>  </td>
            <td  style="border:3px solid ;padding=6px;width="100%""> <center> '.round($lboca * 1.2 , 2).'</center></td>
            
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
        
        $dev = DB::table('devis')->join('cl_fous','devis.cl_fous_id','=','cl_fous.id')
        ->select('devis.*','cl_fous.société')->get();
        $client=DB::select('select * from cl_fous');
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        $A=0;
        return view('devisgen_view',['devis'=>$dev , 'client'=>$client , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3 , 'A'=>$A]);
        
    }
    public function index()
    {
        
        $dev = DB::table('devis')->join('cl_fous','devis.cl_fous_id','=','cl_fous.id')->where('cl_fous.type','=','fournisseur')
        ->select('devis.*','cl_fous.société')->get();
        $client=DB::table('cl_fous')->where('type','=','fournisseur')->get();
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        $A=0;
        return view('devis_view',['devis'=>$dev , 'client'=>$client, 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3 , 'A'=>$A ]);
        
    }
    public function index2()
    {
        
        $dev = DB::table('devis')->join('cl_fous','devis.cl_fous_id','=','cl_fous.id')->where('cl_fous.type','=','client')->orwhere('cl_fous.type','=','prospect')
        ->select('devis.*','cl_fous.société')->get();
        $client=DB::table('cl_fous')->where('type','=','client')->orwhere('type','=','prospect')->get();
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        $A=0;
        return view('devisvente_view',['devis'=>$dev , 'client'=>$client , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3 , 'A'=>$A]);
        
    }
    public function find($id)
    {
        $dev = DB::table('devis')->join('cl_fous','devis.cl_fous_id','=','cl_fous.id')
        ->select('devis.*','cl_fous.société')->get();
        $client=DB::select('select * from cl_fous');
        $devi = DB::table('ligne_devis')->join('produits','ligne_devis.produit_id','=','produits.id')
        ->join('devis','ligne_devis.devis_id','=','devis.id')
        ->select('ligne_devis.*','produits.nom')->where('devis.id', '=', $id)->get();
        $ligne=DB::select('select * from devis');
        $lign=DB::select('select * from produits');
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
      $A=0;$B=0;
        return view('devis_acc',['marc'=>$devi , 'devis'=>$dev ,'client'=>$client , 'produit'=>$lign , 'devi'=>$ligne , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3 , 'A'=>$A , 'B'=>$B ]);
        
    }

    public function insert(Request $request){
        
        $id = $request->input('id');
        $cl_fous = $request->input('cl_fous');
        $date = date('Y-m-d' , strtotime($request->input('date')));
        $modepaiement = $request->input('modepaiement');
        $solution = $request->input('solution');
        $statut = $request->input('statut');
       
        $data=array( 'id'=>$id , 'cl_fous_id'=>$cl_fous , 'date'=>$date , 'modepaiement'=>$modepaiement,'solution'=>$solution,'statut'=>$statut );
        DB::table('devis')->insert($data);
        /*echo"record inserted successfully.<br/>";
        echo ' list clients <a href="/client_fournisseur">click here </a> ';*/
        return back();
    
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
        $devis = $request->input('devis');
        if ($validator->fails()) {
            return redirect('/erreur');
        }
        else{
        $data=array( 'id'=>$id , 'produit_id'=>$produit , 'quantite'=>$quantite , 'prixht'=>$prixht,'devis_id'=>$devis );
        DB::table('ligne_devis')->insert($data);
        /*echo"record inserted successfully.<br/>";
        echo ' list clients <a href="/client_fournisseur">click here </a> ';*/
        return back();
        }
    
    }
    
    public function destroy($id)
    {
        $dev =  DB::table('devis')->where('id', '=', $id);
        $de = $dev->first();
        $dev->delete();
    
        return redirect('/devis')->with('form_message', 'categorie supprimer avec succèss');
    }
    public function destroy2($id)
    {
        $dev =  DB::table('ligne_devis')->where('id', '=', $id);
        $de = $dev->first();
        $dev->delete();
    
        return back();
    }
    public function modifie($id)
    {
        
        $dev = DB::table('devis')->join('cl_fous','devis.cl_fous_id','=','cl_fous.id')->where('devis.id' , '=' , $id)
        ->select('devis.*','cl_fous.société')->get();
        $client = DB::select('select * from cl_fous');
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        
        
        return view('devis_modifier',['devis'=>$dev , 'client'=>$client  , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3]);

    }
    public function modifie2($id)
    {
        $devi = DB::table('ligne_devis')->join('produits','ligne_devis.produit_id','=','produits.id')
        
        ->select('ligne_devis.*','produits.nom')->where('ligne_devis.id', '=', $id)->get();
        $ligne=DB::select('select * from devis');
        $lign=DB::select('select * from produits');
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        return view('devis_acc_modifie',['lignedevis'=>$devi , 'devis'=>$ligne , 'produit'=>$lign  , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3]);
    }
    public function modifier($id , Request $request)
    {
        
        $société = $request->input('cl_fous');
        $date =date('Y-m-d' , strtotime($request->input('date')));  
        $modepaiement = $request->input('modepaiement');
        $solution = $request->input('solution');
        $statut = $request->input('statut');
        

        $affected = DB::table('devis')
              ->where('id', $id)
              ->update(['cl_fous_id' =>$société , 'date'=>$date , 'modepaiement'=>$modepaiement , 'solution'=>$solution , 'statut'=>$statut ]);
              return redirect('/devis');
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
        $devis = $request->input('devis');
        if ($validator->fails()) {
            return redirect('/erreur');
        }
        else{
        

        $affected = DB::table('ligne_devis')
              ->where('id', $id)
              ->update(['produit_id' =>$produit , 'quantite'=>$quantite , 'prixht'=>$prixht , 'devis_id'=>$devis  ]);
              return redirect('/devis');     
        }
    }
}
