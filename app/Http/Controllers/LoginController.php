<?php

namespace Gesol\Http\Controllers;

use Illuminate\Http\Request;

//Validacion
use Gesol\Http\Requests\ValidaLoginRequest;

//Bibliotecas para login
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Gesol\usuarios;

//Consultar a base de datos
use DB;



class LoginController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidaLoginRequest $request)
    {
        
        //Proceso de loggeo
       if(Auth::attempt(['email' => $request['correo'], 'password' => $request['password']])){

            //Proceso para integrar datos de usuario a sesion despues de loggearse
            //obtener todos los datos del usuario con ese correo
            $usuarioLoggeado = DB::table('usuarios')->where('email', $request['correo'])->first();     

            //añadir atributos de usuario a sesion y tomar decisiones en
            //navbar respecto a eso
            $request->session()->put('sesionIniciada', true);

            $request->session()->put('rol_id', $usuarioLoggeado->rol_id);

            $request->session()->put('email', $usuarioLoggeado->email);

            $request->session()->put('usu_nombres', $usuarioLoggeado->usu_nombres);

            $request->session()->put('usu_apellidos', $usuarioLoggeado->usu_apellidos);

            $request->session()->put('usu_cedula', $usuarioLoggeado->usu_cedula);

            $request->session()->put('usu_telefono', $usuarioLoggeado->usu_telefono);

            $request->session()->put('usu_foto', $usuarioLoggeado->usu_foto);

            //Determinar nombre del rol
            if ($usuarioLoggeado->rol_id == 3) {
                $request->session()->put('rol_nombre', 'Coordinador (Admin)');
            }elseif ($usuarioLoggeado->rol_id == 2) {
                $request->session()->put('rol_nombre', 'Secretario(a)');
            }elseif ($usuarioLoggeado->rol_id == 4) {
                $request->session()->put('rol_nombre', 'Decano(a)');
            }elseif ($usuarioLoggeado->rol_id == 5) {
                $request->session()->put('rol_nombre', 'Docente');
            }else{
                $request->session()->put('rol_nombre', 'Estudiante');
            }
        
            //envío de mensaje.
            Session::flash('mensaje-exito', '¡Bienvenido a Gesol!');  
            //return redirect()->intended('/');
            return Redirect::to('/');

        }else{

            Session::flash('mensaje-error', 'El correo electronico o la contraseña son incorrectos');
            //return redirect()->intended('/iniciarSesion');
            return Redirect::to('/iniciarSesion');
        }
    }

    public function logout(){

        //cerrar sesion
        Auth::logout();

        //enviar mensaje informativo
        Session::flash('mensaje-exito', 'Has cerrado sesion.');    

        //borrar todas lasvariables de sesion
        Session::flush();

        //redireccionar
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
