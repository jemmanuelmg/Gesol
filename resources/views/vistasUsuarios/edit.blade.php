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

    		<center>
    		<div class="btn-group btn-group-toggle" data-toggle="buttons">
			  <label class="btn btn-secondary active">
			    <input type="radio" name="opcion_foto" value="si"> Sin foto
			  </label>
			  <label class="btn btn-secondary">
			    <input type="radio" name="opcion_foto" value="no"> Con foto
			  </label>
			</div>
			</center>
			<br>


			{!!Form::open(['route' => ['usuarios.update', $usuario->usu_cedula], 'method'=>'PUT'])!!}

	      	<div class="row">

	      		<div id="foto_container" class="col-md-5">

	      			<h5>Foto de usuario</h5>

					<script type="text/javascript" src="{{ URL::asset('js/webcam/webcam.js') }}"></script>

					<div id="my_camera" class="circleBase"></div>

					<a href="javascript:void(take_snapshot())" class="btn btn-primary btn-sm">Tomar foto</a>

					<div id="my_result"></div>

					Ó selecciona una foto: <input type="file" name="foto2" class="form-control-file" accept=".jpg, .jpeg, .png, .gif">

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

	        		<input id="foto" type="hidden" name="foto" value=""/>
	        		
	         		
		          	<div class="form-group">
			          <label class="control-label" for="cedula">Cedula</label>
			          	<div class="input-group">
			            	<input type="number" value='' class="form-control" name="cedula" placeholder="Introduzca su cedula" />
			        	</div>             	
			        </div>  

			        <div class="form-group">
			          <label class="control-label" for="nombres">Nombres</label>
			          	<div class="input-group">
			            	<input type="text" value='' class="form-control" name="nombres" placeholder="Introduzca su nombre" />
			        	</div>             	
			        </div>

			        <div class="form-group">
			          <label class="control-label" for="apellidos">Apellidos</label>
			          	<div class="input-group">
			            	<input type="text" value='' class="form-control" name="apellidos" placeholder="Introduzca su apellido" />
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
			            	<input name="fechaNac" type="date" class="form-control" value=''/>
			        	</div>             	
			        </div>

			        <div class="form-group">
			          <label class="control-label" for="telefono">Telefono</label>
			          	<div class="input-group">
			            	<input type="number" value='' class="form-control" name="telefono" placeholder="Introduzca su telefono" />
			        	</div>             	
			        </div>

			        <div class="form-group">
			          <label class="control-label" for="correo">Correo Electrónico</label>
			          <div class="input-group">
			            <input type="email" value='' class="form-control" name="correo" placeholder="Introduzca su correo electrónico" />
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
					@if(session('rol_id') == 3)
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

			<div class="delete-container">
				<h2 class="display-4"><center><strong>Eliminar cuenta</strong></center></h2>
	    		<br>

				@if(session('rol_id') == 3)
				{!!Form::open(['route' => ['usuarios.destroy', $usuario->usu_cedula], 'method'=>'DELETE'])!!}

				<div class="row">
					<div class="col-md-12">
					<!--Formulario eliminar. Necesario usar un formulario completo para indicar el método DELETE en el submit-->
						
						<center>
						<input type="submit" value="Eliminar" class="btn btn-danger btn-lg">
						</center>

						<hr>

						<p style="color: #DC3545;">
							<span class="badge badge-danger" id="span-tel">info</span>  Al eliminar una cuenta se removerán todos los registros de la base de datos relacionados a la misma.								
						</p>
					</div>
				</div><!--/row-->
				
				{!!Form::close()!!}
				@endif
			</div>

		</div>

	</div>
	<!-- FIN DEL CONTENEDOR EDITAR USUARIO -->

@stop


@section('javascript')
	@parent
	<script type="text/javascript">

		$(document).ready(function() {

			var foto_container = $('#foto_container');
			var datos_container = $('#datos_container');
			var radio_foto = $(':radio');

			var flag = 0;

			radio_foto.change(function(){
				
				if(flag == 0){

					datos_container.removeClass("col-md-12");
					datos_container.addClass("col-md-7");

					foto_container.show(350);

					flag = 1;

				}else{

					foto_container.hide(350);

					datos_container.removeClass("col-md-7");
					datos_container.addClass("col-md-12");

					flag = 0;
				}

			})

			foto_container.hide();

			/*con_foto.click(function(e){
				alert('hijueputa');

				

			});

			sin_foto.click(function(e){

				

				

			});
			*/

		});
	</script>
@stop
