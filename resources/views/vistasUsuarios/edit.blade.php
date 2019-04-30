@extends ('layouts.templateBasico')

@section('titulo')
	Editar o eliminar usuario
@stop

@section('contenido')


	<!-- CONTENEDOR EDITAR USUARIO -->
    <div class="container">

    	<div class="jumbotron">

    		

    		<h2 class="display-4"><center><strong>Editar Usuario</strong></center></h2>
    		<br>

			<br>

			<!--Switch para tomar foto o no-->
			<center>
        		<h5 class="texto-azul" id="lblFoto"> ¿Quieres añadir una foto a tu perfil?:</h5>

		       	<div class="switch">
		    		<div class="btn-group btn-group-toggle" data-toggle="buttons">
						<label class="btn btn-secondary active">
							<input type="radio" name="opcion_foto" value="si"> Sin foto
						</label>

						<label class="btn btn-secondary">
							<input type="radio" name="opcion_foto" value="no" data-toggle="popover" data-trigger="focus" data-placement="right" data-content="Si no funciona la camara, da clic en (&#8520), al lado del botón recargar, y concede permiso para la camara"> Con foto
						</label>
					</div>
				</div>
		    </center>


			{!!Form::open(['route' => ['usuarios.update', $usuario->usu_cedula], 'files' => true, 'enctype' => 'multipart/form-data', 'method'=>'PUT'])!!}

	      	<div class="row">

	      		<div id="foto_container" class="col-md-5">

	      			<h5>Foto de usuario</h5>

					<script type="text/javascript" src="{{ URL::asset('js/webcam/webcam.js') }}"></script>

					<center>

						<div id="my_camera" class="circleBase"></div>

						<a href="javascript:void(take_snapshot())" class="btn btn-primary btn-sm"><i class="fas fa-camera-retro"></i> &nbsp;&nbsp; Tomar foto</a>

						<div id="my_result"></div>

						<br>
						<p style="text-align: left">

							
							<hr>

							<br>
							Ó selecciona una foto: <i class="fas fa-upload"></i> &nbsp;&nbsp;
							<br>
							<input type="file" name="foto2" class="form-control-file" accept=".jpg, .jpeg, .png, .gif">
							<input type="hidden" name="MAX_FILE_SIZE" value="1228800" />
						</p> 

					</center>

					<script language="JavaScript">
					    Webcam.attach( '#my_camera' );
					    
					    function take_snapshot() {
					        Webcam.snap( function(data_uri) {

					        	var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
					        	document.getElementById('foto').value = raw_image_data;

					            document.getElementById('my_result').innerHTML = '<img class="result_img" src="'+data_uri+'"/>';

					        } );
					    }
					</script>

				</div>








	        	<div id="datos_container" class="col-md-12">

	        		<!--Input escondido para almacenar la foto codificada-->
	        		<input id="foto" type="hidden" name="foto" value=""/>
	        		
	         		
		          	<div class="form-group">
			          <label class="control-label" for="cedula">Cedula</label>
			          	<div class="input-group">
			            	<input type="number" value='{{$usuario->usu_cedula}}' class="form-control" name="cedula" id="cedula" placeholder="Introduzca su cedula" />
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
				            <input class="form-check-input" type="radio" name="genero" value="m" checked>
				            Masculino
				          </label>
				        </div>
				        <div class="form-check-inline">
				          <label class="form-check-label">
				            <input class="form-check-input" type="radio" name="genero" value="f">
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

			        @if($usuario->rol_id != 1)
			        <br>
			        <center>
			        <div class="alert alert-primary" id="div-firma" role="alert">

			        	<div class="row">

			        		<div class="col-sm-1">
			        			<i class="fas fa-info-circle fa-2x"></i>
			        		</div>

			        		<div class="col-sm-11">
			        			<p>Al ser usuario administrativo, ingrese una imagen que contenga su firma:</p>	
					  			<input type="file" name="firma" class="form-control-file" accept=".jpg, .jpeg, .png, .gif">			
					  			<input type="hidden" name="MAX_FILE_SIZE" value="1228800" />
			        		</div>

			        	</div>		
			          
					</div>
					</center>
					<br>
					@endif

			        
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

					<center>
					<input type="submit" value="Actualizar" class="btn btn-primary btn-lg">

					
					</center>
						 
		          	<br>

		      	</div>

			</div><!--/row-->

			{!!Form::close()!!}

			<br>
			<br>


			@if(session('rol_id') == 3 && session()->has('rol_id'))
			{!!Form::open(['route' => ['usuarios.destroy', $usuario->usu_cedula], 'method'=>'DELETE'])!!}

			<div class="delete-container">
			<h2 class="display-4"><center><strong>Eliminar cuenta</strong></center></h2>
    		<br>

			<div class="row">
				<div class="col-md-12">
				<!--Formulario eliminar. Necesario usar un formulario completo para indicar el método DELETE en el submit-->
					
					<center>
					<input type="submit" value="Eliminar" class="btn btn-danger btn-lg">
					</center>

					<hr>

					<p style="color: #DC3545;">
						<span class="badge badge-danger" id="span-tel">info</span>  Al eliminar ésta cuenta se removerán todos los registros de la base de datos relacionados a la misma., como solicitudes, respuestas, documentos PDF, etc.								
					</p>
				</div>
			</div><!--/row-->
			</div>
			
			{!!Form::close()!!}
			@endif
			

		</div>

	</div>

	<!-- FIN DEL CONTENEDOR EDITAR USUARIO -->

@stop


@section('javascript')
	@parent
	<script type="text/javascript" src="{{ URL::asset('js/script-foto-usuario.js') }}"></script>
	<script type="text/javascript">
	$(function(){
		$('[data-toggle="popover"]').popover()
	});
</script>
@stop
