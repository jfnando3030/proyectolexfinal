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

    

    public function admin(Request $request){

      if(Auth::user()->rol == "Administrador"){
        return view('administracion.index');
    
      }else {
        if(Auth::user()->rol == "Abogado"){
          $total_solicitudes_finalizados = Solicitud::where('estado_solicitud',1)->where('leido_solicitud',0)->whereNull('id_user_abogado')->count();
          
          
          $total_solicitudes_usuario = Solicitud::where('estado_solicitud',1)->where('id_user_abogado', Auth::user()->id )->count();
          $total_finalizados_usuario = Solicitud::where('estado_solicitud',1)->where('id_user_abogado', Auth::user()->id )->where('finalizado_solicitud', 1)->count();
          $total_solicitudes_nuevos = Solicitud::where('estado_solicitud',1)->where('leido_solicitud',0)->count();
         
        
    
          $solicitudes_usuario = Solicitud::where('estado_solicitud',1)->where('id_user_abogado', Auth::user()->id )->paginate(15);
          $solicitudes_nuevos = Solicitud::where('estado_solicitud',1)->where('leido_solicitud',0)->orderBy('fecha_solicitud', 'asc')->orderBy('hora_solicitud', 'desc')->paginate(15);
          $finalizados_usuarios = Solicitud::where('estado_solicitud',1)->where('id_user_abogado', Auth::user()->id )->where('finalizado_solicitud', 1)->paginate(15);
          $user_departamentos = UserDepartamento::where('user_id',Auth::user()->id)->get();

          $respuestas = Respuesta::where('estado',1)->where('id_user_receptor', Auth::user()->id)->orderBy('fecha', 'asc')->orderBy('hora', 'desc')->get();
          $total_respuestas = Respuesta::where('estado',1)->where('id_user_receptor', Auth::user()->id)->count();
          
          
          return view('administracion.index', compact('total_respuestas','respuestas','user_departamentos','finalizados_usuarios','total_solicitudes', 'total_solicitudes_usuario', 'total_finalizados_usuario','total_solicitudes_nuevos', 'solicitudes_nuevos', 'solicitudes_usuario'));
    
        }else{
    
          $total_solicitudes_registrados = Solicitud::where('estado_solicitud',1)->where('id_user_solicitud', Auth::user()->id )->count();
          $solicitudes_registrados = Solicitud::where('estado_solicitud',1)->where('id_user_solicitud', Auth::user()->id )->orderBy('fecha_solicitud', 'asc')->orderBy('hora_solicitud', 'desc')->paginate(15);
    
         
          $respuestas = Respuesta::where('estado',1)->where('id_user_receptor', Auth::user()->id)->orderBy('fecha', 'asc')->orderBy('hora', 'desc')->get();
          $total_respuestas = Respuesta::where('estado',1)->where('id_user_receptor', Auth::user()->id)->count();
         
          
    
          return view('administracion.index', compact('total_respuestas','respuestas','total_solicitudes_registrados','solicitudes_registrados'));
    
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
		
	return view('administracion.abogados.listado', ['usuario'=>$usuario, 'departamento' => $users]);
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

      foreach($usuarios as $u){
        $usuario = User::find($u->id);
        $departamento = Departamento::find($u->departamento_id);
        $usuario->sendLawyersNotifications($departamento->nombre_departamento, $solicitud->id);
      }

      return redirect('administracion/solicitud/registrar')->with('mensaje-registro', 'La solicitud ha sido enviado correctamente.');
    }else{
      return redirect('administracion/solicitud/registrarr')->with('mensaje-registro2', 'Problemas al enviar los datos.');
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
  
      if($casos->save()){
        return redirect('administracion')->with('mensaje-registro', 'Caso aceptado exitosamente.');
      }
    
    }


    public function ver_caso(Request $request, $id)
    {
      $caso = Solicitud::findOrFail($id);  
      $archivos = Archivos::where('id_solicitud',$id)->get();
     
  
     
      return view('administracion.aceptar_caso.index',compact('caso', 'archivos'));
     
    
    }


    public function ver_respuesta(Request $request, $id)
    {
      $respuesta = Respuesta::findOrFail($id);  
      $archivos = ArchivosRespuesta::where('id_respuesta',$id)->get();
     
  
     
      return view('administracion.responder.index',compact('respuesta', 'archivos'));
     
    
    }



    
    
  public function gestionar_casos()
  {
    $solicitud = Solicitud::where('estado_solicitud',1)->whereNotNull('id_user_abogado')->get();
    //return "hola";
    return view('administracion.gestionar.listado', ['solicitud' => $solicitud]);
  }
 
  public function gestionar_abogado_casos($id)
  {
    $solicitud = DB::select("select  solicitud.*, departamento.* from solicitud, departamento where solicitud.id_departamento = departamento.id and solicitud.id = ? and solicitud.estado_solicitud = 1 and solicitud.id_user_abogado is not null", [$id] ); 


    $area = DB::select("select  departamento.id from solicitud, departamento where solicitud.id_departamento = departamento.id and solicitud.id = ? and solicitud.estado_solicitud = 1 and solicitud.id_user_abogado is not null", [$id] ); 

    $abogados = DB::select("select * from users where id in (select user_id from departamento_user where departamento_id = ?)", [$area[0]->id] );   

    $abogado = DB::select("select * from users where id = ? ", [$solicitud[0]->id_user_abogado]); 
    

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

    public function registrar_respuesta(Request $request, $id)
    {
      //$departamento = Departamento::all();
      $casos = Solicitud::findOrFail($id); 
      return view('administracion.respuesta.registrar', ['casos' => $casos]);
    }

    public function store_respuesta(Request $request)
    {

      $date = Carbon::now();
      $hoy = $date->format('Y-m-d');
      $hora = $date->format('h:i:s');

      $respuesta = new Respuesta();
      $respuesta->titulo = $request->nombre;
      $respuesta->respuesta = $request->respuesta;
      $respuesta->fecha = $hoy;
      $respuesta->hora = $hora;
      $respuesta->solicitud_id = $request->id_solicitud;
      $respuesta->id_user_receptor = $request->id_user_receptor;
       
      if( $respuesta->save() ){
        
        //  PARA ARCHIVO 1 
        if($request->archivo1 != ""){
          if($request->file('archivo1')){
            $archivos1 = new ArchivosRespuesta();
            $archivos1->path = Storage::disk('local2')->put('respuesta',   $request->file('archivo1')); 
            $archivos1->id_respuesta = $respuesta->id;
            $archivos1->save();
          }
        }

        //  PARA ARCHIVO 2
        if($request->archivo2 != ""){
          if($request->file('archivo2')){
            $archivos2 = new ArchivosRespuesta();
            $archivos2->path = Storage::disk('local2')->put('respuesta',   $request->file('archivo2')); 
            $archivos2->id_respuesta = $respuesta->id;
            $archivos2->save();
          }
        }

        //  PARA ARCHIVO 3
        if($request->archivo3 != ""){
          if($request->file('archivo3')){
            $archivo3 = new ArchivosRespuesta();
            $archivo3->path = Storage::disk('local2')->put('respuesta',   $request->file('archivo3')); 
            $archivo3->id_respuesta = $respuesta->id;
            $archivo3->save();
          }
        }

        //  PARA ARCHIVO 4
        if($request->archivo4 == ""){
          if($request->file('archivo4')){
            $archivo4 = new ArchivosRespuesta();
            $archivo4->path = Storage::disk('local2')->put('respuesta',   $request->file('archivo4')); 
            $archivo4->id_respuesta = $respuesta->id;
            $archivo4->save();
          }
        }

        //  PARA ARCHIVO 5
        if($request->archivo5 == ""){
          if($request->file('archivo5')){
            $archivo5 = new ArchivosRespuesta();
            $archivo5->path = Storage::disk('local2')->put('respuesta',   $request->file('archivo5')); 
            $archivo5->id_respuesta = $respuesta->id;
            $archivo5->save();
          }
        }

        return redirect('administracion')->with('mensaje-registro', 'Respuesta enviada correctamente.');
      }else{
        return redirect('administracion')->with('mensaje-registro2', 'Problemas al enviar la respuesta.');
      }
    }

    public function store_respuesta2(Request $request)
    {

      $date = Carbon::now();
      $hoy = $date->format('Y-m-d');
      $hora = $date->format('h:i:s');

      $respuesta = new Respuesta();
      $respuesta->titulo = $request->nombre;
      $respuesta->respuesta = $request->respuesta;
      $respuesta->fecha = $hoy;
      $respuesta->hora = $hora;
      $respuesta->solicitud_id = $request->id_solicitud;
      $respuesta->id_autorespuesta = $request->id_solicitud;
      $respuesta->id_user_receptor = $request->id_user_receptor;
       
      if( $respuesta->save() ){
        
        //  PARA ARCHIVO 1 
        if($request->archivo1 != ""){
          if($request->file('archivo1')){
            $archivos1 = new ArchivosRespuesta();
            $archivos1->path = Storage::disk('local2')->put('respuesta',   $request->file('archivo1')); 
            $archivos1->id_respuesta = $respuesta->id;
            $archivos1->save();
          }
        }

        //  PARA ARCHIVO 2
        if($request->archivo2 != ""){
          if($request->file('archivo2')){
            $archivos2 = new ArchivosRespuesta();
            $archivos2->path = Storage::disk('local2')->put('respuesta',   $request->file('archivo2')); 
            $archivos2->id_respuesta = $respuesta->id;
            $archivos2->save();
          }
        }

        //  PARA ARCHIVO 3
        if($request->archivo3 != ""){
          if($request->file('archivo3')){
            $archivo3 = new ArchivosRespuesta();
            $archivo3->path = Storage::disk('local2')->put('respuesta',   $request->file('archivo3')); 
            $archivo3->id_respuesta = $respuesta->id;
            $archivo3->save();
          }
        }

        //  PARA ARCHIVO 4
        if($request->archivo4 == ""){
          if($request->file('archivo4')){
            $archivo4 = new ArchivosRespuesta();
            $archivo4->path = Storage::disk('local2')->put('respuesta',   $request->file('archivo4')); 
            $archivo4->id_respuesta = $respuesta->id;
            $archivo4->save();
          }
        }

        //  PARA ARCHIVO 5
        if($request->archivo5 == ""){
          if($request->file('archivo5')){
            $archivo5 = new ArchivosRespuesta();
            $archivo5->path = Storage::disk('local2')->put('respuesta',   $request->file('archivo5')); 
            $archivo5->id_respuesta = $respuesta->id;
            $archivo5->save();
          }
        }

        return redirect('administracion')->with('mensaje-registro', 'Respuesta enviada correctamente.');
      }else{
        return redirect('administracion')->with('mensaje-registro2', 'Problemas al enviar la respuesta.');
      }
    }

    public function listado_solicitud_casos(Request $request)
    {
      $solicitud = Solicitud::where('id_user_abogado', $request->user()->id)->where('estado_solicitud',1)->where('finalizado_solicitud',0)->get();

    return view('administracion.solicitudes.listado_casos', ['solicitud' => $solicitud]);
    }

    
    public function finalizar_casos($id)
    {
      $casos = Solicitud::findOrFail($id);  
      $casos->finalizado_solicitud = "1";
      $casos->save();
      return redirect('administracion/solicitud/casos');
    }

    public function registrar_pago()
    {
      $tarifa = Tarifa::where('estado', 1)->get();
      $tarifa2 = Tarifa::where('estado', 1)->get();
      return view('administracion.pagos.registrar', ['tarifa' => $tarifa, 'tarifa2' => $tarifa2]);
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
      
      if( $tarifa->id == 1){
        $pagos->modo_pago = "Free";
        $pagos->comprobante_pago = "Ninguno";
      }else{
        $pagos->modo_pago = "DT";
      }
      
      
      $pagos->monto_pago = $tarifa->precio;


      if($tarifa->id == 1){
        $pagos->estado = 1;
        $pagos->activo = 1; 
        $pagos->path = "Ninguno";
        $pagos->comprobante_pago = "Ninguno";
      }else{
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
      }

     
      if( $pagos->save())
      {
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

      return view('administracion.pagos.listado_pagos', ['pagos' => $pagos]);
    }

     public function aprobacion_pagos(Request $request)
    {
      $pagos = DB::select('select pagos.*, users.nombres, users.apellidos FROM users, pagos WHERE users.id = pagos.id_user ');

      return view('administracion.pagos.aprobacion', ['pagos' => $pagos]);

    }

    public function aprobacion_pagos_id($id)
    {
    $pagos =Pagos::find($id);
    
    $pagos->activo = 1;
    $pagos->estado = 1;
    $pagos->save();      

    return redirect('administracion/pago/aprobacion')->with('mensaje-registro', 'Pago aprobado exitosamente');
    }

    public function cancelar_pagos_id($id)
    {
    $pagos =Pagos::find($id);
    
    $pagos->activo = 2;
    $pagos->estado = 0;
    $pagos->save();      

    return redirect('administracion/pago/aprobacion')->with('mensaje-registro', 'Pago cancelado exitosamente');;
    }

    public function cancelar_pagos_id2($id)
    {
    $pagos =Pagos::find($id);
    
    $pagos->activo = 2;
    $pagos->estado = 0;
    $pagos->save();      

    return redirect('administracion/pago/historial')->with('mensaje-registro', 'Pago cancelado exitosamente');;
    }

}
