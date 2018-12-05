@extends('layouts.templateBasico')

<!--Adicionar estilos css necesrios para tabla, por eso se menciona la seccion estilos y @parent para sobreescribir-->
@section('estilos')
	@parent
	
	
	{!!Html::style('css/footer.css')!!}
	{!!Html::style('css/font-awesome.min.css')!!}
	{!!Html::style('js/DataTables/media/css/jquery.dataTables.css')!!}

@stop

@section('titulo') Gesol - Listado de usuarios @stop

@section('contenido')
	<br>

	<div class="jumbotron text-center" style="margin: 0 1em; padding: 2em 0;">
		<div class="row">
        	<div class="container">
        		<h1><strong>Administrar usuarios</strong></h1>
        		<br>
        		<p class="lead">Crear un nuevo usuario:</p>
        		<a href="/usuarios/create" class="btn btn-outline-primary"><i class="fa fa-user" aria-hidden="true"></i> Nuevo usuario</a>
        	</div>
        </div>	
	</div>

	<br>
	<br>
	
	<div class="container-fluid">
			<table id="example"  class="responstable">
				<thead>
					<tr>
						<th>Cedula</th>
						<th>Nombre</th>
						<th>Apellidos</th>
						<th>Genero</th>
						<th>Fecha de nacimiento</th>
						<th>Telefono</th>
						<th>Correo Electronico</th>
						<th>Rol Usuario</th>
						<th>Opciones</th>
					</tr>
				</thead>

				<tbody>

					@foreach($listaUsuarios as $usuario)
					<tr>
						<td>{{$usuario->usu_cedula}}</td>
						<td>{{$usuario->usu_nombres}}</td>
						<td>{{$usuario->usu_apellidos}}</td>
						<td>{{$usuario->usu_genero}}</td>
						<td>{{$usuario->usu_fechaNac}}</td>
						<td>{{$usuario->usu_telefono}}</td>
						<td style="text-align: left;">{{$usuario->email}}</td>
						<td>{{$usuario->rol_nombre}}</td>

						<!--En parameters se escribe las variables que llevará el metodo GET. En atributes cosas como la clase css, id, etc. Entre corchetes por que es un array-->

						<td style="text-align: center;">
							{!! link_to_route('usuarios.edit', $title = '', $parameters = $usuario->usu_cedula, $attributes = ['class'=>'fa fa-pencil btn btn-outline-primary']); !!}
						</td>
					</tr>
					@endforeach
					
				</tbody>

			</table>

	</div>	

@stop

<!--Adicionar javascript necesrios para tabla-->
@section('javascript')
	@parent
	
	{!! HTML::script('js/DataTables/media/js/jquery.dataTables.js'); !!} 

	<script type="text/javascript">

		$(document).ready(function() {
			$('#example').DataTable({
				"language":{
					"search":"Buscar en tabla",
					"paginate":{
						"first" : "primero",
						"previous" : "anterior",
						"next" : "siguiente",
						"last" : "ultimo",
					},
					"lengthMenu":     "Mostrar _MENU_ registros",
					"lenghtMenu":"Mostrando _MENU_ registros por pagina.",
					"zeroRecords":"No se ha encontrado información.",
					"info":"Mostrando la pagina _PAGE_ de _PAGES_",
					"infoEmpty":"No hay registros disponibles.",
					"infoFiltered":"(filtrado de _MAX_ registros totales.)"
				}
			});

		} );

	</script>
@stop