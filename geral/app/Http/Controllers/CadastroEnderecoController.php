<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastroBairroRequest;
use App\Http\Requests\CadastroEnderecoRequest;
use App\Http\Requests\CadastroEstadoRequest;
use App\Http\Requests\CadastroLogradouroRequest;
use App\Http\Requests\CadastroMunicipioRequest;
use App\Http\Requests\CadastroPessoaTemEnderecoRequest;
use App\Http\Requests\CadastroTipoLogradouroRequest;
use App\Models\CadastroBairro;
use App\Models\CadastroBanco;
use App\Models\CadastroEndereco;
use App\Models\CadastroEnderecoTipo;
use App\Models\CadastroEstado;
use App\Models\CadastroLogradouro;
use App\Models\CadastroMunicipio;
use App\Models\CadastroPessoaTemEndereco;
use App\Models\CadastroTipoLogradouro;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Fabio\Bibliotecas\Util\StoreUpdate;

class CadastroEnderecoController extends Controller
{

    /**
     * @OA\Get(
     *  path="/geral/endereco/",
     *  summary="Listar enderecos",
     *  operationId="listarEnderecos",
     *  tags={"endereco"},
     *  @OA\Response(
     *      response=200,
     *      description="Lista de enderecos",
     *      @OA\JsonContent(ref="#/components/schemas/CadastroEndereco")
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
        sleep(15);
        $sql = CadastroEndereco::getSelect();

        if ($request->has('INT_END') > 0){

           $sql .= " WHERE INT_END = '".$request->query('INT_END')."'";
    
        }

        return DB::select( DB::raw($sql) );
       
    }

    public function indexTipo(Request $request)
    {

        if ( $request->has('INT_TP_END') )
        {

            $municipios = CadastroEnderecoTipo::where('INT_TP_END', '=', $request->query('INT_TP_END'));
            $municipios = $municipios->paginate(10);
            return $municipios->items();

        }else{

            return CadastroEnderecoTipo::get();
        }
    }

    public function indexEnderecoPessoa(Request $request)
    {

        $sql = CadastroEndereco::getSelectPessoaEndereco();

        if ($request->has('INT_PES')){

            $sql .= " WHERE PTE.INT_PES = '".$request->query('INT_PES')."'";
        
        }
       
        return DB::select( DB::raw($sql) );
    }

    /**
     * @OA\Post(
     *  path="/geral/endereco/",
     *  summary="Inserir endereco",
     *  operationId="inserirEnderecos",
     *  tags={"endereco"},
     *  @OA\RequestBody(
     *      required=true,
     *      description="Informar dados do endereco",
     *      @OA\JsonContent(ref="#/components/schemas/CadastroEndereco"),
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Endereco criado com sucesso"
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
     * @param  \App\Http\Requests\CadastroEnderecoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CadastroEnderecoRequest $request)
    {

        $return = StoreUpdate::executeWithResponse(new CadastroEndereco(), $request);
        return response()->json($return, $return['status']);

    }

    public function storeEnderecoPessoa(CadastroPessoaTemEnderecoRequest $request)
    {

        $return = StoreUpdate::executeWithResponse(new CadastroPessoaTemEndereco(), $request);
        return response()->json($return, $return['status']);
        
    }
    
    /**
     * @OA\Put(
     *  path="/geral/endereco/{id}",
     *  summary="Atualizar endereco",
     *  operationId="updateEnderecos",
     *  tags={"endereco"},
     *  @OA\Parameter(
     *      description="Id do endereço",
     *      in="path",
     *      name="id",
     *      required=true,
     *      @OA\Schema(type="integer")
     *  ),
     *  @OA\RequestBody(
     *      required=true,
     *      description="Informar dados do endereco",
     *      @OA\JsonContent(ref="#/components/schemas/CadastroEndereco"),
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Endereco editado com sucesso"
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
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CadastroEnderecoRequest  $request
     * @param  \App\Models\CadastroEndereco  $CadastroEndereco
     * @return \Illuminate\Http\Response
     */
    public function updateEnderecoPessoa(CadastroPessoaTemEnderecoRequest $request, int $INT_PES_END)
    {   

        $return = StoreUpdate::executeWithResponse(CadastroPessoaTemEndereco::find($INT_PES_END), $request);
        return response()->json($return, $return['status']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CadastroEndereco  $CadastroEndereco
     * @return \Illuminate\Http\Response
     */
    public function show(int $INT_END)
    {
        return [CadastroEndereco::find($INT_END)];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CadastroEndereco  $CadastroEndereco
     * @return \Illuminate\Http\Response
     */
    public function showTipo(int $INT_TP_END)
    {
        return [CadastroEnderecoTipo::find($INT_TP_END)];
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CadastroEndereco  $CadastroEndereco
     * @return \Illuminate\Http\Response
     */
    public function showEnderecoPessoa(int $INT_PES_END)
    {
        $sql = CadastroEndereco::getSelectPessoaEndereco();
        $sql .= " WHERE PTE.INT_PES = '".$INT_PES_END."'";
        return DB::select( DB::raw($sql) );
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CadastroEndereco  $CadastroEndereco
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $INT_END)
    {
        CadastroEndereco::find($INT_END)->delete();
        return response()->json([], 204);
    }


    public function cep(string $CEP){

        $cep  = preg_replace('/\D/','',trim($CEP));

        $endereco = $this->viacep($cep);

        $LOGRADOURO      = explode(' ', trim($endereco['logradouro']));
        $TP_LOGRADOURO   = $LOGRADOURO[0];
        unset($LOGRADOURO[0]);
        $LOGRADOURO      = join(' ',$LOGRADOURO);

        $payload['NM_BAIR']    = $endereco['bairro'];
        $payload['NM_MUN']     = $endereco['localidade'];
        $payload['INT_IBGE']   = $endereco['ibge'];
        $payload['UF_EST']     = $endereco['uf'];
        $payload['NM_LOGR']    = $LOGRADOURO;
        $payload['NM_TP_LOGR'] = $TP_LOGRADOURO;
        $payload['CEP_END']    = $cep;

        //$request = $request->withQueryParams($payload)->withParsedBody($payload);
        
        $resultEnde = $this->doSurvey($payload);
        
        return response()->json($resultEnde);
    }

    private function viacep($cep) : Array
    {

        $url = "https://viacep.com.br/ws/".$cep."/json/";

        $ch = curl_init();
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL,$url);
        // Execute
        $result=curl_exec($ch);
        // Closing
        curl_close($ch);

        // Will dump a beauty json :3
        return json_decode($result, true);
    }


    private function doSurvey(array $payload) : Array
    {   

        try{
            
            DB::beginTransaction();

            $resultSurvey = array();

            //localiza ou cadastra o bairro
            $resultBairro         = CadastroBairro::where('NM_BAIR','=',$payload['NM_BAIR']);
            $resultLogradouro     = CadastroLogradouro::where('NM_LOGR','=',$payload['NM_LOGR']);
            $resultTipoLogradouro = CadastroTipoLogradouro::where('NM_TP_LOGR','=',$payload['NM_TP_LOGR']);
            $resultMunicipio      = CadastroMunicipio::where('NM_MUN','=',$payload['NM_MUN'] );
            $resultEstado         = CadastroEstado::where('UF_EST','=',$payload['UF_EST'] );

            if($resultBairro->count() == 0){
                $requestBairro = new CadastroBairroRequest();
                $requestBairro->setValidation(['NM_BAIR' => $payload['NM_BAIR']]);
                $resultBairro = (new CadastroBairroController())->store($requestBairro);
                $resultSurvey['INT_BAIR']    =$resultBairro->getData()->data->INT_BAIR;;
            }else{
                $resultSurvey['INT_BAIR']    = $resultBairro->value('INT_BAIR');
            }

            if($resultLogradouro->count() == 0){
                $requestLogradouro = new CadastroLogradouroRequest();
                $requestLogradouro->setValidation(['NM_LOGR' =>  $payload['NM_LOGR']]);
                $resultLogradouro = (new CadastroLogradouroController())->store($requestLogradouro);
                $resultSurvey['INT_LOGR']    = $resultLogradouro->getData()->data->INT_LOGR;
            }else{
                $resultSurvey['INT_LOGR']    = $resultLogradouro->value('INT_LOGR');
            }

            if($resultTipoLogradouro->count() == 0){
                $requestTipoLogradouro = new CadastroTipoLogradouroRequest();
                $requestTipoLogradouro->setValidation(['NM_LOGR' => $payload['NM_LOGR']]);
                $resultTipoLogradouro = (new CadastroLogradouroController())->storeTipo($requestTipoLogradouro);
                $resultSurvey['INT_TP_LOGR'] = $resultTipoLogradouro->getData()->data->INT_LOGR;

            }else{
                $resultSurvey['INT_TP_LOGR'] = $resultTipoLogradouro->value('INT_TP_LOGR');
            }

            if($resultMunicipio->count() == 0){
                $requestMunicipio = new CadastroMunicipioRequest();
                $requestMunicipio->setValidation(['NM_MUN' => $payload['NM_MUN'],'INT_IBGE' => $payload['INT_IBGE'],'UF_EST' => $resultEstado->value('INT_EST')] );
                $resultMunicipio = (new CadastroMunicipioController())->store($requestMunicipio);
                $resultSurvey['INT_MUN']     = $resultMunicipio->getData()->data->INT_MUN;
            }else{
                $resultSurvey['INT_MUN']     = $resultMunicipio->value('INT_MUN');
            }

            $resultSurvey['CEP_END']     = $payload['CEP_END'];
            
            DB::commit();

            return $resultSurvey;

        } catch (\PDOException $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'falha ao salvar',
                'data'    => $e
            ],500);
        }
    }

   
}

