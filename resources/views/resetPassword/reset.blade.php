@extends ('layouts.templateBasico')

@section('titulo') Gesol : Contraseñas @stop

@section('contenido')

	<!-- CONTENEDOR PARA CAMBIAR CONTRASEÑA -->
    <div class="container">

    	<div class="jumbotron">

	      	<div class="row">

	        	<div class="col-md-12">

	         		<h2><strong>Restablecer contraseña</strong></h2>

		          	<!--Aqui se usa url, no route.-->
					{!!Form::open(['url' => '/resetPassword/reset', 'method'=>'POST'])!!}     

		          	<div class="form-group">
			          	<div class="input-group">
			          		<input type="hidden" name="token" value="{{ $token }}">
			        	</div>             	
			        </div>

			        <div class="form-group">
			          <label class="control-label" for="email">Correo Electrónico *</label>
			          <div class="input-group">
			            <input type="email" value="{{old('email')}}" class="form-control" name="email" placeholder="Introduzca su correo electrónico" />
			          </div>
			        </div>
			        
			        <div class="form-group">
			          <label class="control-label" for="password">Nueva contraseña *</label>
			          <div class="input-group">
			            <input type="password" class="form-control" name="password" placeholder="Introduzca su contraseña" />
			          </div>
			        </div>

			        <div class="form-group">
			          <label class="control-label" for="password_confirmation">Repetir nuevamente la contraseña *</label>
			          	<div class="input-group">
			          		<input type="password" class="form-control" name="password_confirmation" placeholder="Introduzca de nuevo la contraseña" />
			        	</div>
			        </div>

					<br>

			        <input type="submit" value="Cambiar contraseña" class="btn btn-primary btn-lg">

		          	{!!Form::close()!!}

		      	</div><!--/span-->

			</div><!--/row-->

		</div>

	</div>
	<!-- FIN DEL CONTENEDOR PARA CAMBIAR CONTRASEÑA -->

@stop