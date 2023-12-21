<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use PHPMailer\PHPMailer\PHPMailer;
    
/**
 * @OA\OpenApi(
 *  @OA\Info(
 *      version="1.0.0",
 *      title="SH3 API Laravel",
 *      description="SH3 - API de serviços independentes",
 *      @OA\Contact(
 *          name="SH3 Suporte",
 *          email="suporte@sh3.com.br"
 *      )
 *  ),
 *  @OA\Server(
 *      url="http://localhost:{porta}/api/",
 *      description="Servidor de desenvolvimento",
 *      @OA\ServerVariable(
 *          serverVariable="porta",
 *          enum={"8000", "8001"},
 *          default="8000"
 *      )
 *  ),
 *  @OA\Components(
 *      @OA\SecurityScheme(
 *          type="http",
 *          scheme="bearer",
 *          name="JWT",
 *          securityScheme="JWT",
 *          bearerFormat="JWT",
 *          in="header"
 *      ),
 *      @OA\Response(
 *          response="UnauthorizedError",
 *          description="Token de acesso não encontrado ou inválido",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              example={"status": "error", "message": "Token not found."}
 *          )
 *      ),
 *      @OA\Response(
 *          response="UnexpectedError",
 *          description="Erro inesperado",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              example={"status": "error", "message": "An exception occurred while executing a query: [...]"}
 *          )
 *      )
 *  )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $stdclass;


    public function __construct(){
        $this->middleware('auth:api', ['except' => []]);
        $this->stdclass = new \stdClass();
    }

    function carregarCredenciaisEmail(){

        $this->stdclass->HOST = env('E_HOST');	
        $this->stdclass->SENHA = env('E_PASS');	
        $this->stdclass->USERNAME = env('E_USER');	
        $this->stdclass->emailContatoGeral = env('E_USER');		
        
    }

    function preparEmail(){

        $this->carregarCredenciaisEmail();

        $mail = new PHPMailer(true);

        //Server settings
        $mail->SMTPDebug  = 0;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = $this->stdclass->HOST;  				// Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = $this->stdclass->USERNAME;              // SMTP username
        $mail->Password   = $this->stdclass->SENHA;                 // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;  
        $mail->setFrom($this->stdclass->USERNAME,utf8_decode('34ª Feira Nacional de Artesanato') );

        return $mail;           
    }
}