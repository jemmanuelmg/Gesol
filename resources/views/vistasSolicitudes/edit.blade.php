@extends ('layouts.templateBasico')

@section('titulo')
	Editar o eliminar usuario
@stop

@section('contenido')


	<!-- CONTENEDOR EDITAR INFORMACION DE SOLICITUD -->
    <div class="container">

    	<div class="jumbotron">

	      	<div class="row">

	        	<div class="col-md-12">
	        		
	         		<h2 class="display-4"><center><strong>Editar informacion de solicitud</strong></center></h2>

	         		<br>

		          	<!--Para actualizar se envía el id y cambia el metodo a PUT-->
					<!--Concatenar variables a rutas en formularios se usa un array con el primer elemento la ruta despues variables-->
		          	{!!Form::open(['route' => ['solicitudes.update', $solicitud->sol_id], 'method'=>'PUT'])!!} 

			        <div class="form-group">
			          <label class="control-label" for="nombre">Nombre solicitud *</label>
			          	<div class="input-group">
			            	<input type="text" value='{{$solicitud->sol_nombre}}' class="form-control" name="nombre" />
			        	</div>             	
			        </div>

			        <div class="form-group">
			          <label class="control-label" for="fechaHora">Fecha hora solicitud *</label>
			          	<div class="input-group">
			            	<input type="datetime" value='{{$solicitud->sol_fechaCreacion}}' class="form-control" name="fechaHora" />
			        	</div>             	
			        </div>

			        <div class="form-group">
                      <label class="control-label" for="estado">Estado solicitud *</label>
                        <div class="input-group">
                            <select name="estado" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                <option value="Pendiente">Pendiente</option>
								<option value="Atendida">Atendida</option>
                            </select>
                        </div>              
                    </div>

			        <div class="form-group">
			          <label class="control-label" for="cedula">Cedula del estudiante que generó la solicitud *</label>
			          	<div class="input-group">
			            	<input name="cedula" type="number" class="form-control" value='{{$solicitud->usu_cedula}}'/>
			        	</div>             	
			        </div>

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

					@if(session('rol_id') == 3 || session('rol_id') == 2)
						<!--Formulario eliminar. Necesario usar un formulario completo para indicar el método DELETE en el submit-->
						{!!Form::open(['route' => ['solicitudes.destroy', $solicitud->sol_id], 'method'=>'DELETE'])!!}

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
								Al eliminar una solicitud se removerán todos los registros de la base de datos
								relacionados a ella, al igual que el formato PDF generado. El estudiante que la formuló  (o cualquier otro usuario) ya no tendrá acceso adicho recurso.
							</p>

						{!!Form::close()!!}

					@endif

		      	</div> <!--/span-->

			</div> <!--/row-->

		</div> <!--/jumbotron-->

	</div>
	<!-- FIN DEL CONTENEDOR EDITAR INFORMACION DE SOLICITUD -->

@stop