<?php

namespace Fabio\Bibliotecas\ConsultaCPFCNPJ;

class ConsultaCPFCNPJ{
	
	private $ConsultaCPFCNPJ;
	private $Cookie;
	private $mdSession;

	function __construct($conexao = ''){

		$this->ConsultaCPFCNPJ = new \stdclass();	
		
		$this->ConsultaCPFCNPJ->HOST_CPF = 'Host: servicos.receita.fazenda.gov.br';
		$this->ConsultaCPFCNPJ->URL_CPF_COOKIE = 'https://servicos.receita.fazenda.gov.br/Servicos/CPF/ConsultaSituacao/ConsultaPublica.asp';
		$this->ConsultaCPFCNPJ->URL_CPF_CAPTCHA = 'https://servicos.receita.fazenda.gov.br/Servicos/CPF/ConsultaSituacao/ConsultaPublicaSonoro.asp';
		$this->ConsultaCPFCNPJ->URL_CPF_VALIDACAO_CAPTHA = 'https://servicos.receita.fazenda.gov.br/Servicos/CPF/ConsultaSituacao/ConsultaPublicaExibir.asp';
															 
		$this->ConsultaCPFCNPJ->HOST_CNPJ = 'Host: solucoes.receita.fazenda.gov.br';
		$this->ConsultaCPFCNPJ->URL_CNPJ_COOKIE = 'http://solucoes.receita.fazenda.gov.br/Servicos/cnpjreva/Cnpjreva_Solicitacao_CS.asp';
		$this->ConsultaCPFCNPJ->URL_CNPJ_CAPTCHA = 'http://solucoes.receita.fazenda.gov.br/Servicos/cnpjreva/captcha/gerarCaptcha.asp';
		$this->ConsultaCPFCNPJ->URL_CNPJ_VALIDACAO_CAPTHA = 'http://solucoes.receita.fazenda.gov.br/Servicos/cnpjreva/valida.asp';

		//$this->Cookie = $GLOBALS['APP_DIR'].'Dados/';
		$this->mdSession =  md5( date('Ymd') );
		
		$this->Cookie = '/tmp/';
		$this->headers();

		session_id($this->mdSession);
		@session_start();
	}


	function headers(){

		// Headers comuns em todas as chamadas CURL, com exce�ao do �ndice [0], que muda para CPF e CNPJ
		$headers = array(
			0 => '',	// aqui vai o HOST da consulta conforme a necessidade (CPF ou CNPJ)
			1 => 'User-Agent: Mozilla/5.0 (Windows NT 6.1; rv:53.0) Gecko/20100101 Firefox/53.0',
			2 => 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
			3 => 'Accept-Language: pt-BR,pt;q=0.8,en-US;q=0.5,en;q=0.3',
			4 => 'Connection: keep-alive',
			5 => 'Upgrade-Insecure-Requests: 1'	
		);	

		$this->ConsultaCPFCNPJ->headers = $headers;
	}



	function adicionarCPNJ($CNPJ){
		$this->ConsultaCPFCNPJ->CNPJ = $CNPJ;
	}

	function adicionarCAPTCHA($CAPTCHA){
		$this->ConsultaCPFCNPJ->CAPTCHA = $CAPTCHA;
	}	

	function obterCaptchaCNPJ(){
	
		$this->ConsultaCPFCNPJ->headers[0] = $this->ConsultaCPFCNPJ->HOST_CNPJ;		
		
		// define o nome do arquivo de cookie a ser usado para cada chamada conforme $key
		$this->ConsultaCPFCNPJ->cookieFile = $this->Cookie.'cnpj_'.session_id();
		
		$this->criarCookie(true);
		$cookie = $this->carregarCookie($this->ConsultaCPFCNPJ->URL_CNPJ_COOKIE);
		
		return  $this->solicitarCapthaCNPJ($cookie);
	}


