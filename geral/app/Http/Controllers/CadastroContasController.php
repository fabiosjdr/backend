<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastroContasRequest;
use App\Models\CadastroContas;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Bool_;
use Fabio\Bibliotecas\Util\StoreUpdate;

class CadastroContasController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth:api', ['except' => ['login']]);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('INT_CTA')){

            $cadastros = CadastroContas::where('INT_CTA', '=', $request->query('INT_CTA'));
            $cadastros = $cadastros->paginate(10);
            return $cadastros->items();

        }else{
            return CadastroContas::get();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CadastroContasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CadastroContasRequest $request, Bool $withResponse = true)
    {
        
        if($withResponse){

            $return = StoreUpdate::executeWithResponse(new CadastroContas(), $request);
            return response()->json($return, $return['status']);

        }else{

            return StoreUpdate::execute(new CadastroContas(), $request);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CadastroContas  $cadastroContas
     * @return \Illuminate\Http\Response
     */
    public function show(CadastroContas $cadastroContas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCadastroContasRequest  $request
     * @param  \App\Models\CadastroContas  $cadastroContas
     * @return \Illuminate\Http\Response
     */
    public function update(CadastroContasRequest $request, CadastroContas $cadastroContas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CadastroContas  $cadastroContas
     * @return \Illuminate\Http\Response
     */
    public function destroy(CadastroContas $cadastroContas)
    {
        //
    }
}
