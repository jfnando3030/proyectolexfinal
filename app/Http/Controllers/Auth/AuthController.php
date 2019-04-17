<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Redirect;

use App\User;
use App\Http\Requests\UserFrontendRequest;
use Illuminate\Validation\Rule;
use Mail;
use PHPMailer\PHPMailer\PHPMailer;


class AuthController extends Controller
{
    protected function getRegister(){
        
        return view("auth.register");
    }

    public function postRegister(UserFrontendRequest $request)
    {
                
        User::create([
            'nombres' => $request['nombres'],
            'apellidos' => $request['apellidos'],
            'cedula' => $request['cedula'],
            'ciudad' => $request['ciudad'],
            'direccion' => $request['direccion'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'rol' => "Registrado",
            'telefono' => $request['telefono'],
            'celular' => $request['celular'],
        ]);

        return Redirect::to('login')->with('mensaje-registro', 'Usuario Registrado Correctamente, proceda a logearse');
    }
}
