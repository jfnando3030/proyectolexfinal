<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Solicitud;
use App\Archivos;
use App\Pagos;
use App\Tarifa;
use App\Departamento;
use Carbon\Carbon;
use App\Comisiones;
use App\Respuesta;
use App\ArchivosRespuesta;
use Illuminate\Support\Facades\DB;
use Mail;
use App\UserDepartamento;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Log;

use App\Visitas;
use App\VisitasRespuestas;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\Rule;
use Session;
use Validator;
use Illuminate\Notifications\NotifyLawyers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
use App\Http\Requests\VisitaRespuestaRequest;

class VisitaController extends Controller
{
    public function visita(Request $request)
  	{
  		if (Auth::user()->rol == "Abogado"){	
	  		$casos = Solicitud::where('id_user_abogado', Auth::user()->id)->where('estado_solicitud', '1')->where('finalizado_solicitud', '0')->get();

			$pagos = Pagos::where('id_user', $request->user()->id)->get();
			
		    $saber_tarifa = Pagos::where('id_user',$request->user()->id)->where('activo',1)->where('estado',1)->get();
		    $total_respuestas_notificacion = Respuesta::where('leido',0)->where('estado',1)->where('id_user_receptor', Auth::user()->id)->count();

			$solicitud_2 = DB::select("select  visitas.* from visitas where id_caso in (select id from solicitud)");
			
			$solicitud= Collection::make($solicitud_2);
			return view('administracion.visita.listado_casos_visita', compact('casos', 'pagos', 'saber_tarifa', 'total_respuestas_notificacion', 'solicitud'));

  		}else{

	  		$casos = Solicitud::where('id_user_solicitud', $request->user()->id)->where('estado_solicitud', '1')->where('leido_solicitud', '1')->where('finalizado_solicitud', '0')->get();
		    $pagos = Pagos::where('id_user', $request->user()->id)->get();
			$saber_tarifa = Pagos::where('id_user',$request->user()->id)->where('activo',1)->where('estado',1)->get();

			$total_respuestas_notificacion = Respuesta::where('leido',0)->where('estado',1)->where('id_user_receptor', Auth::user()->id)->count();
			
			return view('administracion.visita.listado_casos_visita', compact('casos', 'pagos', 'saber_tarifa', 'total_respuestas_notificacion'));

		   

  		}
	    
	   
	}

	
	public function registrar_visita(Request $request, $id)
	{

		$date = Carbon::now();
		$caso= Solicitud::find($id);

		$visitas = new Visitas();
		$visitas->nombre_solicitud = $caso->nombre_solicitud;
	    $visitas->fecha = $date;	
		$visitas->id_caso = $id;
		
		$caso->visita= 1;
		$caso->save();

	    if( $visitas->save() ){
			$date = Carbon::now();
        $hoy = $date->format('Y-m-d');
        $hora = $date->format('H:i:s');
    
        $ip_navegador= $request['ip_valor1']. ' - ' .$request['navegador1'];
    
        Log::create([
            'fecha_log' => $hoy,
            'hora_log' => $hora,
            'estado' => 1,
            'id_user_log' => Auth::user()->id,
            'ip' =>  $ip_navegador,
            'accion' => "Realizo una petición para un visita",
                        
    
        
        ]);
	    	
	    	$pago_visita = Pagos::where('estado',1)->where('activo',1)->where('id_user', Auth::user()->id)->get();
          	$pago_visita[0]->cantidad_visitas =  $pago_visita[0]->cantidad_visitas + 1;
          	$pago_visita[0]->save();
	    	
	    	$request->flush();
	    	return redirect('/administracion/visita')->with('mensaje-registro', 'La solicitud de visita se envió correctamente.');
	    }else{
	        $request->flush();
	        return redirect('/administracion/visita')->with('mensaje-error', 'Problemas al registrar los datos.');
	    }
	}

	public function visita_responder(Request $request, $id)
  	{
		$id_caso= Crypt::decrypt($id);
  		$casos = Solicitud::where('id_user_abogado', Auth::user()->id)->where('estado_solicitud', '1')->get();
      
	    $pagos = Pagos::where('id_user', $request->user()->id)->get();
	    $saber_tarifa = Pagos::where('id_user',$request->user()->id)->where('activo',1)->where('estado',1)->get();
	    $total_respuestas_notificacion = Respuesta::where('leido',0)->where('estado',1)->where('id_user_receptor', Auth::user()->id)->count();

	    $solicitud = DB::select("select  visitas.* from visitas where id_caso in (select id from solicitud)"); 
	    
	    return view('administracion.visita.registrar', compact('id_caso','casos', 'pagos', 'saber_tarifa', 'total_respuestas_notificacion'));
	}

	public function respuestas_visita(Request $request){

		$casos = Solicitud::where('id_user_solicitud', $request->user()->id)->where('estado_solicitud', '1')->where('leido_solicitud', '1')->where('finalizado_solicitud', '0')->get();
		$respuestas_visitas= VisitasRespuestas::all();
		$saber_tarifa = Pagos::where('id_user',$request->user()->id)->where('activo',1)->where('estado',1)->get();
		$total_respuestas_notificacion = Respuesta::where('leido',0)->where('estado',1)->where('id_user_receptor', Auth::user()->id)->count();

	
		return view('administracion.visita.listado', compact('casos','respuestas_visitas', 'saber_tarifa', 'total_respuestas_notificacion'));
	

	}

	public function visita_responder_post(VisitaRespuestaRequest $request)
  	{
		 
		$visitas = new VisitasRespuestas();
		$visitas->asunto = $request->asunto;
		$visitas->respuesta = $request->respuesta;
		$visitas->fecha = $request->fecha;
		$visitas->hora = $request->hora;
		$visitas->id_visita = $request->caso;
		if( $visitas->save() ){	
			$date = Carbon::now();
        $hoy = $date->format('Y-m-d');
        $hora = $date->format('H:i:s');
    
        $ip_navegador= $request['ip_valor1']. ' - ' .$request['navegador1'];
    
        Log::create([
            'fecha_log' => $hoy,
            'hora_log' => $hora,
            'estado' => 1,
            'id_user_log' => Auth::user()->id,
            'ip' =>  $ip_navegador,
            'accion' => "Realizó una cita con un cliente",
                        
    
        
        ]);	
			return redirect('/administracion/visita')->with('mensaje-registro', 'Su respuesta de visita se envió correctamente.');
		 
		}
	}

}
