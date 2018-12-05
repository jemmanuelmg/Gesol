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
        return view('correos.contacto');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidaCorreoContactoRequest $request)
    {
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
}
