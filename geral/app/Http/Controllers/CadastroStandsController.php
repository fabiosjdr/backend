<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastroStoreStandsRequest;
use App\Http\Requests\CadastroUpdateStandsRequest;
use App\Models\CadastroStands;
use Fabio\Bibliotecas\SearchEngine\SearchEngine;
use Fabio\Bibliotecas\Util\StoreUpdate;
use Illuminate\Http\Request;

class CadastroStandsController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api', ['except' => ['index','store','update','destroy']]);
    }  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $SearchEngine = new SearchEngine(new CadastroStands());

        if (!empty($request->query())) {
            
            try {

                $SearchEngine->build( $request->query() ); 
                return $SearchEngine->run();
                //$rawSql = $SearchEngine->getSql();
               
               
            } catch (\Throwable $th) {
                throw $th;
            }
            
        }else{

            return CadastroStands::get();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStandsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CadastroStoreStandsRequest $request)
    {
        $return = StoreUpdate::executeWithResponse(new CadastroStands(), $request);
        return response()->json($return, $return['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stands  $stands
     * @return \Illuminate\Http\Response
     */
    public function show(int $INT_STAND)
    {
        return [CadastroStands::find($INT_STAND)];
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStandsRequest  $request
     * @param  \App\Models\Stands  $stands
     * @return \Illuminate\Http\Response
     */
    public function update(CadastroUpdateStandsRequest $request, int $INT_STAND)
    {
        $return = StoreUpdate::executeWithResponse(CadastroStands::find($INT_STAND), $request);
        return response()->json($return, $return['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stands  $stands
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $INT_STAND)
    {
        CadastroStands::find($INT_STAND)->delete();
        return response()->json([], 204);
    }
}
