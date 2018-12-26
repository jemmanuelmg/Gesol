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

	/**
	 * Rutas generales.
	 */
Route::get('/', function () {
	return view('index');
});

Route::get('/ayuda', function () {
	return view('vistasUsuarios.paginaAyuda');
});

	/**
	 * Rutas de usuario.
	 */
Route::resource('usuarios','UsuarioController'); 
Route::get('iniciarSesion','UsuarioController@formIniciarSesion');

	/**
	 * Rutas de respuestas.
	 * Para comenzar a redactar respuesta se necesita saber la ruta del archivo pdf para editarlo
	 * y el nombre de la solicitud para despacharlo a el formulario correspondiente
	 * de esa solicitud
	 */
Route::resource('respuestas','RespuestasController'); 
Route::get('redactarRespuesta/{sol_nombre}/{sol_formato}/{sol_id}', 'RespuestasController@despachadorVistasRespuestas');

	/**
	 * Rutas de solicitudes.
	 */
Route::resource('solicitudes','SolicitudesController'); 
Route::get('redactarSolicitud', 'SolicitudesController@mostrarSelectorSolicitudes');
Route::post('solicitudes/despachador', 'SolicitudesController@despachadorVistasSolicitudes');
Route::get('solicitudes/misSolicitudes/{usu_cedula}','SolicitudesController@verMisSolicitudes'); 

	/**
	 * Rutas de loggeo.
	 */
Route::resource('login','LoginController');
Route::get('logout','LoginController@logout');

	 /**
	 * Rutas de correo electronico.
	 */
Route::resource('contacto','CorreoController');

	/**
	 * Rutas reestablecimiento de contraseña.
	 */
Route::get('resetPassword/reset', 'resetPassword\ForgotPasswordController@showLinkRequestForm');
Route::post('resetPassword/email', 'resetPassword\ForgotPasswordController@sendResetLinkEmail');
Route::get('resetPassword/reset/{token}', 'resetPassword\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('resetPassword/reset', 'resetPassword\ResetPasswordController@reset');

	/**
	 * Rutas metricas software
	 */
Route::get('metricas', 'MetricasController@generarMetricas');

	/**
	* Rutas para nexmo sms
	*/
Route::get('confirmarSms/{telefono}', 'SmsController@enviarSmsConfirmacion');


/*Tests*/

Route::get('grafico1', 'MetricasController@procesarG1');
Route::get('grafico2', 'MetricasController@procesarG2');
Route::get('grafico3', 'MetricasController@procesarG3');
Route::get('lala', 'MetricasController@lala');



Route::get('test/cargar', function(){
	return view('tests.iconoTest');
});

Route::get('lala', 'MetricasController@lala');
