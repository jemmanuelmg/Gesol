<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body style="font-family: 'Century Gothic'; font-size: 14px;">

	<!-- CONTENEDOR PARA CONFIRMAR SOLICITUD -->
    <div class="container" style="position: relative;
  margin-left: auto;
  margin-right: auto;
  padding-right: 160px;
  padding-left: 160px;border-color:#D3D3D3;
  border-style: solid;
  border-radius:6px;
  padding: 10px; 
  border-width: 1px;">

  

    	<div class="jumbotron" style="
    	padding: 2rem 1rem;
		margin-bottom: 2rem;
		background-color: #eceeef;
		border-radius: 0.3rem;">

	        <center><h1 style="font-size: 25px;">Gesol: Solicitud guardada con exito</h1></center>
	        <p>
				Se ha guardado la nueva solicitud en el sistema Gesol. Desde ahora, su petición será revisada por la coordinación y en unos dias se enviará la respuesta automáticamente a su bandeja de entrada. Ninguna otra acción es requerida.
			</p>
    	</div>
    	<!-- /.jumbotron -->


    	<center>
    	

		<p class="lead" style="color: #fff;
  background-color: #0275d8;
  border-color: #0275d8;width:150px; height:50px; border-radius: 6px;">
		{!! link_to('solicitudesPDF/' . $sol_formato, $title = "Ver documento", $attributes = ['class'=>'btn btn-primary btn-lg'], $secure = null); !!}
		</p>

		</center>



    	<p class="texto-gris" style="color:gray;">
    		Atentamente, 
    		<i>-El equipo Gesol.</i>
    	</p>
    

      

    </div>
    <!-- FIN CONTENEDOR PARA CONFIRMAR SOLICITUD -->



</body>
</html>
















<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body>

	<!-- CONTENEDOR PARA CONFIRMAR SOLICITUD -->
    <div class="container">

    	<div class="jumbotron">
	        <h1 class="display-4"></h1>
	        <hr/>
	        <p class="lead">
	        	
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

	

