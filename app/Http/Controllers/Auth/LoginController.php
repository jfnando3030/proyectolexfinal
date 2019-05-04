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
use Session;
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


    protected function logout(Request $request){
        $date = Carbon::now();
        $hoy = $date->format('Y-m-d');
        $hora = $date->format('H:i:s');
        $ip_navegador="";
      
        if($request['ip_valor5']!=null){
            $ip_navegador= $request['ip_valor5']. ' - ' .$request['navegador5'];

        }else 
        if($request['ip_valor6']!=null){

            $ip_navegador= $request['ip_valor6']. ' - ' .$request['navegador6'];

        }else{

            $ip_navegador= $request['ip_valor7']. ' - ' .$request['navegador7'];

        }

        

        Log::create([
            'fecha_log' => $hoy,
            'hora_log' => $hora,
            'estado' => 1,
            'id_user_log' => Auth::user()->id,
            'ip' =>  $ip_navegador,
            'accion' => "Cerró sesión en el sistema",
                        

        
        ]);
        
        Auth::logout();

        Session::flush();

     

        

        return redirect('/');
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

            $ip_navegador= $request['ip_valor']. ' - ' .$request['navegador'];

            Log::create([
                'fecha_log' => $hoy,
                'hora_log' => $hora,
                'estado' => 1,
                'id_user_log' => Auth::user()->id,
                'ip' =>  $ip_navegador,
                'accion' => "Inicio sesión en el sistema",
                            

            
            ]);

            return Redirect::to('/administracion');
        }
        return Redirect::back()->with('mensaje-error', 'Datos incorrectos, vuelve a intentarlo.');



    }
}
