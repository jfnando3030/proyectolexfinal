<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\Rule;
use Mail;
use PHPMailer\PHPMailer\PHPMailer;
use App\User;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verify(Request $request)
    {
        if ($request->route('id') != $request->user()->getKey()) {
            throw new AuthorizationException;
        }

        if ($request->user()->hasVerifiedEmail()) {
            Session::flash('message', 'Usted ya verifico su correo electrónico anteriormente.');
            return redirect($this->redirectPath());
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }


        if($request->user()->codpatrocinador == '0992760621001'){
            $emailto =$request->user()->email;

            $nombres = $request->user()->nombres . ' ' . $request->user()->apellidos;
            $cedula = $request->user()->cedula;

            $url_invitacion = 'http://afiliados.bangoenergygel.com/administracion/invita/bango/' . $nombres . '/' . $cedula;

            $codigohtml = '
                <head>
                    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
                 </head>

                 <body style="background-color:black;">
                    <div style="width:100%; background-color:black; text-align:center;">
                        <div style="width:550px;margin:50px auto; background-color:white;">
                            <div style="width:100%; padding-top:35px; padding-bottom:15px;">
                                <img width="213" border="0" style="width: 213px;" src="https://afiliados.bangoenergygel.com/frontend/images/redondo.png" alt="" />
                            </div>
                            <div style="width:100%; color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;">
                                <p style="color:#999; line-height:0px;margin-top:-15px;">_</p>
                            </div>
                            <div style="color: #888888; font-size: 16px; font-family: Work Sans, Calibri, sans-serif; line-height: 24px; width:400px; margin:30px auto; text-align:center;">
                                <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify">&iexcl;Bienvenido ' . $nombres  . ', muchas gracias por registrarte!</p> 

                                <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify">Queremos aprovechar la oportunidad para presentarnos: somos <strong>Nutrispot S.A.</strong> comercializadores de suplementos alimenticios hechos de banano, como <a href="https://www.bangoenergygel.com/" target="_blank">BanGo Energy Gel</a> que es un <em>shot</em> de agua de coco con banano, no contiene aditivos, preservantes ni saborizantes artificiales de ning&uacute;n tipo, <strong>es totalmente natural y seguro de consumir</strong>, disponemos de otros productos que podr&aacute;s revisar en nuestro sitio web, <a href="https://www.bangoenergygel.com/" target="_blank">click aqu&iacute;</a>.</p>

                                 <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify">
                                 Tu informaci&oacute;n, acorde lo ingresado es esta:
                                 .        
                                       <table width="80%" border="0" align="left" cellpadding="3" cellspacing="2" style="font-family: Verdana, Geneva, sans-serif; font-size: 11px; text-align:justify">
                                         <tr align="center" valign="middle">
                                           <td width="35%" align="left" valign="middle"><strong>Nombres:</strong></td>
                                           <td width="65%" align="left">' . $request['nombres'] . '&nbsp;</td>
                                         </tr>
                                         <tr align="center" valign="middle">
                                           <td align="left" valign="middle"><span><strong>Apellidos:</strong></span></td>
                                           <td align="left"> ' . $request['apellidos'] . ' &nbsp;</td>
                                         </tr>
                                         <tr align="center" valign="middle">
                                           <td align="left" valign="middle"><strong>C&eacute;dula de identidad:</strong></td>
                                           <td align="left"> ' . $cedula . '  &nbsp;</td>
                                         </tr>
                                         <tr align="center" valign="middle">
                                           <td align="left" valign="middle"><strong>Contrase&ntilde;a:</strong></td>
                                           <td align="left">' . $request['password']. '&nbsp;</td>
                                         </tr>
                                         <tr align="center" valign="middle">
                                           <td align="left" valign="middle"><strong>Link de invitaci&oacute;n:</strong></td>
                                           <td align="left"><a href="' . $url_invitacion . '" target="_blank"> ' . $url_invitacion . '</a>&nbsp;</td>
                                         </tr>
                                   </table></td>
                                 </tr>
                                  <tr>
                                    <td align="left" valign="top"><br>  
                                       <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify">Por favor guarda esta informaci&oacute;n en alg&uacute;n sitio de r&aacute;pido y f&aacute;cil acceso.  </p>
                                    <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify"><strong>A partir de este momento ya puedes comprar tus productos Bango y adem&aacute;s invitar a tus amigos a que se inscriban y adquieran BanGo por lo que ganar&aacute;s dinero o productos, lo que decidas.</strong></p>
                                    
                                       <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify">Antes de finalizar quisi&eacute;ramos recordarte <strong>actualizar tus datos</strong> en el backoffice en la secci&oacute;n respectiva.</p>
                                     <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify">' . $nombres .', nuevamente bienvenido y muchas gracias por tu confianza.</p>
                                 <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify">&iexcl;Un abrazo!,<br/> <br/><br/>
                                 
                                 Sucre P&eacute;rez  MacCollum / Ricardo Jurado Faggioni <br/>
                                 Fundadores <br/>
                                 NutriSpot S.A.</p>
                                 <p style="font-family: Verdana, Geneva, sans-serif; font-size: 11px;"><span><strong>ESTA ES UNA COMUNICACI&Oacute;N AUTOM&Aacute;TICA, POR FAVOR NO RESPONDER.</strong></span></p>
                                </td></tr></table>

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
            $mail->SMTPSecure = 'tls';
            $mail->Host = 'smtp.mandrillapp.com';
            $mail->Port = 587;              
            $mail->IsHTML(true);
            $mail->CharSet = 'UTF-8';

            //confirmaciones
            $mail->Username = 'Guayas Emprende por Internet';
            $mail->Password = '5luKaRwGdN_5wKEUWTfc6w';
            $mail->SetFrom('confirmaciones@bangoenergygel.com', 'Notificaciones Bango Energy Gel');
            $mail->Subject = html_entity_decode('Forma parte de Bango Energy Gel');
                
            $mail->Body = $codigohtml;      
            $mail->AddAddress($emailto);
            $mail->Send();   

        }else{  

            $existe_codigo = User::where('cedula', $request->user()->codpatrocinador )->get();

            $emailto = $existe_codigo[0]->email;

            $nombres = $existe_codigo[0]->nombres . ' ' . $existe_codigo[0]->apellidos;
            $nombres_invitado = $request->user()->nombres . ' ' . $request->user()->apellidos;
            $cedula_invitado = $request->user()->cedula;


            $codigohtml = '
                <head>
                    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
                 </head>

                 <body style="background-color:black;">
                    <div style="width:100%; background-color:black; text-align:center;">
                        <div style="width:550px;margin:60px auto; background-color:white;">
                            <div style="width:100%; padding-top:35px; padding-bottom:15px;">
                                <img width="213" border="0" style="width: 213px;" src="https://afiliados.bangoenergygel.com/frontend/images/redondo.png" alt="" />
                            </div>
                            <div style="width:100%; color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;">
                                <p style="color:#999; line-height:0px;margin-top:-15px;">_</p>
                            </div>
                            <div style="color: #888888; font-size: 16px; font-family: Work Sans, Calibri, sans-serif; line-height: 24px; width:400px; margin:30px auto; text-align:center;">
                                <p>&iexcl;Saludos ' . $nombres . '!, queremos informate que tu invitado ' . $nombres_invitado . ' con c&oacute;digo ' . $cedula_invitado . ' se ha confirmado en <strong>Bango Energy Gel</strong>, &iexcl;felicitaciones!, te invitamos a que hagas el seguimiento del caso <strong>para que adquiriera nuestros productos y puedas comisionar el 10%.</strong></p>
                                <p>&iexcl;Adelante, que el cielo es el l&iacute;mite!<br>
                                Cordialmente</p>
                                <p><strong>Sucre P&eacute;rez MacCollum / Ricardo Jurado Faggioni</strong><br>
                                Fundadores de Bango Energy Gel</p>          
                            </div>
                            <div style="color: #888888; font-size: 12px; font-family: Work Sans, Calibri, sans-serif; line-height: 14px; width:400px; margin:30px auto; text-align:justify;">
                                <p>PD. Por favor imprime este correo y gu&aacute;rdalo en un sitio de f&aacute;cil acceso, si tienes alguna inquietud por favor escribe a <a href="mailto:info@bangoenergygel.com">info@bangoenergygel.com"</a> </p>
                            </div>      
                            <div style="width:550px;margin:0px auto; color:#999; font-family: Work Sans, Calibri, sans-serif;background-color:dimgray; padding-top:10px; padding-bottom:10px;">
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



            $emailto2 = $request->user()->email; 

            $nombres = $request->user()->nombres . ' ' . $request->user()->apellidos; 
            $cedula = $request->user()->cedula;

            $url_invitacion = 'http://afiliados.bangoenergygel.com/administracion/invita/bango/' . $nombres . '/' . $cedula;

            $codigohtml = '
                <head>
                    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
                 </head>

                 <body style="background-color:black;">
                    <div style="width:100%; background-color:black; text-align:center;">
                        <div style="width:550px;margin:50px auto; background-color:white;">
                            <div style="width:100%; padding-top:35px; padding-bottom:15px;">
                                <img width="213" border="0" style="width: 213px;" src="https://afiliados.bangoenergygel.com/frontend/images/redondo.png" alt="" />
                            </div>
                            <div style="width:100%; color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;">
                                <p style="color:#999; line-height:0px;margin-top:-15px;">_</p>
                            </div>
                            <div style="color: #888888; font-size: 16px; font-family: Work Sans, Calibri, sans-serif; line-height: 24px; width:400px; margin:30px auto; text-align:center;">
                                <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify">&iexcl;Bienvenido ' . $nombres  . ', muchas gracias por registrarte!</p> 

                                <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify">Queremos aprovechar la oportunidad para presentarnos: somos <strong>Nutrispot S.A.</strong> comercializadores de suplementos alimenticios hechos de banano, como <a href="https://www.bangoenergygel.com/" target="_blank">BanGo Energy Gel</a> que es un <em>shot</em> de agua de coco con banano, no contiene aditivos, preservantes ni saborizantes artificiales de ning&uacute;n tipo, <strong>es totalmente natural y seguro de consumir</strong>, disponemos de otros productos que podr&aacute;s revisar en nuestro sitio web, <a href="https://www.bangoenergygel.com/" target="_blank">click aqu&iacute;</a>.</p>

                                 <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify">
                                 Tu informaci&oacute;n, acorde lo ingresado es esta:
                                 .        
                                       <table width="80%" border="0" align="left" cellpadding="3" cellspacing="2" style="font-family: Verdana, Geneva, sans-serif; font-size: 11px; text-align:justify">
                                         <tr align="center" valign="middle">
                                           <td width="35%" align="left" valign="middle"><strong>Nombres:</strong></td>
                                           <td width="65%" align="left">' . $request->user()->nombres  . '&nbsp;</td>
                                         </tr>
                                         <tr align="center" valign="middle">
                                           <td align="left" valign="middle"><span><strong>Apellidos:</strong></span></td>
                                           <td align="left"> ' . $request->user()->apellidos . ' &nbsp;</td>
                                         </tr>
                                         <tr align="center" valign="middle">
                                           <td align="left" valign="middle"><strong>C&eacute;dula de identidad:</strong></td>
                                           <td align="left"> ' . $cedula . '  &nbsp;</td>
                                         </tr>
                                         <tr align="center" valign="middle">
                                           <td align="left" valign="middle"><strong>Contrase&ntilde;a:</strong></td>
                                           <td align="left">' . $request['password']. '&nbsp;</td>
                                         </tr>
                                         <tr align="center" valign="middle">
                                           <td align="left" valign="middle"><strong>Link de invitaci&oacute;n:</strong></td>
                                           <td align="left"><a href="' . $url_invitacion . '" target="_blank"> ' . $url_invitacion . '</a>&nbsp;</td>
                                         </tr>
                                   </table></td>
                                 </tr>
                                  <tr>
                                    <td align="left" valign="top"><br>  
                                       <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify">Por favor guarda esta informaci&oacute;n en alg&uacute;n sitio de r&aacute;pido y f&aacute;cil acceso.  </p>
                                    <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify"><strong>A partir de este momento ya puedes comprar tus productos Bango y adem&aacute;s invitar a tus amigos a que se inscriban y adquieran BanGo por lo que ganar&aacute;s dinero o productos, lo que decidas.</strong></p>
                                    
                                       <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify">Antes de finalizar quisi&eacute;ramos recordarte <strong>actualizar tus datos</strong> en el backoffice en la secci&oacute;n respectiva.</p>
                                     <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify">' . $nombres .', nuevamente bienvenido y muchas gracias por tu confianza.</p>
                                 <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify">&iexcl;Un abrazo!,<br/> <br/><br/>
                                 
                                 Sucre P&eacute;rez  MacCollum / Ricardo Jurado Faggioni <br/>
                                 Fundadores <br/>
                                 NutriSpot S.A.</p>
                                 <p style="font-family: Verdana, Geneva, sans-serif; font-size: 11px;"><span><strong>ESTA ES UNA COMUNICACI&Oacute;N AUTOM&Aacute;TICA, POR FAVOR NO RESPONDER.</strong></span></p>
                                </td></tr></table>

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
            $mail->SMTPSecure = 'tls';
            $mail->Host = 'smtp.mandrillapp.com';
            $mail->Port = 587;              
            $mail->IsHTML(true);
            $mail->CharSet = 'UTF-8';

            //confirmaciones
            $mail->Username = 'Guayas Emprende por Internet';
            $mail->Password = '5luKaRwGdN_5wKEUWTfc6w';
            $mail->SetFrom('confirmaciones@bangoenergygel.com', 'Notificaciones Bango Energy Gel');
            $mail->Subject = html_entity_decode('Forma parte de Bango Energy Gel');
                
            $mail->Body = $codigohtml;      
            $mail->AddAddress($emailto2);
            $mail->Send();   

        }

        Session::flash('message', 'Tu correo electrónico ha sido verificada exitosamente.');

        return redirect($this->redirectPath())->with('verified', true);
    }


     public function resend2(Request $request, $email)
    {
            
        $usuario = User::where('email', $email)->get();

        $emailto2 = $usuario[0]->email; 

        $nombres = $usuario[0]->nombres . ' ' . $usuario[0]->apellidos; 
        
        $codigohtml = '
            <head>
                <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,700" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
             </head>

             <body style="background-color:black;">
                <div style="width:100%; background-color:black; text-align:center;">
                    <div style="width:550px;margin:50px auto; background-color:white;">
                        <div style="width:100%; padding-top:35px; padding-bottom:15px;">
                            <img width="213" border="0" style="width: 213px;" src="https://afiliados.bangoenergygel.com/frontend/images/redondo.png" alt="" />
                        </div>
                        <div style="width:100%; color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;">
                            <p style="color:#999; line-height:0px;margin-top:-15px;">_</p>
                        </div>
                        <div style="color: #888888; font-size: 16px; font-family: Work Sans, Calibri, sans-serif; line-height: 24px; width:400px; margin:30px auto; text-align:center;">
                            <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify">Hola  ' . $nombres  . ', queremos recordarte que aun no has confirmado tu correo electrónico, para hacerlo, solo da clic en el enlace de abajo:</p> 
                            <br>
                            <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:center">
                             <a href="https://afiliados.bangoenergygel.com/email/verification/' . $emailto2 . '" style="background-color:red; color:white; text-decoration: none; padding: 12px; font-weight: 800;" target="_blank">Haz click aquí</a>
                           </p>

                            

                        </div>
                            
                        <div style="width:550px;margin:0px auto; color:#999; font-family: Work Sans, Calibri, sans-serif;background-color: dimgray; padding-top:10px; padding-bottom:10px;">
                            <table style="margin:auto auto;">
                                <tr>
                                    <td width="90" style="color:#999; font-family: Work Sans, calibri, sans-serif;font-size:13px; font-weight:bold;">
                                        <p style="color: white; ">S&iacute;guenos:</p>
                                    </td>               
                                    <td width="250">
                                    <p><a href="https://www.twitter.com/BangoEc" target="_blank"><img width="30" src="http://download.seaicons.com/download/i49182/yootheme/social-bookmark/yootheme-social-bookmark-social-twitter-button-blue.ico" alt="twitter" style="margin-right:15px;"/></a>
                                    <a href="https://www.facebook.com/BangoEnergyGel/" target="_blank"><img width="30" src="https://cdn0.iconfinder.com/data/icons/yooicons_set01_socialbookmarks/512/social_facebook_button_blue.png" alt="twitter" style="margin-right:15px;"/></a>
                                    <a href="https://www.instagram.com/bangoenergygel/" target="_blank"><img width="30" src="https://3.bp.blogspot.com/-PLtBjidnB-o/W5Ap8VkGNTI/AAAAAAAAAv4/5WmcJdRBWN0ut_7Kuq5AI1E_di6XaRh3ACLcBGAs/s1600/instagram-colourful-icon.png" alt="twitter"/></a></p>
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
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.mandrillapp.com';
        $mail->Port = 587;              
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';

        //confirmaciones
        $mail->Username = 'Guayas Emprende por Internet';
        $mail->Password = '5luKaRwGdN_5wKEUWTfc6w';
        $mail->SetFrom('confirmaciones@bangoenergygel.com', 'Notificaciones Bango Energy Gel');
        $mail->Subject = html_entity_decode('Forma parte de Bango Energy Gel');
            
        $mail->Body = $codigohtml;      
        $mail->AddAddress($emailto2);
        $mail->Send();   

        Session::flash('message', 'Invitación ha sido enviada.');
        
        return redirect('administracion/mired');

    }



}
