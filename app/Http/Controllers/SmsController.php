<?php

namespace Gesol\Http\Controllers;

use Illuminate\Http\Request;
use telesign\sdk\messaging\MessagingClient;

class SmsController extends Controller
{
	public function enviarSmsConfirmacion($telefono){

	$arreglo = array('msg'=> 'Esta llegando al metodo y el telefono es'. $telefono,
				'other' => 'value');

	return json_encode($arreglo);


		//if(!$request->ajax()){
			

			/*
			$token = rand(1000, 9999);

			$customer_id = "44153ECC-F0AD-4D45-9F23-E95431EC8C63";
			$api_key = "orub9TGHNbP1itCRoF1lFINssYfy+VHYJI8FnXNp2hhzc2/S9QOGmZyQQHVR1qmbaIxfVQjgsgInHrz9JymGHQ==";

			//$phone_number = $request->telefono;
			$phone_number = $telefono;
			$message = "____ \n\n Saludos desde Gesol! Tu código de confirmación es: \n\n" . $token . "\n\n El equipo Gesol.";
			$message_type = "ARN";

			$messaging = new MessagingClient($customer_id, $api_key);
			$response = $messaging->message($phone_number, $message, $message_type);

			return response()->json({
				'status'=> 'success',
				'token' => $token
			});

			*/

		//}

	}
}
