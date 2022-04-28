<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use PDF;

class cl_fouviewcontroller extends Controller
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
        $cli = DB::select('select * from cl_fous');
        $A=0;
        $ouput='
        <div class="header">
        <img src="assets/images/DELTA.JPG"  width="180" height="80">
        <div class="header-right">
        <div style="float:right">
        
        </div>
        
        </div>
      </div>
        
        <h3 align="center"> Liste des Clients et Fournisseurs  </h3>
        
        <table  width="100%" style="border-collapse:collapse;border=5px;" >
    <thead>
      <tr>
      <th style="border:1px solid ;padding=6px;width="100%"">Numero de Ligne</th>
        <th style="border:1px solid ;padding=6px;width="100%">Coté</th>
        <th style="border:1px solid ;padding=6px;width="100%">Société</th>
        <th style="border:1px solid ;padding=6px;width="100%">Email</th>
        <th style="border:1px solid ;padding=6px;width="100%">Tel</th>
        <th style="border:1px solid ;padding=6px;width="100%">ICE</th>
        <th style="border:1px solid ;padding=6px;width="100%">Adresse</th>
        <th style="border:1px solid ;padding=6px;width="100%">Type</th>
      </tr>
    </thead>
        
        ';
        foreach($cli as $client)
        {
            $ouput .='
            <tr>
            <td style="border:1px solid ;padding=6px;">'.($A+=1 ).'</td>
      <td style="border:1px solid ;padding=6px;">'.$client->id .'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->société.'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->email .'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->Tel .'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->ice.'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->adresse.'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->type.'</td>
      </tr>
            ';
        }
        $ouput .='</table>';
        return $ouput;
    }
    public function pdf2()
    {
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert2());
        $pdf->getDOMPDF()->set_option("enable_php",true);
        $pdf->setPaper('a4','landscape');
        return $pdf->stream();
    }
    public function convert2()
    {
        $cli = DB::table('cl_fous')->where('type','=','client')->get();
        $A=0;
        $ouput=' 
        <div class="header">
        <img src="assets/images/DELTA.JPG"  width="180" height="80">
        <div class="header-right">
        <div style="float:right">
        
        </div>
        
        </div>
      </div>
        
        <h3 align="center"style="color : #00bfff;"> Liste des Clients   </h3>
        <table  width="100%" style="border-collapse:collapse;border=5px;" >
    <thead>
      <tr>
      <th style="border:1px solid ;padding=6px;width="100%">Numero de Ligne</th>
        <th style="border:1px solid ;padding=6px;width="100%">Coté</th>
        <th style="border:1px solid ;padding=6px;width="100%">Société</th>
        <th style="border:1px solid ;padding=6px;width="100%">Email</th>
        <th style="border:1px solid ;padding=6px;width="100%">Tel</th>
        <th style="border:1px solid ;padding=6px;width="100%">ICE</th>
        <th style="border:1px solid ;padding=6px;width="100%">Adresse</th>
        <th style="border:1px solid ;padding=6px;width="100%">Type</th>
      </tr>
    </thead>
        
        ';
        foreach($cli as $client)
        {
            $ouput .='
            <tr>
            <td style="border:1px solid ;padding=6px;">'.($A+=1 ).'</td>
      <td style="border:1px solid ;padding=6px;">'.$client->id .'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->société.'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->email .'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->Tel .'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->ice.'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->adresse.'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->type.'</td>
      </tr>
            ';
        }
        $ouput .='</table>';
        return $ouput;
    }
    public function pdf3()
    {
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert3());
        $pdf->getDOMPDF()->set_option("enable_php",true);
        $pdf->setPaper('a4','landscape');
        return $pdf->stream();
    }
    public function convert3()
    {
        $cli = DB::table('cl_fous')->where('type','=','fournisseur')->get();
        $A=0;
        $ouput='
        <div class="header">
        <img src="assets/images/DELTA.JPG"  width="180" height="80">
        <div class="header-right">
        <div style="float:right">
        
        </div>
        
        </div>
      </div>
        
        <h3 align="center"> Liste des Fournisseurs   </h3>
        <table  width="100%" style="border-collapse:collapse;border=5px;" >
    <thead>
      <tr>
      <th style="border:1px solid ;padding=6px;width="100%">Numero de Ligne</th>
        <th style="border:1px solid ;padding=6px;width="100%">Coté</th>
        <th style="border:1px solid ;padding=6px;width="100%">Société</th>
        <th style="border:1px solid ;padding=6px;width="100%">Email</th>
        <th style="border:1px solid ;padding=6px;width="100%">Tel</th>
        <th style="border:1px solid ;padding=6px;width="100%">ICE</th>
        <th style="border:1px solid ;padding=6px;width="100%">Adresse</th>
        <th style="border:1px solid ;padding=6px;width="100%">Type</th>
      </tr>
    </thead>
        
        ';
        foreach($cli as $client)
        {
            $ouput .='
            <tr>
            <td style="border:1px solid ;padding=6px;">'.($A+=1 ).'</td>
      <td style="border:1px solid ;padding=6px;">'.$client->id .'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->société.'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->email .'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->Tel .'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->ice.'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->adresse.'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->type.'</td>
      </tr>
            ';
        }
        $ouput .='</table>';
        return $ouput;
    }
    public function pdf4()
    {
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert4());
        $pdf->getDOMPDF()->set_option("enable_php",true);
        $pdf->setPaper('a4','landscape');
        return $pdf->stream();
    }
    public function convert4()
    {
        $cli = DB::table('cl_fous')->where('type','=','prospect')->get();
        $A=0;
        $ouput='
        <div class="header">
        <img src="assets/images/DELTA.JPG"  width="180" height="80">
        <div class="header-right">
        <div style="float:right">
        
        </div>
        
        </div>
      </div>
        
        <h3 align="center"> Liste des Prospects   </h3>
        <table  width="100%" style="border-collapse:collapse;border=5px;" >
    <thead>
      <tr>
      <th style="border:1px solid ;padding=6px;width="100%">Numero de Ligne</th>
        <th style="border:1px solid ;padding=6px;width="100%">Coté</th>
        <th style="border:1px solid ;padding=6px;width="100%">Société</th>
        <th style="border:1px solid ;padding=6px;width="100%">Email</th>
        <th style="border:1px solid ;padding=6px;width="100%">Tel</th>
        <th style="border:1px solid ;padding=6px;width="100%">ICE</th>
        <th style="border:1px solid ;padding=6px;width="100%">Adresse</th>
        <th style="border:1px solid ;padding=6px;width="100%">Type</th>
      </tr>
    </thead>
        
        ';
        foreach($cli as $client)
        {
            $ouput .='
            <tr>
            <td style="border:1px solid ;padding=6px;">'.($A+=1 ).'</td>
      <td style="border:1px solid ;padding=6px;">'.$client->id .'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->société.'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->email .'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->Tel .'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->ice.'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->adresse.'</td>
      <td style="border:1px solid ;padding=6px;">'. $client->type.'</td>
      </tr>
            ';
        }
        $ouput .='</table>';
        return $ouput;
    }
    public function index(Request $request)
    {
        
        $cli = DB::select('select * from cl_fous');
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        $A=0;
        
        
        
        return view('cl_fou_view',['cl_fous'=>$cli, 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3,'A'=>$A ]);
    }
    public function client(Request $request)
    {
        
        $cli = DB::table('cl_fous')->where('type','=','client')->get();
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        $A=0;
        
        
        
        
        return view('client',['cl_fous'=>$cli, 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3,'A'=>$A ]);
    }
    public function fournisseur(Request $request)
    {
        
        $cli = DB::table('cl_fous')->where('type','=','fournisseur')->get();
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        $A=0;
        
        
        return view('fournisseur',['cl_fous'=>$cli , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3,'A'=>$A]);
    }
    public function prospect(Request $request)
    {
        
        $cli = DB::table('cl_fous')->where('type','=','prospect')->get();
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        $A=0;
        
        
        return view('prospect',['cl_fous'=>$cli , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3,'A'=>$A ]);
    }
    public function insertform()
    {
        return view('cl_fou_create');
    }

    public function insert(Request $request){
        $validator = Validator::make($request->all(), [
            
            'société' => 'bail|required|alpha_num',
            'email' => 'bail|required|email',
            'Tel' => 'bail|required|numeric',
            'ice' => 'bail|required|alpha_num',
        ]);
        
        $id = $request->input('id');
        $société = $request->input('société');
        $email = $request->input('email');
        $tel = $request->input('Tel');
        $ice = $request->input('ice');
        $adresse = $request->input('adresse');
        $type = $request->input('type');
        if ($validator->fails()) {
            return redirect('/erreur');
        }
        else{
        $data=array( 'id'=>$id , 'société'=>$société , 'email'=>$email , 'Tel'=>$tel,'ice'=>$ice,'adresse'=>$adresse,'type'=>$type );
        DB::table('cl_fous')->insert($data);
        /*echo"record inserted successfully.<br/>";
        echo ' list clients <a href="/client_fournisseur">click here </a> ';*/
        return back();
        }
        
    
    }
   
    public function destroy($id)
    {
        $client =  DB::table('cl_fous')->where('id', '=', $id);
    $cl = $client->first();
    $client->delete();

    return back();
    }
    public function modifie($id)
    {
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        $client = DB::table('cl_fous')->where('id','=',$id)->get();
        
        
        return view('cl_fou_modifier',['cli_fous'=>$client , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3]);

    }
    public function modifier($id , Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'société' => 'bail|required|alpha_num',
            'email' => 'bail|required|email',
            'Tel' => 'bail|required|numeric',
            'ice' => 'bail|required|alpha_num',
        ]);
        $société = $request->input('société');
        $email = $request->input('email');
        $tel = $request->input('Tel');
        $ice = $request->input('ice');
        $adresse = $request->input('adresse');
        $type = $request->input('type');
        if ($validator->fails()) {
            return redirect('/erreur');
        }
        else{
        $affected = DB::table('cl_fous')
              ->where('id', $id)
              ->update(['société' =>$société , 'email'=>$email , 'Tel'=>$tel , 'ice'=>$ice , 'adresse'=>$adresse , 'type'=>$type]);
              return redirect('/client_fournisseur');} 
    }
    public function rechercher(Request $request)
    {
        $rech=$request->input('rechercher');
        $pro = DB::table('cl_fous')
        ->where('id',$rech)
        ->orwhere('société','like','%'.$rech.'%')
        ->orwhere('email','like','%'.$rech.'%')
        ->orwhere('Tel',$rech)
        ->orwhere('ice',$rech)
        ->orwhere('adresse','like','%'.$rech.'%')
        ->orwhere('type',$rech)
        ->get();
        $count= DB::table("cl_fous")->get()->count("id");
        $count2= DB::table("categories")->get()->count("id");
        $count3= DB::table("produits")->get()->count("id");
        return view('rech_client',['cli_fous'=>$pro , 'count'=>$count , 'count2'=>$count2 , 'count3'=>$count3]);
    }
}
