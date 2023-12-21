<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastroContasRequest;
use App\Http\Requests\CadastroUsuarioRequest;
use App\Http\Requests\ContaTemUsuarioRequest;
use App\Models\CadastroContas;
use App\Models\CadastroUsuario;
use App\Models\ContaTemUsuario;
use Illuminate\Http\Request;
use Fabio\Bibliotecas\Util\StoreUpdate;
use Illuminate\Support\Facades\DB;

class CadastroUsuarioController extends Controller
{


    public function __construct(){
        parent::__construct();
        $this->middleware('auth:api', ['except' => ['store']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //DB::enableQueryLog();

        if ($request->has('INT_USU')){

            $cadastros = CadastroUsuario::where('INT_USU', '=', $request->query('INT_USU'));
            $cadastros = $cadastros->paginate(10);
            dd(DB::getQueryLog());
            return $cadastros->items();

        }else{
            $teste = CadastroUsuario::get();
           // dd(DB::getQueryLog());
            return $teste;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CadastroUsuarioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CadastroUsuarioRequest $request)
    {
       
        DB::beginTransaction();
            
        $this->payload = $request->validated();
        
        $this->payload['SHA1_SENHA'] = password_hash( $this->payload['SHA1_SENHA'], PASSWORD_BCRYPT);
        
        $request->setValidation($this->payload);

        $usuario = StoreUpdate::execute(new CadastroUsuario(), $request);
        $usuario->refresh();

        //$contaController       = new CadastroContasController();
        $cadastroContasRequest = new CadastroContasRequest();
        $cadastroContasRequest->setValidation(['LG_ATV' => 'S', 'DH_VALID' => date('Y-m-d H:i:s')]);
        
        //$conta = $contaController->store($cadastroContasRequest,false);
        $conta = StoreUpdate::execute(new CadastroContas(), $cadastroContasRequest);
        $conta->refresh();

        //$contaTemUsuarioController = new ContaTemUsuarioController();
        $contasTemUsuarioRequest = new ContaTemUsuarioRequest();
        $contasTemUsuarioRequest->setValidation(['INT_USU' => $usuario->INT_USU, 'INT_CTA' => $conta->INT_CTA, 'LG_OWNER' => 'S']);
        
        $return = StoreUpdate::executeWithResponse(new ContaTemUsuario(), $contasTemUsuarioRequest);
        //$return = $contaTemUsuarioController->store($contasTemUsuarioRequest);

        $send = $this->sendMailNewAccount($usuario);

        DB::commit();

        return response()->json($return, $return['status']);
    }


    private function sendMailNewAccount($usuario){

        $mail = $this->preparEmail();

        try {
        
            //Recipients		    
            $mail->addAddress($usuario->STR_EMAIL, '34º Feira Nacional de Artesanato');     // Add a recipient
        
            // Content
            $mail->isHTML(true);// Set email format to HTML
            $mail->Subject = utf8_decode('Nova conta criada');
            
            $mail->Body = utf8_decode($this->modeloNovaConta($usuario) );
            
            $result = $mail->send();

            return ['success' => true,
                'status'  => 200, 
                'message' => 'Mensagem enviada com sucesso!',
                'data'    => '',
                'result'  => $result
            ];

        } catch (\Exception $e) {

            return ['success' => false,
                'status'  => 500, 
                'message' => "Falha ao tentar enviar o email: {$mail->ErrorInfo}",
                'data'    => '',
                'result'  => $result
            ];

        }

    }

    public function sendEmailRecoveryPassword($usuario,$senha){

        $mail = $this->preparEmail();

        try {
        
            //Recipients		    
            $mail->addAddress($usuario->STR_EMAIL, '34º Feira Nacional de Artesanato');     // Add a recipient
        
            // Content
            $mail->isHTML(true);// Set email format to HTML
            $mail->Subject = utf8_decode('Recuperação de senha');
            
            $mail->Body = utf8_decode($this->modeloRecovery($usuario,$senha) );
            
            $result = $mail->send();

            return ['success' => true,
                'status'  => 200, 
                'message' => 'Mensagem enviada com sucesso!',
                'data'    => '',
                'result'  => $result
            ];

        } catch (\Exception $e) {

            return ['success' => false,
                'status'  => 500, 
                'message' => "Falha ao tentar enviar o email: {$mail->ErrorInfo}",
                'data'    => '',
                'result'  => $result
            ];

        }

    }
    
    public function modeloRecovery($usuario,$senha){

        //$BASEURL = $_SERVER['SERVER_NAME'].'/'.$_SERVER['DOCUMENT_ROOT'].'/';

		$corpo = ' <div style="width:100%;background: #ccc">
                    <div style="margin-left: 20%;margin-right: 20%;width: 60%;" align="center">
                        <div style="width: 100%; background:#fff">
                            
                            <div style=" padding: 5px 0; background: #fff; text-align: left">
                        
                                <p style="color: #6b6868; font-family: sans-serif; margin-left: 10%; margin-right: 10%; text-align: justify;">
                                    
                                    Olá  '.$usuario->STR_NM_USU.'.<br>
                                    Uma solicitação de recuperação de senha foi recebido.<br>
                                    Sua nova senha agora é : '.$senha.'<br><br>
                                
                                    <a href="https://www.eravirtual.org/feira2023/" target="_blank" style="text-decoration:none; background: #5161af; color:#fff; padding: 20px 30px; border-radius: 15px;" >Clique aqui para entrar </a>
                                    
                                </p>
                            
                            </div>
                
                            <div style="padding: 15px 45px;background: #fff;float: left;">
                                    <img src="https://www.eravirtual.org/feira2023/assets/FeiraLogo1-836d2f69.png" height="100" />
                            </div>
                            
                        </div>
                    </div>
                </div>';


		return $corpo;		
	}

    public function modeloNovaConta($usuario){

        //$BASEURL = $_SERVER['SERVER_NAME'].'/'.$_SERVER['DOCUMENT_ROOT'].'/';

		$corpo = ' <div style="width:100%;background: #ccc">
                    <div style="margin-left: 20%;margin-right: 20%;width: 60%;" align="center">
                        <div style="width: 100%; background:#fff">
                            
                            <div style=" padding: 5px 0; background: #fff; text-align: left">
                        
                                <p style="color: #6b6868; font-family: sans-serif; margin-left: 10%; margin-right: 10%; text-align: justify;">
                                    
                                    Olá  '.$usuario->STR_NM_USU.'.<br>
                                    O seu cadastro na 34º Feira Nacional de Artesanato foi concluída com sucesso.<br><br><br>
                
                                
                                    <a href="https://www.eravirtual.org/feira2023/" target="_blank" style="text-decoration:none; background: #5161af; color:#fff; padding: 20px 30px; border-radius: 15px;" >Clique aqui para entrar </a>
                                    
                                </p>
                            
                            </div>
                
                            <div style="padding: 15px 45px;background: #fff;float: left;">
                                    <img src="https://www.eravirtual.org/feira2023/assets/FeiraLogo1-836d2f69.png" height="100" />
                            </div>
                            
                        </div>
                    </div>
                </div>';


		return $corpo;		
	}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CadastroUsuario  $cadastroUsuario
     * @return \Illuminate\Http\Response
     */
    public function show(CadastroUsuario $cadastroUsuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCadastroUsuarioRequest  $request
     * @param  \App\Models\CadastroUsuario  $cadastroUsuario
     * @return \Illuminate\Http\Response
     */
    public function update(CadastroUsuarioRequest $request, int $INT_USU)
    {
        $return = StoreUpdate::executeWithResponse(CadastroUsuario::find($INT_USU), $request);
        return response()->json($return, $return['status']);
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CadastroUsuario  $cadastroUsuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $INT_USU)
    {
        CadastroUsuario::find($INT_USU)->delete();
        return response()->json([], 204);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CadastroUsuario  $cadastroUsuario
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
       // $input = $request->all();

        // DB::enableQueryLog();

        if ($request->has('CPF_USU') && $request->has('SHA1_SENHA') ){
            
            $teste =  $request->input('CPF_USU');

            $cadastros = CadastroUsuario::where('CPF_USU', '=', $request->input('CPF_USU'))->where('SHA1_SENHA', '=', $request->input('SHA1_SENHA'));
            $cadastros = $cadastros->paginate(10);
            
        //     dd(DB::getQueryLog());
        //       $teste = $cadastros->get();
            $teste = $cadastros->count();

            if($cadastros->count() > 0){

                if( isset($cadastros->LG_ATV) && $cadastros->LG_ATV == 'S' ){
           
                    $output['ID']    = $cadastros->INT_USU;
                    $output['LOGIN'] = true;
                    $output['TOKEN'] = '123'; //$this->createJWToken($client);
                    
                }else{
                    $output['LOGIN'] = false;
                }
        
                return response()->json([
                    'success' => true,
                    'message' => 'Sucesso',
                     $output
                ],200);

            }else{
                return  response()->json(['LOGIN'=> false], 400); ;
            }

            
        }else{
            return response()->json(['LOGIN'=> false],400);
        }


    }
}