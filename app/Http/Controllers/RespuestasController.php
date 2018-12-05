<?php

namespace Gesol\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Gesol\Http\Requests\ValidaFormsSolicitudes;
use Gesol\solicitudes;
use Gesol\respuestas;
use Gesol\Http\Requests\ValidaUpdateRespuestaRequest;
use DB;

class RespuestasController extends Controller
{

    public function __construct(){

        $this->middleware('secretario');

    }

    /**
     * ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
     * ::::::::::::::::::::::::::::::::::Métodos CRUD :::::::::::::::::::::::::::::::::::
     * ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($res_id)
    {
        $respuesta = respuestas::find($res_id);
        return view('vistasRespuestas.edit', compact('respuesta'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaResp = \DB::table('respuestas')
        ->join('usuarios', 'usuarios.usu_cedula', '=', 'respuestas.usu_cedula')
        ->join('roles', 'usuarios.rol_id', '=', 'roles.rol_id')
        ->select('res_formato','res_id','sol_nombre', 'res_fechaRespuesta', 'usu_nombres', 'usu_apellidos', 'usuarios.usu_cedula', 'rol_nombre')
        ->get();

        //compact usa solo el nombre de la variable sin el $
        return view('vistasRespuestas.indexRespuestas', compact('listaResp'));
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
    public function store(Request $request){

        
        switch ($request['sol_nombre']){

            case 'R-DC-13':
            $this->responderRDC13($request);
            break;

            case "R-DC-14":
            $this->responderRDC14($request);
            break;

            case "R-DC-39":
            $this->responderRDC39($request);
            break;

            case "R-DC-40":
            $this->responderRDC40($request);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidaUpdateRespuestaRequest $request, $res_id)
    {
        $respuesta = Respuestas::find($res_id);

        $respuesta->sol_nombre = $request['nombre'];
        $respuesta->res_fechaRespuesta = $request['fechaHora'];
        $respuesta->usu_cedula = $request['cedula'];

        $respuesta->save();


        Session::flash('mensaje-exito', 'Se ha actualizado la informacion exitosamente');
        return Redirect::to('/respuestas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($res_id)
    {
        $respuesta = respuestas::find($res_id);

        respuestas::destroy($res_id);

        Session::flash('mensaje-exito', 'El registro de la respuesta se han eliminado satisfactoriamente. <br> Sin embargo, los cambios hechos en el pdf aún existen. Para eliminar el archivo, deberá eliminarlo desde el menú de "solicitudes"');
        return Redirect::to('/respuestas');
    }

    /**
     * :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
     * ::::::::::::::::::::::::::::::::::Métodos Respuestas :::::::::::::::::::::::::::::
     * :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
     */

    public function despachadorVistasRespuestas($sol_nombre, $sol_formato, $sol_id){
        
        switch ($sol_nombre){

            case 'R-DC-13':
            return view('vistasRespuestas.R-DC-13Respuesta', compact('sol_nombre', 'sol_formato', 'sol_id'));
            break;

            case "R-DC-14":
            return view('vistasRespuestas.R-DC-14Respuesta', compact('sol_nombre', 'sol_formato', 'sol_id'));
            break;

            case "R-DC-39":
            return view('vistasRespuestas.R-DC-39Respuesta', compact('sol_nombre', 'sol_formato', 'sol_id'));
            break;

            case "R-DC-40":
            return view('vistasRespuestas.R-DC-40Respuesta', compact('sol_nombre', 'sol_formato', 'sol_id'));
            break;

            case "R-DC-52":
            return view('vistasRespuestas.R-DC-52Respuesta', compact('sol_nombre', 'sol_formato', 'sol_id'));
            break;

            default:
            Session::flash('mensaje-error', 'La respuesta seleccionada no existe.');
            return Redirect::to('/respuestas');
        }
    }


