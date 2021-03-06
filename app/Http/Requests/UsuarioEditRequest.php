<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioEditRequest extends FormRequest
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
            'nombres' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'celular' => 'required',
            'id_roles'=>'required',
            'cedula' => 'required|max:10',
            'ciudad' => 'required',
             
        ];
    }
}
