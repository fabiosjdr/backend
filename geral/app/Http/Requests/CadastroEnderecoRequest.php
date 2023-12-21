<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator as Validation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Fabio\Bibliotecas\MainRequest\MainRequest;

class CadastroEnderecoRequest extends FormRequest
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

   /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $mreq = new MainRequest();

        return $mreq->rules( [
            'INT_END'    => 'integer|nullable',
            'INT_CAD'    => 'required|integer', 
            'INT_NUM'    => 'integer|nullable',
            'STR_LOGR'   => 'string|nullable',
            'STR_BAIR'   => 'string|nullable',
            'STR_CID'    => 'string|nullable',
            'INT_MUN'    => 'integer|required',
            'INT_EST'    => 'integer|required',
            'STR_EST'    => 'string|nullable',
            'STR_PAIS'   => 'string|nullable',
            'CEP_END'    => ['string','regex:/\d/']
            

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