	function obterCaptchaCPF(){
		
		$this->ConsultaCPFCNPJ->headers[0] = $this->ConsultaCPFCNPJ->HOST_CPF;		
		// define o nome do arquivo de cookie a ser usado para cada chamada conforme $key
		$this->ConsultaCPFCNPJ->cookieFile = $this->Cookie.'cpf_'.session_id();
		$this->criarCookie(true);
		//$cookie = $this->carregarCookie($this->ConsultaCPFCNPJ->URL_CPF_COOKIE);
		$this->carregarCookie($this->ConsultaCPFCNPJ->URL_CPF_COOKIE);
		//$this->ConsultaCPFCNPJ->cookie
		return  $this->solicitarCapthaCPF();
	}

	function criarCookie($force = false){

		// cria o arquivo se ele n�o existe
		if(!file_exists($this->ConsultaCPFCNPJ->cookieFile) || $force){
		
			$file = fopen($this->ConsultaCPFCNPJ->cookieFile, 'w');	
			fclose($file);
		}else{
			
			// pega os dados de sess�o gerados na visualiza��o do captcha dentro do cookie
			$file = fopen($this->ConsultaCPFCNPJ->cookieFile, 'r');

			while (!feof($file)){
				
				@$conteudo .= fread($file, 1024);
			}

			fclose ($file);
	
			$explodir = explode(chr(9),$conteudo);
			
			$sessionName = trim($explodir[count($explodir)-2]);
			$sessionId = trim($explodir[count($explodir)-1]);	
	
			// constroe o par�metro de sess�o que ser� passado no pr�ximo curl
			$this->ConsultaCPFCNPJ->cookie = $sessionName.'='.$sessionId;
		}

	}

