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
use App\Log;
use App\Respuesta;
use App\ArchivosRespuesta;
use Illuminate\Support\Facades\DB;
use Mail;
use App\UserDepartamento;
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
use Illuminate\Notifications\NotifyLawyers;
use Illuminate\Support\Collection as Collection;




use Illuminate\Support\Facades\Auth;


class WelcomeController extends Controller
{


  public $dias = array( ""=>"Seleccione un día" ,1=>"Lunes", 2=>"Martes", 3=>"Miércoles", 4=>"Jueves", 5=>"Viernes", 6=>"Sábado", 7=>"Domingo");

  public function __construct()
  {
    $this->middleware('admin', ['only'=>'auth']);
    $this->middleware('guest', ['only'=>'index']);
  }
    
  public function index()
  {
     
      return view('welcome');
  }

  public function getIp()
  {
    $ip= \Request::getClientIp(true);

     dd($ip);
  }

  public function ver_logs(Request $request){

    $logs = Log::where('estado',1)->orderBy('id')->paginate(10);
  
    if ($request->ajax()) {
        return view('logs-ajax', compact('logs'));
    }

    return view('administracion.logs.index',compact('logs'));


  }

  public function admin(Request $request)
  {

    $saber_tarifa = Pagos::where('id_user',$request->user()->id)->where('activo',1)->where('estado',1)->get();

    if(count($saber_tarifa) > 0 and Auth::user()->rol == "registrado" ){
      $saber_si_cumple_condicion_tarifa_y_cantidad_solicitud = Tarifa::where('id', $saber_tarifa[0]->id_tarifa )->get();
      if( $saber_si_cumple_condicion_tarifa_y_cantidad_solicitud[0]->cantidad_consultorias <= $saber_tarifa[0]->cantidad_consultorias ){
        $saber_consultoria = 0;
      }else{
        $saber_consultoria = 1;
      }
    }else{
       $saber_consultoria = 0;
    }
      
    if(Auth::user()->rol == "Administrador"){
      $fechas=DB::table('solicitud')->where('leido_solicitud', 1)->orderBy('fecha_solicitud', 'asc')->distinct()->get(['fecha_solicitud']);
      $fechas2=DB::table('solicitud')->where('finalizado_solicitud', 1)->orderBy('fecha_finalizacion_solicitud', 'asc')->distinct()->get(['fecha_finalizacion_solicitud']);
      
      
      $estadisticas = DB::select('select fecha_solicitud, count(*) as casos  from lex_backoffice.solicitud where lex_backoffice.solicitud.leido_solicitud = 1 group by fecha_solicitud order by fecha_solicitud asc;');
      $estadisticas2 = DB::select('select fecha_finalizacion_solicitud, count(*) as casos  from lex_backoffice.solicitud where lex_backoffice.solicitud.finalizado_solicitud = 1 group by fecha_finalizacion_solicitud order by fecha_finalizacion_solicitud asc;');
      

      $estadisticas_diarias = Collection::make($estadisticas);
      $estadisticas_finalizacion = Collection::make($estadisticas2);
     
      
        $total_clientes = User::where('estado',1)->where('rol',"Registrado")->count();
        $total_aceptados = Solicitud::where('estado_solicitud',1)->where('leido_solicitud',1)->count();

        $total_casos = Solicitud::where('estado_solicitud',1)->count();
        $total_finalizados = Solicitud::where('estado_solicitud',1)->where('finalizado_solicitud',1)->count();
      return view('administracion.index', compact('fechas2','estadisticas_finalizacion','total_aceptados','fechas','estadisticas_diarias','saber_tarifa', 'saber_consultoria', 'total_clientes', 'total_casos', 'total_finalizados'));
  
    }else {
      if(Auth::user()->rol == "Abogado"){
        $total_solicitudes_finalizados = Solicitud::where('estado_solicitud',1)->where('leido_solicitud',0)->whereNull('id_user_abogado')->count();
        
        
        $total_solicitudes_usuario = Solicitud::where('estado_solicitud',1)->where('id_user_abogado', Auth::user()->id )->count();
        $total_finalizados_usuario = Solicitud::where('estado_solicitud',1)->where('id_user_abogado', Auth::user()->id )->where('finalizado_solicitud', 1)->count();
        $total_solicitudes_nuevos = Solicitud::where('estado_solicitud',1)->where('leido_solicitud',0)->count();
       
        $fechas=DB::table('solicitud')->where('leido_solicitud', 1)->orderBy('fecha_solicitud', 'asc')->distinct()->get(['fecha_solicitud']);
        $fechas2=DB::table('solicitud')->where('finalizado_solicitud', 1)->orderBy('fecha_finalizacion_solicitud', 'asc')->distinct()->get(['fecha_finalizacion_solicitud']);
        
        
        $estadisticas = DB::select('select fecha_solicitud, count(*) as casos  from lex_backoffice.solicitud where lex_backoffice.solicitud.leido_solicitud = 1 group by fecha_solicitud order by fecha_solicitud asc;');
        $estadisticas2 = DB::select('select fecha_finalizacion_solicitud, count(*) as casos  from lex_backoffice.solicitud where lex_backoffice.solicitud.finalizado_solicitud = 1 group by fecha_finalizacion_solicitud order by fecha_finalizacion_solicitud asc;');
        
  
        $estadisticas_diarias = Collection::make($estadisticas);
        $estadisticas_finalizacion = Collection::make($estadisticas2);
      
  
        $solicitudes_usuario = Solicitud::where('estado_solicitud',1)->where('id_user_abogado', Auth::user()->id )->get();
        $solicitudes_nuevos = Solicitud::where('estado_solicitud',1)->where('leido_solicitud',0)->orderBy('fecha_solicitud', 'desc')->orderBy('hora_solicitud', 'desc')->get();
        $finalizados_usuarios = Solicitud::where('estado_solicitud',1)->where('id_user_abogado', Auth::user()->id )->where('finalizado_solicitud', 1)->get();
        $user_departamentos = UserDepartamento::where('user_id',Auth::user()->id)->get();

        $respuestas = Respuesta::where('estado',1)->where('id_user_receptor', Auth::user()->id)->orderBy('fecha', 'desc')->orderBy('hora', 'desc')->get();
        $total_respuestas = Respuesta::where('estado',1)->where('id_user_receptor', Auth::user()->id)->count();
        
        
        return view('administracion.index', compact('estadisticas_finalizacion','estadisticas_diarias','estadisticas2','estadisticas','fechas2','fechas','total_respuestas','respuestas','user_departamentos','finalizados_usuarios', 'total_solicitudes_usuario', 'total_finalizados_usuario','total_solicitudes_nuevos', 'solicitudes_nuevos', 'solicitudes_usuario', 'saber_tarifa', 'saber_consultoria'));
  
      }else{

        $fechas=DB::table('solicitud')->where('leido_solicitud', 1)->orderBy('fecha_solicitud', 'asc')->distinct()->get(['fecha_solicitud']);
        $fechas2=DB::table('solicitud')->where('finalizado_solicitud', 1)->orderBy('fecha_finalizacion_solicitud', 'asc')->distinct()->get(['fecha_finalizacion_solicitud']);
        
        
        $estadisticas = DB::select('select fecha_solicitud, count(*) as casos  from lex_backoffice.solicitud where lex_backoffice.solicitud.leido_solicitud = 1 group by fecha_solicitud order by fecha_solicitud asc;');
        $estadisticas2 = DB::select('select fecha_finalizacion_solicitud, count(*) as casos  from lex_backoffice.solicitud where lex_backoffice.solicitud.finalizado_solicitud = 1 group by fecha_finalizacion_solicitud order by fecha_finalizacion_solicitud asc;');
        
  
        $estadisticas_diarias = Collection::make($estadisticas);
        $estadisticas_finalizacion = Collection::make($estadisticas2);


  
        $total_solicitudes_registrados = Solicitud::where('estado_solicitud',1)->where('id_user_solicitud', Auth::user()->id )->count();
        $solicitudes_registrados = Solicitud::where('estado_solicitud',1)->where('id_user_solicitud', Auth::user()->id )->orderBy('fecha_solicitud', 'desc')->orderBy('hora_solicitud', 'desc')->get();
  
       
        $respuestas = Respuesta::where('estado',1)->where('id_user_receptor', Auth::user()->id)->orderBy('fecha', 'desc')->orderBy('hora', 'desc')->get();
        $total_respuestas = Respuesta::where('estado',1)->where('id_user_receptor', Auth::user()->id)->count();

        $total_respuestas_notificacion = Respuesta::where('leido',0)->where('estado',1)->where('id_user_receptor', Auth::user()->id)->count();
       
        $respuestas_notificacion = Respuesta::where('leido',0)->where('estado',1)->where('id_user_receptor', Auth::user()->id)->orderBy('fecha', 'desc')->orderBy('hora', 'desc')->take(3)->get();
        

  
        return view('administracion.index', compact('estadisticas_finalizacion','estadisticas_diarias','estadisticas2','estadisticas','fechas2','fechas','respuestas_notificacion','total_respuestas_notificacion','total_respuestas','respuestas','total_solicitudes_registrados','solicitudes_registrados', 'saber_tarifa', 'saber_consultoria'));
  
      }
    }    
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
    $saber_tarifa = Pagos::where('id_user',$request->user()->id)->where('activo',1)->where('estado',1)->get();
    return view('administracion.departamento.registrar', ['dias' => $this->dias,'saber_tarifa' => $saber_tarifa]);
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
            'accion' => "Ingreso un nuevo registro de dapartamento al sistema",
                        
    
        
        ]);

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
    
  public function listado_departamento( Request $request)
  {
    $departamento = Departamento::where('estado_departamento',1)->get();
    $saber_tarifa = Pagos::where('id_user',$request->user()->id)->where('activo',1)->where('estado',1)->get();
    return view('administracion.departamento.listado', ['departamento' => $departamento, 'saber_tarifa' => $saber_tarifa]);
  }
  
	public function listarAbogados(Request $request)
	{
    
  	$users = DB::table('departamento_user')
  		->join('users', 'departamento_user.user_id', '=', 'users.id')
  		->join('departamento', 'departamento_user.departamento_id', '=', 'departamento.id')
  		->select('users.id' ,'users.nombres', 'users.apellidos', 'departamento.nombre_departamento')
  		->where([['departamento.estado_departamento','=',1],['users.estado','=',1]])
  		->distinct()
  		->get();

  		$ids = Array();
  		foreach($users as $u){
  			array_push($ids, $u->id);
  		}

  	$ids = array_unique($ids);
  	$usuario = User::find($ids);

    $saber_tarifa = Pagos::where('id_user',$request->user()->id)->where('activo',1)->where('estado',1)->get();
   
   
   
  	return view('administracion.abogados.listado', ['usuario'=>$usuario, 'departamento' => $users, 'saber_tarifa' => $saber_tarifa]);
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
            'accion' => "Actualizó un registro de dapartamento en el sistema",
                        
    
        
        ]); 
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
          'accion' => "Actualizó un registro de dapartamento en el sistema",
                      
  
      
      ]); 
      return redirect('administracion/departamento/listado')->with('mensaje-registro', 'Se ha eliminado correctamente.');
    }
  }

  public function registrar_solicitud(Request $request)
  {
    $departamento = Departamento::all();
    $respuestas_notificacion = Respuesta::where('leido',0)->where('id_user_receptor', Auth::user()->id)->take(3)->get();

    $total_respuestas_notificacion = Respuesta::where('leido',0)->where('id_user_receptor', Auth::user()->id)->count();

    $saber_tarifa = Pagos::where('id_user',$request->user()->id)->where('activo',1)->where('estado',1)->get();

    if(count($saber_tarifa) > 0 ){
      
      $saber_si_cumple_condicion_tarifa_y_cantidad_solicitud = Tarifa::where('id', $saber_tarifa[0]->id_tarifa )->get();
      if( $saber_si_cumple_condicion_tarifa_y_cantidad_solicitud[0]->cantidad_consultorias <= $saber_tarifa[0]->cantidad_consultorias ){
        $saber_consultoria = 0;
      }else{
        $saber_consultoria = 1;
      }
    }else{
     
      $saber_consultoria = 0;
    }

    return view('administracion.solicitudes.registrar', ['departamento' => $departamento, 'total_respuestas_notificacion' => $total_respuestas_notificacion, 'respuestas_notificacion'=>$respuestas_notificacion, 'saber_tarifa'=>$saber_tarifa, 'saber_consultoria'=>$saber_consultoria ]);
  }

  public function store_solicitud(Request $request)
  {

    $saber_tarifa = Pagos::where('id_user',$request->user()->id)->where('activo',1)->where('estado',1)->get();

    if(count($saber_tarifa) > 0 ){
      $saber_si_cumple_condicion_tarifa_y_cantidad_solicitud = Tarifa::where('id', $saber_tarifa[0]->id_tarifa )->get();
      if( $saber_si_cumple_condicion_tarifa_y_cantidad_solicitud[0]->cantidad_consultorias <= $saber_tarifa[0]->cantidad_consultorias ){
        $saber_consultoria = 0;
      }else{
        $date = Carbon::now();
        $hoy = $date->format('Y-m-d');
        $hora = $date->format('H:i:s');

        $solicitud = new Solicitud();
        $solicitud->nombre_solicitud = $request->nombre;
        $solicitud->descripcion = $request->solicitud;
        $solicitud->id_user_solicitud = $request->user()->id;
        $solicitud->fecha_solicitud = $hoy;
        $solicitud->hora_solicitud = $hora;
        $solicitud->id_departamento = $request->departamento;

        $bandera=false;
         
        if( $solicitud->save() ){

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
            'accion' => "Realizó una solicitud de un caso ",
                        
    
        
        ]);

          $pago_consultoria = Pagos::where('estado',1)->where('activo',1)->where('id_user', Auth::user()->id)->get();
          $pago_consultoria[0]->cantidad_consultorias =  $pago_consultoria[0]->cantidad_consultorias + 1;
          $pago_consultoria[0]->save();

          //  PARA ARCHIVO 1 
          if($request->archivo1 != ""){
            if($request->file('archivo1')){
              $archivos1 = new Archivos();
              $archivos1->path = Storage::disk('local2')->put('archivos',   $request->file('archivo1')); 
              $archivos1->id_solicitud = $solicitud->id;
              $bandera=true;
              $archivos1->save();
            }
          }

          //  PARA ARCHIVO 2
          if($request->archivo2 != ""){
            if($request->file('archivo2')){
              $archivos2 = new Archivos();
              $archivos2->path = Storage::disk('local2')->put('archivos',   $request->file('archivo2')); 
              $archivos2->id_solicitud = $solicitud->id;
              $bandera=true;
              $archivos2->save();
            }
          }

          //  PARA ARCHIVO 3
          if($request->archivo3 != ""){
            if($request->file('archivo3')){
              $archivo3 = new Archivos();
              $archivo3->path = Storage::disk('local2')->put('archivos',   $request->file('archivo3')); 
              $archivo3->id_solicitud = $solicitud->id;
              $bandera=true;
              $archivo3->save();
            }
          }

          //  PARA ARCHIVO 4
          if($request->archivo4 == ""){
            if($request->file('archivo4')){
              $archivo4 = new Archivos();
              $archivo4->path = Storage::disk('local2')->put('archivos',   $request->file('archivo4')); 
              $archivo4->id_solicitud = $solicitud->id;
              $bandera=true;
              $archivo4->save();
            }
          }

          //  PARA ARCHIVO 5
          if($request->archivo5 == ""){
            if($request->file('archivo5')){
              $archivo5 = new Archivos();
              $archivo5->path = Storage::disk('local2')->put('archivos',   $request->file('archivo5')); 
              $archivo5->id_solicitud = $solicitud->id;
              $bandera=true;
              $archivo5->save();
            }
          }

          if($bandera){
            $solicitud_busqueda = Solicitud::find($solicitud->id);
            $solicitud_busqueda->tiene_archivo_adjunto = 1;
            $solicitud_busqueda->save();

          }

          $id_departamento = $request->departamento;
          $usuarios = DB::table('departamento_user')
          ->join('users', function($join) use($id_departamento){
            $join->on('departamento_user.user_id', '=', 'users.id')
            ->where([
              ['departamento_user.departamento_id', $id_departamento],
              [ 'users.estado', '1' ]
            ]);
          })
          ->select('users.id', 'departamento_user.departamento_id')
          ->get();

          
          return redirect('administracion')->with('mensaje-registro', 'La solicitud ha sido enviado correctamente.');
        }else{
          return redirect('administracion')->with('mensaje-registro2', 'Problemas al enviar los datos.');
        }
      }
    }

   
  }

  public function listado_solicitud(Request $request)
  {
    $solicitud = Solicitud::where('id_user_solicitud', $request->user()->id)->where('estado_solicitud',1)->get();
    return view('administracion.solicitudes.listado', ['solicitud' => $solicitud]);
  }

  public function aceptar_casos(Request $request, $id)
  {
    $date = Carbon::now();
    $hoy = $date->format('Y-m-d');
    $hora = $date->format('H:i:s');
    $casos = Solicitud::findOrFail($id);  
    $casos->leido_solicitud = "1";
    $casos->id_user_abogado = $request->user()->id;
    $casos->fecha_aceptar_solicitud= $hoy;
    $casos->hora_aceptar_solicitud= $hora;

    if($casos->save()){
     
    
        $ip_navegador= $request['ip_valor1']. ' - ' .$request['navegador1'];
    
        Log::create([
            'fecha_log' => $hoy,
            'hora_log' => $hora,
            'estado' => 1,
            'id_user_log' => Auth::user()->id,
            'ip' =>  $ip_navegador,
            'accion' => "Aceptó un nuevo caso",
                        
    
        
        ]);
      return redirect('administracion')->with('mensaje-registro', 'Caso aceptado exitosamente.');
    }
  
  }

  public function ver_caso(Request $request, $id)
  {
    $caso = Solicitud::findOrFail(Crypt::decrypt($id));  
    $archivos = Archivos::where('id_solicitud',Crypt::decrypt($id))->get();
  
    $total_respuestas_notificacion = Respuesta::where('leido',0)->where('id_user_receptor', Auth::user()->id)->count();
    $respuestas_notificacion = Respuesta::where('leido',0)->where('id_user_receptor', Auth::user()->id)->take(3)->get();
    $saber_tarifa = Pagos::where('id_user',$request->user()->id)->where('activo',1)->where('estado',1)->get();

    return view('administracion.aceptar_caso.index',compact('respuestas_notificacion','total_respuestas_notificacion','caso', 'archivos', 'saber_tarifa'));
  }

  public function ver_respuesta(Request $request, $id)
  {
    $nuevo_id= Crypt::decrypt($id);  
      
    $notificacion = Respuesta::find($nuevo_id);
    $notificacion->leido = 1;
    $notificacion->save();

    $respuesta = Respuesta::findOrFail($nuevo_id);  
    $archivos = ArchivosRespuesta::where('id_respuesta',$nuevo_id)->get();
    $total_respuestas_notificacion = Respuesta::where('leido',0)->where('id_user_receptor', Auth::user()->id)->count();
    $respuestas_notificacion = Respuesta::where('leido',0)->where('id_user_receptor', Auth::user()->id)->take(3)->get();
   
    return view('administracion.responder.index',compact('respuestas_notificacion','total_respuestas_notificacion','respuesta', 'archivos'));
  }

  public function ver_respuesta2(Request $request, $id)
  {
    $nuevo_id= Crypt::decrypt($id);
    $notificacion = Respuesta::find($nuevo_id);
    $notificacion->leido = 1;
    $notificacion->save();

    $respuesta = Respuesta::findOrFail($nuevo_id);  
    $archivos = ArchivosRespuesta::where('id_respuesta',$nuevo_id)->get();
    $total_respuestas_notificacion = Respuesta::where('leido',0)->where('id_user_receptor', Auth::user()->id)->count();
    $respuestas_notificacion = Respuesta::where('leido',0)->where('id_user_receptor', Auth::user()->id)->take(3)->get();

    return view('administracion.responder.index-abogado',compact('respuestas_notificacion','total_respuestas_notificacion','respuesta', 'archivos'));
  }

  public function gestionar_casos(Request $request)
  {
    $solicitud = Solicitud::where('estado_solicitud',1)->whereNotNull('id_user_abogado')->get();
    $saber_tarifa = Pagos::where('id_user',$request->user()->id)->where('activo',1)->where('estado',1)->get();

    return view('administracion.gestionar.listado', ['solicitud' => $solicitud, 'saber_tarifa' => $saber_tarifa]);
  }
 
  public function gestionar_abogado_casos(Request $request, $id)
  {
    $solicitud = DB::select("select  solicitud.*, departamento.* from solicitud, departamento where solicitud.id_departamento = departamento.id and solicitud.id = ? and solicitud.estado_solicitud = 1 and solicitud.id_user_abogado is not null", [Crypt::decrypt($id)] ); 

    $area = DB::select("select  departamento.id from solicitud, departamento where solicitud.id_departamento = departamento.id and solicitud.id = ? and solicitud.estado_solicitud = 1 and solicitud.id_user_abogado is not null", [Crypt::decrypt($id)] );

    $abogados = DB::select("select * from users where id in (select user_id from departamento_user where departamento_id = ?)", [$area[0]->id] );   

    $abogado = DB::select("select * from users where id = ? ", [$solicitud[0]->id_user_abogado]); 
    
    $saber_tarifa = Pagos::where('id_user',$request->user()->id)->where('activo',1)->where('estado',1)->get();

    return view('administracion.gestionar.actualizar', ['solicitud' => $solicitud, 'abogado' => $abogado,  'abogados' => $abogados,'saber_tarifa' => $saber_tarifa]);
  }

  public function actualizar_abogado_caso(Request $request)
  {
    $casos = Solicitud::findOrFail($request->id);  
    $casos->id_user_abogado = $request->abogado;

    $abogado = User::findOrFail($request->abogado);
    $cliente = User::findOrFail($casos->id_user_solicitud);  

    if($casos->save()){

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
          'accion' => "Asignó un caso a otro abogado",
                      
  
      
      ]);


      // NOTIFICA AL ABOGADO
      $emaiL_abogado =$abogado->email;
      $nombres_abogado = $abogado->nombres . ' ' . $abogado->apellidos;
      $nombres_cliente = $cliente->nombres . ' ' . $cliente->apellidos;

      $codigohtml = '
          <head>
              <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet">
              <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
           </head>

           <body style="background-color:white;">
              <div style="width:100%; background-color:#003364; text-align:center;">
              <br>    
                  <div style="width:550px;margin:50px auto; background-color:white;">
                      <div style="width:100%; padding-top:35px; padding-bottom:15px;">
                          <img width="213" border="0" style="width: 213px;" src="http://35.237.74.133/frontend/images/redondo.png" alt="" />
                      </div>
                      <div style="width:100%; color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;">
                          <p style="color:#999; line-height:0px;margin-top:-15px;">_</p>
                      </div>
                      <div style="color: #888888; font-size: 16px; font-family: Work Sans, Calibri, sans-serif; line-height: 24px; width:400px; margin:30px auto; text-align:center;">

                        <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify"> Hola ' . $nombres_abogado  . ', te escribimos para notificarte que se te ha asignado el caso: ' . $casos->nombre_solicitud . ', el cual pertenece a ' . $nombres_cliente  . '.</p>

                        <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify">&iexcl;Un abrazo!,<br/>
                           El equipo de Merino&Asociados<br/>
                        <p style="font-family: Verdana, Geneva, sans-serif; font-size: 11px;"><span><strong>ESTA ES UNA COMUNICACI&Oacute;N AUTOM&Aacute;TICA, POR FAVOR NO RESPONDER.</strong></span></p>
                      </div>
                          
                      <div style="width:550px;margin:0px auto; color:#999; font-family: Work Sans, Calibri, sans-serif;background-color: dimgray; padding-top:10px; padding-bottom:10px;">
                          <table style="margin:auto auto;">
                              <tr>
                                  <td width="90" style="color:#999; font-family: Work Sans, calibri, sans-serif;font-size:13px; font-weight:bold;">
                                      <p style="color: white; ">S&iacute;guenos:</p>
                                  </td>               
                                  <td width="250">
                                  <p><a href="https://www.twitter.com/BangoEc" target="_blank"><img width="50" src="http://download.seaicons.com/download/i49182/yootheme/social-bookmark/yootheme-social-bookmark-social-twitter-button-blue.ico" alt="twitter" style="margin-right:15px;"/></a>
                                  <a href="https://www.facebook.com/BangoEnergyGel/" target="_blank"><img width="50" src="https://cdn0.iconfinder.com/data/icons/yooicons_set01_socialbookmarks/512/social_facebook_button_blue.png" alt="twitter" style="margin-right:15px;"/></a>
                                  <a href="https://www.instagram.com/bangoenergygel/" target="_blank"><img width="50" src="https://3.bp.blogspot.com/-PLtBjidnB-o/W5Ap8VkGNTI/AAAAAAAAAv4/5WmcJdRBWN0ut_7Kuq5AI1E_di6XaRh3ACLcBGAs/s1600/instagram-colourful-icon.png" alt="twitter"/></a></p>
                                  </td>
                              </tr>
                          </table>            
                      </div>
                  </div>
                  <div style="width:550px;margin:0px auto; color:#666; font-family: Work Sans, Calibri, sans-serif;font-size:12px;">
                      Esta es una comunicaci&oacute;n autom&aacute;tica, no responder a esta direcci&oacute;n de correo.
                  </div>
              </div>
          </body>
      ';

      $mail = new PHPMailer(true);
      $mail->IsSMTP();
      $mail->SMTPDebug = 0;
      $mail->SMTPAuth = true; //'login'
      $mail->SMTPSecure = 'ssl';
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 465;              
      $mail->IsHTML(true);
      $mail->CharSet = 'UTF-8';

      //confirmaciones
      $mail->Username = 'gerencia@geomarvaldez.com';
      $mail->Password = 'Geomar2018';
      $mail->SetFrom('gerencia@geomarvaldez.com', 'Notificaciones Merino & Asociados');
      $mail->Subject = html_entity_decode('Cambio de abogado');
          
      $mail->Body = $codigohtml;      
      $mail->AddAddress($emaiL_abogado);
      $mail->Send();


      // NOTIFICANDO AL CLIENTE 

       // NOTIFICA AL ABOGADO

      $emaiL_cliente =$cliente->email;

      $codigohtml = '
          <head>
              <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet">
              <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
           </head>

           <body style="background-color:white;">
              <div style="width:100%; background-color:#003364; text-align:center;">
              <br>    
                  <div style="width:550px;margin:50px auto; background-color:white;">
                      <div style="width:100%; padding-top:35px; padding-bottom:15px;">
                          <img width="213" border="0" style="width: 213px;" src="http://35.237.74.133/frontend/images/redondo.png" alt="" />
                      </div>
                      <div style="width:100%; color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;">
                          <p style="color:#999; line-height:0px;margin-top:-15px;">_</p>
                      </div>
                      <div style="color: #888888; font-size: 16px; font-family: Work Sans, Calibri, sans-serif; line-height: 24px; width:400px; margin:30px auto; text-align:center;">

                        <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify"> Hola ' . $nombres_cliente  . ', te escribimos para notificarte que tu caso: ' . $casos->nombre_solicitud . ' ha sido cambiado al Abogado ' . $nombres_abogado  . '.</p>

                        <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify">&iexcl;Un abrazo!,<br/>
                           El equipo de Merino&Asociados<br/>
                        <p style="font-family: Verdana, Geneva, sans-serif; font-size: 11px;"><span><strong>ESTA ES UNA COMUNICACI&Oacute;N AUTOM&Aacute;TICA, POR FAVOR NO RESPONDER.</strong></span></p>
                      </div>
                          
                      <div style="width:550px;margin:0px auto; color:#999; font-family: Work Sans, Calibri, sans-serif;background-color: dimgray; padding-top:10px; padding-bottom:10px;">
                          <table style="margin:auto auto;">
                              <tr>
                                  <td width="90" style="color:#999; font-family: Work Sans, calibri, sans-serif;font-size:13px; font-weight:bold;">
                                      <p style="color: white; ">S&iacute;guenos:</p>
                                  </td>               
                                  <td width="250">
                                  <p><a href="https://www.twitter.com/BangoEc" target="_blank"><img width="50" src="http://download.seaicons.com/download/i49182/yootheme/social-bookmark/yootheme-social-bookmark-social-twitter-button-blue.ico" alt="twitter" style="margin-right:15px;"/></a>
                                  <a href="https://www.facebook.com/BangoEnergyGel/" target="_blank"><img width="50" src="https://cdn0.iconfinder.com/data/icons/yooicons_set01_socialbookmarks/512/social_facebook_button_blue.png" alt="twitter" style="margin-right:15px;"/></a>
                                  <a href="https://www.instagram.com/bangoenergygel/" target="_blank"><img width="50" src="https://3.bp.blogspot.com/-PLtBjidnB-o/W5Ap8VkGNTI/AAAAAAAAAv4/5WmcJdRBWN0ut_7Kuq5AI1E_di6XaRh3ACLcBGAs/s1600/instagram-colourful-icon.png" alt="twitter"/></a></p>
                                  </td>
                              </tr>
                          </table>            
                      </div>
                  </div>
                  <div style="width:550px;margin:0px auto; color:#666; font-family: Work Sans, Calibri, sans-serif;font-size:12px;">
                      Esta es una comunicaci&oacute;n autom&aacute;tica, no responder a esta direcci&oacute;n de correo.
                  </div>
              </div>
          </body>
      ';

      $mail = new PHPMailer(true);
      $mail->IsSMTP();
      $mail->SMTPDebug = 0;
      $mail->SMTPAuth = true; //'login'
      $mail->SMTPSecure = 'ssl';
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 465;              
      $mail->IsHTML(true);
      $mail->CharSet = 'UTF-8';

      //confirmaciones
      $mail->Username = 'gerencia@geomarvaldez.com';
      $mail->Password = 'Geomar2018';
      $mail->SetFrom('gerencia@geomarvaldez.com', 'Notificaciones Merino & Asociados');
      $mail->Subject = html_entity_decode('Cambio de abogado');
          
      $mail->Body = $codigohtml;      
      $mail->AddAddress($emaiL_cliente);
      $mail->Send();

      return redirect('administracion/gestionar')->with('mensaje-registro', 'Datos actualizados correctamente.');
    }
  }

  public function registrar_respuesta(Request $request, $id)
  {
    //$departamento = Departamento::all();
    $casos = Solicitud::findOrFail(Crypt::decrypt($id)); 
    $saber_tarifa = Pagos::where('id_user',$request->user()->id)->where('activo',1)->where('estado',1)->get();

    return view('administracion.respuesta.registrar', ['casos' => $casos, 'saber_tarifa' => $saber_tarifa]);
  }

  public function store_respuesta(Request $request)
  {

    $date = Carbon::now();
    $hoy = $date->format('Y-m-d');
    $hora = $date->format('H:i:s');

    $respuesta = new Respuesta();
    $respuesta->titulo = $request->nombre;
    $respuesta->respuesta = $request->respuesta;
    $respuesta->fecha = $hoy;
    $respuesta->hora = $hora;
    $respuesta->solicitud_id = $request->id_solicitud;
    $respuesta->id_user_receptor = $request->id_user_receptor;

    $bandera=false;
     
    if( $respuesta->save() ){

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
            'accion' => "Respondió a una de las solicitudes de algún caso.",
                        
    
        
        ]);
      
      //  PARA ARCHIVO 1 
      if($request->archivo1 != ""){
        if($request->file('archivo1')){
          $archivos1 = new ArchivosRespuesta();
          $archivos1->path = Storage::disk('local2')->put('respuesta',   $request->file('archivo1')); 
          $archivos1->id_respuesta = $respuesta->id;
          $bandera=true;
          $archivos1->save();
        }
      }

      //  PARA ARCHIVO 2
      if($request->archivo2 != ""){
        if($request->file('archivo2')){
          $archivos2 = new ArchivosRespuesta();
          $archivos2->path = Storage::disk('local2')->put('respuesta',   $request->file('archivo2')); 
          $archivos2->id_respuesta = $respuesta->id;
          $bandera=true;
          $archivos2->save();
        }
      }

      //  PARA ARCHIVO 3
      if($request->archivo3 != ""){
        if($request->file('archivo3')){
          $archivo3 = new ArchivosRespuesta();
          $archivo3->path = Storage::disk('local2')->put('respuesta',   $request->file('archivo3')); 
          $archivo3->id_respuesta = $respuesta->id;
          $bandera=true;
          $archivo3->save();
        }
      }

      //  PARA ARCHIVO 4
      if($request->archivo4 == ""){
        if($request->file('archivo4')){
          $archivo4 = new ArchivosRespuesta();
          $archivo4->path = Storage::disk('local2')->put('respuesta',   $request->file('archivo4')); 
          $archivo4->id_respuesta = $respuesta->id;
          $bandera=true;
          $archivo4->save();
        }
      }

      //  PARA ARCHIVO 5
      if($request->archivo5 == ""){
        if($request->file('archivo5')){
          $archivo5 = new ArchivosRespuesta();
          $archivo5->path = Storage::disk('local2')->put('respuesta',   $request->file('archivo5')); 
          $archivo5->id_respuesta = $respuesta->id;
          $bandera=true;
          $archivo5->save();
        }
      }

      if($bandera){
        $respuesta_busqueda = Respuesta::find($respuesta->id);
        $respuesta_busqueda->tiene_archivo_adjunto = 1;
        $respuesta_busqueda->save();

      }
      
      $usuario_respuesta = User::findOrFail($request->id_user_receptor); 
      $nombres_respuesta = $usuario_respuesta->nombres . ' ' . $usuario_respuesta->apellidos;

      $emailto =$usuario_respuesta->email;

      $nombres_abogado = $request->user()->nombres . ' ' . $request->user()->apellidos;

      $codigohtml = '
          <head>
              <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet">
              <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
           </head>

           <body style="background-color:white;">
              <div style="width:100%; background-color:#003364; text-align:center;">
              <br>    
                  <div style="width:550px;margin:50px auto; background-color:white;">
                      <div style="width:100%; padding-top:35px; padding-bottom:15px;">
                          <img width="213" border="0" style="width: 213px;" src="http://35.237.74.133/frontend/images/redondo.png" alt="" />
                      </div>
                      <div style="width:100%; color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;">
                          <p style="color:#999; line-height:0px;margin-top:-15px;">_</p>
                      </div>
                      <div style="color: #888888; font-size: 16px; font-family: Work Sans, Calibri, sans-serif; line-height: 24px; width:400px; margin:30px auto; text-align:center;">

                        <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify"> Hola ' . $nombres_respuesta  . ', te escribimos para notificarte que el abogado ' . $nombres_abogado . ' ha respondido a tu solicitud.</p>

                        <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify"> Para ver la respuesta da clic en el siguiente enlace.</p>

                        <a href="http://35.237.74.133/administracion/casos/respuesta/' . Crypt::encrypt($respuesta->id ) . '" style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:center"> Da clic en este enlace </a>

                        <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify">&iexcl;Un abrazo!,<br/>
                           El equipo de Merino&Asociados<br/>
                        <p style="font-family: Verdana, Geneva, sans-serif; font-size: 11px;"><span><strong>ESTA ES UNA COMUNICACI&Oacute;N AUTOM&Aacute;TICA, POR FAVOR NO RESPONDER.</strong></span></p>
                      </div>
                          
                      <div style="width:550px;margin:0px auto; color:#999; font-family: Work Sans, Calibri, sans-serif;background-color: dimgray; padding-top:10px; padding-bottom:10px;">
                          <table style="margin:auto auto;">
                              <tr>
                                  <td width="90" style="color:#999; font-family: Work Sans, calibri, sans-serif;font-size:13px; font-weight:bold;">
                                      <p style="color: white; ">S&iacute;guenos:</p>
                                  </td>               
                                  <td width="250">
                                  <p><a href="https://www.twitter.com/BangoEc" target="_blank"><img width="50" src="http://download.seaicons.com/download/i49182/yootheme/social-bookmark/yootheme-social-bookmark-social-twitter-button-blue.ico" alt="twitter" style="margin-right:15px;"/></a>
                                  <a href="https://www.facebook.com/BangoEnergyGel/" target="_blank"><img width="50" src="https://cdn0.iconfinder.com/data/icons/yooicons_set01_socialbookmarks/512/social_facebook_button_blue.png" alt="twitter" style="margin-right:15px;"/></a>
                                  <a href="https://www.instagram.com/bangoenergygel/" target="_blank"><img width="50" src="https://3.bp.blogspot.com/-PLtBjidnB-o/W5Ap8VkGNTI/AAAAAAAAAv4/5WmcJdRBWN0ut_7Kuq5AI1E_di6XaRh3ACLcBGAs/s1600/instagram-colourful-icon.png" alt="twitter"/></a></p>
                                  </td>
                              </tr>
                          </table>            
                      </div>
                  </div>
                  <div style="width:550px;margin:0px auto; color:#666; font-family: Work Sans, Calibri, sans-serif;font-size:12px;">
                      Esta es una comunicaci&oacute;n autom&aacute;tica, no responder a esta direcci&oacute;n de correo.
                  </div>
              </div>
          </body>
      ';

      $mail = new PHPMailer(true);
      $mail->IsSMTP();
      $mail->SMTPDebug = 0;
      $mail->SMTPAuth = true; //'login'
      $mail->SMTPSecure = 'ssl';
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 465;              
      $mail->IsHTML(true);
      $mail->CharSet = 'UTF-8';

      //confirmaciones
      $mail->Username = 'gerencia@geomarvaldez.com';
      $mail->Password = 'Geomar2018';
      $mail->SetFrom('gerencia@geomarvaldez.com', 'Notificaciones Merino & Asociados');
      $mail->Subject = html_entity_decode('Respuesta del abogado');
          
      $mail->Body = $codigohtml;      
      $mail->AddAddress($emailto);
      $mail->Send();

      return redirect('administracion')->with('mensaje-registro', 'Respuesta enviada correctamente.');
    }else{
      return redirect('administracion')->with('mensaje-registro2', 'Problemas al enviar la respuesta.');
    }
  }

  public function store_respuesta2(Request $request)
  {

    $date = Carbon::now();
    $hoy = $date->format('Y-m-d');
    $hora = $date->format('H:i:s');

    $respuesta = new Respuesta();
    $respuesta->titulo = $request->nombre;
    $respuesta->respuesta = $request->respuesta;
    $respuesta->fecha = $hoy;
    $respuesta->hora = $hora;
    $respuesta->solicitud_id = $request->id_solicitud;
    $respuesta->id_autorespuesta = $request->id_auto_respuesta;
    $respuesta->id_user_receptor = $request->id_user_receptor;
    $bandera=false;
     
    if( $respuesta->save() ){

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
            'accion' => "Respondió a una solicitud de algún caso",
                        
    
        
        ]);
      
      //  PARA ARCHIVO 1 
      if($request->archivo1 != ""){
        if($request->file('archivo1')){
          $archivos1 = new ArchivosRespuesta();
          $archivos1->path = Storage::disk('local2')->put('respuesta',   $request->file('archivo1')); 
          $archivos1->id_respuesta = $respuesta->id;
          $bandera=true;
          $archivos1->save();
        }
      }

      //  PARA ARCHIVO 2
      if($request->archivo2 != ""){
        if($request->file('archivo2')){
          $archivos2 = new ArchivosRespuesta();
          $archivos2->path = Storage::disk('local2')->put('respuesta',   $request->file('archivo2')); 
          $archivos2->id_respuesta = $respuesta->id;
          $bandera=true;
          $archivos2->save();
        }
      }

      //  PARA ARCHIVO 3
      if($request->archivo3 != ""){
        if($request->file('archivo3')){
          $archivo3 = new ArchivosRespuesta();
          $archivo3->path = Storage::disk('local2')->put('respuesta',   $request->file('archivo3')); 
          $archivo3->id_respuesta = $respuesta->id;
          $bandera=true;
          $archivo3->save();
        }
      }

      //  PARA ARCHIVO 4
      if($request->archivo4 == ""){
        if($request->file('archivo4')){
          $archivo4 = new ArchivosRespuesta();
          $archivo4->path = Storage::disk('local2')->put('respuesta',   $request->file('archivo4')); 
          $archivo4->id_respuesta = $respuesta->id;
          $bandera=true;
          $archivo4->save();
        }
      }

      //  PARA ARCHIVO 5
      if($request->archivo5 == ""){
        if($request->file('archivo5')){
          $archivo5 = new ArchivosRespuesta();
          $archivo5->path = Storage::disk('local2')->put('respuesta',   $request->file('archivo5')); 
          $archivo5->id_respuesta = $respuesta->id;
          $bandera=true;
          $archivo5->save();
        }
      }

      if($bandera){
        $respuesta_busqueda = Respuesta::find($respuesta->id);
        $respuesta_busqueda->tiene_archivo_adjunto = 1;
        $respuesta_busqueda->save();

      }


      $usuario_respuesta = User::findOrFail($request->id_user_receptor); 
      $nombres_respuesta = $usuario_respuesta->nombres . ' ' . $usuario_respuesta->apellidos;

      $emailto =$usuario_respuesta->email;

      $nombres_abogado = $request->user()->nombres . ' ' . $request->user()->apellidos;

      $codigohtml = '
          <head>
              <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet">
              <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
           </head>

           <body style="background-color:white;">
              <div style="width:100%; background-color:#003364; text-align:center;">
              <br>    
                  <div style="width:550px;margin:50px auto; background-color:white;">
                      <div style="width:100%; padding-top:35px; padding-bottom:15px;">
                          <img width="213" border="0" style="width: 213px;" src="http://35.237.74.133/frontend/images/redondo.png" alt="" />
                      </div>
                      <div style="width:100%; color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;">
                          <p style="color:#999; line-height:0px;margin-top:-15px;">_</p>
                      </div>
                      <div style="color: #888888; font-size: 16px; font-family: Work Sans, Calibri, sans-serif; line-height: 24px; width:400px; margin:30px auto; text-align:center;">

                        <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify"> Hola ' . $nombres_respuesta  . ', te escribimos para notificarte que ' . $nombres_abogado . ' ha respondido a tu mensaje.</p>

                        <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify"> Para ver la respuesta da clic en el siguiente enlace.</p>

                        <a href="http://35.237.74.133/administracion/casos/respuesta-abogado/' . Crypt::encrypt($respuesta->id ) . '" style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:center"> Da clic en este enlace </a>

                        <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify">&iexcl;Un abrazo!,<br/>
                           El equipo de Merino&Asociados<br/>
                        <p style="font-family: Verdana, Geneva, sans-serif; font-size: 11px;"><span><strong>ESTA ES UNA COMUNICACI&Oacute;N AUTOM&Aacute;TICA, POR FAVOR NO RESPONDER.</strong></span></p>
                      </div>
                          
                      <div style="width:550px;margin:0px auto; color:#999; font-family: Work Sans, Calibri, sans-serif;background-color: dimgray; padding-top:10px; padding-bottom:10px;">
                          <table style="margin:auto auto;">
                              <tr>
                                  <td width="90" style="color:#999; font-family: Work Sans, calibri, sans-serif;font-size:13px; font-weight:bold;">
                                      <p style="color: white; ">S&iacute;guenos:</p>
                                  </td>               
                                  <td width="250">
                                  <p><a href="https://www.twitter.com/BangoEc" target="_blank"><img width="50" src="http://download.seaicons.com/download/i49182/yootheme/social-bookmark/yootheme-social-bookmark-social-twitter-button-blue.ico" alt="twitter" style="margin-right:15px;"/></a>
                                  <a href="https://www.facebook.com/BangoEnergyGel/" target="_blank"><img width="50" src="https://cdn0.iconfinder.com/data/icons/yooicons_set01_socialbookmarks/512/social_facebook_button_blue.png" alt="twitter" style="margin-right:15px;"/></a>
                                  <a href="https://www.instagram.com/bangoenergygel/" target="_blank"><img width="50" src="https://3.bp.blogspot.com/-PLtBjidnB-o/W5Ap8VkGNTI/AAAAAAAAAv4/5WmcJdRBWN0ut_7Kuq5AI1E_di6XaRh3ACLcBGAs/s1600/instagram-colourful-icon.png" alt="twitter"/></a></p>
                                  </td>
                              </tr>
                          </table>            
                      </div>
                  </div>
                  <div style="width:550px;margin:0px auto; color:#666; font-family: Work Sans, Calibri, sans-serif;font-size:12px;">
                      Esta es una comunicaci&oacute;n autom&aacute;tica, no responder a esta direcci&oacute;n de correo.
                  </div>
              </div>
          </body>
      ';

      $mail = new PHPMailer(true);
      $mail->IsSMTP();
      $mail->SMTPDebug = 0;
      $mail->SMTPAuth = true; //'login'
      $mail->SMTPSecure = 'ssl';
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 465;              
      $mail->IsHTML(true);
      $mail->CharSet = 'UTF-8';

      //confirmaciones
      $mail->Username = 'gerencia@geomarvaldez.com';
      $mail->Password = 'Geomar2018';
      $mail->SetFrom('gerencia@geomarvaldez.com', 'Notificaciones Merino & Asociados');
      $mail->Subject = html_entity_decode('Respuesta del abogado');
          
      $mail->Body = $codigohtml;      
      $mail->AddAddress($emailto);
      $mail->Send();


      return redirect('administracion')->with('mensaje-registro', 'Respuesta enviada correctamente.');
    }else{
      return redirect('administracion')->with('mensaje-registro2', 'Problemas al enviar la respuesta.');
    }
  }

  public function listado_solicitud_casos(Request $request)
  {
    $solicitud = Solicitud::where('id_user_abogado', $request->user()->id)->where('estado_solicitud',1)->where('finalizado_solicitud',0)->get();
    $saber_tarifa = Pagos::where('id_user',$request->user()->id)->where('activo',1)->where('estado',1)->get();

    return view('administracion.solicitudes.listado_casos', ['solicitud' => $solicitud, 'saber_tarifa' => $saber_tarifa]);
  }

  public function finalizar_casos(Request $request, $id)
  {
    $date = Carbon::now();
        $hoy = $date->format('Y-m-d');
        $hora = $date->format('H:i:s');
    $casos = Solicitud::findOrFail($id);  
    $casos->finalizado_solicitud = "1";
    $casos->fecha_finalizacion_solicitud= $hoy;
    $casos->hora_finalizacion_solicitud= $hora;
    $casos->save();
    
    
        $ip_navegador= $request['ip_valor1']. ' - ' .$request['navegador1'];
    
        Log::create([
            'fecha_log' => $hoy,
            'hora_log' => $hora,
            'estado' => 1,
            'id_user_log' => Auth::user()->id,
            'ip' =>  $ip_navegador,
            'accion' => "Finalizó un caso",
                        
    
        
        ]);
    return redirect('administracion/solicitud/casos');
  }

  public function registrar_pago(Request $request)
  {

    $tarifa = Tarifa::where('estado', 1)->get();
    $tarifa2 = Tarifa::where('estado', 1)->get();

    $saber_tarifa = Pagos::where('id_user',$request->user()->id)->where('activo',1)->where('estado',1)->get();

    $total_respuestas_notificacion = Respuesta::where('leido',0)->where('estado',1)->where('id_user_receptor', Auth::user()->id)->count();
       
    $respuestas_notificacion = Respuesta::where('leido',0)->where('estado',1)->where('id_user_receptor', Auth::user()->id)->orderBy('fecha', 'desc')->orderBy('hora', 'desc')->take(3)->get();

    return view('administracion.pagos.registrar', ['tarifa' => $tarifa, 'tarifa2' => $tarifa2, 'total_respuestas_notificacion' => $total_respuestas_notificacion, 'respuestas_notificacion' => $respuestas_notificacion, 'saber_tarifa' => $saber_tarifa]);
  }

  public function saber_comprobante_repetido($comprobante_pago)
  {
    $pagos = Pagos::where('comprobante_pago', $comprobante_pago)->get();

    if (count($pagos) == 0 ){
      return "no_existe";
    }else{
      return "existe";
    }
  }

  public function store_pago(Request $request)
  {

    $pago_consulta = Pagos::where('id_user', $request->user()->id)->where('activo', 1)->orWhere('activo', 0)->get();

    if (count($pago_consulta) > 0){
      $pago_consulta[0]->activo = 2;
      $pago_consulta[0]->estado = 0;

      $pago_consulta[0]->save();
    }

    $tarifa = Tarifa::findOrFail($request->rb); 

    $date = Carbon::now();
    $hoy = $date->format('Y-m-d');

    $pagos = new Pagos();
    $pagos->id_user = $request->user()->id;
    $pagos->id_tarifa = $tarifa->id;
    $pagos->fecha_inicio = $hoy;
    $pagos->fecha_finalizacion = $this->aumentar_dias_activacion(Carbon::parse($hoy));
    $pagos->modo_pago =  "DT";
    $pagos->monto_pago = $tarifa->precio;

    $pagos->estado = 0;
    $pagos->activo = 0;
    if ($this->saber_comprobante_repetido($request->numero_comprobante) == "existe"){
      return redirect('administracion/pago/registrar')->with('mensaje-error', 'El comprobante de pago no es válido.');
    }else{
      $pagos->comprobante_pago = $request->numero_comprobante;
      if($request->archivo1 != ""){
        if($request->file('archivo1')){
          $pagos->path = Storage::disk('local2')->put('comprobante_pagos',   $request->file('archivo1')); 
        }
      }else{
        $pagos->path = "Ninguno";
      }
    }

    if( $pagos->save())
    {
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
            'accion' => "Realizó un pago por transferencia bancaria",
                        
    
        
        ]);
      return redirect('administracion/pago/registrar')->with('mensaje-registro', 'Los datos se han guardado satisfactoriamente.');
    }else{
      return redirect('administracion/pago/registrar')->with('mensaje-error', 'Problemas al registrar los datos.');
    }
  }

  public function aumentar_dias_activacion($fecha)
  {
    $nuevafecha = $fecha->addDay(30);
    return $nuevafecha;
  }

  public function listado_pago(Request $request)
  {
    $pagos = Pagos::where('id_user', $request->user()->id)->get();
    $total_respuestas_notificacion = Respuesta::where('leido',0)->where('estado',1)->where('id_user_receptor', Auth::user()->id)->count();
    
    $saber_tarifa = Pagos::where('id_user',$request->user()->id)->where('activo',1)->where('estado',1)->get();

    $respuestas_notificacion = Respuesta::where('leido',0)->where('estado',1)->where('id_user_receptor', Auth::user()->id)->orderBy('fecha', 'desc')->orderBy('hora', 'desc')->take(3)->get();

    return view('administracion.pagos.listado_pagos', ['pagos' => $pagos, 'total_respuestas_notificacion' => $total_respuestas_notificacion, 'respuestas_notificacion' => $respuestas_notificacion, 'saber_tarifa' => $saber_tarifa]);
  }

   public function aprobacion_pagos(Request $request)
  {
    $pagos = DB::select('select pagos.*, users.nombres, users.apellidos FROM users, pagos WHERE users.id = pagos.id_user ');
    
    $saber_tarifa = Pagos::where('id_user',$request->user()->id)->where('activo',1)->where('estado',1)->get();

    return view('administracion.pagos.aprobacion', ['pagos' => $pagos, 'saber_tarifa' => $saber_tarifa]);

  }

  public function aprobacion_pagos_id(Request $request, $id)
  {
    $pagos =Pagos::find($id);
    
    $pagos->activo = 1;
    $pagos->estado = 1;
    $pagos->save(); 
    
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
            'accion' => "Aprobó un pago por transferencia bancaria",
                        
    
        
        ]);

    return redirect('administracion/pago/aprobacion')->with('mensaje-registro', 'Pago aprobado exitosamente');
  }

  public function cancelar_pagos_id(Request $request, $id)
  {
    $pagos =Pagos::find($id);
    
    $pagos->activo = 2;
    $pagos->estado = 0;
    $pagos->save(); 
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
            'accion' => "Canceló un pago",
                        
    
        
        ]);     

    return redirect('administracion/pago/aprobacion')->with('mensaje-registro', 'Pago cancelado exitosamente');;
  }

  public function cancelar_pagos_id2(Request $request, $id)
  {
    $pagos =Pagos::find($id);
    
    $pagos->activo = 2;
    $pagos->estado = 0;
    $pagos->save();  
    
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
            'accion' => "Canceló un pago",
                        
    
        
        ]);

    return redirect('administracion/pago/historial')->with('mensaje-registro', 'Pago cancelado exitosamente');;
  }
}
