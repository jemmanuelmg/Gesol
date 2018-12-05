@extends ('layouts.templateBasico')



	@section('estilos')

      {!!Html::style('css/footer.css')!!}

      {!!Html::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css')!!}

  @show

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->




  @section('contenido')

  <!-- CONTENEDOR PRUEBA-->
  <div class="container">
    <div class="jumbotron">
      <div class="row">
        <div class="col-sm-12" >
            <center>
              <img src={{asset('images/gesol_logo_new2.png')}} alt="Logo" height="80px">
            </center>
          <br><br>           
        </div>
      </div>


      <!--<form class="form-horizontal" role="form" method="POST" action="/login"> -->
      {!!Form::open(['route' => 'login.store', 'method'=>'POST'])!!}
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h2>Ingresa a GESOL&nbsp;&nbsp;&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i>
</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-group has-danger">
                    <label class="sr-only" for="correo">Correo Electronico</label>
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                        <input type="text" name="correo" class="form-control" id="correo"
                               placeholder="Ingrese su correo" required autofocus>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="sr-only" for="password">Contraseña</label>
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                        <input type="password" name="password" class="form-control" id="password"
                               placeholder="Ingrese su contraseña" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="padding-top: 1rem">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <button type="submit" class="btn" style="background-color: #BBD035; color: #FFF;"><i class="fa fa-sign-in"></i> Ingresar</button>
                <a href="resetPassword/reset" class="btn-link mx-2" style="color: #BBD035;">¿Ha olvidado la contraseña?</a>
            </div>
        </div>
      <!-- </form> -->
      {!!Form::close()!!}
    </div>
  </div>

  @stop
	<!-- FIN CONTENEDOR -->

	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	 @section('javascript')
      
    @show