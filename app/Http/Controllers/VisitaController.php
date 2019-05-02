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


class VisitaController extends Controller
{
    public function visita(Request $request)
  	{
	    $casos = Solicitud::where('id_user_solicitud', $request->user()->id)->where('estado_solicitud', '1')->get();
	    $pagos = Pagos::where('id_user', $request->user()->id)->get();
	    $saber_tarifa = Pagos::where('id_user',$request->user()->id)->where('activo',1)->where('estado',1)->get();
	    $total_respuestas_notificacion = Respuesta::where('leido',0)->where('estado',1)->where('id_user_receptor', Auth::user()->id)->count();

	    $solicitud = DB::select("select  visitas.* from visitas where id_caso in (select id from solicitud)"); 

	    

	    return view('administracion.visita.listado_casos_visita', compact('casos', 'pagos', 'saber_tarifa', 'total_respuestas_notificacion'));
	}

	
	public function registrar_visita(Request $request, $id)
	{

		$date = Carbon::now();

		$visitas = new Visitas();
	    $visitas->fecha = $date;
	    $visitas->id_caso = $id;

	    if( $visitas->save() ){
	    	$request->flush();
	    	return redirect('/administracion/visita')->with('mensaje-registro', 'Los datos se han guardado satisfactoriamente.');
	    }else{
	        $request->flush();
	        return redirect('/administracion/visita')->with('mensaje-error', 'Problemas al registrar los datos.');
	    }
	}

}
