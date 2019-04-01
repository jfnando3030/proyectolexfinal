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


	// para abogados 

	
	Route::get('administracion/invita/bango','WelcomeController@invita_bango');
	Route::get('administracion/saber_niveles/{id}','WelcomeController@saber_niveles');

	Route::post('administracion/enviar_mail_invitacion','WelcomeController@enviar_mail_invitacion')->name('enviar_mail_invitacion');
	
	//Route::get('administracion/afiliados/total','WelcomeController@admin');
	

	Route::resource('administracion/perfil', 'PerfilController');
	Route::resource('administracion/herramientas', 'HerramientasController');
	Route::resource('administracion/documentos', 'DocumentoController');



	Route::get('administracion/ganancia/historial','WelcomeController@historial_ganancia_vista');

	Route::resource('administracion/tarifa', 'TarifaController');

});

Route::match(['get', 'post'], 'ajax-image-upload', 'ImageController@ajaxImage');