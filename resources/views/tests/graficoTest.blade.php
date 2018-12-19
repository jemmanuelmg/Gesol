@extends ('layouts.templateBasico')

@section('estilos')
	@parent
	{!! Charts::assets() !!}

@stop


@section('contenido')

	<br>
	<br>
	<br>
	
	<div class="container">

		<h3 class="subencabezado">Ingrese periodo deseado</h3>
		<br>

		<div class="row">

			<div class="col-md-5">
				<div class="form-group">
					<label class="control-label" for="fechaNac">Fecha de inicio (dia/mes/año)*</label>
					<div class="input-group">
						<div class="input-group-addon" style="width: 2.6rem"><i class="fas fa-calendar-alt"></i></div>

						<input name="fechaIni" id="fechaIni" type="date" value="2017-01-01" class="form-control"/>

					</div>             	
				</div>
			</div>

			<div class="col-md-5">
				<div class="form-group">
					<label class="control-label" for="fechaNac">Fecha de finalización (dia/mes/año)*</label>
					<div class="input-group">
						<div class="input-group-addon" style="width: 2.6rem"><i class="fas fa-calendar-alt"></i></div>

						<input name="fechaFin" id="fechaFin" type="date" value="{{date('Y-m-d')}}" class="form-control"/>

					</div>             	
				</div>
			</div>

			<div class="col-md-2">
				<button id="botonG1" class="btn btn-primary btn-sm" type="button" >Filtrar</button>

			</div>

			<br>

		</div>
	</div>

	<br>
	<br>
	<br>
	<div id="container"></div>
	<h2><strong>{!! $chart1->render() !!}</strong></h2>

@stop


@section('javascript')
	@parent

	<!--Paquete auxiliar para funcionalidad Ajax en el grafico
	<script src="https://code.highcharts.com/highcharts-more.js"></script>
	<!--Termina paquete auxiliar-->

	<script type="text/javascript" src="{{ URL::asset('js/procesar-g1.js') }}"></script>

@stop