@extends(session('rol_id') == 3 ? 'layouts.templateDashboard' : 'layouts.templateBasico');

@section('titulo') Gesol - Listado de solicitudes @stop

<!--Adicionar estilos css necesrios para tabla, por eso se menciona la seccion estilos y @parent para sobreescribir-->
@section('estilos')
	@parent
	
	{!!Html::style('js/DataTables/media/css/jquery.dataTables.css')!!}

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
        		<h1><strong>Administrar Solicitudes</strong></h1>      		
        	</div>
        </div>	
	</div>

	<br>
	<br>

	
		<table id="example" class="responstable">
			<thead class="">
				@if(session('rol_id') == 3)
				<tr class="tr-admin">
				@else
				<tr>
				@endif	
					<th>Procedimiento</th>
					<th>Fecha solicitud</th>
					<th>Nombres estudiante</th>
					<th>Apellidos estudiante</th>
					<th>Cedula estudiante</th>
					<th>Correo estudiante</th>
					<th>Estado solicitud</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>

				@foreach($listaSol as $solicitud)
				<tr>
					<td>{{$solicitud->sol_nombre}}</td>
					<td>{{$solicitud->sol_fechaCreacion}}</td>
					<td>{{$solicitud->usu_nombres}}</td>
					<td width="80px">{{$solicitud->usu_apellidos}}</td>
					<td>{{$solicitud->usu_cedula}}</td>
					<td style="text-align: left;">{{$solicitud->email}}</td>
					<td>{{$solicitud->sol_estado}}</td>

					<!--En parameters se escribe las variables que llevará el metodo GET. En atributes cosas como la clase css, id, etc. Entre corchetes por que es un array-->
					<td style="width:14%">
						
						<a href="{{'/solicitudesPDF/' . $solicitud->sol_formato}}" class="btn btn-outline-danger btn-sm" target="_blank"><i class="far fa-file-pdf"></i> &nbsp;Ver</a>

						@if(session('rol_id') == 3) <!--solo admin coordinador puede editar solicitud-->
						
							<!--
							Este link se puede cambiar por el otro normal, fijandose en la ruta a la que va con php:artisan route:list
							sin tener que usar solicitudes.edit
							{!! link_to_route('solicitudes.edit', $title = 'Editar', $parameters = $solicitud->sol_id, $attributes = ['class'=>'far fa-edit btn btn-outline-primary']); !!}-->

							<!-- <a href="{{'/solicitudes/' . $solicitud->sol_id . '/edit'}}" class="btn btn-outline-primary btn-sm" target="_blank"><i class="far fa-edit"></i>&nbsp;Edit</a> -->

						@endif


						<a href="{{'/redactarRespuesta/' . $solicitud->sol_nombre . '/' . $solicitud->sol_formato . '/' . $solicitud->sol_id}}" class="btn btn-outline-info btn-sm" target="_blank"><i class="far fa-arrow-alt-circle-left"></i> &nbsp;Resp</a>

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

	<script type="text/javascript" src=""></script>
	
	{!! Html::script('js/DataTables/media/js/jquery.dataTables.js'); !!} 

	<script type="text/javascript">

		$(document).ready(function() {
			$('#example').DataTable({
				"order":[[1,"desc"]],
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