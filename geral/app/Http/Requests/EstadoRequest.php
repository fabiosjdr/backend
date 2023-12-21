<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Fabio\Bibliotecas\MainRequest\MainRequest;

class EstadosRequest extends FormRequest
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
            'INT_EST'     => 'integer|nullable',
            'NM_EST'      => 'string|required',
            'STR_SIGLA'   => 'string|required',
        ], $this);
    }
}
