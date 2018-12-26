<?php

namespace Gesol\Http\Controllers;

use Illuminate\Http\Request;
use Gesol\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Gesol\solicitudes;
use Gesol\usuarios;
use Gesol\respuestas;
use DB;
use Charts;
use Chart;




class MetricasController extends Controller
{
    public function lala(){

        $query1= DB::select(DB::raw("SELECT count(solicitudes.sol_id) as cantidad
                    FROM solicitudes
                    WHERE solicitudes.sol_estado ='Atendida' 
                        AND sol_fechaCreacion BETWEEN '" . '2001-01-01' . "' AND '" . '2018-12-01' . "'" 
                    ));
            

        dd($query1);

    }

    public function procesarG1(Request $request){

        if($request->ajax()){

            $fechaIni = $_GET['fechaIni'];

            $fechaFin = $_GET['fechaFin'];

            $query= DB::select(DB::raw("SELECT count(solicitudes.sol_id) as cantidad
                    FROM solicitudes
                    WHERE solicitudes.sol_estado ='Atendida' 
                        AND sol_fechaCreacion BETWEEN '" . $fechaIni . "' AND '" . $fechaFin . "'" 
                    ));

            $cantAtendidas = $query[0]->cantidad;


            $query= DB::select(DB::raw("SELECT count(solicitudes.sol_id) as cantidad
                    FROM solicitudes
                    WHERE solicitudes.sol_estado ='Pendiente' 
                        AND sol_fechaCreacion BETWEEN '" . $fechaIni . "' AND '" . $fechaFin . "'" 
                    ));

            
            $cantPendientes = $query[0]->cantidad;

            return json_encode(array(
                
                'cantAtendidas'=> $cantAtendidas,
                'cantPendientes' => $cantPendientes
                
            ));

            
            
        }

        $cantAtendidas = DB::table('solicitudes')
        ->where('sol_estado', '=', 'Atendida')
        ->count();

        $cantPendientes = DB::table('solicitudes')
        ->where('sol_estado', '=', 'Pendiente')
        ->count();

        return view('tests.graficoTest', ['cantAtendidas' => $cantAtendidas, 'cantPendientes' => $cantPendientes]);

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
