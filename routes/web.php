<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WelcomeController@index');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\AuthController@getRegister')->name('register');
Route::post('registrado', 'Auth\AuthController@postRegister')->name('registrado');;
Route::get('administracion/invita/bango/{nombres}/{cedula}','WelcomeController@invitar_bango_get');

Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::get('email/resend2/{email}', 'Auth\VerificationController@resend2')->name('verification.resend2');
Route::get('email/verification/{email}', 'WelcomeController@verificacion');


Route::get('administracion/prueba','WelcomeController@prueba');



// app bango
Route::get('administracion/app/login/{email}/{contra}','WelcomeController@login_app');
Route::get('administracion/app/registrar/{email}/{cedula}/{txt_codpatrocina}/{htxt_codpatrocin}/{nombre}/{apellidos}/{contrasena}','WelcomeController@registrar_app');
Route::get('administracion/app/invitar/{txt_nombreinvitado}/{txt_emailinvitado}/{cedula}','WelcomeController@invitar_app');
Route::get('administracion/app/niveles/{cedula}/{id}','WelcomeController@niveles_app');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');



Route::middleware(['auth', 'verified'])->group(function () {

	Route::get('administracion','WelcomeController@admin');
	Route::get('administracion/mired','WelcomeController@mired');
	

// ************************** DEPARTAMENTOS *************************************** 
	
	//REGISTRAR 
	Route::get('/administracion/departamento/registrar', 'WelcomeController@registrar_departamento');
	Route::post('/administracion/departamento/store', 'WelcomeController@store_departamento')->name('store_departamento');
	
	// LISTADO 
	Route::get('/administracion/departamento/listado', 'WelcomeController@listado_departamento');

	//LISTADO ABOGADOS
	Route::get('/administracion/departamento/abogados', 'WelcomeController@listarAbogados');

	//ACTUALIZAR 
	Route::get('/administracion/departamento/actualizar/{id}', 'WelcomeController@actualizar_departamento');
	Route::put('/administracion/departamento/editar', 'WelcomeController@editar_departamento')->name('editar_departamento');

	//ELIMINAR 
	Route::get('/administracion/departamento/eliminar/{id}', 'WelcomeController@eliminar_departamento');
 
// ************************** FIN DE  DEPARTAMENTOS ********************************* 

// ************************** SOLICITUDES *************************************** 
	
	//REGISTRAR 
	Route::get('/administracion/solicitud/registrar', 'WelcomeController@registrar_solicitud');
	Route::post('/administracion/solicitud/store', 'WelcomeController@store_solicitud')->name('store_solicitud');
	
	// LISTADO 
	//Route::get('/administracion/solicitud/listado', 'WelcomeController@listado_solicitud');
	
	Route::get('/administracion/solicitud/casos', 'WelcomeController@listado_solicitud_casos');

	//ACTUALIZAR 
	Route::get('/administracion/solicitud/actualizar/{id}', 'WelcomeController@actualizar_solicitud');
	Route::put('/administracion/solicitud/editar', 'WelcomeController@editar_solicitud')->name('editar_solicitud');

	// FINALIZAR CASO
	Route::get('/administracion/solicitud/Finalizar/{id}', 'WelcomeController@finalizar_casos');
	//ELIMINAR 
	//Route::get('/administracion/solicitud/eliminar/{id}', 'WelcomeController@eliminar_departamento');
 
// ************************** FIN DE  SOLICITUDES ********************************* 

// ************************** GESTIONAR CASOS *************************************** 
	
	//ACEPTAR CASOS POR ABOGADO 
	Route::get('/administracion/gestionar/casos/aceptar/{id}', 'WelcomeController@aceptar_casos')->name('aceptar');
	Route::get('/administracion/gestionar/casos/{id}', 'WelcomeController@ver_caso')->name('ver_caso');
	
	// CAMBIAR ABOGADO A LOS CASOS  
	Route::get('/administracion/gestionar/', 'WelcomeController@gestionar_casos');
	Route::get('/administracion/gestionar/casos/cambiar/{id}', 'WelcomeController@gestionar_abogado_casos');
	Route::get('/administracion/gestionar/casos/', 'WelcomeController@actualizar_abogado_caso')->name('actualizar_abogado_caso');

 
// ************************** FIN DE  SOLICITUDES ********************************* 


// ************************** RESPUESTAS *************************************** 
	Route::get('/administracion/casos/respuesta/{id}', 'WelcomeController@ver_respuesta')->name('ver_respuesta');
	Route::get('/administracion/casos/respuesta-abogado/{id}', 'WelcomeController@ver_respuesta2')->name('ver_respuesta2');
	Route::get('/administracion/notificaciones', 'NotificacionUserController@all_notificaciones')->name('all_notificaciones');
	
	//REGISTRAR 
	Route::get('/administracion/respuesta/registrar/{id}', 'WelcomeController@registrar_respuesta')->name('respuesta');
	Route::post('/administracion/respuesta/store', 'WelcomeController@store_respuesta')->name('store_respuesta');
	Route::post('/administracion/respuesta/store2', 'WelcomeController@store_respuesta2')->name('store_respuesta2');
	
	// LISTADO 
	//Route::get('/administracion/solicitud/listado', 'WelcomeController@listado_solicitud');

	//ACTUALIZAR 
	Route::get('/administracion/respuesta/actualizar/{id}', 'WelcomeController@actualizar_respuesta');
	Route::put('/administracion/respuesta/editar', 'WelcomeController@editar_respuesta')->name('editar_respuesta');

	//ELIMINAR 
	Route::get('/administracion/respuesta/eliminar/{id}', 'WelcomeController@eliminar_respuesta');
 
// ************************** FIN DE  RESPUESTAS ********************************* 

// ************************** PAGOS *************************************** 
	
	//REGISTRAR 
	Route::get('/administracion/pago/registrar', 'WelcomeController@registrar_pago')->name('registrar_pago');;
	Route::post('/administracion/pago/store', 'WelcomeController@store_pago')->name('store_pago');
	
	// LISTADO 
	//Route::get('/administracion/solicitud/listado', 'WelcomeController@listado_solicitud');
	
	Route::get('/administracion/pago/historial', 'WelcomeController@listado_pago');

	// FINALIZAR CASO
	Route::get('/administracion/pago/eliminar/{id}', 'WelcomeController@eliminar_pago');
	//ELIMINAR 
	//Route::get('/administracion/solicitud/eliminar/{id}', 'WelcomeController@eliminar_departamento');


	Route::get('administracion/pago/aprobacion', 'WelcomeController@aprobacion_pagos');
	Route::get('administracion/pagos/aprobar/{id}', 'WelcomeController@aprobacion_pagos_id');
	Route::get('administracion/pagos/cancelar/{id}', 'WelcomeController@cancelar_pagos_id');
	Route::get('administracion/pagos/cancelar2/{id}', 'WelcomeController@cancelar_pagos_id2');
 
// ************************** FIN DE  PAGOS ********************************* 

	Route::get('administracion/invita/bango','WelcomeController@invita_bango');
	Route::get('administracion/saber_niveles/{id}','WelcomeController@saber_niveles');

	Route::post('administracion/enviar_mail_invitacion','WelcomeController@enviar_mail_invitacion')->name('enviar_mail_invitacion');
	
	//Route::get('administracion/afiliados/total','WelcomeController@admin');
	

	Route::resource('administracion/perfil', 'PerfilController');
	Route::resource('administracion/herramientas', 'HerramientasController');
	Route::resource('administracion/documentos', 'DocumentoController');
	Route::resource('administracion/usuarios', 'UserController');


	Route::get('administracion/ganancia/historial','WelcomeController@historial_ganancia_vista');

	Route::resource('administracion/tarifa', 'TarifaController');


// ************************** PAYPAL *************************************** 
	
	// route for view/blade file
	Route::get('paywithpaypal', array('as' => 'paywithpaypal','uses' => 'AddMoneyController@payWithPaypal',));
	// route for post request
	Route::post('paypal', array('as' => 'paypal','uses' => 'AddMoneyController@postPaymentWithpaypal',));
	// route for check status responce
	Route::get('paypal', array('as' => 'status','uses' => 'AddMoneyController@getPaymentStatus',));

// ************************** FIN DE PAYPAL ********************************* 

//*******************************OFICIO********************************
	Route::get('administracion/oficio', 'OficioController@create');
	Route::post('administracion/oficio/procuracion_judicial', 'OficioController@pj');
	Route::post('administracion/oficio/contrato_arrendamiento', 'OficioController@ca');
	Route::post('administracion/oficio/contrato_psppacj', 'OficioController@psppacj');
	Route::post('administracion/oficio/contrato_psp', 'OficioController@psp');
	
	Route::get('/administracion/notificaciones/{id}', 'NotificacionUserController@notificacion')->name('notificacion');

});

Route::match(['get', 'post'], 'ajax-image-upload', 'ImageController@ajaxImage');