    public function responderRDC13(Request $request){

        $pdf = new \fpdi\FPDI('P', 'mm','Letter');

        $pdf->AddPage();

        /*Usar como plantilla la solicitud creada por estudiante
        para añadir informaciona campos de docente, coordinaro, etc. En el mismo pdf*/
        $pdf->setSourceFile("../public/solicitudesPDF/" . $request['sol_formato']);

        $tplIdx = $pdf->importPage(1);

        $pdf->useTemplate($tplIdx, 1, 1, 217, 279);

        $pdf->SetTitle('R-DC-13');
        $pdf->SetFont('Arial','',10);
        $pdf->SetTextColor(0, 0, 0);

        //Decano
        if (Session('rol_id') == 4) {
            
            $Docente1 = $_POST["Docente1"];
            $Docente2 = $_POST["Docente2"];
            $Dia = $_POST["dia"];
            $Mes = $_POST["mes"];
            $Año = $_POST["año"];

            $pdf->SetXY(19, 123);
            $pdf->Write(0, $Docente1);

            $pdf->SetXY(111, 123);
            $pdf->Write(0, $Docente2);

            $pdf->SetXY(27, 136);
            $pdf->Write(0, $Dia);

            $pdf->SetXY(36, 136);
            $pdf->Write(0, $Mes);

            $pdf->SetXY(46, 136);
            $pdf->Write(0, $Año);
        }
        

        //Docentes
        if (Session('rol_id') == 5) {

            $Concepto = $_POST["Concepto"];
            $resultado = substr($Concepto, 0, 79);
            $resultado2 = substr($Concepto, 80, 174);
            $Numero = $_POST["Numero"];
            $Letras = $_POST["Letras"];
            $Dias = $_POST["dia1"];
            $Meses = $_POST["mes1"];
            $Años = $_POST["año1"];

            $pdf->SetXY(43, 158);
            $pdf->Write(0, $resultado);
            $pdf->SetXY(14, 163.5);
            $pdf->Write(0, $resultado2);

            $pdf->SetXY(32, 172.5);
            $pdf->Write(0, $Numero);

            $pdf->SetXY(57, 172.5);
            $pdf->Write(0, $Letras);

            $pdf->SetXY(150, 172.5);
            $pdf->Write(0, $Dias);

            $pdf->SetXY(156, 172.5);
            $pdf->Write(0, $Meses);

            $pdf->SetXY(165, 172.5);
            $pdf->Write(0, $Años);

        }

        //Coordinador
        if (Session('rol_id') == 3) {

            $Concepto2 = $_POST["Concepto2"];
            $resultado3 = substr($Concepto2, 0, 79);
            $resultado4 = substr($Concepto2, 80, 174);
            $Diasas = $_POST["dia2"];
            $Mesese = $_POST["mes2"];
            $Añosa = $_POST["año2"];

            $pdf->SetXY(43, 216);
            $pdf->Write(0, $resultado3);
            $pdf->SetXY(14, 221.5);
            $pdf->Write(0, $resultado4);

            $pdf->SetXY(26, 237);
            $pdf->Write(0, $Diasas);

            $pdf->SetXY(32, 237);
            $pdf->Write(0, $Mesese);

            $pdf->SetXY(40, 237);
            $pdf->Write(0, $Añosa);
        }
        

        $pdf->Close();

        $rutaGuardar = '../public/solicitudesPDF/' . $request['sol_formato'];

        //Crear registro en bd con cedula de secreatario(a) o persona
        //que responde
        Respuestas::create([
            'usu_cedula' => Session('usu_cedula'),
            'sol_nombre' => $request['sol_nombre'],
            'res_formato' => $request['sol_formato']
        ]);

        //Editar solicitud para cambiar estado a 'Atendida'
        //solo si así se especifica
        if ($request['atendida'] == "si") {
            $solicitud = Solicitudes::find($request['sol_id']);
            $solicitud->sol_estado = 'Atendida';
            $solicitud->save();
        }
        

        //Enviar correo informativo a estudiante que solicita
        $this->enviarCorreo($request);

        $pdf->Output($request['sol_formato'], 'I');
        $pdf->Output($rutaGuardar, 'F'); 

        Session::flash('mensaje-exito', 'Se ha guardado la respuesta correctamente <br> Se ha notificado al correo del estudiante. Revise el formato de esta solicitud para corroborar cambios');

    }

