<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comisiones;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;


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

    	
    	if($request->user()->rol == "Administrador" ){
    		// cantidad de compras
	    	$compras = Comisiones::all();
			$total_compras = count($compras);
    	}else{
    		// cantidad de compras
	    	$compras = Comisiones::where('cedula', $request->user()->cedula)->get();
			$total_compras = count($compras);
    	}

    	if($request->user()->rol == "Administrador" ){
	    	// calculando el mensual de comisiones
	    	$date = Carbon::now();
			$date2 = $date->format('m');
	    	$mes_comisiones = Comisiones::all();
	    	$suma_mes_comisiones=00.0000;
	    	foreach ($mes_comisiones as $mes_comisiones) {
	    		$aux_fecha = Carbon::parse($mes_comisiones->fecha);
				$date_aux = $aux_fecha->format('m');
				if($date_aux == $date2){
					$suma_mes_comisiones = $suma_mes_comisiones + $mes_comisiones->monto;
				}
	    	}
	    	$mes_comisiones_con_2_decimales = substr($suma_mes_comisiones, 0, strpos($suma_mes_comisiones, '.') + 3);
    	}else{
	    	// calculando el mensual de comisiones
	    	$date = Carbon::now();
			$date2 = $date->format('m');
	    	$mes_comisiones = Comisiones::where('cedula', $request->user()->cedula)->get();
	    	$suma_mes_comisiones=00.0000;
	    	foreach ($mes_comisiones as $mes_comisiones) {
	    		$aux_fecha = Carbon::parse($mes_comisiones->fecha);
				$date_aux = $aux_fecha->format('m');
				if($date_aux == $date2){
					$suma_mes_comisiones = $suma_mes_comisiones + $mes_comisiones->monto;
				}
	    	}
	    	$mes_comisiones_con_2_decimales = substr($suma_mes_comisiones, 0, strpos($suma_mes_comisiones, '.') + 3);
    	}

    	
    	if($request->user()->rol == "Administrador" ){
    		// calculando el total de comisiones
	    	$total_comisiones = Comisiones::all()->sum('monto');
	    	$total_comisiones_con_2_decimales = substr($total_comisiones, 0, strpos($total_comisiones, '.') + 3);
    	}else{
    		// calculando el total de comisiones
	    	$total_comisiones = Comisiones::where('cedula', $request->user()->cedula)->sum('monto');
	    	$total_comisiones_con_2_decimales = substr($total_comisiones, 0, strpos($total_comisiones, '.') + 3);
    	}	

    	
    	if($request->user()->rol == "Administrador" ){
    		$fecha_para_ultima_semana = Carbon::now();
	    	$hoy_para_ultima_Semana = $fecha_para_ultima_semana->format('Y-m-d');

	    	$nuevafecha = Carbon::parse($hoy_para_ultima_Semana)->subDay(6);
	    	$dias_atras = $nuevafecha->format('Y-m-d');

	    	//$usuarios = User::all();
	    	$usuarios = DB::select("select * from users  where date_format(created_at, '%Y-%m-%d') between ? AND ?", [Carbon::parse($dias_atras), Carbon::parse($hoy_para_ultima_Semana)] );

	    	$lunes = 0;
			$martes = 0;
			$miercoles = 0;
			$jueves = 0;
			$viernes = 0;
			$sabado = 0; 
			$domingo = 0;
	    	// fecha de hoy 
	    	$fech = Carbon::now();
			$hoy = $date->format('D');

	    	if ($hoy == "Mon"){
	    		$martes = 0;
	    		$miercoles = 0;
	    		$jueves = 0;
	    		$viernes = 0; 
				$sabado = 0; 
				$domingo = 0;

				foreach ($usuarios as $usuarios) {
					$aux_fecha = Carbon::parse($usuarios->created_at);
					$date_aux = $aux_fecha->format('D');
					if($date_aux == "Mon"){
						$lunes = $lunes + 1;
					}
				}

	    	}else{
	    		if ($hoy == "Tue"){
		    		$miercoles = 0;
		    		$jueves = 0;
		    		$viernes = 0; 
					$sabado = 0; 
					$domingo = 0;

					foreach ($usuarios as $usuarios) {
						$aux_fecha = Carbon::parse($usuarios->created_at);
						$date_aux = $aux_fecha->format('D');
						if($date_aux == "Mon"){
							$lunes = $lunes + 1;
						}
						if($date_aux == "Tue"){
							$martes = $martes + 1;
						}
					}

	    		}else{
	    			if ($hoy == "Wed"){
			    		$jueves = 0;
			    		$viernes = 0; 
						$sabado = 0; 
						$domingo = 0;

						foreach ($usuarios as $usuarios) {
							$aux_fecha = Carbon::parse($usuarios->created_at);
							$date_aux = $aux_fecha->format('D');
							if($date_aux == "Mon"){
								$lunes = $lunes + 1;
							}
							if($date_aux == "Tue"){
								$martes = $martes + 1;
							}
							if($date_aux == "Wed"){
								$miercoles = $miercoles + 1;
							}
							
						}

	    			}else{
	    				if ($hoy == "Thu"){
				    		$viernes = 0; 
							$sabado = 0; 
							$domingo = 0;

							foreach ($usuarios as $usuarios) {
								$aux_fecha = Carbon::parse($usuarios->created_at);
								$date_aux = $aux_fecha->format('D');
								if($date_aux == "Mon"){
									$lunes = $lunes + 1;
								}
								if($date_aux == "Tue"){
									$martes = $martes + 1;
								}
								if($date_aux == "Wed"){
									$miercoles = $miercoles + 1;
								}
								if($date_aux == "Thu"){
									$jueves = $jueves + 1;
								}
							}

	    				}else{
	    					if ($hoy == "Fri"){
								$sabado = 0; 
								$domingo = 0;

								foreach ($usuarios as $usuarios) {
									$aux_fecha = Carbon::parse($usuarios->created_at);
									$date_aux = $aux_fecha->format('D');
									if($date_aux == "Mon"){
										$lunes = $lunes + 1;
									}
									if($date_aux == "Tue"){
										$martes = $martes + 1;
									}
									if($date_aux == "Wed"){
										$miercoles = $miercoles + 1;
									}
									if($date_aux == "Thu"){
										$jueves = $jueves + 1;
									}
									if($date_aux == "Fri"){
										$viernes = $viernes + 1;
									}
								}

	    					}else{
	    						if ($hoy == "Sat"){
									$domingo = 0;
									foreach ($usuarios as $usuarios) {
										$aux_fecha = Carbon::parse($usuarios->created_at);
										$date_aux = $aux_fecha->format('D');
										if($date_aux == "Mon"){
											$lunes = $lunes + 1;
										}
										if($date_aux == "Tue"){
											$martes = $martes + 1;
										}
										if($date_aux == "Wed"){
											$miercoles = $miercoles + 1;
										}
										if($date_aux == "Thu"){
											$jueves = $jueves + 1;
										}
										if($date_aux == "Fri"){
											$viernes = $viernes + 1;
										}
										if($date_aux == "Sat"){
											$sabado = $sabado + 1;
										}
									}
	    						}else{
	    							foreach ($usuarios as $usuarios) {
										$aux_fecha = Carbon::parse($usuarios->created_at);
										$date_aux = $aux_fecha->format('D');
										if($date_aux == "Mon"){
											$lunes = $lunes + 1;
										}
										if($date_aux == "Tue"){
											$martes = $martes + 1;
										}
										if($date_aux == "Wed"){
											$miercoles = $miercoles + 1;
										}
										if($date_aux == "Thu"){
											$jueves = $jueves + 1;
										}
										if($date_aux == "Fri"){
											$viernes = $viernes + 1;
										}
										if($date_aux == "Sat"){
											$sabado = $sabado + 1;
										}
										if($date_aux == "Sun"){
											$domingo = $domingo + 1;
										}
									}
	    						}
	    					}
	    				}
	    			}

	    		}
	    	}
    	}else{
    		$fecha_para_ultima_semana = Carbon::now();
	    	$hoy_para_ultima_Semana = $fecha_para_ultima_semana->format('Y-m-d');

	    	$nuevafecha = Carbon::parse($hoy_para_ultima_Semana)->subDay(6);
	    	$dias_atras = $nuevafecha->format('Y-m-d');

	    	//$usuarios = User::all();
	    	$usuarios = DB::select("select * from users  where codpatrocinador = ? and date_format(created_at, '%Y-%m-%d') between ? AND ?", [$request->user()->cedula, Carbon::parse($dias_atras), Carbon::parse($hoy_para_ultima_Semana)] );

	    	$lunes = 0;
			$martes = 0;
			$miercoles = 0;
			$jueves = 0;
			$viernes = 0;
			$sabado = 0; 
			$domingo = 0;
	    	// fecha de hoy 
	    	$fech = Carbon::now();
			$hoy = $date->format('D');

	    	if ($hoy == "Mon"){
	    		$martes = 0;
	    		$miercoles = 0;
	    		$jueves = 0;
	    		$viernes = 0; 
				$sabado = 0; 
				$domingo = 0;

				foreach ($usuarios as $usuarios) {
					$aux_fecha = Carbon::parse($usuarios->created_at);
					$date_aux = $aux_fecha->format('D');
					if($date_aux == "Mon"){
						$lunes = $lunes + 1;
					}
				}

	    	}else{
	    		if ($hoy == "Tue"){
		    		$miercoles = 0;
		    		$jueves = 0;
		    		$viernes = 0; 
					$sabado = 0; 
					$domingo = 0;

					foreach ($usuarios as $usuarios) {
						$aux_fecha = Carbon::parse($usuarios->created_at);
						$date_aux = $aux_fecha->format('D');
						if($date_aux == "Mon"){
							$lunes = $lunes + 1;
						}
						if($date_aux == "Tue"){
							$martes = $martes + 1;
						}
					}

	    		}else{
	    			if ($hoy == "Wed"){
			    		$jueves = 0;
			    		$viernes = 0; 
						$sabado = 0; 
						$domingo = 0;

						foreach ($usuarios as $usuarios) {
							$aux_fecha = Carbon::parse($usuarios->created_at);
							$date_aux = $aux_fecha->format('D');
							if($date_aux == "Mon"){
								$lunes = $lunes + 1;
							}
							if($date_aux == "Tue"){
								$martes = $martes + 1;
							}
							if($date_aux == "Wed"){
								$miercoles = $miercoles + 1;
							}
							
						}

	    			}else{
	    				if ($hoy == "Thu"){
				    		$viernes = 0; 
							$sabado = 0; 
							$domingo = 0;

							foreach ($usuarios as $usuarios) {
								$aux_fecha = Carbon::parse($usuarios->created_at);
								$date_aux = $aux_fecha->format('D');
								if($date_aux == "Mon"){
									$lunes = $lunes + 1;
								}
								if($date_aux == "Tue"){
									$martes = $martes + 1;
								}
								if($date_aux == "Wed"){
									$miercoles = $miercoles + 1;
								}
								if($date_aux == "Thu"){
									$jueves = $jueves + 1;
								}
							}

	    				}else{
	    					if ($hoy == "Fri"){
								$sabado = 0; 
								$domingo = 0;

								foreach ($usuarios as $usuarios) {
									$aux_fecha = Carbon::parse($usuarios->created_at);
									$date_aux = $aux_fecha->format('D');
									if($date_aux == "Mon"){
										$lunes = $lunes + 1;
									}
									if($date_aux == "Tue"){
										$martes = $martes + 1;
									}
									if($date_aux == "Wed"){
										$miercoles = $miercoles + 1;
									}
									if($date_aux == "Thu"){
										$jueves = $jueves + 1;
									}
									if($date_aux == "Fri"){
										$viernes = $viernes + 1;
									}
								}

	    					}else{
	    						if ($hoy == "Sat"){
									$domingo = 0;
									foreach ($usuarios as $usuarios) {
										$aux_fecha = Carbon::parse($usuarios->created_at);
										$date_aux = $aux_fecha->format('D');
										if($date_aux == "Mon"){
											$lunes = $lunes + 1;
										}
										if($date_aux == "Tue"){
											$martes = $martes + 1;
										}
										if($date_aux == "Wed"){
											$miercoles = $miercoles + 1;
										}
										if($date_aux == "Thu"){
											$jueves = $jueves + 1;
										}
										if($date_aux == "Fri"){
											$viernes = $viernes + 1;
										}
										if($date_aux == "Sat"){
											$sabado = $sabado + 1;
										}
									}
	    						}else{
	    							foreach ($usuarios as $usuarios) {
										$aux_fecha = Carbon::parse($usuarios->created_at);
										$date_aux = $aux_fecha->format('D');
										if($date_aux == "Mon"){
											$lunes = $lunes + 1;
										}
										if($date_aux == "Tue"){
											$martes = $martes + 1;
										}
										if($date_aux == "Wed"){
											$miercoles = $miercoles + 1;
										}
										if($date_aux == "Thu"){
											$jueves = $jueves + 1;
										}
										if($date_aux == "Fri"){
											$viernes = $viernes + 1;
										}
										if($date_aux == "Sat"){
											$sabado = $sabado + 1;
										}
										if($date_aux == "Sun"){
											$domingo = $domingo + 1;
										}
									}
	    						}
	    					}
	    				}
	    			}

	    		}
	    	}
    	}
    	

    	// saber los niveles 

    	$usuarios_afiliados = DB::select("select * from users  where codpatrocinador = ? ", [ $request->user()->cedula] );
    	$nivel1 = count($usuarios_afiliados);



    	$users = User::all();
    	$cedulas_nivel1 = array();
    	$x=0;

    	foreach ($usuarios_afiliados as $usuarios_afiliados ) {
			$cedulas_nivel1[$x] = $usuarios_afiliados->cedula;
			$x = $x + 1;
		}

    	$nivel2 = 0;

    	$cedulas_nivel2 = array();
    	$users3 = User::all();

    	foreach ($users3 as $users3) {
			for ($i=0; $i < count( $cedulas_nivel1); $i++) { 
				if($users3->codpatrocinador == $cedulas_nivel1[$i]){
					$cedulas_nivel2[$nivel2] = $users3->cedula;
    				$nivel2 = $nivel2 + 1;
    			}
    		}
    	}

    	$users1 = User::all();
    	$nivel3 = 0;


    	foreach ($users1 as $users1) {
			for ($i=0; $i < count( $cedulas_nivel2); $i++) { 
				if($users1->codpatrocinador == $cedulas_nivel2[$i]){
    				$nivel3 = $nivel3 + 1;
    			}
    		}
    	}	

    	if($request->user()->rol == "Administrador" ){
    		// obteniendo el total de afiliados
	    	$afiliados = User::all();
	    	$total_afiliados = count($afiliados);
    	}else{
    		$total_afiliados = $nivel1 + $nivel2 + $nivel3;
    	}
    	

        return view('administracion.index', ['total_afiliados' => $total_afiliados, 'mes_comisiones_con_2_decimales' => $mes_comisiones_con_2_decimales, 'total_comisiones_con_2_decimales' => $total_comisiones_con_2_decimales, 'total_compras' => $total_compras, 'lunes' => $lunes, 'martes' => $martes, 'miercoles' => $miercoles, 'jueves' => $jueves, 'viernes' => $viernes, 'sabado' => $sabado, 'domingo' => $domingo, 'nivel1' => $nivel1, 'nivel2' => $nivel2, 'nivel3' => $nivel3  ]);
    }

    public function invita_bango()
    {
    	return view('administracion.invita_bango');
    }

    public function enviar_mail_invitacion(Request $request)
    {
        $url = $request->root();    
        $unir_url= $url . '/administracion/invita/bango/'. $request->user()->nombres . ' ' . $request->user()->apellidos . '/' . $request->user()->cedula;
        $emailto = $request->email;

        $codigohtml = '<!doctype html>
			<html lang="en">
			  <head>
			    <meta charset="utf-8">
			    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			    <link rel="stylesheet" href="http://localhost/proyectobango/frontend/css/font-awesome.min.css">
			    <link rel="stylesheet" href="http://localhost/proyectobango/frontend/css/bootstrap.min.css">
			    <link rel="stylesheet" href="http://localhost/proyectobango/frontend/css/material-design-iconic-font.min.css">
			    <link rel="stylesheet" href="http://localhost/proyectobango/frontend/css/style.css">
			    <link rel="stylesheet" href="http://localhost/proyectobango/frontend/css/responsive.css">
			    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
			  </head>
			  <body>
			    <div class="welcome-area" id="home">
			        <div class="container banner3">
			            <div class="row">
			                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">

			                </div>

			                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">

			                    <div class="user_card">
			                        <div class="d-flex justify-content-center">
			                            <div class="brand_logo_container">
			                               
			                            </div> 
			                        </div>
			                        <div class="d-flex justify-content-center form_container">
			                            <form style="width: 100%;" method="POST" action="">
			                                <div class="row">
			                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

			                                        <table width="100%" border="0" cellspacing="2" cellpadding="0" style="background-color: black;">
			                                            <tr>
			                                                <td valign="top">
			                                                    <p style=" text-align:center;">
			                                                    	<img  width="150px" height="150px" src="http://afiliados.bangoenergygel.com/frontend/images/redondo.png" class="brand_logo" alt="Logo">
			                                                    </p>
			                                                    <p style="color: white; font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:center;">
			                                                        <strong>¡Hola ' . $request->nombres . '!</strong>
			                                                        <br>
			                                                        <br> ' . $request->user()->nombres . ' ' . $request->user()->apellidos . ' te ha invitado para que te unas a Bango Energy Gel.
			                                                    </p> 
			                                                    <p style="color: white; font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:center">Haz clic en este v&iacute;nculo para que te inscribas:
			                                                        <br>
			                                                        <br>
			                                                        <a href="'. $unir_url .'" title="Invita a tus amigos" target="_blank" style="border:medium; font-family:Verdana, Geneva, sans-serif; font-size:12px; color:white;"> <strong> ' . $unir_url . ' </strong> </a>
			                                                    </p>
			                                                    <br>
			                                                </td>
			                                            </tr>
			                                        </table>
			                                        
			                                    </div>
			                                </div>
			                            </form>
			                        </div>
			                    </div>     
			                </div>
			            </div>
			        </div>
			    </div>
			    </body>
			    <!--welcome area end-->
			</html>
			';

        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true; //'login'
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.mandrillapp.com';
        $mail->Port = 587;              
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';

        //confirmaciones
        $mail->Username = 'Guayas Emprende por Internet';
        $mail->Password = '5luKaRwGdN_5wKEUWTfc6w';
        $mail->SetFrom('notificaciones@bangoenergygel.com', 'Notificaciones Bango Energy Gel');
        $mail->Subject = html_entity_decode('Forma parte de Bango Energy Gel');
            
        $mail->Body = $codigohtml;      
        $mail->AddAddress($emailto);
        $mail->Send();  

        if($mail){
            return Redirect::to('administracion/invita/bango')->with('mensaje-registro', 'Tu invitación ha sido enviada.');
        }else{
            return Redirect::to('administracion/invita/bango')->with('mensaje-registro', 'Problemas al enviar tu invitación.');
        }

    }


    public function saber_niveles($niveles, Request $request)
    {
    	if ($request->ajax()) {

	    	
	    	if($niveles == 1){
	    		$nivel = User::where('codpatrocinador', $request->user()->cedula )->orderByRaw('created_at DESC')->get();

	    		return response()->json($nivel);
	    	}

	    	if($niveles == 2){
	    		$nivel1 = User::where('codpatrocinador', $request->user()->cedula )->orderByRaw('created_at DESC')->get();

	    		$cedulas_nivel1 = array();
	    		$i =0;
	    		foreach ($nivel1 as $nivel1) {
	    			$cedulas_nivel1[$i] = $nivel1->cedula; 
	    			$i=$i+1;
	    		}

    			$nivel = User::whereIn('codpatrocinador', $cedulas_nivel1 )->orderByRaw('created_at DESC')->get();
				return response()->json($nivel);
	    	}

	    	if($niveles == 3){
	    		//return json_encode($nivel3_afiliados);
	    		$nivel1 = User::where('codpatrocinador', $request->user()->cedula )->orderByRaw('created_at DESC')->get();


	    		$cedulas_nivel1 = array();
	    		$i =0;
	    		foreach ($nivel1 as $nivel1) {
	    			$cedulas_nivel1[$i] = $nivel1->cedula; 
	    			$i=$i+1;
	    		}

	    		$nivel2 = User::whereIn('codpatrocinador', $cedulas_nivel1 )->orderByRaw('created_at DESC')->get();

	    		$cedulas_nivel2 = array();
	    		$x =0;
	    		foreach ($nivel2 as $nivel2) {
	    			$cedulas_nivel2[$x] = $nivel2->cedula; 
	    			$x=$x+1;
	    		}

	    		$nivel = User::whereIn('codpatrocinador', $cedulas_nivel2 )->orderByRaw('created_at DESC')->get();

	    		return response()->json($nivel);
	    	}

	    	if($niveles >3){
	    		$mensaje = array("mensaje" => 'error' );
				//return json_encode($mensaje, true);
				return response()->json($mensaje);	
	    	}

		}
    }

    public function mired(Request $request)
    {
    	//$nivel1 = User::query();

    	$nivel = User::where('codpatrocinador', $request->user()->cedula )->orderByRaw('created_at DESC')->get();
    	//$nivel1 = User::paginate(3);
    	return view('administracion.mired',  [ 'nivel' => $nivel]);
    	//return view('administracion.mired', [ 'nivel1' => $nivel1,  'siguiente' => $siguiente, 'atras' => $atras, 'ultimo' => $ultimo, 'actual' => $actual ]);
    }


    public function invitar_bango_get($nombres, $cedula)
    {
    	return view('administracion.invita_bango_get', compact('nombres', 'cedula'));
    }

    public function historial_ganancia_vista()
    {
    	return view('administracion.historial_ganancia');
    }


	public function login_app($cedula, $contraseña)
    {   
        $usuario = User::where('cedula', $cedula)->get();

        if ($usuario->count() == 0){
            $errores = 'usuario_no_valido'; 
            echo $errores;
        }else{
            $usuario2 = DB::select("select * FROM users WHERE cedula = ?", [$cedula]);
            if (password_verify($contraseña, $usuario2[0]->password)) {

            	$nombres = $usuario2[0]->nombres . ' ' . $usuario2[0]->apellidos;
            	$cedula =  $usuario2[0]->cedula;

            	$datos = array("cedula" => $cedula, "nombre" => $nombres  );
				echo json_encode($datos, true);
            } else {
            	$errores = 'incorrecto'; 
            	echo $errores;
            }            
        }
    }

    public function registrar_app($email, $cedula, $htxt_codpatrocin, $txt_codpatrocina, $nombre,  $apellidos , $contrasena)
    {
    	$usuario = User::where('email', $email)->get();
    	$saber_cedula = User::where('cedula', $cedula)->get();
    	$saber_patrocinador = User::where('cedula', $htxt_codpatrocin)->get();



    	if ($usuario->count() > 0  && $saber_patrocinador->count() > 0 && $saber_cedula->count() > 0) { 
			$error = array("mensaje" => "Datos ingresado invalidos, revise por favor" );
			echo json_encode($error, true);
		}else{
			if($usuario->count() > 0 && $saber_patrocinador->count() > 0){
				$error = array("mensaje" => "Código patrocinador no valido, y Email ya se encuentra registrado" );
				echo json_encode($error, true);	
			}else{
				if($saber_patrocinador->count() > 0  && $saber_cedula->count() > 0){
					$error = array("mensaje" => "Código patrocinador no valido, y cedula ya se encuentra registrada" );
					echo json_encode($error, true);	
				}else{
					if($usuario->count() > 0 && $saber_cedula->count() > 0){
						$error = array("mensaje" => "Cédula y Email se encuentran registrados" );
						echo json_encode($error, true);	
					}else{
						if($saber_cedula->count() > 0){
							$error = array("mensaje" => "Cédula ya se encuentra registrada" );
							echo json_encode($error, true);	
						}else{
							if ($usuario->count() > 0 ){
								$error = array("mensaje" => "Email ya se encuentra registrado" );
								echo json_encode($error, true);	
							}else{
								if ($saber_patrocinador->count() == 0 ){
									$error = array("mensaje" => "Código patrocinador no encontrado" );
									echo json_encode($error, true);
								}else{
									$user =  User::create([
							            'nombres' => $nombre,
							            'email' => $email,
							            'password' => Hash::make($contrasena),
							            'codpatrocinador' => $htxt_codpatrocin,
							            'apellidos' => $apellidos,
							            'cedula' => $cedula,
							            'rol' => "Afiliado",

							        ]);

							        if ($user == null){
							        	$msj = array("mensaje" => 'problemas_al_registrar' );
						            	echo json_encode($msj, true);
							        }else{
							        	$error = array("exito" => "exito" );
										echo json_encode($error, true);	
							        }
								}
							}
						}
					}
				}
			}
		}     
    }

    public function invitar_app($nombre, $email , $cedula, Request $request)
    {

    	$usuarios = DB::select("Select * from users where cedula = ? and estado = 'A' and  activado = 'S'", [ $cedula] );

    	if (count($usuarios) > 0 ){
    		  //include_once("send_email.php");

		  	$vnombinvitado	= $nombre;
			$vemailinvitado	= $email;

			$codpromotor = $usuarios[0]->cedula;
			$vnombres = $usuarios[0]->nombres . ' ' . $usuarios[0]->apellidos; 
			//ARMO CORREO HTML
			$url = $request->root();	
			$unir_url= $url . '/administracion/invita/bango/'. $vnombres . '/' . $codpromotor;

			$codigohtml = '<!doctype html>
			<html lang="en">
			  <head>
			    <meta charset="utf-8">
			    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			    <link rel="stylesheet" href="http://localhost/proyectobango/frontend/css/font-awesome.min.css">
			    <link rel="stylesheet" href="http://localhost/proyectobango/frontend/css/bootstrap.min.css">
			    <link rel="stylesheet" href="http://localhost/proyectobango/frontend/css/material-design-iconic-font.min.css">
			    <link rel="stylesheet" href="http://localhost/proyectobango/frontend/css/style.css">
			    <link rel="stylesheet" href="http://localhost/proyectobango/frontend/css/responsive.css">
			    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
			  </head>
			  <body>
			    <div class="welcome-area" id="home">
			        <div class="container banner3">
			            <div class="row">
			                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">

			                </div>

			                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">

			                    <div class="user_card">
			                        <div class="d-flex justify-content-center">
			                            <div class="brand_logo_container">
			                               
			                            </div> 
			                        </div>
			                        <div class="d-flex justify-content-center form_container">
			                            <form style="width: 100%;" method="POST" action="">
			                                <div class="row">
			                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

			                                        <table width="100%" border="0" cellspacing="2" cellpadding="0" style="background-color: black;">
			                                            <tr>
			                                                <td valign="top">
			                                                    <p style=" text-align:center;">
			                                                    	<img  width="150px" height="150px" src="http://afiliados.bangoenergygel.com/frontend/images/redondo.png" class="brand_logo" alt="Logo">
			                                                    </p>
			                                                    <p style="color: white; font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:center;">
			                                                        <strong>¡Hola ' . $vnombinvitado . '!</strong>
			                                                        <br>
			                                                        <br> ' . $vnombres . ' te ha invitado para que te unas a Bango Energy Gel.
			                                                    </p> 
			                                                    <p style="color: white; font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:center">Haz clic en este v&iacute;nculo para que te inscribas:
			                                                        <br>
			                                                        <br>
			                                                        <a href="'. $unir_url .'" title="Invita a tus amigos" target="_blank" style="border:medium; font-family:Verdana, Geneva, sans-serif; font-size:12px; color:white;"> <strong> ' . $unir_url . ' </strong> </a>
			                                                    </p>
			                                                    <br>
			                                                </td>
			                                            </tr>
			                                        </table>
			                                        
			                                    </div>
			                                </div>
			                            </form>
			                        </div>
			                    </div>     
			                </div>
			            </div>
			        </div>
			    </div>
			    </body>
			    <!--welcome area end-->
			</html>
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
			$mail->Username = 'registros@bangoenergygel.com';
			$mail->Password = 'registros.bango2018';
			$mail->SetFrom('notificaciones@bangoenergygel.com', 'Notificaciones Bango Energy Gel');
			$mail->Subject = html_entity_decode('Forma parte de Bango Energy Gel');
				
			$mail->Body = $codigohtml;		
			$mail->AddAddress($vemailinvitado);
			$mail->Send();	

			$error = array("exito" => "exito" );
			echo json_encode($error, true);
    	}

    }

    public function niveles_app($cedula, $niveles )
    {
	    	
    	if($niveles == 1){
    		$nivel = User::where('codpatrocinador', $cedula )->get();

    		return response()->json($nivel);
    	}

    	if($niveles == 2){
    		$nivel1 = User::where('codpatrocinador', $cedula )->get();

    		$cedulas_nivel1 = array();
    		$i =0;
    		foreach ($nivel1 as $nivel1) {
    			$cedulas_nivel1[$i] = $nivel1->cedula; 
    			$i=$i+1;
    		}

			$nivel = User::whereIn('codpatrocinador', $cedulas_nivel1 )->get();
			return response()->json($nivel);
    	}

    	if($niveles == 3){
    		//return json_encode($nivel3_afiliados);
    		$nivel1 = User::where('codpatrocinador', $cedula )->get();


    		$cedulas_nivel1 = array();
    		$i =0;
    		foreach ($nivel1 as $nivel1) {
    			$cedulas_nivel1[$i] = $nivel1->cedula; 
    			$i=$i+1;
    		}

    		$nivel2 = User::whereIn('codpatrocinador', $cedulas_nivel1 )->get();

    		$cedulas_nivel2 = array();
    		$x =0;
    		foreach ($nivel2 as $nivel2) {
    			$cedulas_nivel2[$x] = $nivel2->cedula; 
    			$x=$x+1;
    		}

    		$nivel = User::whereIn('codpatrocinador', $cedulas_nivel2 )->get();

    		return response()->json($nivel);
    	}

    	if($niveles >3){
    		$mensaje = array("mensaje" => 'error' );
			//return json_encode($mensaje, true);
			return response()->json($mensaje);	
    	}

    }

    public function prueba()
    {
    	return view('administracion.prueba');
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


}
