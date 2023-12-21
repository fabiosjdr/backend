<?php

namespace Fabio\Bibliotecas\RabbitConsumer;

class RabbitConsumer{
    
    private $message;
    private $req;
    private $progressBar;
    
    function __construct($messanger,$req){

        $this->messanger = $messanger;
        $this->req     = $req;
        $this->progressBar = [
            'executando'      => false,
            'indicePrincipal' => 0,
            'totalPrincipal'  => 0,
            'subIndice'       => 0,
            'totalSubIndice'  => 0
        ];
    }

    public function setExecutando($bool){
        $this->progressBar['executando'] = $bool;
    }

    public function setTotalPrincipal($total){
        $this->progressBar['totalPrincipal'] = $total;
    }

    public function setIndicePrincipal($i){
        $this->progressBar['indicePrincipal'] = $i;
    }

    public function tickIndicePrincipal(){
        $this->progressBar['indicePrincipal'] = $this->progressBar['indicePrincipal'] + 1;
    }
    

    public function setTotalSubIndice($i){
        $this->progressBar['totalSubIndice'] = $i;
    }

    public function setSubIndice($i){
        $this->progressBar['subIndice'] = $i;
    }

    public function tickSubIndice(){
        $this->progressBar['subIndice'] = $this->progressBar['subIndice'] + 1;
    }
    
    public function getContent($as_array = true){
        return  json_decode($this->req->body,$as_array);
    }

    public function getPayload(){

        $data = $this->getContent();
        return  $data['payload'];
    }


    public function iniciar(){
        $this->setExecutando(true);
    }
    
    public function terminar()
    {
        $this->setExecutando(false);
        $this->sendMessage();
        $this->req->ack();
    }
    
    public function sendMessage(){

        $this->messanger::sendMessage($this->progressBar, $this->req);
    }

}