<?php

namespace Gesol\Http\Controllers;

use Illuminate\Http\Request as RequestAjax;
use Gesol\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
//Importar validaciones
use Gesol\Http\Requests\ValidaLoginRequest;
use Gesol\Http\Requests\ValidaUsuarioCreateRequest;
use Gesol\Http\Requests\ValidaUsuarioUpdateRequest;
//Importar modelo
use Gesol\usuarios;
use DB;

class UsuarioController extends Controller
{
    public function __construct(){

        /*Aplicar primera proteccion. Necesita esta autenticarse para todo
        menos para registrarse. Se redireccionará segun lo escrito en Exceptions/handler@*/
        $this->middleware('autenticado')->except('create', 'store', 'formIniciarSesion', 'offline');
        /*Segunda proteccion. Los usuarios registrados solo pueden entrar a index de usuario
        si son administradores*/
        $this->middleware('administrador')->only('index', 'destroy', 'verDashboard');

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
     * Muestra el dashboard para iniciar admiistradores
     *
     * @return \iniciarSesion
     */
    public function verDashboard(){

        $cantSol=DB::select(DB::raw("SELECT count(sol_id) as cuenta FROM solicitudes JOIN usuarios ON solicitudes.usu_cedula = usuarios.usu_cedula WHERE usuarios.ins_id =" . Session('ins_id') ))[0]->cuenta;

        $cantResp=DB::select(DB::raw("SELECT count(res_id) as cuenta FROM respuestas JOIN usuarios ON respuestas.usu_cedula = usuarios.usu_cedula WHERE usuarios.ins_id =" . Session('ins_id') ))[0]->cuenta;

        $cantUsu=DB::select(DB::raw("SELECT count(usu_cedula) as cuenta FROM usuarios WHERE rol_id = 1 AND ins_id = " . Session('ins_id') ))[0]->cuenta;

        $cantCompa=DB::select(DB::raw("SELECT count(usu_cedula) as cuenta FROM usuarios WHERE rol_id IN (2,4,5) AND ins_id = " . Session('ins_id') ))[0]->cuenta;

        return view('vistasUsuarios.indexDashboard', compact(['cantSol', 'cantResp', 'cantUsu', 'cantCompa']));
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

        $instituciones = \DB::table('instituciones')
        ->select('ins_id', 'ins_nombre')
        ->get();

        return view('vistasUsuarios.create', compact('instituciones'));
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
                    'ins_id' =>$request['institucion'],
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
                    'password'=>\Hash::make($request['password']),
                    'ins_id' =>$request['institucion']

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

        $usuario = new Usuarios();
        $usuario = usuarios::find($usu_cedula);

        //Comprobación y guardado de foto (en caso de que haya adjuntado una)
        $ext = "jpg";
        $conFoto = false;
        $conFirma = false;

        //Si añadió foto a traves de la camara
        if(!empty($request['foto'])){

            $conFoto=true;
            $ext = "jpg";
            $encoded_data = $request['foto'];
            $binary_data = base64_decode( $encoded_data );

            $result = file_put_contents(  base_path() . '/public/images/fotos_usuarios/foto_usuario' . Session('usu_cedula') . '.jpg', $binary_data );
            
        }
        //Si añadió foto a traves de archivo
        if (isset($request['foto2'])){

            $conFoto=true;
            $ext = explode( '/',$_FILES['foto2']['type'])[1];
            $targetfile = base_path() . '/public/images/fotos_usuarios/foto_usuario'. Session('usu_cedula') . '.' . $ext;
            move_uploaded_file($_FILES['foto2']['tmp_name'], $targetfile);

        }
        //Si añadió firma 
        if (isset($request['firma'])){

            $conFirma = true;
            $ext = explode( '/',$_FILES['firma']['type'])[1]; //obtener la eztensión de imagen con explode posición 1
            $targetfile = base_path() . '/public/images/firmas_usuarios/firma_usuario'. Session('usu_cedula') . '.' . $ext; //definir el nombre final del archivo en servidor (firma_usuario1046669400.jpeg)
            move_uploaded_file($_FILES['firma']['tmp_name'], $targetfile); //mover el archivo subido a la ubicación deseada dentro del servidor. El nombre se cambia aquí con el nombre que le de $targetfile

        }

        
        //En caso de que quiera cambiar su contraseña
        if (!empty($request['password'])) {
            $usuario->password = \Hash::make($request['password']);
        }

        //En caso de que el admin especifique el rol
        if(isset($request['rol'])){
            $usuario->rol_id = $request['rol'];
        }

        //Continuar con la actualización normal
        $usuario->usu_cedula = $request['cedula'];
        $usuario->usu_nombres = $request['nombres'];
        $usuario->usu_apellidos = $request['apellidos'];
        $usuario->usu_genero = $request['genero'];
        $usuario->usu_fechaNac = $request['fechaNac'];
        $usuario->usu_telefono = $request['telefono'];
        $usuario->email = $request['correo'];

        //Definir si agregar una foto o no
        if ($conFoto) {
            $usuario->usu_foto = 'foto_usuario'.Session('usu_cedula') . '.' . $ext;
            $request->session()->put('usu_foto', 'foto_usuario'.Session('usu_cedula') . '.' . $ext);
        }
        //Definir si agregar firma
        if ($conFirma) {
            $usuario->usu_firma = 'firma_usuario'.Session('usu_cedula') . '.' . $ext;
        }

        //terminar
        $usuario->save();
        
        //Poner mensaje informativo
        Session::flash('mensaje-exito', 'Se ha actualizado exitosamente');
        return Redirect::to('/');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($usu_cedula)
    {

        $listaSols = \DB::table('solicitudes')
        ->select('sol_formato')
        ->where('usu_cedula', '=', $usu_cedula)
        ->get();

        

        //Eliminar todas los archvos PDF creados por ese usuario

        if ($listaSols != null) {
            
            foreach ($listaSols as $solicitud) {
                //dd(base_path() . '/public/solicitudesPDF/' . $solicitud->sol_formato);

               unlink( base_path() . '/public/solicitudesPDF/' . $solicitud->sol_formato);
            
                    
            }

        }

        usuarios::destroy($usu_cedula);

        Session::flash('mensaje-exito', 'El usuario se ha eliminado satisfactoriamente');
        return Redirect::to('/usuarios');

    }

}