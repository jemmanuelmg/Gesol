<?php

namespace Gesol\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidaCorreoContactoRequest extends FormRequest
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
        return [
            'nombre'=>'required|string|min:3',
            'asunto'=>'required|string|min:3',
            'mensaje'=>'required|string|min:3',
            'correo'=>'required|email',
        ];
    }
}
