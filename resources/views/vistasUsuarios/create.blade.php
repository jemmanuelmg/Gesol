@extends('layouts.templateBasico')

@section('titulo')
Registrarse Gesol
@stop

@section('estilos')
@parent

<meta name="csrf-token" content="{{ csrf_token() }}" />
@stop

@section('contenido')

<!-- CONTENEDOR PARA REGISTRARSE -->
<div class="container">

	<div class="jumbotron">

		<h2 class="display-4"><center><strong>Registro&nbsp;&nbsp;&nbsp;<i class="fas fa-edit" aria-hidden="true"></i></strong></center></h2>

		{!!Form::open(['route'=>'usuarios.store', 'method'=>'POST'])!!}   

		<div class="row">

			

			<div class="col-md-6"> <!--Primera columnsa de inputs-->

				<div class="form-group">
					<label class="control-label" for="cedula">Cedula *</label>
					<div class="input-group">
						<input type="number" class="form-control" name="cedula" placeholder="Introduzca su cedula" />
					</div>             	
				</div>  

				<div class="form-group">
					<label class="control-label" for="nombres">Nombres *</label>
					<div class="input-group">
						<input type="text" class="form-control" name="nombres" placeholder="Introduzca su nombre" />
					</div>             	
				</div>

				<div class="form-group">
					<label class="control-label" for="apellidos">Apellidos *</label>
					<div class="input-group">
						<input type="text" class="form-control" name="apellidos" placeholder="Introduzca su apellido" />
					</div>             	
				</div>

				<!--
				<fieldset class="form-group row">
					<legend class="col-form-legend col-sm-2">Genero</legend>
					<div class="col-sm-10">
						<div class="form-check-inline">
							<label class="form-check-label">
								<input class="form-check-input" type="radio" name="genero" value="Masculino">
								Masculino
							</label>
						</div>
						<div class="form-check-inline">
							<label class="form-check-label">
								<input class="form-check-input" type="radio" name="genero" value="Femenino">
								Femenino
							</label>
						</div>
					</div>
				</fieldset>


				<div class="form-group">
					<label class="control-label" for="fechaNac">Fecha de nacimiento *</label>
					<div class="input-group">
						<input name="fechaNac" type="date" class="form-control"/>
					</div>             	
				</div>
				-->

			</div>

			<div class="col-md-6"> <!--Segunda columnda de inputs-->

				<div class="form-group">
					<label class="control-label" for="correo">Correo Electrónico *</label>
					<div class="input-group">
						<input type="email" class="form-control" name="correo" placeholder="Introduzca su correo electrónico" />
					</div>
				</div>

				<div class="form-group">
					<label class="control-label" for="password">Contraseña *</label>
					<div class="input-group">
						<input type="password" class="form-control" name="password" placeholder="Introduzca su contraseña" />
					</div>
				</div>

				<div class="form-group">
					<label class="control-label" for="password">Repetir contraseña *</label>
					<div class="input-group">
						<input type="password" class="form-control" name="passwordRepeat" placeholder="Introduzca de nuevo la contraseña" />
					</div>
				</div>

				@if(session('rol_id') == 3)
				<div id='rolUsuario'>
					<label for="rol" class="mr-sm-2">Rol de usuario *</label>
					<select name='rol' class="custom-select mb-2 mr-sm-2 mb-sm-0">
						<option value="1">Estudiante</option>
						<option value="2">Secretaria(o)</option>
						<option value="3">Coordinador</option>
						<option value="4">Decano</option>
						<option value="5">Docente</option>
					</select>
				</div>
				@endif

				@if(session('rol_id') == 1)
				<div id="contenedor-tel">
					<div class="form-group">
						<label class="control-label" id="label-telefono" for="telefono">Telefono:</label>
						<p class="texto-gris"> 
							<span class="badge badge-info" id="span-tel">info</span> Para confirmar tu cuenta debes introducir tu número celular al cual le será enviado un código de confirmación. Será valido por los siguientes 10 minutos.
						</p>

						<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon" style="width: 2.6rem"><i class="fas fa-mobile-alt"></i></div>
						<input type="number" id="input-telefono" class="form-control" name="telefono" placeholder="Introduzca su telefono" />
						</div>

						<button id="btn-telefono"class="btn btn-primary btn-sm" type="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Verificando.." data-content="Se enviará un mensaje de texto al número">
							
							<i class="fas fa-user fa-1x" aria-hidden="true"></i>
							<div id="div-spin"><i class="fas fa-sync fa-spin fa-1x" aria-hidden="true"></i></div>

						</button>
					</div>
					<br>

					<div id="div-verificar-tel"> 
						<label id="lbl-token" class="control-label" for="token">Código:</label> 

						<input type="number" id="input-token" name="token" class="form-control" placeholder="Introduzce tu codigo de confirmación" />

						<input type="hidden" id="input-token-res" name="tokenRes" value="">
					</div>

				</div>
				@endif

				<br>

				<input type="submit" value="Registrarme" class="btn btn-primary btn-lg">


			</div>
			

			

		</div><!--/row-->

		{!!Form::close()!!}

	</div>

</div>
<!-- FIN DEL CONTENEDOR PARA REGISTRARSE -->

@stop

@section('javascript')
@parent
<!--OJO: para seccion header añadir estilos o scripts con Html y no HTML-->
<!--{!! Html::script('https://www.google.com/recaptcha/api.js'); !!} -->

<!--Script para popup en botones-->
<script type="text/javascript">
	$(function(){
		$('[data-toggle="popover"]').popover()
	});
</script>

<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': {!! json_encode(csrf_token()) !!}
		}
	});
</script>

<!--Script ajax para enviar SMS-->
<script type="text/javascript" src="{{ URL::asset('js/verificar-tel-ajax.js') }}"></script>


@stop



