@extends('layouts.templateBasico')

<!--Adicionar estilos css necesrios para tabla, por eso se menciona la seccion estilos y @parent para sobreescribir-->
@section('estilos')
	@parent
	
	{!!Html::style('js/DataTables/media/css/jquery.dataTables.css')!!}
	{!!Html::style('https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css')!!}
	{!!Html::style('css/footer.css')!!}
	{!!Html::style('css/font-awesome.min.css')!!}

@stop

@section('contenido')
	<br>

	<div class="jumbotron text-center" style="margin: 0 1em; padding: 2em 0;">
		<div class="row">
        	<div class="container">
        		<h1><strong>Mis Solicitudes</strong></h1>      		
        	</div>
        </div>	
	</div>

	<div class="container-fluid">
		<table id="example" class="responstable">
			<thead>
				<tr>
					<th>Nombre solicitud</th>
					<th>Fecha solicitud (aaaa/mm/dd)</th>
					<th>Nombres estudiante</th>
					<th>Apellidos estudiante</th>
					<th>Cedula estudiante</th>
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
					<td>{{$solicitud->usu_apellidos}}</td>
					<td>{{$solicitud->usu_cedula}}</td>
					<td>{{$solicitud->sol_estado}}</td>

					<!--En parameters se escribe las variables que llevará el metodo GET. En atributes cosas como la clase css, id, etc. Entre corchetes por que es un array-->
					<td>
						{!! link_to('solicitudesPDF/' . $solicitud->sol_formato, $title = " Ver solicitud PDF", $attributes = ['class'=>'fa fa-file-pdf-o btn btn-outline-danger', 'target'=>'_blank'], $secure = null); !!}
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