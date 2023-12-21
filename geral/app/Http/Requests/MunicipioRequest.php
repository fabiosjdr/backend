<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Fabio\Bibliotecas\MainRequest\MainRequest;

class CadastroMunicipioRequest extends FormRequest
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
            'INT_EST'  => 'integer|required', 
            'NM_MUN'   => 'integer|required',
            'INT_MUN'  => 'integer|nullable',
        ], $this);

    }

    public function attributes()
    {
        return [
            'NM_MUN'   => 'nome municipio', 
            'INT_EST'  => 'código estado', 
            'INT_MUN'  => 'código municipio',
        ];
    }

   

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }

    public function setValidation(array $data){

        $validator = FacadesValidator::make($data,$this->rules());
        $this->setValidator( $validator);
    }
}
