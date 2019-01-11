<?php

namespace Gesol\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Route;

class ValidaUsuarioUpdateRequest extends FormRequest
{

    /**Contructor que añade el atributo route a esta clase
    con el valor de la ruta que invoca este request
    **/
    public function __construct(Route $route)
    {

        $this->route = $route;

    }

    

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
        /**Si el usuario no actualiza cedula, debe ignorarse 
        que se vuelva a escribir la misma info en la bd.
        La ultima parte de la validacion revisa que sea unico, 
        ignorando el registro actual obtenido de la ruta indicada en el contructor
        ( usuario/{usuario}      | usuario.update)
        **/

        return [

            'cedula'=> 'numeric','unique:usuarios,usu_cedula,'.Session('usu_cedula'),
            /*
            'nombres'=>'string|min:3',
            'apellidos'=>'string|min:3',
            'genero'=>'string|in:Femenino,Masculino',
            'telefono'=>'numeric',
            'email','unique:usuarios,email,'.Session('usu_cedula'),
            */
            'password'=>'same:repetirContraseña',
            'rol'=>'numeric|in:1,2,3,4,5'
            
        ];
    }
}