    public function responderRDC39(Request $request){

        $pdf = new \fpdi\FPDI('P', 'mm','Letter');

        $pdf->AddPage();

        $pdf->setSourceFile("../public/solicitudesPDF/" . $request['sol_formato']);

        $tplIdx = $pdf->importPage(1);

        $pdf->useTemplate($tplIdx, 1, 1, 217, 279);

        $pdf->SetTitle('R-DC-39');
        $pdf->SetFont('Arial','',10);
        $pdf->SetTextColor(0, 0, 0);

        //Variables

        $Numero = $_POST["Numero"];
        $Letras = $_POST["Letras"];
        $Concepto = $_POST["Concepto"];
        $Concepto2 = $_POST["Concepto"];
        $resultado = substr($Concepto, 0, 95);
        $resultado2 = substr($Concepto2, 95, 190);
        $Dia = $_POST["dia"];
        $Mes = $_POST["mes"];
        $Año = $_POST["año"];

        //Renglon 1

        $pdf->SetXY(80, 234);
        $pdf->Write(0, $Numero);

        $pdf->SetXY(116, 234);
        $pdf->Write(0,  $Letras);

        //Observaciones
        $pdf->SetXY(14, 218);
        $pdf->Write(0, $resultado);
        $pdf->SetXY(14, 223);
        $pdf->Write(0, $resultado2);

        //Fecha de solicitud 

        $pdf->SetXY(33, 251);
        $pdf->Write(0, $Dia);
        $pdf->SetXY(45, 251);
        $pdf->Write(0, $Mes);
        $pdf->SetXY(55, 251);
        $pdf->Write(0, $Año);

        $pdf->Close();

        $rutaGuardar = '../public/solicitudesPDF/' . $request['sol_formato'];

        //Crear registro en bd con cedula de secreatario(a) o persona
        //que responde
        Respuestas::create([
            'usu_cedula' => Session('usu_cedula'),
            'sol_nombre' => $request['sol_nombre'],
            'res_formato' => $request['sol_formato']
        ]);

        //Editar solicitud para cambiar estado a 'Atendida'
        $solicitud = Solicitudes::find($request['sol_id']);
        $solicitud->sol_estado = 'Atendida';
        $solicitud->save();

        //Enviar correo informativo a estudiante que solicita
        $this->enviarCorreo($request);

        $pdf->Output($rutaGuardar, 'F'); 
        $pdf->Output($request['sol_formato'], 'I');

        Session::flash('mensaje-exito', 'Se ha guardado la respuesta correctamente <br> Se ha notificado al correo del estudiante. Revise el formato de esta solicitud para corroborar cambios');
    }

