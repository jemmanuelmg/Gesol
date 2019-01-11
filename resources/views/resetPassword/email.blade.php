@extends ('layouts.templateBasico')

@section('titulo') Gesol : Contraseñas @stop

@section('contenido')


	<!-- CONTENEDOR PARA CAMBIAR CONTRASEÑA -->
    <div class="container">

    		<div class="row">

    			<div class="col-md-12">

    				<br>
    				<br>
    				<br>
	    			<h3 class="subencabezado">Elegir método de recuperación</h3>
	    			<br>
		      		<p>Elige el método que te resulte mas cómodo para recuperar tu contraseña:</p>
		      		

	      		</div>

    		</div>

    		<div class="row">

    			<div class="col-md-6">

    				<div class="card h-100">
				      <a href="#"><img class="card-img-top" src="../images/email-reset.jpeg" alt="recuperar con correo electronico"></a>
				      <div class="card-body">

				        <h4 class="card-title texto-azul">Correo electrónico</h4>

				        <p class="card-text">Ingresa el correo electrónico con que te registraste y recibirás mas información en su bandeja de entrada</p>

				        <br>

					    <button class="btn btn-primary btn-small" id="btn-email" data-toggle="popover" data-trigger="focus" data-placement="right" data-content="Revisa abajo &#9759"><i class="fas fa-at"></i>&nbsp;&nbsp;Enviar a correo</button>

				      </div>
				    </div>

    			</div>

    			<div class="col-md-6">
    				
    				<div class="card h-100">
				      <a href="#"><img class="card-img-top" src="../images/phone-reset.jpg" alt="recuperar con correo electronico"></a>
				      <div class="card-body">

				        <h4 class="card-title texto-azul">Teléfono móvil</h4>

				        <p class="card-text">Recibe una contraseña provisional al teléfono que usaste para registrarte en gesol. Despues podrás cambiarla de nuevo.</p>

				        <br>

				        <button class="btn btn-primary btn-small" id="btn-tel" data-toggle="popover" data-trigger="focus" data-placement="right" data-content="Revisa abajo &#9759"><i class="fas fa-phone-square"></i>&nbsp;&nbsp;Enviar a tel. móvil</button>

				      </div>
				    </div>

    			</div>
    		</div>

	      	
    		<br>
    		<br>
    		<br>

	      	<div class="row" id="contenedor-email-reset">


	        	<div class="col-md-12">

	         		<h2>Con e-mail &nbsp;&nbsp;<i class="fas fa-at"></i></h2>

		          	<!--Aqui se usa url, no route.-->
					{!!Form::open(['url' => '/resetPassword/email', 'method'=>'POST'])!!}     	

			        <div class="form-group">
			          <label class="control-label" for="email">Correo Electrónico *</label>
			          <div class="input-group">
			            <input type="email" class="form-control" name="email" placeholder="Introduzca su correo electrónico" required/>
			          </div>
			        </div>

					<p style="color: #BBD035;">
						<b>En un momento te será enviado el correo de reestablecimiento. Revisa tu bandeja de entrada, y de ser necesario, tu carpeta de spam.</b>
					</p>

			        <input type="submit" value="Enviar correo" class="btn btn-primary btn-lg">

		          	{!!Form::close()!!}

		      	</div>

			</div>


			<div class="row" id="contenedor-phone-reset">


	        	<div class="col-md-12">

	         		<h2>Con teléfono &nbsp;&nbsp;<i class="fas fa-phone-square"></i></h2>

		          	<!--Aqui se usa url, no route.-->
					{!!Form::open(['url' => '/enviarPassword', 'method'=>'POST'])!!}     	

			        <div class="form-group">
			          <label class="control-label" for="email">Numero de teléfono *</label>
			          <div class="input-group">
			            <input type="number" class="form-control" name="telefono" placeholder="Introduzca su numero de teléfono" required/>
			          </div>
			        </div>

					<p style="color: #BBD035;">
						<b>En un momento te será enviada una contraseña provisional a tu teléfono vía SMS, para que la cambies despues de iniciar sesión con ella. <br> No añadas prefijos (no +57), solo tus 10 dígitos </b>
					</p>

			        <input type="submit" value="Enviar correo" class="btn btn-primary btn-lg">

		          	{!!Form::close()!!}

		      	</div>

			</div>

			<br>
			<br>
			<br>

		

	</div>
	<!-- FIN DEL CONTENEDOR PARA CAMBIAR CONTRASEÑA -->

@stop

@section('javascript')
	@parent

	<!--Nota, se usaron los unicode symbols en los tooltip. Buscar el articulo de w3schools sobre eso-->
	<script type="text/javascript">
		$(function(){
			$('[data-toggle="popover"]').popover()
		});
	</script>

	<script type="text/javascript" src="{{ URL::asset('js/reset-pw-opciones.js') }}"></script>
@stop