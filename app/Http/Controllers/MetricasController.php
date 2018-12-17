<?php

namespace Gesol\Http\Controllers;

use Illuminate\Http\Request;
use Gesol\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gesol\solicitudes;
use Gesol\usuarios;
use Gesol\respuestas;
use DB;
use Charts;




class MetricasController extends Controller
{

    /*
    public function __construct(){
        $this->middleware('secretario');
    }
    */





    /**
    * Gráfico que muestra las solicitudes pendientes vs 
    * solicitudes atendidas. Se plantea dotarlo de 
    * ajax para permitir filtrar el resultado usando fechas
    */
    public function procesarGrafico1(){


        if($request->ajax()){
            $fechaIni = $_GET['fechaIni'];

            dd($fechaIni);
        }






        $cantAtendidas = DB::table('solicitudes')
        ->where('sol_estado', '=', 'Atendida')
        ->count();

        $cantPendientes = DB::table('solicitudes')
        ->where('sol_estado', '=', 'Pendiente')
        ->count();

        $chart1 = Charts::create('pie', 'highcharts')
            ->title('Comparacion solicitudes atendidas y pendientes')
            ->labels(['Solicitudes atendidas', 'Solicitudes pendientes'])
            ->values([$cantAtendidas, $cantPendientes])
            ->dimensions(1000,500)
            ->colors(['#88CC88', '#D46A6A'])
            ->responsive(true);

        return view('tests.graficoTest', compact('chart1'));

    }









    public function generarMetricas()
    {
        //Instalacion: composer require consoletvs/charts:3.*
        //Grafico solicitudes resueltas y pendientes.

        $cantAtendidas = DB::table('solicitudes')
        ->where('sol_estado', '=', 'Atendida')
        ->count();

        $cantPendientes = DB::table('solicitudes')
        ->where('sol_estado', '=', 'Pendiente')
        ->count();

        $chart1 = Charts::create('pie', 'highcharts')
            ->title('Comparacion solicitudes atendidas y pendientes')
            ->labels(['Solicitudes atendidas', 'Solicitudes pendientes'])
            ->values([$cantAtendidas, $cantPendientes])
            ->dimensions(1000,500)
            ->colors(['#88CC88', '#D46A6A'])
            ->responsive(true);

        //Grafico productividad por administrativo
        $admins= DB::select(DB::raw("SELECT count(respuestas.res_id) as cuenta, usuarios.usu_nombres
                    FROM respuestas JOIN usuarios
                    ON respuestas.usu_cedula = usuarios.usu_cedula
                    GROUP BY usuarios.usu_nombres"));

        $size = count($admins);
        $nombres = array($size);
        $puntos = array($size);
        $i=0;
        foreach ($admins as $admin) {
            $nombres[$i] = $admin->usu_nombres;
            $puntos[$i] = $admin->cuenta;
            $i++;
        }

        $chart2 = Charts::create('donut', 'highcharts')
            ->title('Cantidad de solicitudes atendidas por administrativo (productividad)')
            ->labels($nombres)
            ->values($puntos)
            ->dimensions(1000,500)
            ->colors(['#ff0000', '#00ff00'])
            ->responsive(true);


        //Grafica cantidad de solicitudes por nombre    
        $solicitudes= DB::select(DB::raw("SELECT count(sol_id) as cuenta, sol_nombre
                    FROM solicitudes
                    GROUP BY sol_nombre"));

        $size = count($solicitudes);
        $nombres2 = array($size);
        $puntos2 = array($size);
        $i=0;
        foreach ($solicitudes as $solicitud) {
            $nombres2[$i] = $solicitud->sol_nombre;
            $puntos2[$i] = $solicitud->cuenta;
            $i++;
        }

        $chart3 = Charts::create('bar', 'highcharts')
            ->title('Cantidad solicitudes por formato')
            ->labels($nombres2)
            ->values($puntos2)
            ->dimensions(1000,500)
            ->colors(['#88CC88', '#D46A6A'])
            ->responsive(true);


        

        return view('metricas.graficosRendimiento', ['chart1' => $chart1 , 'chart2' => $chart2, 'chart3' => $chart3]);
        
    }
}