    public function responderRDC14(Request $request){

        $pdf = new \fpdi\FPDI('P', 'mm','Letter');

        $pdf->AddPage();

        $pdf->setSourceFile("../public/solicitudesPDF/" . $request['sol_formato']);

        $tplIdx = $pdf->importPage(1);

        $pdf->useTemplate($tplIdx, 1, 1, 217, 279);

        $pdf->SetTitle('R-DC-14');
        $pdf->SetFont('Arial','',10);
        $pdf->SetTextColor(0, 0, 0);

        //Docente
        if (Session('rol_id') == 5) {

            $Apellidos = $_POST["apellidos"];
            $Nombres = $_POST["nombres"];
            $Codigo = $_POST["Codigo"];
            $Concepto = $_POST["Concepto"];
            $Concepto2 = $_POST["Concepto"];
            $Concepto3 = $_POST["Concepto"];
            $resultado = substr($Concepto, 0, 85);
            $resultado2 = substr($Concepto2, -190, -95);
            $resultado3 = substr($Concepto3, 180, 275);
            $Corte1 = $_POST["Corte1"];
            $Corte2 = $_POST["Corte2"];
            $Corte3 = $_POST["Corte3"];
            $Habilitacion = $_POST["Habilitacion"];
            $Numero = $_POST["Numero"];
            $Letras = $_POST["Letras"];

            $Dia = $_POST["dia"];
            $Mes = $_POST["mes"];
            $Año = $_POST["año"];

            $pdf->SetXY(14, 154.5);
            $pdf->Write(0, $Apellidos);

            $pdf->SetXY(79, 154.5);
            $pdf->Write(0,  $Nombres);

            $pdf->SetXY(134, 154.5);
            $pdf->Write(0, $Codigo);

            $pdf->SetXY(34, 163);
            $pdf->Write(0,  $resultado);
            $pdf->SetXY(14, 171);
            $pdf->Write(0,  $resultado2);
            $pdf->SetXY(14, 179);
            $pdf->Write(0,  $resultado3);

            $pdf->SetXY(58, 190.5);
            $pdf->Write(0, $Corte1);

            $pdf->SetXY(97, 190.5);
            $pdf->Write(0, $Corte2);

            $pdf->SetXY(136, 190.5);
            $pdf->Write(0, $Corte3);

            $pdf->SetXY(178, 190.5);
            $pdf->Write(0, $Habilitacion);

            $pdf->SetXY(55, 198);
            $pdf->Write(0, $Numero);

            $pdf->SetXY(73, 198);
            $pdf->Write(0, $Letras);

            $pdf->SetXY(152, 198);
            $pdf->Write(0, $Dia);
            $pdf->SetXY(161, 198);
            $pdf->Write(0, $Mes);
            $pdf->SetXY(169, 198);
            $pdf->Write(0, $Año);

        }

        //Coordinador
        if (Session('rol_id') == 3) {

            $Observaciones = $_POST["Observaciones"];
            $Observaciones2 = $_POST["Observaciones"];
            $resultado4 = substr($Observaciones, 0, 94);
            $resultado5 = substr($Observaciones2, 95, 190);

            $pdf->SetXY(14, 242);
            $pdf->Write(0, $resultado4);
            $pdf->SetXY(14, 248);
            $pdf->Write(0, $resultado5);
        }

        $pdf->Close();

        $rutaGuardar = '../public/solicitudesPDF/' . $request['sol_formato'];

        //Crear registro en bd con cedula de secreatario(a) o persona
        //que responde
        Respuestas::create([
            'usu_cedula' => Session('usu_cedula'),
            'sol_nombre' => $request['sol_nombre'],
            'res_formato' => $request['sol_formato']
        ]);

        //Editar solicitud para cambiar estado a 'Atendida'
        //solo si así se especifica
        if ($request['atendida'] == "si") {
            $solicitud = Solicitudes::find($request['sol_id']);
            $solicitud->sol_estado = 'Atendida';
            $solicitud->save();
        }

        //Enviar correo informativo a estudiante que solicita
        $this->enviarCorreo($request);

        $pdf->Output($rutaGuardar, 'F'); 
        $pdf->Output($request['sol_formato'], 'I');

        Session::flash('mensaje-exito', 'Se ha guardado la respuesta correctamente <br> Se ha notificado al correo del estudiante. Revise el formato de esta solicitud para corroborar cambios');

    }

