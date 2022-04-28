<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class produitviewcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf()
    {
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert());
        $pdf->getDOMPDF()->set_option("enable_php",true);
        $pdf->setPaper('a4','landscape');
        return $pdf->stream();
    }
    public function convert()
    {
        $pro = DB::table('produits')->join('categories','produits.categorie_id','=','categories.id')
        ->select('produits.*','categories.libellé')->get();
        $A=0;
        $ouput=' 
        <div class="header">
        <img src="assets/images/DELTA.JPG"  width="180" height="80">
        <div class="header-right">
        <div style="float:right">
        
        </div>
        
        </div>
      </div>
        <h3 align="center" style="color : #00bfff;"> Liste des Produits  </h3>
        <table  width="100%" style="border-collapse:collapse;border=5px;" >
    <thead>
      <tr>
      <th style="border:1px solid ;padding=6px;width="100%">Numero de Ligne</th>
        <th style="border:1px solid ;padding=6px;width="100%">Coté</th>
        <th style="border:1px solid ;padding=6px;width="100%">Nom du Produit</th>
        <th style="border:1px solid ;padding=6px;width="100%">Categorie</th>
        <th style="border:1px solid ;padding=6px;width="100%">Description</th>
       
      </tr>
    </thead>
        
        ';
        foreach($pro as $client)
        {
            $ouput .='
            <tr>
            <td style="border:1px solid ;padding=6px;">'.($A+=1 ).'</td>
      <td style="border:1px solid ;padding=6px;">'.$client->id .'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->nom.'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->libellé .'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->description .'</td>
      
      </tr>
            ';
        }
        $ouput .='</table>';
        return $ouput;
    }
    public function index()
    {
        
        $pro = DB::table('produits')->join('categories','produits.categorie_id','=','categories.id')
        ->select('produits.*','categories.libellé')->get();
       $count= DB::table("cl_fous")->get()->count("id");
       $count2= DB::table("categories")->get()->count("id");
       $count3= DB::table("produits")->get()->count("id");
        $cat = DB::select('select distinct * from categories');
        $A=0;
        return view('produit_view',['produits'=>$pro , 'categories'=>$cat , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3 , 'A'=>$A]);
    }
    public function indexx($id)
    {
        $pro = DB::table('produits')->join('categories','produits.categorie_id','=','categories.id')
        ->where('produits.categorie_id',$id)
        ->select('produits.*','categories.libellé')->get();
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        $A=0;
        return view('produit_view2',['produits'=>$pro , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3 , 'A'=>$A ]);
    }

    public function insertform()
    {
        
        $cat = DB::select('select * from categories');
        return view('produit_create',['categories'=>$cat]);
        
    }
    public function insert(Request $request){
        $id = $request->input('id');
        $nom = $request->input('nom');
        $famille = $request->input('famille');
        $description = $request->input('description');
       
        $data=array( 'id'=>$id , 'nom'=>$nom ,'categorie_id'=>$famille,'description'=>$description);
        DB::table('produits')->insert($data);
       
        return back();
    
    }


    
    public function destroy($id)
    {
        $pro =  DB::table('produits')->where('id', '=', $id);
        $prod = $pro->first();
        $pro->delete();
        return back();
    }
    public function modifie($id)
    {
        $pro = DB::table('produits')->join('categories','produits.categorie_id','=','categories.id')
        ->where('produits.id',$id)
        ->select('produits.*','categories.libellé')->get();
        $cat=DB::select('select distinct * from categories');
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        return view('produit_modifie',['produits'=>$pro , 'categories'=>$cat , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3 ]);
        
    }
    public function modifier($id , Request $request)
    {
        $nom = $request->input('nom');
        $famille = $request->input('famille');
        $description = $request->input('description');
        $affected = DB::table('produits')
              ->where('id', $id)
              ->update(['nom' =>$nom , 'description'=>$description]);
              return redirect('/produit');       
    }
    public function rechercher(Request $request)
    {
        $rech=$request->input('rechercher');
        $pro = DB::table('produits')->join('categories','produits.categorie_id','=','categories.id')
        ->where('produits.id',$rech)
        ->orwhere('categories.libellé',$rech)
        ->orwhere('produits.nom','like','%'.$rech.'%')
        ->select('produits.*','categories.libellé')
        ->get();
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        $A=0;
        return view('rech_produit',['produits'=>$pro , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3 , 'A'=>$A]);
    }
}
