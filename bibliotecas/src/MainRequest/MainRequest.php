<?php

namespace Fabio\Bibliotecas\MainRequest;

//use Illuminate\Foundation\Http\FormRequest;

// use Illuminate\Contracts\Validation\Validator;
// use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Http\Exceptions\HttpResponseException;

class MainRequest{

    public function __construct()
    {
        
    }

    public function rules(array $rules, $request)
    {
        $method = $request->method();

        if (null !== $request->get('_method', null)) {
            $method = $request->get('_method');
        }

        $request->offsetUnset('_method');
        
        switch ($method) {

            // case 'DELETE':
            // case 'GET':
            //         $this->rules = [];
            //     break;

            default:
                $this->rules =  $rules;
            break;
        }

        return $this->rules;
        
    }

}