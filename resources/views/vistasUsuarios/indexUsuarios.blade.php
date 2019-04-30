@extends('layouts.templateDashboard')

@section('titulo') Gesol - Listado de usuarios @stop


<!--Adicionar estilos css necesrios para tabla, por eso se menciona la seccion estilos y @parent para sobreescribir-->
@section('estilos')
	@parent
	
	{!!Html::style('js/DataTables/media/css/jquery.dataTables.min.css')!!}

@stop


@section('contenido')
	<br>
	<br>
	<br>
	<br>

	<div class="container-fluid">

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
		
		
		<table id="example"  class="responstable">
			<thead>
				<tr class="tr-admin">
					<th>Documento</th>
					<th>Nombre</th>
					<th>Apellidos</th>
					<th>Genero</th>
					<th>Telefono</th>
					<th>Correo Electronico</th>
					<th>Rol Usuario</th>
					<th>Editar</th>
				</tr>
			</thead>

			<tbody>

				@foreach($listaUsuarios as $usuario)
				<tr>
					<td>{{$usuario->usu_cedula}}</td>
					<td>{{$usuario->usu_nombres}}</td>
					<td>{{$usuario->usu_apellidos}}</td>
					<td>{{$usuario->usu_genero}}</td>
					<td>{{$usuario->usu_telefono}}</td>
					<td style="text-align: left;">{{$usuario->email}}</td>
					<td>{{$usuario->rol_nombre}}</td>

					<!--En parameters se escribe las variables que llevará el metodo GET. En atributes cosas como la clase css, id, etc. Entre corchetes por que es un array-->

					<td style="text-align: center;">
						{!! link_to_route('usuarios.edit', $title = '', $parameters = $usuario->usu_cedula, $attributes = ['class'=>'far fa-edit btn btn-outline-primary']); !!}
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
	
	{!! HTML::script('js/DataTables/media/js/jquery.dataTables.min.js'); !!} 

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