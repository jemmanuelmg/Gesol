@extends('layouts.templateBasico')

@section('titulo')
Registrarse en Gesol
@stop

@section('estilos')
@parent

<meta name="csrf-token" content="{{ csrf_token() }}" />
@stop

@section('contenido')

<!-- CONTENEDOR PARA REGISTRARSE (este es un pequeño cambio para heroku) -->
<div class="container">

	<div class="jumbotron">

		<h2 class="display-4"><center><strong>Registro&nbsp;&nbsp;&nbsp;<i class="fas fa-edit" aria-hidden="true"></i></strong></center></h2>
		<br>

		{!!Form::open(['route'=>'usuarios.store', 'method'=>'POST'])!!}   

		<div class="row">

			

			<div class="col-md-6"> <!--Primera columnsa de inputs-->

				<div class="form-group">
					<label class="control-label" for="cedula">No. Documento *</label>
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

				<div class="form-group">
					<label class="control-label" for="institucion">Institución Educativa *</label>
					<div class="input-group">
					<select name='institucion' class="custom-select mb-2 mr-sm-2 mb-sm-0">
						<option value="-1">Seleccione</option>

						@foreach ($instituciones as $registro)
						    <option value="{{$registro->ins_id}}">{{$registro->ins_nombre}}</option>
						@endforeach						

					</select>
					</div>
				</div>

				

			</div>

			<div class="col-md-6"> <!--Segunda columnda de inputs-->

				<div class="form-group">
					<label class="control-label" for="correo">Correo Electrónico *</label>
					<div class="input-group">
						<input type="email" id="input-email" class="form-control" name="correo" placeholder="Introduzca su correo electrónico" />
					</div>
				</div>

				<!--PANEL PARA INTRODUCIR TELEFONO o correo-->
				<div class="form-group">
					<label class="control-label" for="correo">Teléfono *</label>
					<div class="input-group">
						<input type="number" id="input-telefono" class="form-control" name="telefono" placeholder="Introduzca su telefono" />
					</div>
				</div>


				<div class="form-group">
					<label class="control-label" for="password">Contraseña *</label>
					<div class="input-group">
						<input type="password" class="form-control" name="password" placeholder="Introduzca su contraseña" />
					</div>
				</div>
				<!--//PANEL PARA INTRODUCIR TELEFONO o correo-->

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

				@if(session('rol_id') != 3)
				<div id="contenedor-tel">
					<div class="form-group">

						<!--INICIA INDICACIONES-->
						<label class="control-label" id="label-telefono" for="telefono">Comprobar cuenta:</label>
						<p class="texto-gris"> 
							<span class="badge badge-info" id="span-tel">info</span> Debes introducir tu numero de celular o email donde quieres que sea enviado un código de confirmación, que luego podrás ingresar aquí para validar tus datos.
						</p>
						<!--FIN INDICACIONES-->
						

						<!--INICIA DIV VISIBLE SELECCIONAR EMAIL O TELEFONO-->	
						<div>

							<!--INICIA RADIO BUTTONS EMAIL TELEFONO-->
							<p>	
							<center>
							<i class="fas fa-mobile-alt fa-1x" id="icono-tel"></i>&nbsp;&nbsp;<input type="radio" name="opc-verif" id="opc-tel"> Con teléfono &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<i class="fas fa-envelope fa-1x" id="icono-email"></i>&nbsp;&nbsp;<input type="radio" name="opc-verif" id="opc-email"> Con Email
							</center>
							</p>
							<!--FIN RADIO BUTTONS EMAIL TELEFONO-->	
							

							
							<!--INICIA BOTÓN ENVIAR CODIGO-->
							<button id="btn-telefono"class="btn btn-primary btn-sm" type="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Verificando.." data-content="Se intentará enviar un mensaje al número o email">
								<i class="fas fa-user fa-1x" aria-hidden="true"></i>
								<div id="div-spin"><i class="fas fa-sync fa-spin fa-1x" aria-hidden="true"></i></div>
							</button>
							<!--FIN BOTÓN ENVIAR CODIGO-->

						</div>
						<!--TERMINA DIV VISIBLE SELECCIONAR EMAIL O TELEFONO-->	

					</div>
					<br>

					<!--INICIA DIV INVISIBLE PARA INGRESAR EL TOKEN-->
					<div id="div-ingresar-token">

						<label id="lbl-token" class="control-label" for="token">Código:</label> 

						<!--INICIA INPUT DEL TOKEN-->
						<center>
						<div id="envoltorio-input-token">
							<div class="input-group mb-2 mr-sm-2 mb-sm-0">
							<div class="input-group-addon" style="width: 2.6rem"><i class="fas fa-check-square"></i></div>
							<input type="text" size="4" maxlength="4" id="input-token" name="token" class="form-control" />
							</div>
						</div>
						</center>
						<!--TERMINA INPUT DEL TOKEN-->

						<!--HIDDEN PARA ALMACENAR CÓDIGO-->
						<input type="hidden" id="input-token-res" name="tokenRes" value="">

					</div>
					<!--TERMINA DIV PARA INGRESAR EL TOKEN-->

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



