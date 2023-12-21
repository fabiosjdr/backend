<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Fabio\Bibliotecas\MainRequest\MainRequest;

class CadastroLoginRequest extends FormRequest
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
            'NM_LOGN'   => 'string|max:255', 
            'STR_PASS'  => 'string|max:255',
            'NM_DB'     => 'required|string|max:255',

        ], $this);


    }
}
