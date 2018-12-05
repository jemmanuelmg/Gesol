<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body>

	<!-- CONTENEDOR PARA CONFIRMAR SOLICITUD -->
    <div class="container">

    	<div class="jumbotron">
	        <h1 class="display-4">Gesol: Solicitud guardada con exito</h1>
	        <hr/>
	        <p class="lead">
	        	Se ha guardado la nueva solicitud en el sistema Gesol. Desde ahora, su petición será revisada por la coordinación y en unos dias se enviará la respuesta automáticamente a su bandeja de entrada. Ninguna otra acción es requerida.
			</p>

			<hr class="my-2">

			<p>
				El formato generado con los datos que ingresaste se encuentra disponible en el siguiente link.
				<br>
			    Atentamente: el equipo Gesol.
		    </p>

			<p class="lead">
			   {!! link_to('solicitudesPDF/' . $sol_formato, $title = "link al recurso", $attributes = ['class'=>'btn btn-primary btn-lg'], $secure = null); !!}
			</p>

    	</div>
      <!-- /.jumbotron -->

    </div>
    <!-- FIN CONTENEDOR PARA CONFIRMAR SOLICITUD -->



</body>
</html>

	

