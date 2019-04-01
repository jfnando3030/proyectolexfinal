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

        if($request['patrocinador'] == "N"){
            User::create([
                'nombres' => $request['nombres'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'codpatrocinador' => $request['cod_patrocinador'],
                'apellidos' => $request['apellidos'],
                'cedula' => $request['cedula'],
                'rol' => "Afiliado",
            ]);

            //$this->notify(new Notifications\VerifyEmail);

            return Redirect::to('login')->with('mensaje-registro', 'Usuario Registrado Correctamente, proceda a logearse');
        }else{
            
            $existe_codigo = User::where('cedula', $request['cod_patrocinador'] )->get();

            if ($existe_codigo->count() == 0){
                $msj = 'El código patrocinador ' . $request['cod_patrocinador'] . '  no esta Registrado';
                return back()->withInput()->with('warning', $msj);
            }else{
                User::create([
                    'nombres' => $request['nombres'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'codpatrocinador' => $request['cod_patrocinador'],
                    'apellidos' => $request['apellidos'],
                    'cedula' => $request['cedula'],
                    'rol' => "Afiliado",
                ]);
                
                return Redirect::to('login')->with('mensaje-registro', 'Usuario Registrado Correctamente, proceda a logearse');

            }
    
        }
    }
}
