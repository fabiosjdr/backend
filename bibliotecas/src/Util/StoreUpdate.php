<?php

namespace Fabio\Bibliotecas\Util;

//use Illuminate\Foundation\Http\FormRequest;

// use Illuminate\Contracts\Validation\Validator;
// use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUpdate{

    public function __construct()
    {
        
    }

    public static function execute($classe,$request){

        $data = $request->validated();
       
        foreach($classe->getFillable() as $value)
        {   
            if(isset($data[$value])){
                $classe->{$value}=$data[$value];
            }else if(  $request->request->get( $value) != null  ){
                //valores injetados no request
                $classe->{$value}= $request->request->get( $value );
            }
        }

        $classe->save();
        
        return $classe;
    }

    public static function executeWithResponse($objeto,$request){
        
        try{

            $result = self::execute($objeto,$request);

            $success = true;
            $status  = '200';
            $message = 'Sucesso';
            $data    = $objeto;

        } catch (\PDOException $e) {
            
            $success = false;
            $status  = '500';
            $message = $e->getMessage();
            $data    = $e;
            $result  = null;
        }

        return ['success' => $success,
                'status'  => $status, 
                'message' => $message,
                'data'    => $data,
                'result'  => $result
               ];
        
    }

}