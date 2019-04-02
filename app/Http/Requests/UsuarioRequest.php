<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|between:6,30',
            'path'=>'file|mimes:jpeg,bmp,png|max:10240',
            'cedula' => 'required|max:10',

             
        ];
    }
}
