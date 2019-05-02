<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use Validator;


use Carbon\Carbon;
use App\Log;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/administracion';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {

        $this->validate($request, [
            'cedula' => [ 'required' ],
            'password'       => [ 'required' ],
        ]);

        $data = $request;
        $cedula = $data['cedula'];
        $password = $data['password'];

        if (Auth::attempt(['cedula' => $cedula, 'password' => $password]))
        {
            $date = Carbon::now();
            $hoy = $date->format('Y-m-d');
            $hora = $date->format('H:i:s');

            Log::create([
                'fecha_log' => $hoy,
                'hora_log' => $hora,
                'estado' => 1,
                'id_user_log' => Auth::user()->id,
                'ip' => \Request::getClientIp(true),
                'accion' => "Inicio sesión en el sistema",
                            

            
            ]);

            return Redirect::to('/administracion');
        }
        return Redirect::back()->with('mensaje-error', 'Datos incorrectos, vuelve a intentarlo.');



    }
}
