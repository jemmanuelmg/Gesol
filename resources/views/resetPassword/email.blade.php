@extends ('layouts.templateBasico')

@section('titulo') Gesol : Contraseñas @stop

@section('contenido')

	<!-- CONTENEDOR PARA CAMBIAR CONTRASEÑA -->
    <div class="container">

    	<div class="jumbotron">

	      	<div class="row">

	        	<div class="col-md-12">

	         		<h2><strong>Restablecer contraseña</strong></h2>

	         		<br>

		          	<!--Aqui se usa url, no route.-->
					{!!Form::open(['url' => '/resetPassword/email', 'method'=>'POST'])!!}     	

			        <div class="form-group">
			          <label class="control-label" for="email">Correo Electrónico *</label>
			          <div class="input-group">
			            <input type="email" class="form-control" name="email" placeholder="Introduzca su correo electrónico" />
			          </div>
			        </div>

			        <br>

					<p style="color: #BBD035;">
						En un momento te será enviado el correo de reestablecimiento. Revisa tu bandeja de entrada, y de ser necesario, tu carpeta de spam.
					</p>

					<br>

			        <input type="submit" value="Enviar correo" class="btn btn-primary btn-lg">

		          	{!!Form::close()!!}

		      	</div><!--/span-->

			</div><!--/row-->

		</div>

	</div>
	<!-- FIN DEL CONTENEDOR PARA CAMBIAR CONTRASEÑA -->

@stop