<?php

namespace Gesol\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gesol\solicitudes;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Gesol\Http\Requests\ValidaFormsSolicitudes;
use Gesol\Http\Requests\ValidaUpdateRespuestaRequest;
use DB;

class SolicitudesController extends Controller{

    public function __construct(){
        //Ojo, para que funcionen los demas mids, debe agregarse el auth
        $this->middleware('autenticado');
        $this->middleware('secretario')->only('index', 'destroy', 'edit', 'update');

    }


    /**
     * ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
     * ::::::::::::::::::::::::::::::::::Métodos CRUD :::::::::::::::::::::::::::::::::::
     * ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
     */

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
    public function edit($sol_id)
    {
        $solicitud = solicitudes::find($sol_id);
        return view('vistasSolicitudes.edit', compact('solicitud'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidaUpdateRespuestaRequest $request, $sol_id)
    {
        $solicitud = Solicitudes::find($sol_id);

        $solicitud->sol_nombre = $request['nombre'];
        $solicitud->sol_fechaCreacion = $request['fechaHora'];
        $solicitud->sol_estado = $request['estado'];
        $solicitud->usu_cedula = $request['cedula'];

        $solicitud->save();


        Session::flash('mensaje-exito', 'Se ha actualizado la informacion exitosamente');
        return Redirect::to('/solicitudes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($sol_id)
    {
        $solicitud = solicitudes::find($sol_id);
        $nombreArchivo = $solicitud->sol_formato;

        solicitudes::destroy($sol_id);

        //Eliminar el archivo PDF
        unlink('../public/solicitudesPDF/' . $nombreArchivo);

        Session::flash('mensaje-exito', 'La solicitud y su pdf se han eliminado satisfactoriamente');
        return Redirect::to('/solicitudes');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Campos ambiguos: si un campo se llama igual en dos tablas
        //hay que seleccionarlo como tabla.campo: usuarios.usu_cedula
        //Seleccionar las solicitudes que puede editar cada rol.
        
        if (session('rol_id') == 3 || session('rol_id') == 2) {     //Si es coordinador o secretaria
            
            $listaSol = \DB::table('solicitudes')
            ->join('usuarios', 'usuarios.usu_cedula', '=', 'solicitudes.usu_cedula')
            ->select('sol_id','sol_nombre', 'sol_formato', 'sol_fechaCreacion', 'sol_estado', 'usu_nombres','usu_apellidos', 'usuarios.usu_cedula', 'email')            
            ->get();

        } elseif (session('rol_id') == 5) {     //Si es docente
            $listaSol = \DB::table('solicitudes')
            ->join('usuarios', 'usuarios.usu_cedula', '=', 'solicitudes.usu_cedula')
            ->select('sol_id','sol_nombre', 'sol_formato', 'sol_fechaCreacion', 'sol_estado', 'usu_nombres','usu_apellidos', 'usuarios.usu_cedula', 'email') 
            ->whereIn('sol_nombre', array('R-DC-13', 'R-DC-14'))           
            ->get();

        } elseif (session('rol_id') == 4) {     //Si es decano
            $listaSol = \DB::table('solicitudes')
            ->join('usuarios', 'usuarios.usu_cedula', '=', 'solicitudes.usu_cedula')
            ->select('sol_id','sol_nombre', 'sol_formato', 'sol_fechaCreacion', 'sol_estado', 'usu_nombres','usu_apellidos', 'usuarios.usu_cedula', 'email')
            ->whereIn('sol_nombre', array('R-DC-13', 'R-DC-40'))             
            ->get();
        }

        //compact usa solo el nombre de la variable sin el signo '$'
        return view('vistasSolicitudes.indexSolicitudes', compact('listaSol'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
        Este método se ha reemplazado por
        'despachador de solicitudes', el cual muestra el formulario
        para la creacion de cada una (diligenciamiento), lo que haría normalmente create
        pero al ser varias solicitudes, no se puede mostrar solo una
        No quise usar el método create por que, para distinguir cual formulario 
        deberia mostrar, se hace menester agregarle un parámetro, y sería faltar
        al estandar HTTP para el método create (mala practica).
        */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        switch ($request['codSol']){

            case 'R-DC-13':
            $this->procesarRDC13($request);
            break;

            case "R-DC-14":
            $this->procesarRDC14($request);
            break;

            case "R-DC-39":
            $this->procesarRDC39($request);
            break;

            case "R-DC-40":
            $this->procesarRDC40($request);
            break;

            case "R-DC-52":
            $this->procesarRDC52($request);
            break;

            default:
            Session::flash('mensaje-error', 'La solicitud seleccionada no existe.');
            return Redirect::to('/redactarSolicitud');
        }

    }

    /**
     * :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
     * ::::::::::::::::::::::::::::::::::Métodos Solicitudes :::::::::::::::::::::::::::::
     * :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
     */

    /**
     * Mostrar la pantalla para seleccionar solicitud
     */
    public function verMisSolicitudes($usu_cedula)
    {

     $listaSol = \DB::table('solicitudes')
     ->join('usuarios', 'usuarios.usu_cedula', '=', 'solicitudes.usu_cedula')
     ->select('sol_id','sol_nombre', 'sol_formato', 'sol_fechaCreacion', 'sol_estado', 'usu_nombres','usu_apellidos', 'usuarios.usu_cedula')
     ->where('usuarios.usu_cedula', '=', Session('usu_cedula'))
     ->get();

        //compact usa solo el nombre de la variable sin el $
     return view('vistasSolicitudes.misSolicitudes', compact('listaSol'));
 }


    /**
     * Mostrar la pantalla para seleccionar solicitud
     */
    public function mostrarSelectorSolicitudes()
    {

        return view('vistasSolicitudes.selectorSolicitudes');
    }

    /**
     * Mostrar la pantalla para seleccionar solicitud
     */
    public function despachadorVistasSolicitudes(Request $request){
        
        switch ($request['codSol']) {

            case 'R-DC-13':
            return view('vistasSolicitudes.R-DC-13Formulario');
            break;

            case "R-DC-14":
            return view('vistasSolicitudes.R-DC-14Formulario');
            break;

            case "R-DC-39":
            return view('vistasSolicitudes.R-DC-39Formulario');
            break;

            case "R-DC-40":
            return view('vistasSolicitudes.R-DC-40Formulario');
            break;

            case "R-DC-52":
            return view('vistasSolicitudes.R-DC-52Formulario');
            break;

            default:
            Session::flash('mensaje-error', 'La solicitud seleccionada no existe.');
            return Redirect::to('/redactarSolicitud');
    }
}


    

    /**
     * Método llamado por store para procesar toda la informacion
     *  proveniente de una solicitud R-DC-39
     *  ->crear PDF
     *  ->mostrar PDF  a usuario
     *  ->registrar en la base de datos
     *  ->enviar correo a usuario con solicitud creada
     */
    public function procesarRDC39(Request $request)
    {

        //Consultar cuantas veces el usuario ha hecho esta misma solicitud
        $sol_nombre = 'R-DC-39';
        $usu_cedula = Session('usu_cedula');

        $cuantasVeces = DB::table('solicitudes')->where([
            ['sol_nombre' , '=', $sol_nombre],
            ['usu_cedula' , '=', $usu_cedula],
            ])->count();


        //Esta consulta no lleva ->get() por que se extrae un numero.
        //con funciones de agragacion no se usa get.

        // Iniciar el objeto para hacer operaciones
        $pdf = new \fpdi\FPDI('P', 'mm','Letter');

        //Nueva Página
        $pdf->AddPage();

        //Extraer plantilla desde pdf existente
        $pdf->setSourceFile("../public/basePDF/R-DC-39.pdf");

        //Importar página de plantilla (en este caso, la 1)
        $tplIdx = $pdf->importPage(1);

        //Poner esta pagina en nueo documento con coordenadas de posicion
        $pdf->useTemplate($tplIdx, 1, 1, 217, 279);

        $pdf->SetTitle('R-DC-39');
        $pdf->SetFont('Arial','',10);
        $pdf->SetTextColor(0, 0, 0);

        // Ahora escribir información en la página
        $pdf->SetTitle('R-DC-39');
        $pdf->SetFont('Arial','',10);
        $pdf->SetTextColor(0, 0, 0);

        //Variables
        $Apellidos = $request["apellidos"];
        $Nombres = $request["nombres"];
        $Cedula = $request["cedula"];
        $Programa = $request["programa"];
        $Semestre = $request["semestre"];
        $Jornada = $request["jornada"];
        $Direccion = $request["direccion"];
        $EMail = $request["e-mail"];
        $Telefono = $request["telefono"];
        $Modificacion = $request["modificacion"];
        $Programa2 = $request["programa2"];
        $Jornada2 = $request["jornada2"];
        $Asignaturas = $request["Asignaturas"];
        $NombreA = $request["NombreA"];
        $CodigoA = $request["CodigoA"];
        $Observaciones = $request["Observaciones"];
        $Modificacion2 = $request["modificacion2"];
        $Dia = $request["Dia"];
        $Mes = $request["Mes"];
        $Año = $request["Año"];
        $otroMotivo = $request["otroMotivo"];


        //Renglon 1

        $pdf->SetXY(14, 51);
        $pdf->Write(0, $Apellidos);

        $pdf->SetXY(89, 51);
        $pdf->Write(0,  $Nombres);

        $pdf->SetXY(157, 51);
        $pdf->Write(0, $Cedula);

        //Renglon 2

        $pdf->SetXY(14, 61);
        $pdf->Write(0,  $Programa);

        $pdf->SetXY(89, 61);
        $pdf->Write(0, $Semestre);

        $pdf->SetXY(157, 61);
        $pdf->Write(0, $Jornada);

        //Renglon 3

        $pdf->SetXY(14, 70);
        $pdf->Write(0, $Direccion);

        $pdf->SetXY(89, 70);
        $pdf->Write(0, $EMail);

        $pdf->SetXY(157, 70);
        $pdf->Write(0, $Telefono);

        //Programa al que aspira
        $pdf->SetXY(16, 111);
        $pdf->Write(0, $Programa2);

        //Tipo de Modificacion

        if ($Modificacion=='Cancelacion') {
            $pdf->SetXY(76.5, 84);
            $pdf->Write(0, 'x');
        }elseif ($Modificacion=='Aplazamiento') {
            $pdf->SetXY(76.5, 88.4);
            $pdf->Write(0, 'x');
        }elseif ($Modificacion=='CambioJornada') {
            $pdf->SetXY(76.5, 93.3);
            $pdf->Write(0, 'x');
        }elseif ($Modificacion=='Readmision') {
            $pdf->SetXY(76.5, 98.3);
            $pdf->Write(0, 'x');
        }elseif ($Modificacion=='Transferencia') {
            $pdf->SetXY(76.5, 102.3);
            $pdf->Write(0, 'x');
        }else{
            $pdf->SetXY(76.5, 123.3);
            $pdf->Write(0, '');
        }

        //Jornada 

        if ($Jornada2=='diurna') {
            $pdf->SetXY(49, 119);
            $pdf->Write(0, 'X');
        }elseif ($Jornada2=='nocturna') {
            $pdf->SetXY(80.5, 119);
            $pdf->Write(0, 'X');
        }else{
            $pdf->SetXY(76.5, 123.3);
            $pdf->Write(0, '');
        }

        //Inclusion Asignatura o Cancelacion

        if ($Asignaturas=='Inclusion') {
            //Inclusion Asignatura
            $pdf->SetXY(162.5, 84.5);
            $pdf->Write(0, 'X');
            //Nombre de la asignatura
            $pdf->SetXY(135, 93);
            $pdf->Write(0, $NombreA);
            //Codigo asignatura
            $pdf->SetXY(135, 98);
            $pdf->Write(0, $CodigoA);
        }elseif ($Asignaturas=='Cancelacion'){
            //Inclusion Asignatura
            $pdf->SetXY(162.5, 107);
            $pdf->Write(0, 'X');
            //Nombre de la asignatura
            $pdf->SetXY(135, 116);
            $pdf->Write(0, $NombreA);
            //Codigo asignatura
            $pdf->SetXY(135, 121);
            $pdf->Write(0, $CodigoA);
        }else{
            $pdf->SetXY(76.5, 123.3);
            $pdf->Write(0, '');
        }

        //Observaciones
        $pdf->SetXY(14, 138);
        $pdf->Write(0, $Observaciones);

        //Motivo de la modificacíón
        if ($Modificacion2=='DificultadAcademica') {
            $pdf->SetXY(79.5, 152.5);
            $pdf->Write(0, 'X');
        }elseif ($Modificacion2=='Traslado') {
            $pdf->SetXY(79.5, 157.5);
            $pdf->Write(0, 'X');
        }elseif ($Modificacion2=='Bajorendimiento') {
            $pdf->SetXY(79.5, 162.5);
            $pdf->Write(0, 'X');
        }elseif ($Modificacion2=='Dificultades') {
            $pdf->SetXY(79.5, 168.5);
            $pdf->Write(0, 'X');
        }elseif ($Modificacion2=='Cambio') {
            $pdf->SetXY(146.5, 152.5);
            $pdf->Write(0, 'X');
        }elseif ($Modificacion2=='Dificultadesfamiliares') {
            $pdf->SetXY(146.5, 157.5);
            $pdf->Write(0, 'X');
        }elseif ($Modificacion2=='Ubicacionlaboral') {
            $pdf->SetXY(146.5, 162.5);
            $pdf->Write(0, 'X');
        }elseif ($Modificacion2=='Eleccionequivocada') {
            $pdf->SetXY(146.5, 167.5);
            $pdf->Write(0, 'X');
        }elseif ($Modificacion2=='Enfermedad') {
            $pdf->SetXY(190, 152.5);
            $pdf->Write(0, 'X');
        }elseif ($Modificacion2=='Economicos') {
            $pdf->SetXY(190, 157.5);
            $pdf->Write(0, 'X');
        }elseif ($Modificacion2=='Otra') {
            $pdf->SetXY(26, 181.5);
            $pdf->Write(0, 'X');
        }else{
            $pdf->SetXY(76.5, 123.3);
            $pdf->Write(0, '');
        }

        $pdf->SetXY(26, 181.5);
        $pdf->Write(0, $otroMotivo);

        //Fecha de solicitud 

        $pdf->SetXY(50, 191);
        $pdf->Write(0, $Dia);
        $pdf->SetXY(60, 191);
        $pdf->Write(0, $Mes);
        $pdf->SetXY(68, 191);
        $pdf->Write(0, $Año);

        $pdf->Close();

        /**
        * mostrar el PDF en pantalla y al mismo tiempo guardarlo en una carpeta.
        * el primer output lo guarda en el servidor local. El segundo muestra a el usuario
        * Guardar en servidor local, con numero de cedula y nombre de solicitud
        * mas numero para diferenciar la solicitud de otra igual
        * P.ej: 1046668700-R-DC-39No3.pdf
        */
        $sol_formato = Session('usu_cedula') . '-R-DC-39' . 'No' . $cuantasVeces . '.pdf';
        $rutaGuardar = '../public/solicitudesPDF/' . $sol_formato;

        /**
        * Iniciar proceso de registro de datos en BD
        * Tomo la cedula de la sesion iniciada por ser mas confiable 
        * que la ingreasda en formulario
        */

        solicitudes::create([

            'sol_nombre'=>'R-DC-39',
            'sol_formato'=>$sol_formato,
            'sol_estado' => 'Pendiente',
            'usu_cedula' => Session('usu_cedula')

            ]);

        //Enviar correo para informar que la solicitud se ha creado
        //se envia como parametro el correo de destino y el nombre de archivo
        $this->enviarCorreo($sol_formato, Session('email'));

        //Enviar mensaje de texto
        $this->enviarSms($sol_nombre);

        $pdf->Output($rutaGuardar, 'F'); 
        $pdf->Output($sol_formato, 'I'); 

    }

    /**
     * Método llamado por store para procesar toda la informacion
     *  proveniente de una solicitud R-DC-13
     *  ->crear PDF
     *  ->mostrar PDF  a usuario
     *  ->registrar en la base de datos
     *  ->enviar correo a usuario con solicitud creada
     */
    public function procesarRDC13(Request $request){

        $sol_nombre = 'R-DC-13';
        $usu_cedula = Session('usu_cedula');

        $cuantasVeces = DB::table('solicitudes')->where([
            ['sol_nombre' , '=', $sol_nombre],
            ['usu_cedula' , '=', $usu_cedula],
            ])->count();

        $pdf = new \fpdi\FPDI('P', 'mm','Letter');

        $pdf->AddPage();

        $pdf->setSourceFile("../public/basePDF/R-DC-13.pdf");

        $tplIdx = $pdf->importPage(1);

        $pdf->useTemplate($tplIdx, 1, 1, 217, 279);

        $pdf->SetTitle('R-DC-13');
        $pdf->SetFont('Arial','',10);
        $pdf->SetTextColor(0, 0, 0);

        //Variables

        $Apellidos = $_POST["apellidos"];
        $Nombres = $_POST["nombres"];
        $Cedula = $_POST["cedula"];
        $Programa = $_POST["programa"];
        $Jornada = $_POST["jornada"];
        $Asignatura = $_POST["asignatura"];
        $Telefono = $_POST["telefono"];
        $Consignacion = $_POST["consignacion"];
        $Dia = $_POST["dia"];
        $Mes = $_POST["mes"];
        $Año = $_POST["año"];


        //Renglon 1

        $pdf->SetXY(14, 58);
        $pdf->Write(0, $Apellidos);

        $pdf->SetXY(86, 58);
        $pdf->Write(0,  $Nombres);

        $pdf->SetXY(160, 58);
        $pdf->Write(0, $Cedula);

        //Renglon 2

        $pdf->SetXY(14, 69);
        $pdf->Write(0,  $Programa);

        $pdf->SetXY(105, 69);
        $pdf->Write(0, $Jornada);

        $pdf->SetXY(142, 69);
        $pdf->Write(0, $Asignatura);

        //Fecha de solicitud 

        
        $pdf->SetXY(30, 81);
        $pdf->Write(0, $Dia." /");
        $pdf->SetXY(36, 81);
        $pdf->Write(0, $Mes." /");
        $pdf->SetXY(56, 81);
        $pdf->Write(0, $Año." /");

        //Renglon 3

        $pdf->SetXY(83, 81);
        $pdf->Write(0, $Consignacion);

        $pdf->SetXY(158, 81);
        $pdf->Write(0, $Telefono);

        //si el usuario decide añadir recibo
        if(isset($request['imgRecibo'])){

            //Agregar imagen recibo de pago a solicitud
            $nombreImg =  Session('usu_cedula') . 'Recibo' . '.' .$request->file('imgRecibo')->getClientOriginalExtension();

            $request->file('imgRecibo')->move(
                base_path() . '/public/recibosPago/', $nombreImg
            );

            //Añadir imagen recibo de pago

            $pdf->AddPage();
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(78, 20);
            $pdf->Write(0, 'RECIBO DE PAGO PARA LA SOLICITUD');
            $pdf->SetXY(78, 20);
            $pdf->Write(0, '');
            $pdf->Image('../public/recibosPago/' . $nombreImg, 10, 30, 170);

            //Eliminar la imagen subida al servidor
            unlink('../public/recibosPago/' . $nombreImg);
        }

        $pdf->Close();

        //Crear nombre del  pdf para guardar localmente en server
        $sol_formato = Session('usu_cedula') . '-R-DC-13' . 'No' . $cuantasVeces . '.pdf';
        $rutaGuardar = '../public/solicitudesPDF/' . $sol_formato;

        //Enviar correo al usuario con solicitud creada
        $this->enviarCorreo($sol_formato, Session('email'));

        //Guardar registro en BD
        solicitudes::create([
            'sol_nombre'=>'R-DC-13',
            'sol_formato'=>$sol_formato,
            'sol_estado' => 'Pendiente',
            'usu_cedula' => Session('usu_cedula')
            ]);

        $pdf->Output($rutaGuardar, 'F');
        $pdf->Output($sol_formato, 'I'); 

    }

    /**
     * Método llamado por store para procesar toda la informacion
     *  proveniente de una solicitud R-DC-14
     *  ->crear PDF
     *  ->mostrar PDF  a usuario
     *  ->registrar en la base de datos
     *  ->enviar correo a usuario con solicitud creada
     */
    public function procesarRDC14(Request $request){

        $sol_nombre = 'R-DC-14';
        $usu_cedula = Session('usu_cedula');

        $cuantasVeces = DB::table('solicitudes')->where([
            ['sol_nombre' , '=', $sol_nombre],
            ['usu_cedula' , '=', $usu_cedula],
            ])->count();

        $pdf = new \fpdi\FPDI('P', 'mm','Letter');

        $pdf->AddPage();

        $pdf->setSourceFile("../public/basePDF/R-DC-14.pdf");

        $tplIdx = $pdf->importPage(1);

        $pdf->useTemplate($tplIdx, 1, 1, 217, 279);

        $pdf->SetTitle('R-DC-14');
        $pdf->SetFont('Arial','',10);
        $pdf->SetTextColor(0, 0, 0);

        //Variables
        $Apellidos = $_POST["apellidos"];
        $Nombres = $_POST["nombres"];
        $Cedula = $_POST["cedula"];
        $Programa = $_POST["programa"];
        $Jornada = $_POST["jornada"];
        $Direccion = $_POST["direccion"];
        $Telefono = $_POST["telefono"];
        $Asignatura = $_POST["asignatura"];
        $CodigoA = $_POST["codigoA"];
        $Periodo = $_POST["periodo"];
        $Docente = $_POST["docente"];
        $Motivo = $_POST["motivo"];
        $Dia = $_POST["dia"];
        $Mes = $_POST["mes"];
        $Año = $_POST["año"];


        //Renglon 1
        $pdf->SetXY(14, 57);
        $pdf->Write(0, $Apellidos);

        $pdf->SetXY(78, 57);
        $pdf->Write(0,  $Nombres);

        $pdf->SetXY(132, 57);
        $pdf->Write(0, $Cedula);

        //Renglon 2
        $pdf->SetXY(14, 69);
        $pdf->Write(0,  $Programa);

        $pdf->SetXY(133, 69);
        $pdf->Write(0, $Jornada);

        $pdf->SetXY(14, 78);
        $pdf->Write(0, $Direccion);

        $pdf->SetXY(133, 78);
        $pdf->Write(0, $Telefono);

        $pdf->SetXY(36, 86);
        $pdf->Write(0, $Asignatura);

        $pdf->SetXY(154, 86);
        $pdf->Write(0, $CodigoA);

        $pdf->SetXY(103, 93);
        $pdf->Write(0, $Periodo);

        $pdf->SetXY(136, 93);
        $pdf->Write(0, $Docente);

        $pdf->SetXY(14, 106);
        $pdf->Write(0, $Motivo);

        //Fecha de solicitud 
        $pdf->SetXY(58, 129);
        $pdf->Write(0, $Dia);
        $pdf->SetXY(67, 129);
        $pdf->Write(0, $Mes);
        $pdf->SetXY(76, 129);
        $pdf->Write(0, $Año);

        $pdf->Close();

        //Crear nombre del  pdf para guardar localmente en server
        $sol_formato = Session('usu_cedula') . '-R-DC-14' . 'No' . $cuantasVeces . '.pdf';
        $rutaGuardar = '../public/solicitudesPDF/' . $sol_formato;

        //Enviar correo al usuario con solicitud creada
        $this->enviarCorreo($sol_formato, Session('email'));

        //Guardar registro en BD
        solicitudes::create([
            'sol_nombre'=>'R-DC-14',
            'sol_formato'=>$sol_formato,
            'sol_estado' => 'Pendiente',
            'usu_cedula' => Session('usu_cedula')
            ]);

        $pdf->Output($rutaGuardar, 'F'); 
        $pdf->Output($sol_formato, 'I'); 
    }



    /**
     * Método llamado por store para procesar toda la informacion
     *  proveniente de una solicitud R-DC-14
     *  ->crear PDF
     *  ->mostrar PDF  a usuario
     *  ->registrar en la base de datos
     *  ->enviar correo a usuario con solicitud creada
     */
    public function procesarRDC40(Request $request){

        $sol_nombre = 'R-DC-40';
        $usu_cedula = Session('usu_cedula');

        $cuantasVeces = DB::table('solicitudes')->where([
            ['sol_nombre' , '=', $sol_nombre],
            ['usu_cedula' , '=', $usu_cedula],
            ])->count();

        $pdf = new \fpdi\FPDI('P', 'mm','Letter');

        $pdf->AddPage();

        $pdf->setSourceFile("../public/basePDF/R-DC-40.pdf");

        $tplIdx = $pdf->importPage(1);

        $pdf->useTemplate($tplIdx, 1, 1, 217, 279);

        $pdf->SetTitle('R-DC-40');
        $pdf->SetFont('Arial','',10);
        $pdf->SetTextColor(0, 0, 0);

        //Variables

        $Apellidos = $_POST["apellidos"];
        $Nombres = $_POST["nombres"];
        $Cedula = $_POST["cedula"];
        $Programa = $_POST["programa"];
        $Jornada = $_POST["jornada"];
        $Consignacion = $_POST["consignacion"];
        $Entidad = $_POST["entidad"];
        $Valor = $_POST["valor"];
        $Educativa = $_POST["Educativa"];
        $Direccion = $_POST["direccion"];
        $Telefono = $_POST["telefono"];
        $Estudios = $_POST["estudios"];
        $Tematicos = $_POST["tematicos"];
        $Folios = $_POST["folios"];
        $Folios2 = $_POST["folios2"];
        $Dia = $_POST["dia"];
        $Mes = $_POST["mes"];
        $Año = $_POST["año"];


        //Renglon 1

        $pdf->SetXY(14, 58);
        $pdf->Write(0, $Apellidos);

        $pdf->SetXY(88, 58);
        $pdf->Write(0,  $Nombres);

        $pdf->SetXY(149, 58);
        $pdf->Write(0, $Cedula);

        //Renglon 2

        $pdf->SetXY(14, 69);
        $pdf->Write(0,  $Programa);

        $pdf->SetXY(149, 69);
        $pdf->Write(0, $Jornada);


        $pdf->SetXY(14, 80);
        $pdf->Write(0, $Consignacion);

        $pdf->SetXY(82, 80);
        $pdf->Write(0, $Entidad);

        $pdf->SetXY(149, 80);
        $pdf->Write(0, $Valor);

        $pdf->SetXY(14, 91);
        $pdf->Write(0, $Educativa);

        $pdf->SetXY(82, 91);
        $pdf->Write(0, $Direccion);

        $pdf->SetXY(149, 91);
        $pdf->Write(0, $Telefono);

        if ($Estudios== true) {
            $pdf->SetXY(103.5, 117.5);
            $pdf->Write(0, "X");
        }else{
            $pdf->SetXY(0, 0);
            $pdf->Write(0, "");
        }

        if ($Tematicos== true) {
            $pdf->SetXY(103.5, 123.5);
            $pdf->Write(0, "X");
        }else{
            $pdf->SetXY(0, 0);
            $pdf->Write(0, "");
        }

        $pdf->SetXY(151, 117);
        $pdf->Write(0, $Folios);

        $pdf->SetXY(151, 123);
        $pdf->Write(0, $Folios2);

        //Fecha de solicitud 
        $pdf->SetXY(27, 140);
        $pdf->Write(0, $Dia);
        $pdf->SetXY(35, 140);
        $pdf->Write(0, $Mes);
        $pdf->SetXY(42, 140);
        $pdf->Write(0, $Año);

        //si el usuario decide añadir recibo
        if(isset($request['imgRecibo'])){

            //Agregar imagen recibo de pago a solicitud
            $nombreImg =  Session('usu_cedula') . 'Recibo' . '.' .$request->file('imgRecibo')->getClientOriginalExtension();

            $request->file('imgRecibo')->move(
                base_path() . '/public/recibosPago/', $nombreImg
            );

            //Añadir imagen recibo de pago

            $pdf->AddPage();
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(78, 20);
            $pdf->Write(0, 'RECIBO DE PAGO PARA LA SOLICITUD');
            $pdf->SetXY(78, 20);
            $pdf->Write(0, '');
            $pdf->Image('../public/recibosPago/' . $nombreImg, 10, 30, 170);

            //Eliminar la imagen subida al servidor
            unlink('../public/recibosPago/' . $nombreImg);
        }

        $pdf->Close();

        //Crear nombre del  pdf para guardar localmente en server
        $sol_formato = Session('usu_cedula') . '-R-DC-40' . 'No' . $cuantasVeces . '.pdf';
        $rutaGuardar = '../public/solicitudesPDF/' . $sol_formato;

        //Enviar correo al usuario con solicitud creada
        $this->enviarCorreo($sol_formato, Session('email'));

        //Guardar registro en BD
        solicitudes::create([
            'sol_nombre'=>'R-DC-40',
            'sol_formato'=>$sol_formato,
            'sol_estado' => 'Pendiente',
            'usu_cedula' => Session('usu_cedula')
            ]);

        $pdf->Output($rutaGuardar, 'F'); 
        $pdf->Output($sol_formato, 'I'); 

    }

    /**
     * Método llamado por store para procesar toda la informacion
     *  proveniente de una solicitud R-DC-14
     *  ->crear PDF
     *  ->mostrar PDF  a usuario
     *  ->registrar en la base de datos
     *  ->enviar correo a usuario con solicitud creada
     */
    public function procesarRDC52(Request $request){

        $sol_nombre = 'R-DC-52';
        $usu_cedula = Session('usu_cedula');

        $cuantasVeces = DB::table('solicitudes')->where([
            ['sol_nombre' , '=', $sol_nombre],
            ['usu_cedula' , '=', $usu_cedula],
            ])->count();

        $pdf = new \fpdi\FPDI('P', 'mm','Letter');

        $pdf->AddPage();

        $pdf->setSourceFile("../public/basePDF/R-DC-52.pdf");

        $tplIdx = $pdf->importPage(1);

        $pdf->useTemplate($tplIdx, 1, 1, 217, 279);

        $pdf->SetTitle('R-DC-52');
        $pdf->SetFont('Arial','',10);
        $pdf->SetTextColor(0, 0, 0);

        //Variables

        $Apellidos = $_POST["apellidos"];
        $Nombres = $_POST["nombres"];
        $Cedula = $_POST["cedula"];
        $Programa = $_POST["programa"];
        $Jornada = $_POST["jornada"];
        $Email = $_POST["email"];
        $Telefono = $_POST["telefono"];
        $Autoriza = $_POST["autoriza"];
        $Asignatura = $_POST["asignatura"];
        $CodigoA = $_POST["codigoA"];
        $Horas = $_POST["horas"];
        $Creditos = $_POST["creditos"];
        $Banco = $_POST["banco"];
        $Cuenta = $_POST["cuenta"];
        $Valor = $_POST["valor"];
        $Liquidacion = $_POST["liquidacion"];
        $Dia = $_POST["dia"];
        $Mes = $_POST["mes"];
        $Año = $_POST["año"];


        //Renglon 1

        $pdf->SetXY(14, 58);
        $pdf->Write(0, $Apellidos);

        $pdf->SetXY(88, 58);
        $pdf->Write(0,  $Nombres);

        $pdf->SetXY(143, 58);
        $pdf->Write(0, $Cedula);

        //Renglon 2

        $pdf->SetXY(14, 72);
        $pdf->Write(0,  $Programa);

        if ($Jornada=='diurna') {
            $pdf->SetXY(165, 67);
            $pdf->Write(0, 'X');
        }elseif ($Jornada=='nocturna') {
            $pdf->SetXY(195, 67);
            $pdf->Write(0, 'X');
        }else{
            $pdf->SetXY(76.5, 123.3);
            $pdf->Write(0, '');
        }


        $pdf->SetXY(14, 85);
        $pdf->Write(0, $Email);

        $pdf->SetXY(101, 85);
        $pdf->Write(0, $Telefono);

        if ($Autoriza=='si') {
            $pdf->SetXY(165, 84);
            $pdf->Write(0, 'X');
        }elseif ($Autoriza=='no') {
            $pdf->SetXY(195, 84);
            $pdf->Write(0, 'X');
        }else{
            $pdf->SetXY(76.5, 123.3);
            $pdf->Write(0, '');
        }

        $pdf->SetXY(14, 98);
        $pdf->Write(0, $Asignatura);

        $pdf->SetXY(101, 98);
        $pdf->Write(0, $CodigoA);

        $pdf->SetXY(150, 98);
        $pdf->Write(0, $Horas);

        $pdf->SetXY(14, 110);
        $pdf->Write(0, $Creditos);
        
        $pdf->SetXY(58, 110);
        $pdf->Write(0, $Banco);

        $pdf->SetXY(88, 110);
        $pdf->Write(0, $Cuenta);
        
        $pdf->SetXY(132, 110);
        $pdf->Write(0, $Valor);

        $pdf->SetXY(173, 110);
        $pdf->Write(0, $Liquidacion);
        //Fecha de solicitud 

        $pdf->SetXY(160, 138);
        $pdf->Write(0, $Dia);
        $pdf->SetXY(174, 138);
        $pdf->Write(0, $Mes);
        $pdf->SetXY(188, 138);
        $pdf->Write(0, $Año);

        $pdf->Close();


        //Crear nombre del  pdf para guardar localmente en server
        $sol_formato = Session('usu_cedula') . '-R-DC-52' . 'No' . $cuantasVeces . '.pdf';
        $rutaGuardar = '../public/solicitudesPDF/' . $sol_formato;

        //Enviar correo al usuario con solicitud creada
        $this->enviarCorreo($sol_formato, Session('email'));

        //Guardar registro en BD
        solicitudes::create([
            'sol_nombre'=>'R-DC-52',
            'sol_formato'=>$sol_formato,
            'sol_estado' => 'Pendiente',
            'usu_cedula' => Session('usu_cedula')
            ]);

        $pdf->Output($rutaGuardar, 'F'); 
        $pdf->Output($sol_formato, 'I'); 

    }



    /**
    * Metodo que envía correo electrónico al usuario con link
    * al pdf guardado en el servidor. Para eso recibe el nombre de archivo
    * y el correo del usuario. El nombre de archivo se usa
    * dentro de la plantilla plantillaConfirmaSol para construir el link al recurso.
    */
    public function enviarCorreo($sol_formato, $usuCorreo){

        //Arreglo de datos para funcion enviar

        $datosMensaje = [
        'sol_formato' => $sol_formato
        ];

        Mail::send('correos.plantillaConfirmaSol', $datosMensaje, function (Message $msj) use ($usuCorreo, $sol_formato){

            $msj->to($usuCorreo)
            ->from('gesol.uts@gmail.com',  'Gesol')
            ->subject('Confirmacion Gesol: solicitud guardada');
            
        });
    }

    /**
    * Metodo que envía sms al usuario informando que lasolicitud fué enviada con éxito.
    */
    public function enviarCorreo($sol_nombre){

        //Iniciar config de idioma y zona horaria
        setlocale(LC_ALL,"es_ES");
        date_default_timezone_set("America/Bogota");

        $customer_id = "44153ECC-F0AD-4D45-9F23-E95431EC8C63";
        $api_key = "orub9TGHNbP1itCRoF1lFINssYfy+VHYJI8FnXNp2hhzc2/S9QOGmZyQQHVR1qmbaIxfVQjgsgInHrz9JymGHQ==";

            //$phone_number = $request->telefono;
        $phone_number = '57' . Session('usu_telefono');
        $message = "\n\n Gesol te informa que tu solicitud " . $sol_nombre . " fué recibida correctamente el día: " . date("l") ." " . date("Y/m/d") . " a las " . date("h:i a") . ". \n Saludos!;
        $message_type = "ARN";

        $messaging = new MessagingClient($customer_id, $api_key);
        $response = $messaging->message($phone_number, $message, $message_type);

        return json_encode(array(
            'status'=> 'success',
            'token' => $token
        ));
    }
}
