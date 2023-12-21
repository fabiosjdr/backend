<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator as Validation;
use Illuminate\Http\Exceptions\HttpResponseException;
use Fabio\Bibliotecas\MainRequest\MainRequest;

class CadastroContasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $mreq = new MainRequest();

        return $mreq->rules( [
            'INT_CTA'    => 'integer|nullable',
            'DH_VALID'   => 'date|required',
            'LG_ATV'      => 'in:"S","N"|nullable',
           
        ], $this);

    }

    public function setValidation(array $data){

        $validator = Validation::make($data,$this->rules());
        $this->setValidator( $validator);
    }
    
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422)); 
    }

}
