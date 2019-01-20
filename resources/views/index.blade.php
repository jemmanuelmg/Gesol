@extends ('layouts.templateBasico')

@section('titulo') Gesol @stop

@section('estilos')

  <script type="text/javascript" src="{{ URL::asset('js/script-chatbot.js') }}"></script>

@show 

@section('contenido')

@include('notificaciones.mostrarErrorForm')

<header>
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>


    
    <div class="carousel-inner" role="listbox">
      <!-- Slide One - Set the background image for this slide in the line below -->

      <div class="carousel-item active" style="background-image: url('../images/slider-gesol-1.jpeg')">
        <div class="carousel-caption d-none d-md-block">
          <h3 class="titulo-carrusel"><b>Bienvenido a gesol!</b></h3>
          <p>El gestor de solicitudes ideal para Instituciones Educativas</p>
        </div>
      </div>
      <!-- Slide Two - Set the background image for this slide in the line below -->
      <div class="carousel-item" style="background-image: url('../images/slider-gesol-2.jpg')">
        <div class="carousel-caption d-none d-md-block">
          <h3 class="titulo-carrusel"><b>Entrega tus papeles desde tu casa!</b></h3>
          <p>...y espera tu respuesta en tu bandeja de entrada. Así de simple.</p>
        </div>
      </div>
      <!-- Slide Three - Set the background image for this slide in the line below -->
      <div class="carousel-item" style="background-image: url('../images/slider-gesol-3.jpeg')">
        <div class="carousel-caption d-none d-md-block">
          <h3 class="titulo-carrusel"><b>Disfrutalo en tu movil.</b></h3>
          <p>Haz solicitudes desde la palma de tu mano.</p>
        </div>
      </div>

      <div class="carousel-item" style="background-image: url('../images/slider-gesol-4.jpg')">
        <div class="carousel-caption d-none d-md-block">
          <h3 class="titulo-carrusel"><b>Para tu comunidad</b></h3>
          <p>Disfruta de la comodidad que te brindan las TIC.</p>
        </div>
      </div>
    </div>
    

    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>

    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>

  </div>
</header>

<!-- Page Content -->
<div class="container">

  <center>
    <img src={{asset('images/gesol_logo_new2.png')}} alt="Logo" height="80px">
  </center>

  <h1 class="my-4">Bienvenido</h1>

  <!-- Features Section -->
  <div class="row">
    <div class="col-lg-6">
      <h2>Caracteristicas</h2>
      <p>Gesol es una plataforma innovadora para la comunidad, la cual permite gestionar de manera mas eficiente y rápida casi cualquiet trámite que requieran los estudiantes.</p>

      <ul>

        <li>
          <i class="fas fa-bolt fa-2x" aria-hidden="true"></i>  &nbsp;&nbsp;&nbsp;&nbsp;  No mas filas!: </strong> Con Gesol puedes diligenciar cualquier solicitud académica (cambio de jornada, revision de notas, tranferencia interna, etc.) <strong>desde la comodida de tu casa!,</strong> Todo se enviará automáticamente a tu bandeja de entrada ;).
        </li>

        <li>
          <i class="fab fa-envira fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;  100% ecológico: Gracias a Gesol logramos reducir el uso de tinta y papel a 0.
        </li>

        <li>
          <i class="fas fa-cloud-download-alt fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp; Todo estará alojado en la nube: tus solicitudes y respuestas se guardarán aquí, para que las veas cuando quieras.
        </li>

        <li>
          <i class="fas fa-id-card-alt fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp; Tus datos personales están a salvo gracias a mecanismos de potección virtual de alta tecnología.
        </li>

        <li>
          <i class="fas fa-comments fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp; Servicios de ayuda, chats, manuales, recuperación de contraseña y muchas cosas mas a tu disposición: ¡Que esperas!
        </li>

      </ul>

      <p>
        Pensado en tu comodidad y bienestar hemos desarrollado esta aplicación. Nuestro mayor logro es que cada vez mas estudiantes disfruten de estos beneficios. Únete ahora mismo a esta comunidad y disfruta de todo lo que ofrece!. Desarrollado <strong>para ayudar a estudiantes.</strong>
      </p>

    </div>

    <div class="col-lg-6">
      <img class="img-fluid rounded" src="../images/gesol-inicio-comunidad.jpeg" alt="">
    </div>
  </div>
  <!-- /.row -->
  
  <!-- Portfolio Section -->
  <br>
  <br>
  <h2>Haz una solicitud en 3 sencillos pasos</h2>

  <div class="row">
      <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="../images/gesol-inicio-unirse.jpeg" alt="Gesol UTS unirse a gesol"></a>
        <div class="card-body">
          <h4 class="card-title">
          </h4>
          <p class="">Registrate en nuestro sistema con tus datos personales</p>
        </div>
      </div>
    </div>



    <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="../images/gesol-inicio-solicitar.jpeg" alt="Gesol UTS hacer una solicitud academica"></a>
        <div class="card-body">
          <h4 class="card-title">
          </h4>
          <p class="">Realiza una solicitud completando los campos requeridos</p>
        </div>
      </div>
    </div>


    <div class="col-lg-4 col-sm-6 portfolio-item">
      <div class="card h-100">
        <a href="#"><img class="card-img-top" src="../images/felices.jpeg" alt="Gesol UTS comodidad tramite virtual"></a>
        <div class="card-body">
          <h4 class="card-title">
          </h4>
          <p class="">Espera por una respuesta enviada a tu correo electrónico, <strong> sin filas, sin desplazarse, sin problemas!</strong></p>
        </div>
      </div>
    </div>

  </div>
<!-- /.row -->

  <hr>

  <!-- Call to Action Section -->
  <div class="row mb-4">
    <div class="col-md-8">
      <p>Para empezar tu experiencia usando GESOL, porfavor registrate dando clic en el siguiente boton. Es la manera mas eficiente de solicitudar cualquier servicio. ¡No te quedes atras!</p>

    </div>
    <div class="col-md-4">
      <a class="btn btn-primary btn-lg" href="/usuarios/create">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Registrarse&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-thumbs-up fa-2x" aria-hidden="true"></i></a>
    </div>
  </div>

  <br>
  <br>
  <br>
  <h2>Nuestros clientes</h2>
  <br>


</div>
<!-- /.container -->

  <div class="parallax">
    <br>
    <br>
    <br>
    <div class="customer-logos">
      <div class="slide"><img src="https://www.solodev.com/assets/carousel/image1.png"></div>
      <div class="slide"><img src="https://www.solodev.com/assets/carousel/image2.png"></div>
      <div class="slide"><img src="https://www.solodev.com/assets/carousel/image3.png"></div>
      <div class="slide"><img src="https://www.solodev.com/assets/carousel/image4.png"></div>
      <div class="slide"><img src="https://www.solodev.com/assets/carousel/image5.png"></div>
      <div class="slide"><img src="https://www.solodev.com/assets/carousel/image6.png"></div>
      <div class="slide"><img src="https://www.solodev.com/assets/carousel/image7.png"></div>
      <div class="slide"><img src="https://www.solodev.com/assets/carousel/image8.png"></div>
    </div>
  </div>

@stop

@section('javascript')
  @parent
  
  <script type="text/javascript" src="{{ URL::asset('js/slick.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/brand-carousell.js') }}"></script>

@stop