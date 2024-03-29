<?php

namespace Gesol\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Gesol\Http\Requests\ValidaCorreoContactoRequest;

class CorreoController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $infoInstitucion = \DB::table('instituciones')
        ->select('ins_nombre', 'ins_direccion', 'ins_telefono', 'ins_email')
        ->where('ins_id', '=', Session('ins_id'))
        ->get();

        return view('correos.contacto', compact('infoInstitucion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidaCorreoContactoRequest $request)
    {

        $recaptcha = $request['g-recaptcha-response'];
        $humano = false;
        
        if ($recaptcha != '') {

            $secret = '6Le6e7IUAAAAANDn0mcfM_XW_AyXi3pbCQN71tFR';
            $ip = $_SERVER['REMOTE_ADDR'];
            $var = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $recaptcha . '&remoteip=' . $ip);
            $array = json_decode($var, true);

            if ($array['success']) {
                $humano = true;
            }else{
                Session::flash('mensaje-error', 'Porfavor, complete la validacion "No soy un robot" correctamente');
                return Redirect::to('contacto/create');
            }

        }else{
            Session::flash('mensaje-error', 'Porfavor, complete la validacion "No soy un robot" correctamente');
            return Redirect::to('contacto/create');
        }


        if($humano){

        //Arreglo de datos para funcion enviar
            $datosMensaje = [
                'nombre' => $request['nombre'],
                'correo' => $request['correo'], 
                'mensaje' => $request['mensaje']
            ];

        //Datos adicionales para funcion anonima

            $usuCorreo = $request['correo'];
            $usuNombre = $request['nombre'];
            $usuAsunto = $request['asunto'];

            Mail::send('correos.plantillaContacto', $datosMensaje, function (Message $msj) use ($usuCorreo, $usuNombre, $usuAsunto){
               
                $msj->to('gesol.uts@gmail.com', 'Gesol')
                ->from($usuCorreo,  $usuNombre)
                ->subject('Contacto a Gesol: ' . $usuAsunto);
            });

            Session::flash('mensaje-exito', 'Mensaje enviado correctamente');

            return Redirect::to('/');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function enviarCorreoConfirmacion($email){

        $token = rand(1000, 9999);

        
        $datosMensaje = [
        'token' => $token
        ];

        
        Mail::send('correos.plantillaEnviaToken', $datosMensaje, function (Message $msj) use ($email){

            $msj->to($email)
            ->from('gesol.uts@gmail.com',  'Gesol')
            ->subject('Gesol - Confirma tu cuenta');
        
        });
        

        

        return json_encode(array(
            'status'=> 'success',
            'token' => $token
        ));
    }
}
