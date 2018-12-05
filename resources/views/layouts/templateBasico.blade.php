<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@section('titulo') Gesol - Inicio @show   </title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <link rel="shortcut icon" href="{{ asset('images/favicon-32x32.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/favicon-32x32.ico') }}" type="image/x-icon">

    @section('estilos')

      {!!Html::style('css/footer.css')!!}
      {!!Html::style('css/font-awesome.min.css')!!}

    @show   

</head>

<body>

    <!-- CONTENEDOR NAVBAR -->
    
    <div id="app">

      <nav class="navbar navbar-expand-lg navbar-dark navbar-fixed-top" style="background-color: #BBD035;">

        <div class="container">
          <!-- LOGO -->
          <a class="navbar-brand" href="/"><img src={{asset('images/gesol_logo_new2.png')}} alt="Logo" height="80px"></a>
          <!-- FIN LOGO-->

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div id="navbarNavDropdown" class="navbar-collapse collapse">

            <ul class="navbar-nav mr-auto">
            </ul>

            <ul class="navbar-nav">

              <!-- SI ESTA LOGUEADO -->
              @if(session()->has('sesionIniciada'))
              
              <!-- CUANDO EL USUARIO ES ADMINISTRADOR -->
              @if(session('rol_id') == 3)

              <!-- VER METRICAS -->
              <li class="nav-item">
                {!! link_to('/metricas', $title = 'Ver metricas', $attributes = ['class'=>'nav-link btn btn-link']); !!}
              </li>

              <!-- MENU DESPLEGABLE DE ADMINISTRAR -->
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Administrar
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">{!! link_to_route('usuarios.index', $title = 'Administrar usuarios', $parameters = '', $attributes = ['class'=>'dropdown-item']); !!}</a>

                  <a class="dropdown-item" href="#">{!! link_to_route('solicitudes.index', $title = 'Responder solicitudes', $parameters = '', $attributes = ['class'=>'dropdown-item']); !!}</a>

                  <a class="dropdown-item" href="#">{!! link_to_route('respuestas.index', $title = 'Ver respuestas', $parameters = '', $attributes = ['class'=>'dropdown-item']); !!}</a>
                </div>
              </div>

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
                  <img src="/images/icono-perfil.png" class="ImagenPerfil" height="20px" width="20px">
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    {{ " " .session('usu_nombres') . " " . session('usu_apellidos')}}
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

    </div>
    <!-- FIN DEL CONTENEDOR NAVBAR -->

    <!--Incluir trozo de codigo para informar exito o error-->
    @include('notificaciones.mostrarMensajes')
    @include('notificaciones.mostrarErrorForm')

    @section('contenido')
      <!--Aquí va el contenido en general de todas las paginas hijas-->
    @show

    <!-- FOOTER -->
    <footer class="footer">

      <br>
      <br>

      <div class="brand">

        <div class="container">

        </div>

      </div>

    </footer>
    <!-- FIN FOOTER -->

    @section('javascript')

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    @show
      
</body>
</html>