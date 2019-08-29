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
use telesign\sdk\messaging\MessagingClient;
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
        
        /*if (session('rol_id') == 3 || session('rol_id') == 2) {     //Si es coordinador o secretaria
            
            $listaSol = \DB::table('solicitudes')
            ->join('usuarios', 'usuarios.usu_cedula', '=', 'solicitudes.usu_cedula')
            ->select('sol_id','sol_nombre', 'sol_formato', 'sol_fechaCreacion', 'sol_estado', 'usu_nombres','usu_apellidos', 'usuarios.usu_cedula', 'email')
            ->orderBy('sol_fechaCreacion', 'desc')            
            ->get();

        } elseif (session('rol_id') == 5) {     //Si es docente
            $listaSol = \DB::table('solicitudes')
            ->join('usuarios', 'usuarios.usu_cedula', '=', 'solicitudes.usu_cedula')
            ->select('sol_id','sol_nombre', 'sol_formato', 'sol_fechaCreacion', 'sol_estado', 'usu_nombres','usu_apellidos', 'usuarios.usu_cedula', 'email')
            ->orderBy('sol_fechaCreacion', 'desc') 
            ->whereIn('sol_nombre', array('R-DC-13', 'R-DC-14'))           
            ->get();

        } elseif (session('rol_id') == 4) {     //Si es decano
            $listaSol = \DB::table('solicitudes')
            ->join('usuarios', 'usuarios.usu_cedula', '=', 'solicitudes.usu_cedula')
            ->select('sol_id','sol_nombre', 'sol_formato', 'sol_fechaCreacion', 'sol_estado', 'usu_nombres','usu_apellidos', 'usuarios.usu_cedula', 'email')
            ->orderBy('sol_fechaCreacion', 'desc')
            ->whereIn('sol_nombre', array('R-DC-13', 'R-DC-40'))             
            ->get();
        }*/

        $listaSol = \DB::table('solicitudes')
            ->join('usuarios', 'usuarios.usu_cedula', '=', 'solicitudes.usu_cedula')
            ->select('sol_id','sol_nombre', 'sol_formato', 'sol_fechaCreacion', 'sol_estado', 'usu_nombres','usu_apellidos', 'usuarios.usu_cedula', 'email')
            ->orderBy('sol_fechaCreacion', 'desc')            
            ->get();


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

            case 'R-ITM-01':
            $this->procesarRITM01($request);
            break;

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
     ->orderBy('sol_fechaCreacion', 'desc')
     ->get();

     //dd($listaSol);

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

            case "R-ITM-01":
            return view('vistasSolicitudes.R-ITM-01Formulario');
            break;

            default:
            Session::flash('mensaje-error', 'La solicitud seleccionada no existe.');
            return Redirect::to('/redactarSolicitud');
    }
}


    /**
    * Método llamado por store para procesar toda la informacion
    * proveniente de una solicitud RITM01
    *
    */
    public function procesarRITM01(Request $request){

        //Consultar cuantas veces el usuario ha hecho esta misma solicitud
        $sol_nombre = 'R-ITM-01';
        $usu_cedula = Session('usu_cedula');

        $cuantasVeces = DB::table('solicitudes')->where([
            ['sol_nombre' , '=', $sol_nombre],
            ['usu_cedula' , '=', $usu_cedula],
            ])->count();

        //nueva variabñe solo usada para itm
        $radicado = Session('usu_cedula') . '-RITM01' . '-' . $cuantasVeces;

        //Esta consulta no lleva ->get() por que se extrae un numero.
        //con funciones de agragacion no se usa get.

        // Iniciar el objeto para hacer operaciones
        $pdf = new \fpdi\FPDI('P', 'mm','Letter');

        //Nueva Página
        $pdf->AddPage();

        //Extraer plantilla desde pdf existente
        $pdf->setSourceFile("../public/basePDF/R-ITM-01.pdf");

        //Importar página de plantilla (en este caso, la 1)
        $tplIdx = $pdf->importPage(1);

        //Poner esta pagina en nueo documento con coordenadas de posicion
        $pdf->useTemplate($tplIdx, 1, 1, 217, 279);

        $fuente = 'Arial';
        $pdf->SetTitle('R-ITM-01');
        $pdf->SetFont('Times','',9);
        $pdf->SetTextColor(0, 0, 0);

        //Variables
        $asunto = $request['asunto'];
        $departamento = $request['departamento'];
        $nombres = $request['nombres'];
        $apellidos = $request['apellidos'];
        $carne = $request['carne'];
        $cedula = $request['cedula'];
        $lugar = $request['lugar'];
        $fijo = $request['fijo'];
        $celular = $request['celular'];
        $email1 = $request['email1'];
        $email2 = $request['email2'];
        $modalidad = $request['modalidad'];
        $programa = $request['programa'];
        $tipoPrograma = $request['tipoPrograma'];
        $fechaSol = $request['fechaSol'];


        $pdf->SetXY(151, 25);
        $pdf->Write(0, 'Comité de trabajos de grado');

        $pdf->SetXY(142, 33);
        $pdf->Write(0, $fechaSol . ' (a/m/d)');

        $pdf->SetXY(146, 33+8.3);
        $pdf->Write(0, $radicado);

        //poner letra a estandar 12 puntos
        $pdf->SetFont('Times','',12);

        $pdf->SetXY(66, 62);
        $pdf->Write(0, $departamento);

        $pdf->SetXY(66-8, 95.5);
        $pdf->Write(0, '"'.$asunto.'"');

        $pdf->SetXY(38, 129);
        $pdf->Write(0, $nombres . ' ' . $apellidos);

        $pdf->SetXY(40, 129+5.5);
        $pdf->Write(0, $cedula);

        $pdf->SetXY(101, 129+5.5);
        $pdf->Write(0, $lugar);

        $pdf->SetFont('Arial','B',12);
        switch ($modalidad) {

            case "1":
            default:
                $pdf->SetXY(35-3.9, 151.4);
                $pdf->Write(0, 'x');
                break;

            case "2":
                $pdf->SetXY(35-3.9, 157.4);
                $pdf->Write(0, 'x');
                break;

            case "3":
                $pdf->SetXY(35-3.9, 157.7 +6);
                $pdf->Write(0, 'x');
                break;

            case "4":
                $pdf->SetXY(35-3.9, 158.1 +12);
                $pdf->Write(0, 'x');
                break;

            case "5":
                $pdf->SetXY(88.5, 151.4);
                $pdf->Write(0, 'x');
                break;

            case "6":
                $pdf->SetXY(88.5, 157.4);
                $pdf->Write(0, 'x');
                break;

            case "7":
                $pdf->SetXY(88.5, 157.7 +6);
                $pdf->Write(0, 'x');
                break;

            case "8":
                $pdf->SetXY(138.6, 151.4);
                $pdf->Write(0, 'x');
                break;

            case "9":
                $pdf->SetXY(138.6, 157.4);
                $pdf->Write(0, 'x');
                break;

            case "10":
                $pdf->SetXY(138.6, 157.7 +6);
                $pdf->Write(0, 'x');
                break;

        }

        if ($tipoPrograma == '1') {
            $pdf->SetXY(35-3.9, 191);
            $pdf->Write(0, 'x');
        }else{
            $pdf->SetXY(56.5, 191);
            $pdf->Write(0, 'x');
        }
        
        //reestablecer fuente a la usada en los anteriores
        $pdf->SetFont('Times','',12);

        $pdf->SetXY(80, 191);
        $pdf->Write(0, $programa);

        //Escribir la firma del usuario
        if (!empty(session('usu_firma')) ) {

            $pdf->Image('../public/images/firmas_usuarios/' . session('usu_firma'), 31, 212, 29, 13.5); //ruta_archivo, x, y, ancho (no poner alto, se calcula automatico)
        }

        //guardar archivos adjuntos para la solicitud si fueron agregados
        if (isset($request['adjunto1'])){

            //establecer nombre de archivo irrepetible
            $nombre1 = 'adjunto-cc-' . session('usu_cedula') . '-' . rand(10000, 99999);
            //obtener la extension del archivo subido
            $ext1 = explode( '/',$_FILES['adjunto1']['type'])[1];
            //definir la ruta donde será guardado el archivo y que nombre tendrá
            $targetfile = base_path() . '/public/adjuntos/'. $nombre1 . '.' . $ext1;
            //mover el archivo subido a la ubicación deseada dentro del servidor. 
            move_uploaded_file($_FILES['adjunto1']['tmp_name'], $targetfile); 

            //El método setSourceFile() retorna el numero de páginas del documento seleccinado
            $numPaginas = $pdf->setSourceFile('../public/adjuntos/'. $nombre1 . '.' . $ext1); 

            for ($i=1; $i <= $numPaginas; $i++) { 
                $pdf->AddPage();
                try{
                    $tplIdx = $pdf->importPage($i);
                    $pdf->useTemplate($tplIdx, 1, 1, 217, 279);
                }catch(Exception $e) {
                  null;
                }
            }
        }

        //Luego de agregar los datos adjuntos ed eta solicitud
        //proseguimos a seguir escribiendo datos en la segunda página de la solicitud

        //Agregamos la segunda página
        $pdf->AddPage();
        $pdf->setSourceFile("../public/basePDF/R-ITM-01.pdf");
        $tplIdx = $pdf->importPage(2);
        $pdf->useTemplate($tplIdx, 1, 1, 217, 279);

        //Escribimos los datos restantes
        $pdf->SetXY(95, 45);
        $pdf->Write(0, $nombres);

        $pdf->SetXY(95, 45+11);
        $pdf->Write(0, $apellidos);

        $pdf->SetXY(95, 45+22);
        $pdf->Write(0, 'No. ' . $carne);

        $pdf->SetXY(95, 45+33);
        $pdf->Write(0, $programa);

        $pdf->SetXY(95, 45+44.5);
        $pdf->Write(0, $fijo);

        $pdf->SetXY(95, 45+55.5);
        $pdf->Write(0, $celular);

        $pdf->SetXY(95, 45+66.5);
        $pdf->Write(0, $email1);

        $pdf->SetXY(95, 45+77.5);
        $pdf->Write(0, $email2);

        //Escribir la firma del usuario
        if (!empty(session('usu_firma')) ) {

            //ruta_archivo, x, y, ancho (no poner alto, se calcula automatico)
            $pdf->Image('../public/images/firmas_usuarios/' . session('usu_firma'), 42, 171.5, 29, 13.5); 
        }

        $pdf->SetXY(70, 215.5);
        $pdf->Write(0, $nombres);

        $pdf->SetXY(120, 215.5);
        $pdf->Write(0, $apellidos);

        $pdf->SetXY(81, 225);
        $pdf->Write(0, $asunto);

        $pdf->SetXY(60, 225+9);
        $pdf->Write(0, 'Comité de trabajos de grado ITM');

        $pdf->SetXY(45, 225+9+8);
        $pdf->Write(0, $fechaSol . '(aaaa/mm/dd)');

        $pdf->SetXY(52, 225+9+8+8);
        $pdf->Write(0, $radicado);

        /**
        * mostrar el PDF en pantalla y al mismo tiempo guardarlo en una carpeta.
        * el primer output lo guarda en el servidor local. El segundo muestra a el usuario
        * Guardar en servidor local, con numero de cedula y nombre de solicitud
        * mas numero para diferenciar la solicitud de otra igual
        * P.ej: 1046668700-R-DC-39No3.pdf
        */
        $sol_formato = Session('usu_cedula') . '-R-ITM-01' . 'No' . $cuantasVeces . '.pdf';
        $rutaGuardar = '../public/solicitudesPDF/' . $sol_formato;

        /**
        * Iniciar proceso de registro de datos en BD
        * Tomo la cedula de la sesion iniciada por ser mas confiable 
        * que la ingreasda en formulario
        */
        solicitudes::create([

            'sol_nombre'=>'R-ITM-01',
            'sol_formato'=>$sol_formato,
            'sol_estado' => 'Pendiente',
            'usu_cedula' => Session('usu_cedula')

        ]);
        

        //Enviar correo para informar que la solicitud se ha creado
        //se envia como parametro el correo de destino y el nombre de archivo
        $this->enviarCorreo($sol_formato, Session('email'));

        //Enviar mensaje de texto
        $this->enviarSms($sol_nombre);


        $pdf->Close();

        $pdf->Output($rutaGuardar, 'F'); 
        $pdf->Output($sol_formato, 'I'); 
            


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
        $pdf->setSourceFile("../public/basePDF/R-ITM-01.pdf");

        //Importar página de plantilla (en este caso, la 1)
        $tplIdx = $pdf->importPage(1);

        //Poner esta pagina en nueo documento con coordenadas de posicion
        $pdf->useTemplate($tplIdx, 1, 1, 217, 279);

        $pdf->SetTitle('R-DC-39');
        $pdf->SetFont('Arial','',10);
        $pdf->SetTextColor(0, 0, 0);


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
        
        $fecha = explode('-', $_POST["fechaSol"]);
        $Año = $fecha[0];
        $Mes = $fecha[1];
        $Dia = $fecha[2];

        $otroMotivo = $request["otroMotivo"];


        //Renglon 1

        $pdf->SetXY(14, 42);
        $pdf->Write(0, $Apellidos);

        $pdf->SetXY(96, 42);
        $pdf->Write(0,  $Nombres);

        $pdf->SetXY(169, 42);
        $pdf->Write(0, $Cedula);

        //Renglon 2

        $pdf->SetXY(14, 51);
        $pdf->Write(0,  $Programa);

        $pdf->SetXY(99, 51);
        $pdf->Write(0, $Semestre);

        $pdf->SetXY(170, 51);
        $pdf->Write(0, $Jornada);

        //Renglon 3

        $pdf->SetXY(29, 56);
        $pdf->Write(0, $Direccion);

        $pdf->SetXY(108, 56);
        $pdf->Write(0, $EMail);

        $pdf->SetXY(183, 56);
        $pdf->Write(0, $Telefono);

        //Programa al que aspira
        $pdf->SetXY(16, 101.5);
        $pdf->Write(0, $Programa2);

        //Tipo de Modificacion

        if ($Modificacion=='Cancelacion') {
            $pdf->SetXY(76.5, 84.5);
            $pdf->Write(0, 'x');
        }elseif ($Modificacion=='Aplazamiento') {
            $pdf->SetXY(76.5, 89.4);
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

        if ($Jornada2=='Diurna') {
            $pdf->SetXY(45.5, 109.5);
            $pdf->Write(0, 'X');
        }elseif ($Jornada2=='Nocturna') {
            $pdf->SetXY(80.5, 119);
            $pdf->Write(0, 'X');
        }else{
            $pdf->SetXY(76.5, 123.3);
            $pdf->Write(0, '');
        }

        //Inclusion Asignatura o Cancelacion

        if ($Asignaturas=='Inclusion') {
            //Inclusion Asignatura
            $pdf->SetXY(176, 71.5);
            $pdf->Write(0, 'X');
            //Nombre de la asignatura
            $pdf->SetXY(150, 80.3);
            $pdf->Write(0, $NombreA);
            //Codigo asignatura
            $pdf->SetXY(150, 85.3);
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
        $pdf->SetXY(14, 122);
        $pdf->Write(0, $Observaciones);

        //Motivo de la modificacíón
        if ($Modificacion2=='DificultadAcademica') {
            $pdf->SetXY(79.5, 150.2);
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

        $pdf->SetXY(26, 163.5);
        $pdf->Write(0, $otroMotivo);

        //Fecha de solicitud 

        $pdf->SetXY(50, 176);
        $pdf->Write(0, $Dia);
        $pdf->SetXY(60, 176);
        $pdf->Write(0, $Mes);
        $pdf->SetXY(68, 176);
        $pdf->Write(0, $Año);

        //Escribir la firma del usuario
        if (!empty(session('usu_firma')) ) {

            $pdf->Image('../public/images/firmas_usuarios/' . session('usu_firma'), 124, 162.5, 29, 13.5); //ruta_archivo, x, y, ancho (no poner alto, se calcula automatico)
        }

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

        $fecha = explode('-', $_POST["fechaSol"]);
        $Año = $fecha[0];
        $Mes = $fecha[1];
        $Dia = $fecha[2];


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

        $pdf->SetXY(87, 81);
        $pdf->Write(0, $Consignacion);

        $pdf->SetXY(158, 81);
        $pdf->Write(0, $Telefono);

        //Escribir la firma del usuario
        //Debe hacerse antes de el recibo por si agrega otra pagina
        //si no, la firma aparece en la segunda hoja
        if (!empty(session('usu_firma')) ) {
            $pdf->Image('../public/images/firmas_usuarios/' . session('usu_firma'), 94, 87  , 30, 15); //ruta_archivo, x, y, ancho (no poner alto, se calcula automatico)
        }

        //si el usuario decide añadir recibo
        if(isset($request['imgRecibo'])){

            //Agregar imagen recibo de pago a solicitud
            $nombreImg =  Session('usu_cedula') . 'Recibo' . '.' .$request->file('imgRecibo')->getClientOriginalExtension();

            //Esta es la forma que tiene laravel de mover archivos subidos a traves de POST
            //para ver la forma general que tiene php, ir a usuario controller edit, en foto de usuario
            $request->file('imgRecibo')->move(
                base_path() . '/public/images/recibosPago/', $nombreImg
            );

            //Añadir imagen recibo de pago

            $pdf->AddPage();
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(78, 20);
            $pdf->Write(0, 'RECIBO DE PAGO PARA LA SOLICITUD');
            $pdf->SetXY(78, 20);
            $pdf->Write(0, '');
            $pdf->Image('../public/images/recibosPago/' . $nombreImg, 10, 30, 170); //ruta_archivo, x, y, ancho (no poner alto, se calcula automatico)

            //Eliminar la imagen subida al servidor
            unlink('../public/images/recibosPago/' . $nombreImg);
        }

        $pdf->Close();
        
        //Crear nombre del  pdf para guardar localmente en server
        $sol_formato = Session('usu_cedula') . '-R-DC-13' . 'No' . $cuantasVeces . '.pdf';
        $rutaGuardar = '../public/solicitudesPDF/' . $sol_formato;


        //Guardar registro en BD
        solicitudes::create([
            'sol_nombre'=>'R-DC-13',
            'sol_formato'=>$sol_formato,
            'sol_estado' => 'Pendiente',
            'usu_cedula' => Session('usu_cedula')
            ]);

        //Enviar correo al usuario con solicitud creada
        $this->enviarCorreo($sol_formato, Session('email'));

        //Enviar mensaje de texto
        $this->enviarSms($sol_nombre);

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

        
        $resultado1 = substr($Motivo, 0, 62);
        $resultado2 = substr($Motivo, 62, 108);
        $resultado3 = substr($Motivo, 170, 118);

        $lala = array($resultado1, $resultado2, $resultado3);
   
        $fecha = explode('-', $_POST["fechaSol"]);
        $Año = $fecha[0];
        $Mes = $fecha[1];
        $Dia = $fecha[2];

        //Renglon 1
        $pdf->SetXY(14, 48);
        $pdf->Write(0, $Apellidos);

        $pdf->SetXY(78, 48);
        $pdf->Write(0,  $Nombres);

        $pdf->SetXY(132, 48);
        $pdf->Write(0, $Cedula);

        //Renglon 2
        $pdf->SetXY(14, 61);
        $pdf->Write(0,  $Programa);

        $pdf->SetXY(162, 61);
        $pdf->Write(0, $Jornada);

        $pdf->SetXY(14, 72);
        $pdf->Write(0, $Direccion);

        $pdf->SetXY(133, 72);
        $pdf->Write(0, $Telefono);

        $pdf->SetXY(36, 79);
        $pdf->Write(0, $Asignatura);

        $pdf->SetXY(156.5, 79);
        $pdf->Write(0, $CodigoA);

        $pdf->SetXY(103, 86);
        $pdf->Write(0, $Periodo);

        $pdf->SetXY(136, 86);
        $pdf->Write(0, $Docente);

        $pdf->SetXY(100, 92.5);
        $pdf->Write(0, $resultado1);

        $pdf->SetXY(15, 98.5);
        $pdf->Write(0, $resultado2);

        $pdf->SetXY(15, 104.5);
        $pdf->Write(0, $resultado3);

        //Fecha de solicitud 
        $pdf->SetXY(58, 122);
        $pdf->Write(0, $Dia);
        $pdf->SetXY(67, 122);
        $pdf->Write(0, $Mes);
        $pdf->SetXY(76, 122);
        $pdf->Write(0, $Año);

        //Escribir la firma del usuario
        if (!empty(session('usu_firma')) ) {
            $pdf->Image('../public/images/firmas_usuarios/' . session('usu_firma'), 140, 109.5, 30, 15); //ruta_archivo, x, y, ancho (no poner alto, se calcula automatico)
        }



        $pdf->Close();


        //Crear nombre del  pdf para guardar localmente en server
        $sol_formato = Session('usu_cedula') . '-R-DC-14' . 'No' . $cuantasVeces . '.pdf';
    
        $rutaGuardar = '../public/solicitudesPDF/' . $sol_formato;

/*
        //Guardar registro en BD
        solicitudes::create([
            'sol_nombre'=>'R-DC-14',
            'sol_formato'=>$sol_formato,
            'sol_estado' => 'Pendiente',
            'usu_cedula' => Session('usu_cedula')
            ]);

        //Enviar correo al usuario con solicitud creada
        $this->enviarCorreo($sol_formato, Session('email'));

        $this->enviarSms($sol_nombre);

        $pdf->Output($rutaGuardar, 'F'); */
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

        $Estudios = false;
        $Tematicos = false;
        if (isset($_POST["estudios"])) {
           $Estudios = $_POST["estudios"];
        }

        if (isset($_POST["tematicos"])) {
           $Tematicos = $_POST["tematicos"];
        }

        $Folios = $_POST["folios"];
        $Folios2 = $_POST["folios2"];

        $fecha = explode('-', $_POST["fechaSol"]);
        $Año = $fecha[0];
        $Mes = $fecha[1];
        $Dia = $fecha[2];



        //Renglon 1

        $pdf->SetXY(14, 58-5);
        $pdf->Write(0, $Apellidos);

        $pdf->SetXY(88, 58-5);
        $pdf->Write(0,  $Nombres);

        $pdf->SetXY(149, 58-5);
        $pdf->Write(0, $Cedula);

        //Renglon 2

        $pdf->SetXY(14, 69-5);
        $pdf->Write(0,  $Programa);

        $pdf->SetXY(149, 69-5);
        $pdf->Write(0, $Jornada);


        $pdf->SetXY(14, 80-5);
        $pdf->Write(0, $Consignacion);

        $pdf->SetXY(82, 80-5);
        $pdf->Write(0, $Entidad);

        $pdf->SetXY(149, 80-5);
        $pdf->Write(0, $Valor);

        $pdf->SetXY(14, 91-5);
        $pdf->Write(0, $Educativa);

        $pdf->SetXY(82, 91-5);
        $pdf->Write(0, $Direccion);

        $pdf->SetXY(149, 91-5);
        $pdf->Write(0, $Telefono);

        if ($Estudios == true) {
            $pdf->SetXY(103.5, 114);
            $pdf->Write(0, "X");
        }

        if ($Tematicos== true) {
            $pdf->SetXY(103.5, 120);
            $pdf->Write(0, "X");
        }

        $pdf->SetXY(151, 117-3);
        $pdf->Write(0, $Folios);

        $pdf->SetXY(151, 123-3);
        $pdf->Write(0, $Folios2);

        //Fecha de solicitud 
        $pdf->SetXY(27, 140-3);
        $pdf->Write(0, $Dia);
        $pdf->SetXY(35, 140-3);
        $pdf->Write(0, $Mes);
        $pdf->SetXY(42, 140-3);
        $pdf->Write(0, $Año);

         //Escribir la firma del usuario
        if (!empty(session('usu_firma')) ) {

            $pdf->Image('../public/images/firmas_usuarios/' . session('usu_firma'), 93, 125, 28, 12.5); //ruta_archivo, x, y, ancho (no poner alto, se calcula automatico)
        }

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


        //guardar archivos adjuntos
        if (isset($request['certificado'])){

            $nombre1 = 'adjunto-cc-' . session('usu_cedula') . '-' . rand(10000, 99999);
            $ext1 = explode( '/',$_FILES['certificado']['type'])[1]; //obtener la eztensión de imagen con explode posición 1
            $targetfile = base_path() . '/public/adjuntos/'. $nombre1 . '.' . $ext1; //definir el nombre final del archivo en servidor (firma_usuario1046669400.jpeg)
            move_uploaded_file($_FILES['certificado']['tmp_name'], $targetfile); //mover el archivo subido a la ubicación deseada dentro del servidor. El nombre se cambia aquí con el nombre que le de $targetfile

            $pdf->setSourceFile('../public/adjuntos/'. $nombre1 . '.' . $ext1); 

            

            for ($i=1; $i <= $Folios; $i++) { 
                $pdf->AddPage();
                try{
                    $tplIdx = $pdf->importPage($i);
                    $pdf->useTemplate($tplIdx, 1, 1, 217, 279);
                }catch(Exception $e) {
                  null;
                }
            }

            

        }

        //guardar archivos adjuntos
        if (isset($request['contenidos'])){

            $nombre2 = 'adjunto-cc-' . session('usu_cedula') . '-' . rand(10000, 99999);
            $ext2 = explode( '/',$_FILES['contenidos']['type'])[1]; //obtener la eztensión de imagen con explode posición 1
            $targetfile = base_path() . '/public/adjuntos/'. $nombre2 . '.' . $ext2; //definir el nombre final del archivo en servidor (firma_usuario1046669400.jpeg)
            move_uploaded_file($_FILES['contenidos']['tmp_name'], $targetfile); //mover el archivo subido a la ubicación deseada dentro del servidor. El nombre se cambia aquí con el nombre que le de $targetfile

            $pdf->setSourceFile('../public/adjuntos/'. $nombre2 . '.' . $ext2); 

            for ($i=1; $i <= $Folios2; $i++) { 
                
                $pdf->AddPage();
                try {
                    $tplIdx = $pdf->importPage($i);
                    $pdf->useTemplate($tplIdx, 1, 1, 217, 279);
                }catch(Exception $e) {
                  null;
                }
            }

            

        }


        $pdf->Close();

        //Borrar documentos adjuntos certificado contenidos
        unlink('../public/adjuntos/'. $nombre2 . '.' . $ext2);
        unlink('../public/adjuntos/'. $nombre1 . '.' . $ext1);

        //Crear nombre del  pdf para guardar localmente en server
        $sol_formato = Session('usu_cedula') . '-R-DC-40' . 'No' . $cuantasVeces . '.pdf';


        $rutaGuardar = '../public/solicitudesPDF/' . $sol_formato;

        //Guardar registro en BD
        solicitudes::create([
            'sol_nombre'=>'R-DC-40',
            'sol_formato'=>$sol_formato,
            'sol_estado' => 'Pendiente',
            'usu_cedula' => Session('usu_cedula')
            ]);

        //Enviar correo al usuario con solicitud creada
        $this->enviarCorreo($sol_formato, Session('email'));

        $this->enviarSms($sol_nombre);

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
    public function responderRDC52(Request $request){

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
        
        $fecha = explode('-', $_POST["fechaSol"]);
        $Año = $fecha[0];
        $Mes = $fecha[1];
        $Dia = $fecha[2];




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

        if ($Jornada=='Diurna') {
            $pdf->SetXY(165, 68.4);
            $pdf->Write(0, 'X');
        }elseif ($Jornada=='Nocturna') {
            $pdf->SetXY(195, 68.4);
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
            $pdf->SetXY(165, 86);
            $pdf->Write(0, 'X');
        }elseif ($Autoriza=='no') {
            $pdf->SetXY(195, 86);
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
        
        $pdf->SetXY(132, 112);
        $pdf->Write(0, $Valor);

        $pdf->SetXY(173, 112);
        $pdf->Write(0, $Liquidacion);
        //Fecha de solicitud 

        $pdf->SetXY(160, 140);
        $pdf->Write(0, $Dia);
        $pdf->SetXY(174, 140);
        $pdf->Write(0, $Mes);
        $pdf->SetXY(188, 140);
        $pdf->Write(0, $Año);

        //Escribir la firma del usuario
        if (!empty(session('usu_firma')) ) {

            $pdf->Image('../public/images/firmas_usuarios/' . session('usu_firma'), 145, 116, 34, 16.5); //ruta_archivo, x, y, ancho (no poner alto, se calcula automatico)
        }


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
        $sol_formato = Session('usu_cedula') . '-R-DC-52' . 'No' . $cuantasVeces . '.pdf';
        $rutaGuardar = '../public/solicitudesPDF/' . $sol_formato;

        //Guardar registro en BD
         solicitudes::create([
             'sol_nombre'=>'R-DC-52',
             'sol_formato'=>$sol_formato,
             'sol_estado' => 'Pendiente',
             'usu_cedula' => Session('usu_cedula')
             ]);

        //Enviar correo al usuario con solicitud creada
        $this->enviarCorreo($sol_formato, Session('email'));

        //$this->enviarSms($sol_nombre);

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
    public function enviarSms($sol_nombre){

        /*if(Session('usu_telefono') != null || !empty(Session('usu_telefono'))){

            try {

                //Iniciar config de idioma y zona horaria
                setlocale(LC_ALL,"es_ES");
                date_default_timezone_set("America/Bogota");

                $customer_id = "E03FF2E9-A27B-4A11-8DC9-C11DF6D54E3E";
                $api_key = "SDnEC0qB848NLboLrs1iHNZD7jOndtV7Um2xBOvQEL1EvojRkSzXQ2wOuYx2tGAhXXgcABxc1ccxpVsuA1EBnA==";

                    //$phone_number = $request->telefono;
                $phone_number = '57' . Session('usu_telefono');
                $message = "\n\n Gesol: Sol. " . $sol_nombre . " recibida correctamente en fecha:" . date("Y/m/d") . " a las " . date("h:i a") . ". Saludos!";
                $message_type = "ARN";

                $messaging = new MessagingClient($customer_id, $api_key);
                $response = $messaging->message($phone_number, $message, $message_type);


            } catch (Exception $e) {
                null;
            }

        }*/

    }
}
