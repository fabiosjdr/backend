<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;
use Fabio\Bibliotecas\SearchEngine\SearchEngine;

class EstadoController extends Controller
{


    public function __construct(){
        $this->middleware('auth:api', ['except' => ['index']]);
    }  

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $SearchEngine = new SearchEngine(new Estado());
        
        if (!empty($request->query())) {
            
            try {

                //$SearchEngine->setAlias('CA');
               // $SearchEngine->setJoin('CADASTRO_GERAL as CG', 'CG.INT_CAD', '=', 'CA.INT_CAD');
                $SearchEngine->build( $request->query() ); 
              
                return $SearchEngine->run();
                //$rawSql = $SearchEngine->getSql();
               
               
            } catch (\Throwable $th) {
                throw $th;
            }
            
        }else{

            return Estado::get();
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
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function show(Estado $estado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit(Estado $estado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estado $estado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estado $estado)
    {
        //
    }
}
