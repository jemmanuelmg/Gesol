<?php

namespace Gesol\Http\Controllers;

use Gesol\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
//Importar validaciones
use Gesol\Http\Requests\ValidaLoginRequest;
use Gesol\Http\Requests\ValidaUsuarioCreateRequest;
use Gesol\Http\Requests\ValidaUsuarioUpdateRequest;
//Importar modelo
use Gesol\usuarios;

class UsuarioController extends Controller
{
    public function __construct(){

        /*Aplicar primera proteccion. Necesita esta autenticarse para todo
        menos para registrarse. Se redireccionará segun lo escrito en Exceptions/handler@*/
        $this->middleware('autenticado')->except('create', 'store', 'formIniciarSesion');
        /*Segunda proteccion. Los usuarios registrados solo pueden entrar a index de usuario
        si son administradores*/
        $this->middleware('administrador')->only('index', 'destroy');

    }

    /**
     * Muestra el formulrio para iniciar sesion
     *
     * @return \iniciarSesion
     */
    public function formIniciarSesion(){
        return view('vistasUsuarios.formIniciarSesion');
    }


    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //el \ antes de BD es por que bd es una clase, y el \ indica el namespace.

        $listaUsuarios = \DB::table('usuarios')
        ->join('roles', 'usuarios.rol_id', '=', 'roles.rol_id')
        ->select('usu_cedula', 'usu_nombres', 'usu_apellidos', 'usu_genero', 'usu_fechaNac','usu_telefono', 'email', 'rol_nombre')
        ->get();

        //compact usa solo el nombre de la variable sin el $
        return view('vistasUsuarios.indexUsuarios', compact('listaUsuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('vistasUsuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //Para validacion el request debe venir de validacion
    public function store(ValidaUsuarioCreateRequest $request)
    {

        if($request['token'] === $request['tokenRes']){
            if(isset($request['rol'])){

                usuarios::create([

                    'usu_cedula'=>$request['cedula'],
                    'usu_nombres'=>$request['nombres'],
                    'usu_apellidos'=>$request['apellidos'],
                    'usu_genero'=>$request['genero'],
                    'usu_fechaNac'=>$request['fechaNac'],
                    'usu_telefono'=>$request['telefono'],
                    'email'=>$request['correo'],
                    'password'=> \Hash::make($request['password']),
                    'rol_id'=>$request['rol']

                ]);

                Session::flash('mensaje-exito', 'Se ha ingresado un nuevo usuario satisfactoriamente por ADMIN');
                return Redirect::to('/');

            }else{

            //En caso de que sea un registro ordinario 
            //(hecho por estudiante o secretaria)
                usuarios::create([

                    'usu_cedula'=>$request['cedula'],
                    'usu_nombres'=>$request['nombres'],
                    'usu_apellidos'=>$request['apellidos'],
                    'usu_genero'=>$request['genero'],
                    'usu_fechaNac'=>$request['fechaNac'],
                    'usu_telefono'=>$request['telefono'],
                    'email'=>$request['correo'],
                    'password'=>\Hash::make($request['password'])

                ]);

                Session::flash('mensaje-exito', 'Se ha ingresado un nuevo usuario satisfactoriamente');
                return Redirect::to('/');

            }    
        }else{
            
            Session::flash('mensaje-error', 'El número de confirmación enviado a tu celular no coincide. Vuelve a intentarlo');
            return Redirect::to('/usuarios/create');                
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
        //Para mostrar datos de un usuario, solo lectura
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * antes public function edit($id)
     */
    public function edit($usu_cedula)
    {
        //tambien puede usarse \Gesol\usuarios::
     $usuario = usuarios::find($usu_cedula);

       //En vez de compact se puede escribir un array como segundo parametro ['nombre' => '$valor'].
     return view('vistasUsuarios.edit', compact('usuario'));
 }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidaUsuarioUpdateRequest $request, $usu_cedula)
    {

        //Comprobación y guardado de foto (en caso de que haya adjuntado una)
        $ext = "";
        if(!empty($request['foto'])){

            $ext = ".jpg";
            $encoded_data = $request['foto'];
            $binary_data = base64_decode( $encoded_data );

            // save to server (beware of permissions)
            $result = file_put_contents(  base_path() . '/public/images/fotos_usuarios/' . Session('usu_cedula') . '.jpg', $binary_data );
            
        }

        if (isset($request['foto2'])){

            $ext = explode( '/',$_FILES['foto2']['type'])[1];

            $targetfile = base_path() . '/public/images/fotos_usuarios/'. Session('usu_cedula') . '.' . $ext;

            move_uploaded_file($_FILES['foto2']['tmp_name'], $targetfile);

        }

        $usuario = new Usuarios();
        $usuario = usuarios::find(Session('usu_cedula'));

        //En caso de que quiera cambiar su contraseña
        if (isset($request['password'])) {
            $usuario->password = \Hash::make($request['password']);
        }

        //En caso de que el admin especifique el rol
        if(isset($request['rol'])){
            
            $usuario->rol_id = $request['rol'];

        }else{

            $usuario->usu_cedula = $request['cedula'];
            $usuario->usu_nombres = $request['nombres'];
            $usuario->usu_apellidos = $request['apellidos'];
            $usuario->usu_genero = $request['genero'];
            $usuario->usu_fechaNac = $request['fechaNac'];
            $usuario->usu_telefono = $request['telefono'];
            $usuario->email = $request['correo'];
            $usuario->usu_foto = Session('usu_cedula') . $ext;

            $usuario->save();

            Session::flash('mensaje-exito', 'Se ha actualizado exitosamente');
            return Redirect::to('/');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($usu_cedula)
    {

        usuarios::destroy($usu_cedula);

        Session::flash('mensaje-exito', 'El usuario se ha eliminado satisfactoriamente');
        return Redirect::to('/usuarios');

    }
}