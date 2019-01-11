@extends('layouts.templateBasico')

@section('title') Gesol : Solicitudes @stop

@section('estilos')
	@parent
	<!--<script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
	{!!Html::script('https://www.google.com/recaptcha/api.js');!!}
	{!!Html::style('css/footer.css')!!}

@stop

@section('contenido')

	@include('notificaciones.mostrarErrorForm')

	<!-- CONTENEDOR PARA SELECCIONAR SOLICITUDES -->
    <div class="container">

    	<div class="jumbotron">

	      	<div class="row">

	        	<div class="col-md-12">

	         		<h2 class="display-4 text-center"><strong>Seleccionar solicitud</strong></h2>

	         		<br><br>

		          	<form action="solicitudes/despachador" method="POST" class="form-inline">

						{{ csrf_field() }}

						<label for="codSol" class="mx-4">Selecciona la solicitud que deseas realizar: </label>

						<select name='codSol' class="custom-select mb-2 mr-sm-2 mb-sm-0">
							<option>Seleccione una solicitud</option>
							<option value="R-DC-13">R-DC-13 Autorización Examen Autosuficiencia</option>
							<option value="R-DC-14">R-DC-14 Solicitud Revisión de Nota</option>
							<option value="R-DC-39">R-DC-39 Modificación Matricula Académica</option>
							<option value="R-DC-40">R-DC-40 Solicitud de Transferencia Externa</option>
							<option value="R-DC-52">R-DC-52 Inscripción Curso de Vacaciones</option>
						</select>

						<br><br><br>

						<input type="submit" value="Enviar" class="btn btn-primary btn-lg mx-4">

					</form>

		      	</div><!--/span-->

			</div><!--/row-->

		</div>

		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>

	</div>
	<!-- FIN DEL CONTENEDOR PARA SELECCIONAR SOLICITUDES -->

@stop

@section('javascript')
	@parent
	<!--OJO: para seccion header añadir estilos o scripts con Html y no HTML-->
	{!! Html::script('https://www.google.com/recaptcha/api.js'); !!} 
@stop