	function carregarCookie($URL){

		$ch = curl_init($URL);
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->ConsultaCPFCNPJ->headers);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $this->ConsultaCPFCNPJ->cookieFile);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $this->ConsultaCPFCNPJ->cookieFile);
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);	

		if(!empty($result)){

			// pega os dados de sess�o gerados nas primeiras chamadas e que est�o dentro do cookie
			$file = fopen($this->ConsultaCPFCNPJ->cookieFile, 'r');
			while (!feof($file)){
				@$conteudo .= fread($file, 1024);
			}
			fclose ($file);
			
			$explodir = explode(chr(9),$conteudo);
					
			$sessionName = trim($explodir[count($explodir)-2]);
			$sessionId = trim($explodir[count($explodir)-1]);	
			
			// constroe o par�metro de sess�o que ser� passado no pr�ximo curl
			$this->ConsultaCPFCNPJ->cookie = $sessionName.'='.$sessionId;			
			
		}else{
			die ('falha');
		}
	}



	function solicitarCapthaCNPJ(){

		// faz segunda chamada para pegar o captcha
		$ch = curl_init($this->ConsultaCPFCNPJ->URL_CNPJ_CAPTCHA);
		
		// continua setando par�metros da chamada curl
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->ConsultaCPFCNPJ->headers);		// headers da chamada 
		curl_setopt($ch, CURLOPT_COOKIEFILE, $this->ConsultaCPFCNPJ->cookieFile);	// dados do arquivo de cookie
		curl_setopt($ch, CURLOPT_COOKIEJAR, $this->ConsultaCPFCNPJ->cookieFile);	// dados do arquivo de cookie
		curl_setopt($ch, CURLOPT_COOKIE, $this->ConsultaCPFCNPJ->cookie);			// cookie com os dados da sess�o
		curl_setopt($ch, CURLOPT_REFERER, $this->ConsultaCPFCNPJ->URL_CNPJ_COOKIE); // refer = url da chamada anterior
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		
		$result = curl_exec($ch);

		curl_close($ch);

		if($result != ''){
			$imagem_cnpj = 'data:image/png;base64,'.base64_encode($result);
		}else{
			$imagem_cnpj = false;
		}
		
		
		return $imagem_cnpj;
	}

	function solicitarCapthaCPF(){

		// faz segunda chamada para pegar o captcha
		$ch = curl_init($this->ConsultaCPFCNPJ->URL_CPF_CAPTCHA);
		
		// continua setando par�metros da chamada curl
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->ConsultaCPFCNPJ->headers);		// headers da chamada 
		curl_setopt($ch, CURLOPT_COOKIEFILE, $this->ConsultaCPFCNPJ->cookieFile);	// dados do arquivo de cookie
		curl_setopt($ch, CURLOPT_COOKIEJAR, $this->ConsultaCPFCNPJ->cookieFile);	// dados do arquivo de cookie
		curl_setopt($ch, CURLOPT_COOKIE, $this->ConsultaCPFCNPJ->cookie);			// cookie com os dados da sess�o
		curl_setopt($ch, CURLOPT_REFERER, $this->ConsultaCPFCNPJ->URL_CPF_COOKIE); // refer = url da chamada anterior

		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);

		$imagem_cpf = false;

		// Pega Imagem Captcha
		$doc = new \DOMDocument();
		@$doc->loadHTML($result);
		//print_r($doc);exit;
		$tags = $doc->getElementsByTagName('img');
		$count = 0;
		foreach ($tags as $tag){
			$count++;			
			if($tag->getAttribute('id') == "imgCaptcha"){
				$imagem_cpf = $tag->getAttribute('src');
			}
		}

		return $imagem_cpf;
	}

	

	function pega_o_que_interessa($inicio,$fim,$total){

		$interesse = str_replace($inicio,'',str_replace(strstr(strstr($total,$inicio),$fim),'',strstr($total,$inicio)));
		return($interesse);
	}

	// fun��o para pegar a resposta html da consulta pelo CPF na p�gina da receita
	function getHtmlCNPJ($cnpj, $captcha){

	    $this->ConsultaCPFCNPJ->cookieFile = $this->Cookie.'cnpj_'.session_id();
	    
	    if(!file_exists($this->ConsultaCPFCNPJ->cookieFile)){
			
	        return false;      
	    
	    }else{

			// pega os dados de sess�o gerados na visualiza��o do captcha dentro do cookie
			$file = fopen($this->ConsultaCPFCNPJ->cookieFile, 'r');

			while (!feof($file)){
				@$conteudo .= fread($file, 1024);
			}

			fclose ($file);
			
			$explodir = explode(chr(9),$conteudo);
			
			$sessionName = trim($explodir[count($explodir)-2]);
			$sessionId = trim($explodir[count($explodir)-1]);
			
			// se n�o tem falg	1 no cookie ent�o acrescenta
			/*if(!strstr($conteudo,'flag	1')){

				// linha que deve ser inserida no cookie antes da consulta cnpj
				// observa��es argumentos separados por tab (chr(9)) e new line no final e inicio da linha (chr(10))
				// substitui dois chr(10) padr�o do cookie para separar cabecario do conteudo , adicionando o conteudo $linha , que tb inicia com dois chr(10)
				$linha = chr(10).chr(10).'www.receita.fazenda.gov.br	FALSE	/pessoajuridica/cnpj/cnpjreva/	FALSE	0	flag	1'.chr(10);
				// novo cookie com o flag=1 dentro dele , antes da linha de sessionname e sessionid
				$novo_cookie = str_replace(chr(10).chr(10),$linha,$conteudo);
				
				// apaga o cookie antigo
				unlink($this->ConsultaCPFCNPJ->cookieFile);
				
				// cria o novo cookie , com a linha flag=1 inserida
				$file = fopen($this->ConsultaCPFCNPJ->cookieFile, 'w');
				fwrite($file, $novo_cookie);
				fclose($file);
			}*/
			
			// constroe o par�metro de sess�o que ser� passado no pr�ximo curl
			$this->ConsultaCPFCNPJ->cookie = $sessionName.'='.$sessionId.';flag=1';	
		}
		
		// dados que ser�o submetidos a consulta por post
	    $post = array
	    (
			'search_type'						=> 'cnpj',
			'origem'						=> 'comprovante',
			'cnpj' 							=> $cnpj, 
			'txtTexto_captcha_serpro_gov_br'=> $captcha,
			'search_type'					=> 'cnpj'
			
	    );
	    
		$post = http_build_query($post, NULL, '&');
		
		// prepara headers da consulta
		$this->ConsultaCPFCNPJ->headers[0] = $this->ConsultaCPFCNPJ->HOST_CNPJ;
		
		$ch = curl_init($this->ConsultaCPFCNPJ->URL_CNPJ_VALIDACAO_CAPTHA);
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->ConsultaCPFCNPJ->headers);
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);		// aqui est�o os campos de formul�rio
	    curl_setopt($ch, CURLOPT_COOKIEFILE, $this->ConsultaCPFCNPJ->cookieFile);	// dados do arquivo de cookie
	    curl_setopt($ch, CURLOPT_COOKIEJAR, $this->ConsultaCPFCNPJ->cookieFile);	// dados do arquivo de cookie
	    curl_setopt($ch, CURLOPT_COOKIE, $this->ConsultaCPFCNPJ->cookie);	    // dados de sess�o e flag=1
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	    curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
	    curl_setopt($ch, CURLOPT_REFERER, $this->ConsultaCPFCNPJ->URL_CNPJ_CAPTCHA);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
	    $html = curl_exec($ch);
		curl_close($ch);
		
		//file_put_contents($GLOBALS['APP_DIR'].'Dados/teste.txt',$html);
	    return $html;
	}

	// fun��o para pegar a resposta html da consulta pelo CPF na p�gina da receita
	function getHtmlCPF($cpf, $datanascim, $captcha){

	    $url = $this->ConsultaCPFCNPJ->URL_CPF_VALIDACAO_CAPTHA; 		

	    $this->ConsultaCPFCNPJ->cookieFile = $this->Cookie.'cpf_'.session_id();
	    
	    if(!file_exists($this->ConsultaCPFCNPJ->cookieFile)){
	       
	        return false;      

	    }else{
			
			// pega os dados de sess�o gerados na visualiza��o do captcha dentro do cookie
			$file = fopen($this->ConsultaCPFCNPJ->cookieFile, 'r');
			
			while (!feof($file)){
				@$conteudo .= fread($file, 1024);
			}
			
			fclose ($file);
			
			$explodir = explode(chr(9),$conteudo);
			
			$sessionName = trim($explodir[count($explodir)-2]);
			$sessionId = trim($explodir[count($explodir)-1]);
			
			// prepara a variavel de session
			$this->ConsultaCPFCNPJ->cookie = $sessionName.'='.$sessionId;	
		}
		
		// dados que ser�o submetidos a consulta por post
	    $post = array(
			'txtTexto_captcha_serpro_gov_br'		=> $captcha,
			'txtCPF'								=> $cpf,
			'txtDataNascimento'						=> $datanascim,
			'idCheckedReCaptcha' => 'false',
			'CPF' => '',
			'NASCIMENTO' => '',
			'Enviar' => 'Consultar' 

	    );
	    
	   
	    $post = http_build_query($post, NULL, '&');
		
		// prepara headers da consulta

		$this->ConsultaCPFCNPJ->headers[0] = $this->ConsultaCPFCNPJ->HOST_CPF;
		
	    $ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->ConsultaCPFCNPJ->headers);
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);		// aqui est�o os campos de formul�rio
	    curl_setopt($ch, CURLOPT_COOKIEFILE, $this->ConsultaCPFCNPJ->cookieFile);	// dados do arquivo de cookie
	    curl_setopt($ch, CURLOPT_COOKIEJAR, $this->ConsultaCPFCNPJ->cookieFile);	// dados do arquivo de cookie
	    curl_setopt($ch, CURLOPT_COOKIE, $this->ConsultaCPFCNPJ->cookie);			// continua a sess�o anterior com os dados do captcha
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	    curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
	    curl_setopt($ch, CURLOPT_REFERER, $this->ConsultaCPFCNPJ->URL_CPF_CAPTCHA);	// Novo Referer 24/Fev/2018
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	    $html = curl_exec($ch);
	    curl_close($ch);
	    //file_put_contents($GLOBALS['APP_DIR'].'Dados/teste.txt',$html);
		
		return $html;
	}

	// Fun��o para extrair o que interessa da HTML e colocar em array
	/*function parseHtmlCNPJ($html)
	{
		// respostas que interessam
		$campos = array(
		'N�MERO DE INSCRI��O',
		'DATA DE ABERTURA',
		'NOME EMPRESARIAL',
		'T�TULO DO ESTABELECIMENTO (NOME DE FANTASIA)',
		'C�DIGO E DESCRI��O DA ATIVIDADE ECON�MICA PRINCIPAL',
		'C�DIGO E DESCRI��O DAS ATIVIDADES ECON�MICAS SECUND�RIAS',
		'C�DIGO E DESCRI��O DA NATUREZA JUR�DICA',
		'LOGRADOURO',
		'N�MERO',
		'COMPLEMENTO',
		'CEP',
		'BAIRRO/DISTRITO',
		'MUNIC�PIO',
		'UF',
		'ENDERE�O ELETR�NICO',
		'TELEFONE',
		'ENTE FEDERATIVO RESPONS�VEL (EFR)',
		'SITUA��O CADASTRAL',
		'DATA DA SITUA��O CADASTRAL',
		'MOTIVO DE SITUA��O CADASTRAL',
		'SITUA��O ESPECIAL',
		'DATA DA SITUA��O ESPECIAL');
		// caracteres que devem ser eliminados da resposta
		$caract_especiais = array(
		chr(9),
		chr(10),
		chr(13),
		'&nbsp;',
		'</b>',
		'  ',
		'<b>MATRIZ<br>',
		'<b>FILIAL<br>'
		 );
		// prepara a resposta para extrair os dados
		$html = str_replace('<br><b>','<b>',str_replace($caract_especiais,'',strip_tags($html,'<b><br>')));
		
		$html3 = $html;
		// faz a extra��o
		for($i=0;$i<count($campos);$i++)
		{		
			$html2 = strstr($html,utf8_decode($campos[$i]));
			$resultado[] = trim(pega_o_que_interessa(utf8_decode($campos[$i]).'<b>','<br>',$html2));
			$html=$html2;
		}
		// extrai os CNAEs secundarios , quando forem mais de um
		if(strstr($resultado[5],'<b>'))
		{
			$cnae_secundarios = explode('<b>',$resultado[5]);
			$resultado[5] = $cnae_secundarios;
			unset($cnae_secundarios);
		}
		// devolve STATUS da consulta correto
		if(!$resultado[0])
		{
			if(strstr($html3,utf8_decode('O n�mero do CNPJ n�o � v�lido')))
			{$resultado['status'] = 'CNPJ incorreto ou n�o existe';}
			else
			{$resultado['status'] = 'Imagem digitada incorretamente';}
		}
		else
		{$resultado['status'] = 'OK';}
		
		return $resultado;
	}*/

	// Fun��o para extrair o que interessa da HTML e colocar em array
	/*function parseHtmlCPF($html){

		// respostas que interessam
		$campos = array(
		'N<sup>o</sup> do CPF: <span class="clBold">',
		'Nome: <span class="clBold">',
		'Data Nascimento: <span class="clBold">',
		'Situa&ccedil;&atilde;o Cadastral: <span class="clBold">',
		'Data de Inscri&ccedil;&atilde;o no CPF: <span class="clBold">'
		);
		// para utilizar na hora de devolver o status da consulta
		$html3 = $html;
		// faz a extra��o
		for($i=0;$i<count($campos);$i++)
		{		
			$html2 = strstr($html,utf8_decode($campos[$i]));
			$resultado[] = trim($this->pega_o_que_interessa(utf8_decode($campos[$i]),'</span>',$html2));
			$html=$html2;
		}
		
		// devolve STATUS da consulta correto
		if(!$resultado[0])
		{
			if(strstr($html3,'CPF incorreto'))
			{$resultado['status'] = 'CPF incorreto';}		
			else if(strstr($html3,'n&atilde;o existe em nossa base de dados'))
			{$resultado['status'] = 'CPF n�o existe';}
			else if(strstr($html3,'Os caracteres da imagem n&atilde;o foram preenchidos corretamente'))
			{$resultado['status'] = 'Imagem digitada incorretamente';}
			else if(strstr($html3,'Data de nascimento informada'))
			{$resultado['status'] = 'Data de Nascimento divergente';}
			else
			{$resultado['status'] = 'Receita n�o responde';}
		}
		else
		{$resultado['status'] = 'OK';}
		return $resultado;
	}*/

	function parseHtmlCNPJ($html){
		$doc = new \DOMDocument();
		@$doc->loadHTML($html);

		$finder = new \DomXPath($doc);
		$nodeErro = $finder->query("//*[@id='msgTxtErroCaptcha']");
		
		if($nodeErro->length > 0){

			
			$dados = '<span class="mensagemForm mensagemErro">Os caracteres da imagem n�o foram preenchidos corretamente. Por favor, envie novamente.</span>
							<input value="voltar" type="button" onclick="javascript:window.location.reload();"></div>';

			return $dados;				

		}else{
			
			
			$nodes = $finder->query("//*[@id='principal']/table[1]/tr/td/table/tr/td");

			if($nodes->length > 0){
			
				$dados = '<table class="listbox" style="width:100%">
								<th>Dados da Receita</th>';

				$tmp_dom = new \DOMDocument(); 

				$i = 0;
				foreach ($nodes as $node){
					$i++;

					if($i < 4){
						continue;
					}
					
					
					$valor = preg_replace("/\n|\r/","",strip_tags($node->nodeValue) )."\n";
					$valor = preg_replace("/\s{2,}/",": ",$valor);
					$valor = preg_replace("/^:\s|\:\s{1,}$|\:$/","",$valor);

					$tr = $tmp_dom->createElement('tr');
					$td = $tmp_dom->createElement('td',$valor);
					
					$tr->appendChild($td);
					
					$tmp_dom->appendChild($tr);
				}

				$dados.= trim($tmp_dom->saveHTML()); 
				$dados .= '</table>';
				return '<div class="confirmarDados"><input value="Obter Dados" type="button" onclick="javascript:obterDadosCNPJ();"></div>'.$dados;
			
			}else{

				$dados = '<span class="mensagemForm mensagemErro">O n�mero do CNPJ n�o � v�lido. Verifique se o mesmo foi digitado corretamente.</span>
							<input value="voltar" type="button" onclick="javascript:window.location.reload();"></div>';

				return $dados;							
			}	
		}	
	}
	
	function prepareIndex(string $index){


		return strtr(utf8_decode($index), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ ()/'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY____');
	}

	function parseHtmlArrayCNPJ($html){
		
		$out = array();

		$doc = new \DOMDocument();
		@$doc->loadHTML($html);

		$finder = new \DomXPath($doc);
		$nodeErro = $finder->query("//*[@id='msgTxtErroCaptcha']");
		
		if($nodeErro->length > 0){

			
			$dados = '<span class="mensagemForm mensagemErro">Os caracteres da imagem n�o foram preenchidos corretamente. Por favor, envie novamente.</span>
							<input value="voltar" type="button" onclick="javascript:window.location.reload();"></div>';

			return $dados;				

		}else{
			
			
			$nodes = $finder->query("//*[@id='principal']/table[1]/tr/td/table/tr/td");

			if($nodes->length > 0){
			
				$tmp_dom = new \DOMDocument(); 

				$i = 0;
				foreach ($nodes as $node){
					$i++;

					if($i < 4){
						continue;
					}
					
					
					$valor = preg_replace("/\n|\r/","",strip_tags($node->nodeValue) )."\n";
					$valor = preg_replace("/\s{2,}/",": ",$valor);
					$valor = preg_replace("/^:\s|\:\s{1,}$|\:$/","",$valor);

					$split = explode(':',$valor);

					$index =  $this->prepareIndex( $split[0]);
					unset($split[0]);

					$out[$index] = join('',$split);

				}

				return $out;
			
			}else{

				$dados = '<span class="mensagemForm mensagemErro">O n�mero do CNPJ n�o � v�lido. Verifique se o mesmo foi digitado corretamente.</span>
							<input value="voltar" type="button" onclick="javascript:window.location.reload();"></div>';

				return $dados;							
			}	
		}	
	}

	function parseHtmlCPF($html){
		
		$doc = new \DOMDocument();
		@$doc->loadHTML($html);
		
		$finder = new \DomXPath($doc);
		$nodeErro = $finder->query("//*[@id='idMensagemErro']");
		
		if($nodeErro->length > 0){

			$tmp_dom = new \DOMDocument(); 

			foreach ($nodeErro as $node){		
							
				$tmp_dom->appendChild($tmp_dom->importNode($node,true));
				$dados = trim($tmp_dom->saveHTML()); 
			}

			return $dados.'<div class="voltarReceita"><input value="voltar" type="button" onclick="javascript:window.location.reload();"></div>';

		}else{

			$finder = new \DomXPath($doc);

			$classname="clConteudoDados";
			$nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");

			if(count($nodes) > 0){

				$tmp_dom = new \DOMDocument(); 
				
				$dados = '<table class="listbox" style="width:100%">
							<th>Dados da Receita</th>';

				foreach ($nodes as $node){
					
					$tr = $tmp_dom->createElement('tr');
					$td = $tmp_dom->createElement('td');				

					$td->appendChild($tmp_dom->importNode($node,true));
					$tr->appendChild($td);
					$tmp_dom->appendChild($tr);
				}

				$dados.= trim($tmp_dom->saveHTML()); 
				$dados .= '</table>';
				return '<div class="confirmarDados"><input value="Obter Dados" type="button" onclick="javascript:obterDadosCPF();"></div>'.$dados;
			
			}else{

				return 'Falha';
			}
		}
	}

	function parseHtmlArrayCPF($html){
		
		$out = array();

		$doc = new \DOMDocument();
		@$doc->loadHTML($html);
		
		$finder = new \DomXPath($doc);
		$nodeErro = $finder->query("//*[@id='idMensagemErro']");
		
		if($nodeErro->length > 0){

			$tmp_dom = new \DOMDocument(); 

			foreach ($nodeErro as $node){		
							
				$tmp_dom->appendChild($tmp_dom->importNode($node,true));
				$dados = trim($tmp_dom->saveHTML()); 
			}

			return $dados.'<div class="voltarReceita"><input value="voltar" type="button" onclick="javascript:window.location.reload();"></div>';

		}else{

			$finder = new \DomXPath($doc);

			$classname="clConteudoDados";
			$nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");

			if(count($nodes) > 0){

				$tmp_dom = new \DOMDocument(); 
				
				foreach ($nodes as $node){
					
					$split = explode(':',$node->nodeValue);

					$index =  $this->prepareIndex( $split[0]);
					unset($split[0]);

					$out[$index] = join('',$split);

				}
			
			}
			
			return $out;
		}
	}
}


?>
