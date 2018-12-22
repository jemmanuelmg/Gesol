@extends('layouts.templateBasico')

@section('estilos')
	<!--Assets para renderizar graficos. Obligatorio en sección header. Primero jquery-->
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<!--Importar librería principal HighCharts-->
	<script type="text/javascript" src="{{ URL::asset('js/highcharts/highcharts.js') }}"></script>
	<!--Scripts adicionales para permitir la descarga del grafico.-->
	<script type="text/javascript" src="{{ URL::asset('js/highcharts/exporting.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/highcharts/offline-exporting.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/highcharts/export-data.js') }}"></script>
@stop

@section('contenido')

	<br>
	<br>
	<br>
	
	<div class="container">

		<h3 class="subencabezado">Ingrese periodo deseado</h3>
		<br>

		<div class="row">

			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label" for="fechaNac">Fecha de inicio (dia/mes/año)*</label>
					<div class="input-group">
						<div class="input-group-addon" style="width: 2.6rem"><i class="fas fa-calendar-alt"></i></div>

						<input name="fechaIni" id="fechaIni" type="date" value="2017-01-01" class="form-control"/>

					</div>             	
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label" for="fechaNac">Fecha de finalización (dia/mes/año)*</label>
					<div class="input-group">
						<div class="input-group-addon" style="width: 2.6rem"><i class="fas fa-calendar-alt"></i></div>

						<input name="fechaFin" id="fechaFin" type="date" value="{{date('Y-m-d')}}" class="form-control"/>

					</div>             	
				</div>
			</div>
			



			<br>
			<br>
			<br>
			<br>
			<br>

		</div>

		<div class="row">
			<div id="container" style="width:100%; height:400px;"></div>

			<script type="text/javascript">

				/*
				var atendidas;
				var pendientes;
				$.ajax({
					url: 'http://127.0.0.1:8000/grafico1X',
					type:'GET',
					async:true,
					dataType:'json',

					success: function(data){
					alert('Pasó a success') // result o tambien llamado data

						atendidas = data.cantAtendidas;
						alert(atendidas);
						pendientes = data.cantPendientes;
						alert(pendientes);
					},

					error: function(xhr, textStatus, errorThrown) {
						alert("Error en el AJAX Gesol");
						console.log(JSON.stringify(xhr));
						console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
					},
				});
				*/

				
				var chart = Highcharts.chart('container', {

				    chart: {
				        plotBackgroundColor: null,
				        plotBorderWidth: null,
				        plotShadow: false,
				        type: 'pie'
				    },
				    title: {
				        text: 'Cantidad solicitudes atentidas Vs pendientes'
				    },
				    subtitle:{
				    	text: 'Registro completo'
				    },
				    tooltip: {
				        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				    },
				    plotOptions: {
				        pie: {
				            allowPointSelect: true,
				            cursor: 'pointer',
				            dataLabels: {
				                enabled: true,
				                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
				                style: {
				                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
				                }
				            }
				        }
				    },
				    series: [{
				        name: 'Cantidad',
				        colorByPoint: true,
				        data: [
						        {
						            name: 'Solicitudes atendidas',
						            y: {{$cantAtendidas}},
						            sliced: true,
						            selected: true
						        }, 
						        {
						            name: 'Solicitudes pendientes',
						            y: {{$cantPendientes}}
						        }, 
				        	]
				    }]
				});

			</script>

			<script type="text/javascript">

				$('#inverted').click(function () {
				    chart.update({

				        series: [{
					        name: 'Cantidad',
					        colorByPoint: true,
					        data:[
					        {
					            name: 'Solicitudes atendidas',
					            y: 80,
					            sliced: true,
					            selected: true
					        }, 
					        {
					            name: 'Solicitudes pendientes',
					            y: 90
					        }, 
			        		]
				    	}]

				    });
				});
			</script>
			
		</div>

	</div>

@stop

