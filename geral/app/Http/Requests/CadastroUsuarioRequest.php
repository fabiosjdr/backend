<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Fabio\Bibliotecas\MainRequest\MainRequest;
use Illuminate\Support\Facades\Validator;

class CadastroUsuarioRequest extends FormRequest
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
            'INT_USU'     => 'integer|nullable',
            'NM_LGN'      => 'string|nullable', 
            'SHA1_SENHA'  => 'string|required',
            'LG_ATV'      => 'in:"S","N"|nullable',
            'LG_SUPER'    => 'in:"S","N"|nullable',
            'CPF_USU'     => 'string|nullable',
            'INT_EST'     => 'integer|nullable',
            'INT_MUN'     => 'integer|nullable',
            'STR_EMAIL'   => 'string|required',
            'STR_NM_USU'  => 'string',
            'STR_TEL'     => 'string',
            
        ], $this);
    }

    public function setValidation(array $data){

        $validator = Validator::make($data,$this->rules());
        $this->setValidator( $validator);
    }
}
