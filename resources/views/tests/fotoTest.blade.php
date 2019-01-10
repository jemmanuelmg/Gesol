@extends ('layouts.templateBasico')

@section('titulo')
	Editar o eliminar usuario
@stop

@section('contenido')


	<!-- CONTENEDOR EDITAR USUARIO -->
    <div class="container">

    	<div class="jumbotron">

	      	<div class="row">

	        	<div class="col-md-12">
	        		
	         		<h2 class="display-4"><center><strong>Editar Usuario</strong></center></h2>

		          	{!!Form::open(['route' => ['usuarios.update', $usuario->usu_cedula], 'method'=>'PUT'])!!}    

		          	<div class="form-group">
			          <label class="control-label" for="cedula">Cedula</label>
			          	<div class="input-group">
			            	<input type="number" value='{{$usuario->usu_cedula}}' class="form-control" name="cedula" placeholder="Introduzca su cedula" />
			        	</div>             	
			        </div>  

			        <div class="form-group">
			          <label class="control-label" for="nombres">Nombres</label>
			          	<div class="input-group">
			            	<input type="text" value='{{$usuario->usu_nombres}}' class="form-control" name="nombres" placeholder="Introduzca su nombre" />
			        	</div>             	
			        </div>

			        <div class="form-group">
			          <label class="control-label" for="apellidos">Apellidos</label>
			          	<div class="input-group">
			            	<input type="text" value='{{$usuario->usu_apellidos}}' class="form-control" name="apellidos" placeholder="Introduzca su apellido" />
			        	</div>             	
			        </div>

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
			          <label class="control-label" for="fechaNac">Fecha de nacimiento</label>
			          	<div class="input-group">
			            	<input name="fechaNac" type="date" class="form-control" value='{{$usuario->usu_fechaNac}}'/>
			        	</div>             	
			        </div>

			        <div class="form-group">
			          <label class="control-label" for="telefono">Telefono</label>
			          	<div class="input-group">
			            	<input type="number" value='{{$usuario->usu_telefono}}' class="form-control" name="telefono" placeholder="Introduzca su telefono" />
			        	</div>             	
			        </div>

			        <div class="form-group">
			          <label class="control-label" for="correo">Correo Electrónico</label>
			          <div class="input-group">
			            <input type="email" value='{{$usuario->email}}' class="form-control" name="correo" placeholder="Introduzca su correo electrónico" />
			          </div>
			        </div>
			        
			        <div class="form-group">
			          <label class="control-label" for="password">Nueva contraseña</label>
			          <div class="input-group">
			            <input type="password" class="form-control" name="password" placeholder="Introduzca su contraseña" />
			          </div>
			        </div>

			        <div class="form-group">
			          <label class="control-label" for="password">Repetir nueva contraseña</label>
			          	<div class="input-group">
			          		<input type="password" class="form-control" name="repetirContraseña" placeholder="Introduzca de nuevo la contraseña" />
			        	</div>
			        </div>

			        

					<!--Solo usuario con rol 3 (admin) puede editar roles, y no puede editar
					su propio rol. Por eso el email con que inicio sesion debe ser != al email
					de este formulario-->

					@if(session('rol_id') == 3 && session('email') != $usuario->email)
						<div id='rolUsuario'>
							<label for="rol" class="mr-sm-2">Rol de usuario</label>
							<select name='rol' class="custom-select mb-2 mr-sm-2 mb-sm-0">
								<option value="1">Estudiante</option>
								<option value="2">Secretaria(o)</option>
								<option value="3">Coordinador</option>
							</select>
						</div>
					@endif

					<br>

			        <div class="container">
				        <div class="row">
				        	<div class="col-sm"></div>
						    <div class="col-sm">
						    	<input type="submit" value="Actualizar" class="btn btn-primary btn-lg">
						    </div>
						    <div class="col-sm"></div>
						</div>
			        </div>

		          	{!!Form::close()!!}

		          	<br>

					@if(session('rol_id') == 3)

					<!--Formulario eliminar. Necesario usar un formulario completo para indicar el método DELETE en el submit-->
						{!!Form::open(['route' => ['usuarios.destroy', $usuario->usu_cedula], 'method'=>'DELETE'])!!}

							<div class="container">
						        <div class="row">
						        	<div class="col-sm"></div>
								    <div class="col-sm">
								    	<input type="submit" value="Eliminar" class="btn btn-danger btn-lg" style="position: relative; bottom: 62px; left: 150px">	
								    </div>
								    <div class="col-sm"></div>
								</div>
					        </div>

							<hr>

							<p style="color: #BBD035;">
								Al eliminar una cuenta se removerán todos los registros de la base de datos relacionados a la misma, lo cual obligará al usuario a registrarse de nuevo con un rol por defecto de 'Estudiante'.								
							</p>
							
						{!!Form::close()!!}

					@endif

		      	</div><!--/span-->

			</div><!--/row-->

		</div>

	</div>
	<!-- FIN DEL CONTENEDOR EDITAR USUARIO -->

@stop