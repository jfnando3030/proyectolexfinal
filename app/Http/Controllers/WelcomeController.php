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

    	
    	

        return view('administracion.index');
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