    public function responderRDC40(Request $request){

        $pdf = new \fpdi\FPDI('P', 'mm','Letter');

        $pdf->AddPage();

        $pdf->setSourceFile("../public/solicitudesPDF/" . $request['sol_formato']);

        $tplIdx = $pdf->importPage(1);

        $pdf->useTemplate($tplIdx, 1, 1, 217, 279);

        $pdf->SetTitle('R-DC-40');
        $pdf->SetFont('Arial','',10);
        $pdf->SetTextColor(0, 0, 0);

        //Coordinador
        if(Session('rol_id') == 3) {

            $Concepto = $_POST["Concepto"];
            $resultado = substr($Concepto, 0, 85);
            $resultado2 = substr($Concepto, 85, 180);
            $Numero = $_POST["Numero"];
            $Letras = $_POST["Letras"];
            $Dia = $_POST["dia"];
            $Mes = $_POST["mes"];
            $Año = $_POST["año"];

            $pdf->SetXY(35, 168);
            $pdf->Write(0, $resultado);

            $pdf->SetXY(14, 174);
            $pdf->Write(0, $resultado2);

            $pdf->SetXY(88, 185);
            $pdf->Write(0,  $Numero);

            $pdf->SetXY(144, 185);
            $pdf->Write(0, $Letras);

            $pdf->SetXY(27, 202.5);
            $pdf->Write(0, $Dia);
            $pdf->SetXY(35, 202.5);
            $pdf->Write(0, $Mes);
            $pdf->SetXY(42, 202.5);
            $pdf->Write(0, $Año);

        }

        //Decano
        if(Session('rol_id') == 4) {

            $Concepto2 = $_POST["Concepto2"];
            $resultado3 = substr($Concepto2, 0, 85);
            $resultado4= substr($Concepto2, 85, 180);
            $Dia2 = $_POST["dia2"];
            $Mes2 = $_POST["mes2"];
            $Año2 = $_POST["año2"];

            $pdf->SetXY(35, 233);
            $pdf->Write(0,  $resultado3);
            $pdf->SetXY(14, 239.5);
            $pdf->Write(0,  $resultado4);

            $pdf->SetXY(27, 253);
            $pdf->Write(0, $Dia2);
            $pdf->SetXY(38, 253);
            $pdf->Write(0, $Mes2);
            $pdf->SetXY(45, 253);
            $pdf->Write(0, $Año2);

        }

        $pdf->Close();  

        $rutaGuardar = '../public/solicitudesPDF/' . $request['sol_formato'];

        //Crear registro en bd con cedula de secreatario(a) o persona
        //que responde
        Respuestas::create([
            'usu_cedula' => Session('usu_cedula'),
            'sol_nombre' => $request['sol_nombre'],
            'res_formato' => $request['sol_formato']
        ]);

        //Editar solicitud para cambiar estado a 'Atendida'
        //solo si así se especifica
        if ($request['atendida'] == "si") {
            $solicitud = Solicitudes::find($request['sol_id']);
            $solicitud->sol_estado = 'Atendida';
            $solicitud->save();
        }

        //Enviar correo informativo a estudiante que solicita
        $this->enviarCorreo($request);

        $pdf->Output($rutaGuardar, 'F'); 
        $pdf->Output($request['sol_formato'], 'I');
        Session::flash('mensaje-exito', 'Se ha guardado la respuesta correctamente <br> Se ha notificado al correo del estudiante. Revise el formato de esta solicitud para corroborar cambios');



    }

    public function enviarCorreo(Request $request){

        $infoAdicional = DB::table('solicitudes')
        ->join('usuarios', 'usuarios.usu_cedula', '=', 'solicitudes.usu_cedula')
        ->select('sol_fechaCreacion', 'email')
        ->where('sol_id', '=', $request['sol_id'])
        ->first();

        $emailEstudiante = $infoAdicional->email;


        /**
        *Los datos que se envían en el correo proceden de distintos lugares.
        *algunos proienen del formulario enviado, otros de la sesion de usuario activa
        *usada para respodner y otros se recuperan desde la consulta
        */
        $datosMensaje = array(
            'sol_nombre' => $request['sol_nombre'], //datos traidos del formulario del que procede la respuesta
            'sol_fechaCreacion' => $infoAdicional->sol_fechaCreacion, //fecha de creacion recuperada en consulta usando el id de la solicitud que viene del formulario
            'sol_formato' =>$request['sol_formato'],            
            'nombreFunc' => Session('usu_nombres'), //nombre del usuario actual que responde
            'apellidoFunc' => Session('usu_apellidos'),
            'rolFunc' => Session('rol_nombre')
        );

        Mail::send('correos.plantillaRespuestaSol', $datosMensaje, function (Message $msj) use ($emailEstudiante){

            $msj->to($emailEstudiante)
            ->from('gesol.uts@gmail.com',  'Gesol')
            ->subject('Gesol: Solicitud atendida');
            
        });

    }

}

