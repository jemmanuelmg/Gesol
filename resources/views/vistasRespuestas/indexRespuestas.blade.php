@extends(session('rol_id') == 3 ? 'layouts.templateDashboard' : 'layouts.templateBasico');

<!--Adicionar estilos css necesrios para tabla, por eso se menciona la seccion estilos y @parent para sobreescribir-->
@section('estilos')
	@parent
	
	{!!Html::style('js/DataTables/media/css/jquery.dataTables.css')!!}

@stop

@section('contenido')
	<br>

	<div class="jumbotron text-center" style="margin: 0 1em; padding: 2em 0;">
		<div class="row">
        	<div class="container">
        		<h1><strong>Administrar Respuestas</strong></h1>      		
        	</div>
        </div>	
	</div>

	<br>
	<br>

	<div class="container-fluid">
	<table id="example" class="responstable">
		<thead>
			@if(session('rol_id') == 3)
			<tr class="tr-admin">
			@else
			<tr>
			@endif	
				<th>Nombre solicitud respondida</th>
				<th>Fecha de respuesta</th>
				<th>Nombre administrativo</th>
				<th>Apellidos administrativo</th>
				<th>Rol</th>
				<th>Cedula administrativo</th>
				<th>Opciones</th>
			</tr>
		</thead>
		<tbody>

			@foreach($listaResp as $respuesta)
			<tr>
				<td>{{$respuesta->sol_nombre}}</td>
				<td>{{$respuesta->res_fechaRespuesta}}</td>
				<td>{{$respuesta->usu_nombres}}</td>
				<td>{{$respuesta->usu_apellidos}}</td>
				<td style="width:12%">{{$respuesta->rol_nombre}}</td>
				<td>{{$respuesta->usu_cedula}}</td>

				<!--En parameters se escribe las variables que llevará el metodo GET. En atributes cosas como la clase css, id, etc. Entre corchetes por que es un array-->
				<td style="text-align: center;">
					<!-- <a href="{{'solicitudesPDF/' . $respuesta->res_formato}}" class="btn btn-danger" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"> Ver respuesta PDF</i></a> -->

					{!! link_to('solicitudesPDF/'.$respuesta->res_formato, $title = '', $attributes = ['class'=>'fas fa-file-pdf btn btn-outline-danger','target'=>'_blank']); !!}

					{!! link_to_route('respuestas.edit', $title = '', $parameters = $respuesta->res_id, $attributes = ['class'=>'far fa-edit btn btn-outline-primary']); !!}
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