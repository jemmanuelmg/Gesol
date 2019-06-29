<?php

namespace Gesol\Http\Controllers;

use Illuminate\Http\Request;
use telesign\sdk\messaging\MessagingClient;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
//Importar validaciones
//Importar modelo
use Gesol\usuarios;

class SmsController extends Controller
{
	public function enviarSmsConfirmacion($telefono){


		$token = rand(1000, 9999);

		$customer_id = "E03FF2E9-A27B-4A11-8DC9-C11DF6D54E3E";
            $api_key = "SDnEC0qB848NLboLrs1iHNZD7jOndtV7Um2xBOvQEL1EvojRkSzXQ2wOuYx2tGAhXXgcABxc1ccxpVsuA1EBnA==";

			//$phone_number = $request->telefono;
		$phone_number = $telefono;
		$message = "\n\n Saludos desde Gesol! Tu código de confirmación es: \n\n" . $token . "\n\n El equipo Gesol.";
		$message_type = "ARN";

		$messaging = new MessagingClient($customer_id, $api_key);
		$response = $messaging->message($phone_number, $message, $message_type);

		return json_encode(array(
			'status'=> 'success',
			'token' => $token
		));

	}

	

	public function enviarPassword(Request $request){

		$telefono = $request['telefono'];

		$usuario = new Usuarios();
		$usuario = usuarios::where('usu_telefono', '=', $telefono)->first();

		//pruebas con usuario predefinido
		//$usuario = usuarios::where('usu_cedula', '=', '199988833')->first();

		if ($usuario === null) {

		   Session::flash('mensaje-error', 'No se ha encontrado ningún usuario con número de teléfono ' . $telefono . '. Vuelva a intentarlo');
           return Redirect::to('/resetPassword/reset');

		}else{

			//Actualizar contraseña a usuario de forma provisional
			$pw = rand(100000, 999999);
			$usuario->password = \Hash::make($pw);
			$usuario->save();

			//Enviar mensaje de texto:
			$customer_id = "E03FF2E9-A27B-4A11-8DC9-C11DF6D54E3E";
            $api_key = "SDnEC0qB848NLboLrs1iHNZD7jOndtV7Um2xBOvQEL1EvojRkSzXQ2wOuYx2tGAhXXgcABxc1ccxpVsuA1EBnA==";

			$phone_number = '57' . $telefono;
			$message = "\n\n Saludos desde Gesol! Tu contraseña provisional es: \n\n" . $pw  . "\n\n El equipo Gesol.";
			$message_type = "ARN";

			$messaging = new MessagingClient($customer_id, $api_key);
			$response = $messaging->message($phone_number, $message, $message_type);


			Session::flash('mensaje-exito', 'Se ha enviado un SMS con tu contraseña provisional. Revisala');
            return Redirect::to('/');

		}

	}
}
