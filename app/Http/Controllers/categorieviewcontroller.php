<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use PDF;

class categorieviewcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat = DB::select('select * from categories');
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        $A=0;
          
        return view('categorie_view',['categories'=>$cat, 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3 , 'A'=>$A]);
        
    }
    

    

    public function insertform()
    {
        return view('categorie_view');
    }
    public function insert(Request $request){
        $validator = Validator::make($request->all(), [
            
            'libellé' => 'bail|required|string',
        ]);
        $id = $request->input('id');
        $libellé = $request->input('libellé');
        if ($validator->fails()) {
            return redirect('/erreur');
        }
        else{
        $data=array( 'id'=>$id , 'libellé'=>$libellé );
        DB::table('categories')->insert($data);
        /*echo"record inserted successfully.<br/>";
        echo ' list categories <a href="/categorie">click here </a> ';*/
        return back();
        }
    
    }

    
    public function destroy($id)
    {
        $cat =  DB::table('categories')->where('id', '=', $id);
        $ca = $cat->first();
        $cat->delete();
    
        return back();
    }
    
}
