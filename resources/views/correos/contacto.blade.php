@extends ('layouts.templateBasico')

@section('titulo') Gesol : Contacto @stop

@section('estilos')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@stop

@section('contenido')	

<!-- CONTENEDOR PARA CONTACTO -->
<div class="container">

	<div class="jumbotron">

		<!--COMIENZA ROW 1 encabezado-->
		<div class="row">

			<div class="col-md-12">

				<h3>
					<center>
							Contáctenos &nbsp;&nbsp; <i class="far fa-comments fa-2x" aria-hidden="true"></i>
						
					</center>
				</h3>
				
				<br>
				<br>
				<div class="alert alert-info" role="alert">
					@if(Session('sesionIniciada'))
						<p>
							@foreach($infoInstitucion as $dato)
								Información de contacto de tu institución educativa: <i><b>{{$dato->ins_nombre}}</i></b>
								<ul>
								
								<li>Teléfono: {{$dato->ins_telefono}}</li>
								
								<li>Dirección: {{$dato->ins_direccion}}</li>
								
								<li>Correo electrónico: {{$dato->ins_email}}</li>

								<li>Horarios de atención: Lunes a Viernes de 8:00 a 12:00 y 14:00 a 16:00 


								</ul>
							@endforeach
						</p>
					@else
						<p>Inicia sesión para ver aquí los datos de contacto de tu Intitución Educativa</p>
					@endif
				</div>
				<br>
				<br>



				<p>Envía un mensaje al personal de <i>Gesol:</i></p>
			</div>

		</div>
		<!--TERMINAR ROW 1 encabezado-->

		{!!Form::open(['route' => 'contacto.store', 'method'=>'POST'])!!}          

		<!--COMIENZA ROW 2 encabezado-->
		<div class="row">

			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label" for="nombre">Nombres *</label>
					<div class="input-group">
						<input type="text" class="form-control" name="nombre" placeholder="Introduzca su nombre" />
					</div>             	
				</div>

				<div class="form-group">
					<label class="control-label" for="correo">Correo Electrónico *</label>
					<div class="input-group">
						<input type="email" class="form-control" name="correo" placeholder="Introduzca su correo electrónico" />
					</div>
				</div>

				<div class="form-group">
					<label class="control-label" for="asunto">Asunto *</label>
					<div class="input-group">
						<input type="text" class="form-control" name="asunto" placeholder="Introduzca su asunto" />
					</div>
				</div>

			</div>

			<div class="col-md-6">

				<div class="form-group">
					<label class="control-label" for="mensaje">Mensaje *</label>
					<div class="input-group">
						<textarea name="mensaje" rows="5" cols="50" class="form-control" placeholder="Introduzca su mensaje"></textarea>
					</div>
				</div>

				<br/>

				<div class="g-recaptcha" data-sitekey="6Le6e7IUAAAAAI5KqE-h67CJ3oX1pPGM1597MdNd"></div>

				<br/>

				<input type="submit" value="Comunicarme" class="btn btn-primary btn-lg">

			</div>

		</div>
		<!--TERMINA ROW 2 encabezado-->

		{!!Form::close()!!}

		</div><!--/row-->

	</div>

</div>
<!-- FIN DEL CONTENEDOR PARA CONTACTO -->

@stop