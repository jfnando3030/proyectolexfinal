<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Solicitud;
use App\Archivos;
use App\Departamento;
use Carbon\Carbon;
use App\Comisiones;
use Illuminate\Support\Facades\DB;
use Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\Rule;
use Session;
use Validator;

use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public $dias = array( ""=>"Seleccione un día" ,1=>"Lunes", 2=>"Martes", 3=>"Miércoles", 4=>"Jueves", 5=>"Viernes", 6=>"Sábado", 7=>"Domingo");

	public function __construct(){
        $this->middleware('admin',['only'=>'auth']);
        $this->middleware('guest',['only'=>'index']);
    }
    
    public function index()
    {
       
        return view('welcome');
    }


    

public function admin(Request $request){

	if(Auth::user()->rol == "Administrador"){
		return view('administracion.index');

	}else {
		if(Auth::user()->rol == "Abogado"){
			$total_solicitudes = Solicitud::where('estado_solicitud',1)->where('leido_solicitud',0)->whereNull('id_user_abogado')->get();

			return view('administracion.index', compact('total_solicitudes'));

		}else{
			return view('administracion.index');

		}
	}
	
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
    	return view('administracion.departamento.registrar', ['dias' => $this->dias]);
    }

    public function store_departamento(Request $request)
    {
		$enviarDatos = true;
		$mensaje1= "";
    	
		if($request->inicioDia >= $request->finDia || $request->inicioHora >= $request->finHora){
			$enviarDatos = false;
			$mensaje1 = 'Revise su horario.';
		}

		if($enviarDatos){
			$departamento = new Departamento();
			$departamento->nombre_departamento = $request->nombres;
			$departamento->descripcion_departamento = $request->descripcion;
			$departamento->horario_inicio = $request->inicioDia;
			$departamento->horario_fin = $request->finDia;
			$departamento->hora_inicio = $request->inicioHora;
			$departamento->hora_fin = $request->finHora;

			if( $departamento->save() ){
				$request->flush();
				return redirect('administracion/departamento/listado/')->with('mensaje-registro', 'Los datos se han guardado satisfactoriamente.');
			}else{
				$request->flush();
				return redirect('administracion/departamento/registrar')->with('mensaje-error', 'Problemas al registrar los datos.');
			}
		}else{
			$request->flash();
			return redirect('administracion/departamento/registrar' )->with('mensaje-error', $mensaje1);
		}
    }
    
    public function listado_departamento()
    {
    	$departamento = Departamento::where('estado_departamento',1)->get();

		return view('administracion.departamento.listado', ['departamento' => $departamento]);
	}
	
	public function listarAbogados()
    {
		$users = DB::table('departamento_user')
			->join('users', 'departamento_user.user_id', '=', 'users.id')
			->join('departamento', 'departamento_user.departamento_id', '=', 'departamento.id')
			->select('users.id' ,'users.nombres', 'users.apellidos', 'users.estado', 'departamento.nombre_departamento', 'departamento.estado_departamento')
			->get();
		return view('administracion.abogados.listado', ['departamento' => $users]);
    }

    public function actualizar_departamento (Request $request, $id)
    {
    	$departamento = Departamento::findOrFail(Crypt::decrypt($id));   

    	return view('administracion.departamento.actualizar', ['departamento' => $departamento, 'dias' => $this->dias]);
    }
    		
    public function editar_departamento(Request $request)
    {
		$enviarDatos = true;
		$mensaje1= "";
    	
		if($request->inicioDia >= $request->finDia || $request->inicioHora >= $request->finHora){
			$enviarDatos = false;
			$mensaje1 = 'Revise su horario.';
		}

		if($enviarDatos){
			$departamento = Departamento::findOrFail($request->id);
			$departamento->nombre_departamento = $request->nombres;
			$departamento->descripcion_departamento = $request->descripcion;
			$departamento->horario_inicio = $request->inicioDia;
			$departamento->horario_fin = $request->finDia;
			$departamento->hora_inicio = $request->inicioHora;
			$departamento->hora_fin = $request->finHora;
			if($departamento->save()){
			return redirect('administracion/departamento/listado')->with('mensaje-registro', 'Datos actualizados correctamente.');
			}
		}else{
			$request->flash();
			return redirect('administracion/departamento/actualizar/' . Crypt::encrypt($request->id) )->with('mensaje-error', $mensaje1);
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
    	$departamento = Departamento::all();
    	return view('administracion.solicitudes.registrar', ['departamento' => $departamento]);
    }

    

public function store_solicitud(Request $request)
{

	$date = Carbon::now();
	$hoy = $date->format('Y-m-d');
	$hora = $date->format('h:i:s');

	$solicitud = new Solicitud();
	$solicitud->nombre_solicitud = $request->nombre;
	$solicitud->descripcion = $request->solicitud;
	$solicitud->id_user_solicitud = $request->user()->id;
	$solicitud->fecha_solicitud = $hoy;
	$solicitud->hora_solicitud = $hora;
	$solicitud->id_departamento = $request->departamento;
	 
	if( $solicitud->save() ){
		
		//  PARA ARCHIVO 1 
		if($request->archivo1 != ""){
			if($request->file('archivo1')){
				$archivos1 = new Archivos();
				$archivos1->path = Storage::disk('local2')->put('archivos',   $request->file('archivo1')); 
				$archivos1->id_solicitud = $solicitud->id;
				$archivos1->save();
			}
		}

		//  PARA ARCHIVO 2
		if($request->archivo2 != ""){
			if($request->file('archivo2')){
				$archivos2 = new Archivos();
				$archivos2->path = Storage::disk('local2')->put('archivos',   $request->file('archivo2')); 
				$archivos2->id_solicitud = $solicitud->id;
				$archivos2->save();
			}
		}

		//  PARA ARCHIVO 3
		if($request->archivo3 != ""){
			if($request->file('archivo3')){
				$archivo3 = new Archivos();
				$archivo3->path = Storage::disk('local2')->put('archivos',   $request->file('archivo3')); 
				$archivo3->id_solicitud = $solicitud->id;
				$archivo3->save();
			}
		}

		//  PARA ARCHIVO 4
		if($request->archivo4 == ""){
			if($request->file('archivo4')){
				$archivo4 = new Archivos();
				$archivo4->path = Storage::disk('local2')->put('archivos',   $request->file('archivo4')); 
				$archivo4->id_solicitud = $solicitud->id;
				$archivo4->save();
			}
		}

		//  PARA ARCHIVO 5
		if($request->archivo5 == ""){
			if($request->file('archivo5')){
				$archivo5 = new Archivos();
				$archivo5->path = Storage::disk('local2')->put('archivos',   $request->file('archivo5')); 
				$archivo5->id_solicitud = $solicitud->id;
				$archivo5->save();
			}
		}

		return redirect('administracion/solicitud/registrar')->with('mensaje-registro', 'Los datos se han guardado satisfactoriamente.');
	}else{
		return redirect('administracion/solicitud/registrarr')->with('mensaje-registro2', 'Problemas al registrar los datos.');
	}
}


    public function listado_solicitud(Request $request)
    {
    	$solicitud = Solicitud::where('id_user_solicitud', $request->user()->id)->where('estado_solicitud',1)->get();

		return view('administracion.solicitudes.listado', ['solicitud' => $solicitud]);
    }

    public function aceptar_casos(Request $request, $id)
    {
		$casos = Solicitud::findOrFail($id);  
    	$casos->leido_solicitud = "1";
    	$casos->id_user_abogado = $request->user()->id;
    	$casos->save();
    }
    
    
  public function gestionar_casos()
  {
	  $solicitud = Solicitud::where('estado_solicitud',1)->whereNotNull('id_user_abogado')->get();
	  //return "hola";
	  return view('administracion.gestionar.listado', ['solicitud' => $solicitud]);
  }


 
  public function gestionar_abogado_casos($id)
  {
	  $solicitud = DB::select("select  * from solicitud where id = ? and estado_solicitud = 1 and id_user_abogado is not null", [$id] ); 
	  $abogado = DB::select("select * from users where id = ? ", [$solicitud[0]->id_user_abogado]); 
	  $abogados = User::where('rol', 'Abogado')->get();

	  return view('administracion.gestionar.actualizar', ['solicitud' => $solicitud, 'abogado' => $abogado,  'abogados' => $abogados]);
  }


    public function actualizar_abogado_caso(Request $request)
    {
    	$casos = Solicitud::findOrFail($request->id);  
    	$casos->id_user_abogado = $request->abogado;
    	if($casos->save()){
            return redirect('administracion/gestionar/casos/listado')->with('mensaje-registro', 'Datos actualizados correctamente.');
        }
    }

}