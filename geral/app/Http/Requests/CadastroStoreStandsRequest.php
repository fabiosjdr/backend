<?php

namespace App\Http\Requests;
use Fabio\Bibliotecas\MainRequest\MainRequest;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator as Validation;
use Illuminate\Http\Exceptions\HttpResponseException;

class CadastroStoreStandsRequest extends FormRequest
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
            'INT_STAND'    => 'integer|nullable',
            'INT_PAG'      => 'integer|nullable',
            'STR_NM'       => 'string|required',
            'STR_NM_FANT'  => 'string|nullable',
            'INT_AREA'     => 'integer|nullable',
            'INT_MUN'      => 'integer|nullable',
            'INT_EST'      => 'integer|nullable',
            'STR_FACE'     => 'string|nullable',
            'STR_INST'     => 'string|nullable',
            'STR_WHAT'     => 'string|nullable',
            'STR_SITE'     => 'string|nullable',
            'STR_TEL'      => 'string|nullable',
            'STR_CEL'      => 'string|nullable',
            'STR_EMAIL'    => 'string|nullable',
            'DESC_TEXT'    => 'string|nullable',
            'DESC_PROD'    => 'string|nullable',
            'LG_CONF'      => 'string|nullable',
            'STR_COTR_INT' => 'string|nullable',
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
