<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContaTemUsuarioRequest;
use App\Models\ContaTemUsuario;
use Fabio\Bibliotecas\Util\StoreUpdate;

class ContaTemUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContaTemUsuarioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContaTemUsuarioRequest $request,Bool $withResponse = true)
    {
        if($withResponse){

            $return = StoreUpdate::executeWithResponse(new ContaTemUsuario(), $request);
            return response()->json($return, $return['status']);
            
        }else{

            return StoreUpdate::execute(new ContaTemUsuario(), $request);
        }
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContaTemUsuarioRequest  $request
     * @param  \App\Models\ContaTemUsuario  $contaTemUsuario
     * @return \Illuminate\Http\Response
     */
    public function update(ContaTemUsuarioRequest $request, ContaTemUsuario $contaTemUsuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContaTemUsuario  $contaTemUsuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContaTemUsuario $contaTemUsuario)
    {
        //
    }
}
