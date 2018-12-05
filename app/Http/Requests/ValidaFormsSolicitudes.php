<?php

namespace Gesol\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidaFormsSolicitudes extends FormRequest
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
            'imgRecibo' => 'required|mimes:png,jpeg,jpg,gif|file|between:20,5120'
        ];
    }
}
