<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body style="font-family: 'Verdana'; font-size: 14px">

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

	        <center><center><img src="{{ $message->embed(public_path() . '/images/gesol_logo_new2.png') }}" /></center></center>
	        <p>
				Se ha guardado la nueva solicitud en el sistema Gesol. Desde ahora, su petición será revisada por su Institución Educativa y en unos dias se enviará la respuesta automáticamente a su bandeja de entrada. Ninguna otra acción es requerida.
			</p>
    	</div>
    	<!-- /.jumbotron -->


    	<center>
    	

		<p style="color: #FFFFFF;
  background-color: #0275d8;
  border-color: #0275d8;width:150px; height:50px; border-radius: 6px; padding-top: 20px">

		{!! link_to('solicitudesPDF/' . $sol_formato, $title = "Ver documento", $attributes = ['style'=>'color:#FFFFFF;  text-decoration: none'], $secure = null); !!}
		</p>

		</center>



    	<p style="color:gray;">
    		Atentamente, 
    		<i>-El equipo Gesol.</i>
    	</p>
    

      

    </div>
    <!-- FIN CONTENEDOR PARA CONFIRMAR SOLICITUD -->



</body>
</html>


