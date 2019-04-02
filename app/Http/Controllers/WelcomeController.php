<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use App\Departamento;

use App\Comisiones;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Crypt;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\Rule;
use Session;

class WelcomeController extends Controller
{

	public function __construct(){

        
  
        $this->middleware('admin',['only'=>'auth']);
        $this->middleware('guest',['only'=>'index']);
    
    }
    
    public function index()
    {
       
        return view('welcome');
    }


    public function admin(Request $request){

    	
    	

        return view('administracion.index');
    }

    public function invita_bango()
    {
    	return view('administracion.invita_bango');
    }
   

    public function verificacion ($email)
    {
        $usuario = User::where('email', $email)->get();

        $current_timestamp = Carbon::now()->format('Y-m-d H:i:s'); 
       

        if($usuario[0]->email_verified_at == null){

            DB::update('update users set email_verified_at = ? where email = ?', [$current_timestamp, $email]);

            Session::flash('message', 'Tu correo electrónico ha sido verificada exitosamente, procede a loguearte.');

            return redirect('login');
        }else{
            Session::flash('message', 'Tu correo electrónico ha sido verificada anteriormente, procede a loguearte.');            
            return redirect('login');
        }

    }

    public function registrar_departamento(Request $request)
    {
    	return view('administracion.departamento.registrar');
    }

    public function store_departamento(Request $request)
    {
    	$departamento = new Departamento();
    	$departamento->nombre_departamento = $request->nombres;
    	$departamento->descripcion_departamento = $request->descripcion;

        if( $departamento->save() ){
        	Session::flash('message', 'Los datos se han guardado satisfactoriamente.');   
        	return redirect('administracion/departamento/registrar')->with('mensaje-registro', 'Los datos se han guardado satisfactoriamente.');
        }else{
        	Session::flash('message', 'Problemas al registrar los datos.');            
        	return redirect('administracion/departamento/registrar')->with('mensaje-registro2', 'Problemas al registrar los datos.');
        }
    }
    
    public function listado_departamento()
    {
    	$departamento = Departamento::where('estado_departamento',1)->get();

		return view('administracion.departamento.listado', ['departamento' => $departamento]);
    }

    public function actualizar_departamento (Request $request, $id)
    {
    	$departamento = Departamento::findOrFail(Crypt::decrypt($id));   

    	return view('administracion.departamento.actualizar', ['departamento' => $departamento]);
    }
    		
    public function editar_departamento(Request $request)
    {
    	$departamento = Departamento::findOrFail($request->id);
        $departamento->nombre_departamento = $request->nombres;
        $departamento->descripcion_departamento = $request->descripcion;

        if($departamento->save()){
            return redirect('administracion/departamento/actualizar/' . Crypt::encrypt($request->id) )->with('mensaje-registro', 'Datos actualizados correctamente.');
        }
    }

    public function eliminar_departamento(Request $request, $id)
    {
		$departamento = Departamento::findOrFail(Crypt::decrypt($id));  
		$departamento->estado_departamento = "0";

		if($departamento->save()){
            return redirect('administracion/departamento/listado')->with('mensaje-registro', 'Se ha eliminado correctamente.');
        }
    }

    public function registrar_solicitud(Request $request)
    {
    	return view('administracion.solicitudes.registrar');
    }

    public function store_solicitud(Request $request)
    {
    	$departamento = new Departamento();
    	$departamento->nombre_departamento = $request->nombres;
    	$departamento->descripcion_departamento = $request->descripcion;

        if( $departamento->save() ){
        	Session::flash('message', 'Los datos se han guardado satisfactoriamente.');   
        	return redirect('administracion/departamento/registrar')->with('mensaje-registro', 'Los datos se han guardado satisfactoriamente.');
        }else{
        	Session::flash('message', 'Problemas al registrar los datos.');            
        	return redirect('administracion/departamento/registrar')->with('mensaje-registro2', 'Problemas al registrar los datos.');
        }
    }




}