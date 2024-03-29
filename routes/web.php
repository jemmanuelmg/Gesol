<?php

use Illuminate\Support\Facades\Session;

if (env('APP_ENV') === 'production') {
    URL::forceSchema('https');
}

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

Route::get('/aplicacion-movil-gesol', function () {
	return view('vistasUsuarios.appgesol');
});


Route::get('offline', 'UsuarioController@offline');

	/**
	 * Rutas de usuario.
	 */
Route::resource('usuarios','UsuarioController'); 
Route::get('iniciarSesion','UsuarioController@formIniciarSesion');

	/**
	 * Rutas dashboard administrador
	 */

Route::get('indexDashboard', 'UsuarioController@verDashboard');

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
Route::post('enviarPassword', 'SmsController@enviarPassword');


	/**
	 * Rutas metricas software
	 */
Route::get('metricas', 'MetricasController@generarMetricas');

	/**
	* Rutas para nexmo sms
	*/
Route::get('confirmarSms/{telefono}', 'SmsController@enviarSmsConfirmacion');
Route::get('confirmarConEmail/{email}', 'CorreoController@enviarCorreoConfirmacion');


	/**
	* Rutas para gráficos o métricas
	*/

Route::get('grafico1', 'MetricasController@procesarG1');
Route::get('grafico2', 'MetricasController@procesarG2');
Route::get('grafico3', 'MetricasController@procesarG3');


	/**
	* Rutas de error
	*/

Route::get('404', function () {
	return view('vistasErrores.404');
})->name('404');

Route::get('500', function () {
	return view('vistasErrores.500');
})->name('500');


