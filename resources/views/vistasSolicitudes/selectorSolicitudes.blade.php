@extends('layouts.templateBasico')

@section('title') Gesol : Solicitudes @stop


@section('contenido')

	@include('notificaciones.mostrarErrorForm')

	<!-- CONTENEDOR PARA SELECCIONAR SOLICITUDES -->
    <div class="container">

    	<br>
    	<br>

    	<div class="jumbotron">

	      	<div class="row">

	        	<div class="col-md-12">

	        		<center>
	         		<h1><strong>Seleccionar solicitud</strong></h1><i class="fas fa-pen-alt fa-2x"></i>
	         		
	         		</center>

	         		<br>
					<form action="solicitudes/despachador" method="POST">

						{{ csrf_field() }}

						<center><p><label for="codSol">Selecciona la solicitud que deseas realizar: </label></p></center>
						
						<center>
							<select name='codSol' class="custom-select" id="selector-sol-dropdown">
								<option>Seleccione una solicitud</option>
								<option value="R-ITM-01">R-ITM-01 Carta Modalidad de Proyecto de Grado - ITM</option>
								<option value="R-DC-13">R-DC-13 Autorización Examen Autosuficiencia</option>
								<option value="R-DC-14">R-DC-14 Solicitud Revisión de Nota</option>
								<option value="R-DC-39">R-DC-39 Modificación Matricula Académica</option>
								<option value="R-DC-40">R-DC-40 Solicitud de Transferencia Externa</option>
								<option value="R-DC-52">R-DC-52 Inscripción Curso Extracurricular</option>
							</select>
						</center>

						<center>
							<br>
							<input type="submit" value="Enviar" class="btn btn-primary btn-lg mx-4 btn-noti">
						</center>

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