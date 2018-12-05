<?php

namespace Gesol\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidaSolicitudUpdateRequest extends FormRequest
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

            'nombre'=> 'required|string|in:R-DC-39,R-DC-13,R-DC-14,R-DC-40,R-DC-52',
            'estado'=>'required|string|in:Pendiente,Atendida',
            'cedula'=>'required|numeric|exists:usuarios,usu_cedula'
        ];
    }
}
