@extends('layouts.templateBasico')

@section('titulo')
	Registrarse Gesol
@stop

@section('estilos')
	@parent
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@stop

@section('contenido')

	<!-- CONTENEDOR PARA REGISTRARSE -->
    <div class="container">

    	<div class="jumbotron">

	      	<div class="row">

	        	<div class="col-md-12">

	         		<h2 class="display-4"><center><strong>Registro&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
</strong></center></h2>

		          	{!!Form::open(['route'=>'usuarios.store', 'method'=>'POST'])!!}     

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

			        <fieldset class="form-group row">
				      <legend class="col-form-legend col-sm-2">Genero *</legend>
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

			        <div class="form-group">
			          <label class="control-label" for="telefono">Telefono *</label>
			          	<div class="input-group">
			            	<input type="number" class="form-control" name="telefono" placeholder="Introduzca su telefono" />
			        	</div>             	
			        </div>

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

					<br>

					<div class="g-recaptcha" data-sitekey="6Lf5vDAUAAAAAB-fgq6MBtZjAqKPOc0Ljw7fZeJX"></div>

					<br>

			        <input type="submit" value="Registrarme" class="btn btn-primary btn-lg">

		          	{!!Form::close()!!}

		      	</div><!--/span-->

			</div><!--/row-->

		</div>

	</div>
	<!-- FIN DEL CONTENEDOR PARA REGISTRARSE -->

@stop

@section('javascript')
	@parent
	<!--OJO: para seccion header añadir estilos o scripts con Html y no HTML-->
	{!! Html::script('https://www.google.com/recaptcha/api.js'); !!} 
@stop



