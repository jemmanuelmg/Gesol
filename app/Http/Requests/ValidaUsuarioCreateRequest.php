<?php

namespace Gesol\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidaUsuarioCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Para activarlo true. Con false no funcionará
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /**El nombre de los campos evaluados depende del nombre de los input
        en el html.
        NO del nombre en la BD.
        **/


        return [

            'cedula'=>'required|numeric|unique:usuarios,usu_cedula',
            'nombres'=>'required|string|min:3',
            'apellidos'=>'required|string|min:3',
            'genero'=>'required|string|in:Femenino,Masculino',
            'fechaNac'=>'required|string',
            'telefono'=>'required|numeric|min:10',
            'token' => 'required|numeric|min:4',
            'token.same:tokenRes' => 'El codigo de confirmación enviado a tu celular no coincide.',
            'correo'=>'required|email|unique:usuarios,email',
            'password'=>'required|string|min:4',
            'password.same:passwordRepeat' => 'Las contraseñas no coinciden',
            'rol'=>'numeric|in:1,2,3,4,5'
        ];
    }
}
