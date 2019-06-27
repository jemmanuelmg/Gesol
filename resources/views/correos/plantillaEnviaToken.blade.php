<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body style="font-family: 'Verdana'; font-size: 14px;">

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
      
      <center><img src="{{ $message->embed(public_path() . '/images/gesol_logo_new2.png') }}" /></center>
      <p>A continuación encontrarás tu código de confirmación para completar tu registro en la palataforma Gesol.</p>
      <p>Gracias por registrarte con nosotros!</p>
    </div>
  <!-- /.jumbotron -->



  <center>
    <div class="alert alert-primary" role="alert" style="padding: 2rem 1rem;
    margin-bottom: 2rem;
    background-color: #eceeef;
    border-radius: 0.3rem;background-color: #d9edf7;
    border-color: #bcdff1;
    color: #31708f; width: 280px;">
    Tu código de confirmación es: <h2><b>{{$token}}</b></h2>
  </div>
  </center>

  <p class="texto-gris" style="color:gray;">
    Si no has solicitado este servicio por favor ignora este mensaje. Ninguna otra acción es necesaria.
    <br>
    <i>-El equipo Gesol.</i>
  </p>

</div>
<!-- FIN CONTENEDOR PARA CONFIRMAR SOLICITUD -->



</body>
</html>




