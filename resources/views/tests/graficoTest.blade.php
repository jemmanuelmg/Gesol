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
			<div class="col-md-10">
				<!--Grafico-->
				<div id="container" style="width:100%; height:400px;"></div>
			</div>
			<div class="col-md-2">

				<h6>Seleccionar estilo de grafico.</h6>

				<select id="estilo-grafico" class="custom-select"> 
					<option selected value="pie">Torta</option> 
					<option value="bar">Barras</option> 
					<option value="column">Columnas</option>
					<option value="scatter">Dispersion</option>  
				</select>

			</div>
		</div>




										<!--SCRIPTS AJAX G1-->

		<!--Script del grafico-->
		<script type="text/javascript">

				
				var chart = Highcharts.chart('container', {

				    chart: {
				        plotBackgroundColor: null,
				        plotBorderWidth: null,
				        plotShadow: false,
				        type: 'pie',
				    },
				    title: {
				        text: 'Cantidad solicitudes atentidas Vs pendientes'
				    },

				    
				    subtitle:{
				    	text: 'Registro completo'
				    },
				    tooltip: {
				        pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}) %</b>'
				    },

				    plotOptions: {
				        pie: {
				            allowPointSelect: true,
				            cursor: 'pointer',
				            dataLabels: {
				                enabled: true,
				                format: '<b>{point.name}</b>:{point.y} {point.percentage:.1f} %',
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

		<!--Actualziar gráfico cuado se cambie una de las fechas-->
		<script>

			var ini = $("#fechaIni").val();
			var fin = $("#fechaFin").val();
		
			$.ajax({
				url: 'http://127.0.0.1:8000/grafico1',
				type:'GET',
				async:true,
				dataType:'json',
				data: {
					fechaIni: ini,
					fechaFin: fin
				},

				success: function(data){

					chart.update({
						subtitle:{
							text: 'desde ' + ini + ' hasta ' + fin
						},
				        series: [{
					        name: 'Cantidad',
					        colorByPoint: true,
					        data:[
					        {
					            name: 'Solicitudes atendidas',
					            y: data.cantAtendidas,
					            sliced: true,
					            selected: true
					        }, 
					        {
					            name: 'Solicitudes pendientes',
					            y: data.cantPendientes
					        }, 
			        		]
				    	}]
		    		});
					
				},

				error: function(xhr, textStatus, errorThrown) {
					alert("Error en el AJAX Gesol");
					console.log(JSON.stringify(xhr));
					console.log('AJAX error: ' + textStatus + ' : ' + errorThrown);
				},
			});
		</script>

		<!--Cambiar tipo de grafico-->
		<script>

			var estiloGrafico = $('#estilo-grafico');

			estiloGrafico.change(function() {
				
				var tipo = estiloGrafico.val();

				chart.update({
						chart:{
							type: tipo
						},
		    		});

			});
		</script>













		<br>
		<br>
		<br>
		<br>
		<hr>

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
			<div class="col-md-10">
				<!--Grafico-->
				<div id="container2" style="width:100%; height:400px;"></div>
			</div>
			<div class="col-md-2">

				<h6>Seleccionar estilo de grafico.</h6>

				<select id="estilo-grafico" class="custom-select"> 
					<option selected value="pie">Torta</option> 
					<option value="bar">Barras</option> 
					<option value="column">Columnas</option>
					<option value="scatter">Dispersion</option>  
				</select>

			</div>
		</div>

		<!--Script del grafico-->
		<script type="text/javascript">

				
				var chart = Highcharts.chart('container2', {

				    chart: {
				        plotBackgroundColor: null,
				        plotBorderWidth: null,
				        plotShadow: false,
				        type: 'pie',
				    },
				    title: {
				        text: 'Cantidad solicitudes atentidas Vs pendientes'
				    },

				    
				    subtitle:{
				    	text: 'Registro completo'
				    },
				    tooltip: {
				        pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}) %</b>'
				    },

				    plotOptions: {
				        pie: {
				            allowPointSelect: true,
				            cursor: 'pointer',
				            dataLabels: {
				                enabled: true,
				                format: '<b>{point.name}</b>:{point.y} {point.percentage:.1f} %',
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

		<!--Actualziar gráfico cuado se cambie una de las fechas-->
		<script>

			var ini = $("#fechaIni").val();
			var fin = $("#fechaFin").val();
		
			$.ajax({
				url: 'http://127.0.0.1:8000/grafico1',
				type:'GET',
				async:true,
				dataType:'json',
				data: {
					fechaIni: ini,
					fechaFin: fin
				},

				success: function(data){

					chart.update({
						subtitle:{
							text: 'desde ' + ini + ' hasta ' + fin
						},
				        series: [{
					        name: 'Cantidad',
					        colorByPoint: true,
					        data:[
					        {
					            name: 'Solicitudes atendidas',
					            y: data.cantAtendidas,
					            sliced: true,
					            selected: true
					        }, 
					        {
					            name: 'Solicitudes pendientes',
					            y: data.cantPendientes
					        }, 
			        		]
				    	}]
		    		});
					
				},

				error: function(xhr, textStatus, errorThrown) {
					alert("Error en el AJAX Gesol");
					console.log(JSON.stringify(xhr));
					console.log('AJAX error: ' + textStatus + ' : ' + errorThrown);
				},
			});
		</script>

		<!--Cambiar tipo de grafico-->
		<script>

			var estiloGrafico = $('#estilo-grafico');

			estiloGrafico.change(function() {
				
				var tipo = estiloGrafico.val();

				chart.update({
						chart:{
							type: tipo
						},
		    		});

			});
		</script>

	<!--CIERRA CONTAINER-->
	</div>

@stop

