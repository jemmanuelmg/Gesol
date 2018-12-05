<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body>

	<!-- CONTENEDOR PARA RESPUESTA SOLICITUD -->
    <div class="container">
		<div class="jumbotron">
			<h2 class="display-3">Respuesta a su solicitud</h2>

			<p class="lead">
				Su solicitud {{ $sol_nombre }} formulada en fecha {{ $sol_fechaCreacion }} ha sido respondida:
				<br>
				A continuación, se muestra un resumen de la respuesta.
				<br>
				<strong>Por favor, de clic en el link 'Ver formato resuelto' para acceder a el formato PDF completo.</strong>
			</p>

			<hr class="my-2">

			<p>
				<ul>
					<li><b>Nombre del formato:</b> {{ $sol_nombre }}</li>
					<li><b>Fecha de solicitud:</b> {{ $sol_fechaCreacion }}</li>
					<li><b>Nombre funcionario que responde:</b> {{ $nombreFunc }} {{ $apellidoFunc }}</li>
					<li><b>Cargo de funcionario:</b> {{ $rolFunc }}</li>
				</ul>
			</p>

			<p class="lead">
			{!! link_to('solicitudesPDF/' . $sol_formato, $title = "Ver formato resuelto", $attributes = ['class'=>'btn btn-primary btn-lg'], $secure = null); !!}
			</p>

			<br>
			<p><strong>Tenga en cuenta</strong> que si la solicitud requiere a diferentes actores para responderse (decano, docente o coordinador) puede recibir varios correos de respuesta sobre esta misma solicitud.</p>
			<br>
			Atentamente: el equipo Gesol.
		</div>
	</div>
	

</body>
</html>