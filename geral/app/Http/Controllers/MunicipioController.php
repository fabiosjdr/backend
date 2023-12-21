<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastroMunicipioRequest;

use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Fabio\Bibliotecas\SearchEngine\SearchEngine;
use Fabio\Bibliotecas\Util\StoreUpdate;

class MunicipioController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api', ['except' => ['index']]);
    }  

    
    /**
     * @OA\Get(
     *  path="/geral/municipio/",
     *  summary="Listar municipios",
     *  operationId="listarMunicipios",
     *  tags={"municipio"},
     *  @OA\Response(
     *      response=200,
     *      description="Lista de municipios",
     *      @OA\JsonContent(ref="#/components/schemas/CadastroMunicipio")
     *  ),
     *  @OA\Response(
     *      response=401,
     *      ref="#/components/responses/UnauthorizedError"
     *  ),
     *  @OA\Response(
     *      response=500,
     *      ref="#/components/responses/UnexpectedError"
     *  )
     * )
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $SearchEngine = new SearchEngine(new Municipio());
        
        if (!empty($request->query())) {
            
            try {
                
                $SearchEngine->setAlias('MUNICIPIO');
                $SearchEngine->setLeftJoin('ESTADO', 'ESTADO.INT_EST', '=', 'MUNICIPIO.INT_EST');
                $SearchEngine->build( $request->query() ); 
              
                return $SearchEngine->run();
               
               
            } catch (\Throwable $th) {
                throw $th;
            }
            
        }else{

            return Municipio::get();
        }
        
    }

    /**
     * @OA\Post(
     *  path="/geral/municipio/",
     *  summary="Inserir municipio",
     *  operationId="inserirMunicipios",
     *  tags={"municipio"},
     *  @OA\RequestBody(
     *      required=true,
     *      description="Informar dados do municipio",
     *      @OA\JsonContent(ref="#/components/schemas/CadastroMunicipio"),
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Municipio criado com sucesso"
     *  ),
     *  @OA\Response(
     *      response=401,
     *      ref="#/components/responses/UnauthorizedError"
     *  ),
     *  @OA\Response(
     *      response=500,
     *      ref="#/components/responses/UnexpectedError"
     *  )
     * )
     *  a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CadastroMunicipioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CadastroMunicipioRequest $request)
    {
       
        $return = StoreUpdate::executeWithResponse(new CadastroMunicipio(), $request);
        return response()->json($return, $return['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CadastroMunicipio  $cadastroMunicipio
     * @return \Illuminate\Http\Response
     */
    public function show(int $INT_MUN)
    {
      
        return [CadastroMunicipio::find($INT_MUN)];
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CadastroMunicipioRequest  $request
     * @param  \App\Models\CadastroMunicipio  $cadastroMunicipio
     * @return \Illuminate\Http\Response
     */
    public function update(CadastroMunicipioRequest $request,int $INT_MUN)
    {   

        $return = StoreUpdate::executeWithResponse(CadastroMunicipio::find($INT_MUN), $request);
        return response()->json($return, $return['status']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CadastroMunicipio  $cadastroMunicipio
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $INT_MUN)
    {
        CadastroMunicipio::find($INT_MUN)->delete();
        return response()->json([], 204);
    }
}
