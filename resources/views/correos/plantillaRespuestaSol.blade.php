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

	        <center><center><img src="{{ $message->embed(public_path() . '/images/gesol_logo_new2.png') }}" /></center></center>
	        <p>
				Su solicitud {{ $sol_nombre }} formulada en fecha {{ $sol_fechaCreacion }} ha sido respondida:
				A continuación, se muestra un resumen de la respuesta.
				
			</p>
    	</div>
    	<!-- /.jumbotron -->

    	<p>
				<ul>
					<li><b>Nombre del formato:</b> {{ $sol_nombre }}</li>
					<li><b>Fecha de solicitud:</b> {{ $sol_fechaCreacion }}</li>
					<li><b>Nombre funcionario que responde:</b> {{ $nombreFunc }} {{ $apellidoFunc }}</li>
					<li><b>Cargo de funcionario:</b> {{ $rolFunc }}</li>
				</ul>
				Para ver la respuesta haga clic en el siguiente botón:
		</p>


    	<center>
    	

		<p style="color: #FFFFFF;
  background-color: #0275d8;
  border-color: #0275d8;width:150px; height:50px; border-radius: 6px; padding-top: 20px">

		{!! link_to('solicitudesPDF/' . $sol_formato, $title = "Ver documento", $attributes = ['style'=>'color:#FFFFFF;  text-decoration: none'], $secure = null); !!}
		</p>

		</center>



    	<p class="texto-gris" style="color:gray;">
    		<strong>Tenga en cuenta</strong> que si la solicitud requiere a diferentes actores para responderse puede recibir varios correos de respuesta sobre esta misma solicitud.
			Atentamente, 
    		<i>-El equipo Gesol.</i>
    	</p>
    

      

    </div>
    <!-- FIN CONTENEDOR PARA CONFIRMAR SOLICITUD -->



</body>
</html>