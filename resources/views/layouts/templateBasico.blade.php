<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<meta name="mobile-web-app-capable" content="yes">-->
  
  <title>@section('titulo') Gesol - Inicio @show   </title>

  <!--MANIFEST-->
  <link rel="manifest" href="{{ asset('manifest.json') }}" />

  <!--CSS: BOOTSTRAP, ESTILOS Y FONTAWESOME-->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('css/styles-main-gesol.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('fonts/fontawesome/css/all.css') }}" />

  <!--FAVICON-->
  <link rel="shortcut icon" href="{{ asset('images/favicon-32x32.ico') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('images/favicon-32x32.ico') }}" type="image/x-icon">


  @section('estilos')
    <!--Estilos adicionales aquí-->
  @show   

</head>

<body>

  <!-- CONTENEDOR NAVBAR -->

  <div id="master-navbar-container">
  <div id="app">

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color: #BBD035;">

      <div class="container">        
        <!-- LOGO -->
        <a class="navbar-brand" href="/"><img src="{{asset('images/gesol_logo_new2.png')}}" alt="Logo" height="55px"></a>
        <!-- FIN LOGO-->

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navbarNavDropdown" class="navbar-collapse collapse">

          <ul class="navbar-nav mr-auto">
          </ul>

          <ul class="navbar-nav custom-center">

            <!-- SI ESTA LOGUEADO -->
            @if(session()->has('sesionIniciada'))

            <!-- CUANDO EL USUARIO ES ADMINISTRADOR -->
            @if(session('rol_id') == 3)

              <li class="nav-item">
                <a href="/indexDashboard" class="nav-link btn btn-link" id="puerta-dashboard">Panel de Admin. &nbsp; <i class="fas fa-book-reader"></i></a>
              </li>

            @endif
            <!-- FIN USUARIO ES ADMINISTRADOR -->

              <!-- CUANDO EL USUARIO ES SECRETARIO, decano o docente 
                las secretarias, decanos y docentes solo pueden responder solicitudes.
                en el metodo dentro del controlador se escoje que listado mostrar a cada uno.-->
                @if(session('rol_id') == 2 || session('rol_id') == 4 || session('rol_id') == 5)

                <!-- MENU DESPLEGABLE DE RESPONDER SOLICITUDES -->
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Responder solicitudes
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">{!! link_to_route('solicitudes.index', $title = 'Ver las solicitudes', $parameters = 'todas', $attributes = ['class'=>'dropdown-item']); !!}</a>
                  </div>
                </div>
                <!-- FIN MENU DESPLEGABLE DE RESPONDER SOLICITUDES -->

                @endif
                <!-- FIN USUARIO ES SECRETARIO -->

                <!-- CUANDO EL USUARIO ES ESTUDIANTE -->
                @if(session('rol_id') == 1)

                <!-- MENU DESPLEGABLE DE REDACTAR SOLICITUDES -->
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Redactar solicitudes
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">{!! link_to('redactarSolicitud', $title = 'Nueva solicitud', $attributes = ['class'=>'dropdown-item']); !!}</a>

                    <a href="solicitudes/misSolicitudes/{{session('usu_cedula')}}" class="dropdown-item">Ver mis solicitudes</a>
                  </div>
                </div>
                <!-- FIN MENU DESPLEGABLE DE REDACTAR SOLICITUDES -->

                <!-- MANUAL -->
                <li class="nav-item">
                  <a href="/ayuda" class="nav-link btn btn-link">Manual</a>
                </li>

                <!-- CONTACTO -->
                <li class="nav-item">
                  <a href="/contacto/create" class="nav-link btn btn-link">Contacto</a>
                </li>

                @endif

              <!-- MENU DESPLEGABLE DE PERFIL, siempre se muestra si esta loggeado
                ; no importa que rol tenga el usuario -->
                <div class="dropdown">

                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    @if(session()->has('usu_foto'))
                    <img src="{{ asset('images/fotos_usuarios/' . Session::get('usu_foto')) }}" class="avatar-nav">
                    @else
                    <img src="/images/icono-perfil.png" class="ImagenPerfil" height="20px" width="20px">
                    @endif

                  </button>


                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">
                      <i class="fa fa-user" aria-hidden="true"></i>
                      {{ " " .session('usu_nombres')}}
                      <br>
                      {{" " . session('usu_apellidos')}}
                    </a>

                    <a class="dropdown-item" href="#">
                      <i class="fa fa-key" aria-hidden="true"></i>
                      {{ "Rol:". " " .session('rol_nombre')}}
                    </a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="#">

                      <a href="/usuarios/{{ session('usu_cedula') }}/edit" class="dropdown-item">
                        <i class="fa fa-pencil" aria-hidden="true"></i> Editar perfil
                      </a>

                    </a>

                    <a class="dropdown-item" href="#">
                      <a href="/logout" class="dropdown-item">
                        <i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar sesión
                      </a>
                    </a>
                  </div>
                </div>    

                <!-- FIN USUARIO ES ESTUDIANTE -->

                <!-- SI NO ESTA LOGUEADO -->
                @else

                <!-- CONTACTO -->
                <li class="nav-item">
                  <a href="/contacto/create" class="nav-link btn btn-link">Contacto</a>
                </li>

                <!-- MANUAL -->
                <li class="nav-item">
                  <a href="/ayuda" class="nav-link btn btn-link">Manual</a>
                </li>

                <!-- REGISTRARSE -->
                <li class="nav-item">
                  <a href="/usuarios/create" class="nav-link btn btn-link">Registrarse</a>
                </li>

                <!-- INICIAR SESION -->
                <li class="nav-item">
                  {!! link_to('/iniciarSesion', $title = 'Ingresar a GESOL', $attributes = ['class'=>'nav-link btn btn-link']); !!}
                </li>

                @endif
                <!-- FIN DE ESTA LOGUEADO -->

              </ul>

            </div>
          </div>   
        </nav>
      </nav>

    </div>
  </div>
    <!-- FIN DEL CONTENEDOR NAVBAR -->

    <!--Incluir trozo de codigo para informar exito o error-->
    @include('notificaciones.mostrarMensajes')
    @include('notificaciones.mostrarErrorForm')

    @section('contenido')
    <!--Aquí va el contenido en general de todas las paginas hijas-->
    @show


    

    <!--FOOTER-->
    
    <div class="footer">
      <div class="row">
        
        <div class="col-md-3 col-lg-3 alinear-izquierda col-footer">

          <center>

          <img src="{{asset('images/gesol_logo_new2.png')}}" width="110px">

          
          <div class="redes">
              <div class="email"><a href="/contacto/create"></a></div>
              <div class="facebook"><a href="#"></a></div>
              <div class="twitter"><a href="#"></a></div>
          </div>
          

          </center>
          
        </div>

        <div class="col-md-3 col-lg-3 alinear-izquierda col-footer">
            <center>
            <p>  
            Gesol 2019 ® 
            Todos los derechos reservados <br><br>

            Avenida No. 45A #56-89, Medellín - Antioquia.
            </center>
            </p>


        </div>        

        <div class="col-md-3 col-lg-3 alinear-izquierda col-footer">
            <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex evaborum.

            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis <br> <br>

            nostrud exercitation ullamco laboris nisi ut aliquip ex evaborum.
            tempor incidi quis nostrud exercitation ullamco laboris nisi ut aliquip ex evaborum.
            tempor incidi 
            </p>
            

        </div>

        <div class="col-md-3 col-lg-3 alinear-izquierda col-footer">

            <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqt in voluptatet laborum.

            <br> <br>

            magna aliqt in voluptatet laborum. magna aliqt in voluptatet laborum.

            <button id="butInstall" aria-label="Install" hidden></button>
            </p>

        </div>
      </div>
    </div>
    
    <!--./FOOTER-->

    @section('javascript')

      <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

      <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>

      <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>

      <script type="text/javascript" src="{{ asset('js/esconder-navbar.js') }}"></script>

      <script type="text/javascript" src="{{ asset('pwa-assets.js') }}"></script>
      <script type="text/javascript" src="{{ asset('install.js') }}"></script>

    @show

  </body>
  </html>