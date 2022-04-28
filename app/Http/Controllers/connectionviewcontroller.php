<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class connectionviewcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $log = $request->input('log');
        $pass = $request->input('pass');
        $login=DB::table('connections')->where('Login','=',$log)
        ->where('Password','=',$pass)->first();
        if($login)
        {
            return redirect('/home');
        }
        else {
            return redirect('/erreurlogin');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request){
        
        $log = $request->input('log');
        $pass = $request->input('pass');
       
       
        
        $data=array( 'Login'=>$log , 'Password'=>$pass  );
        DB::table('connections')->insert($data);
        /*echo"record inserted successfully.<br/>";
        echo ' list categories <a href="/categorie">click here </a> ';*/
        return back();
        }
    public function destroy($id)
    {
        //
    }
}
