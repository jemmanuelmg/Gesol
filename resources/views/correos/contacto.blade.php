@extends ('layouts.templateBasico')

@section('titulo') Gesol : Contacto @stop

@section('contenido')	

	<!-- CONTENEDOR PARA CONTACTO -->
    <div class="container">

    	<div class="jumbotron">

	      	<div id="contact_form" class="row">

	        	<div class="col-md-12">
	        		
          			<h2 class="display-4"><center><strong>Contáctenos&nbsp;&nbsp;&nbsp;<i class="far fa-comments fa-2x" aria-hidden="true"></i></strong></center></h2>

	        		{!!Form::open(['route' => 'contacto.store', 'method'=>'POST'])!!}          

		            <div class="form-group">
		              <label class="control-label" for="nombre">Nombres *</label>
		              	<div class="input-group">
		                	<input type="text" class="form-control" name="nombre" placeholder="Introduzca su nombre" />
		            	</div>             	
		            </div>

		            <div class="form-group">
		              <label class="control-label" for="correo">Correo Electrónico *</label>
		              <div class="input-group">
		                <input type="email" class="form-control" name="correo" placeholder="Introduzca su correo electrónico" />
		              </div>
		            </div>
		            
		            <div class="form-group">
		              <label class="control-label" for="asunto">Asunto *</label>
		              <div class="input-group">
		                <input type="text" class="form-control" name="asunto" placeholder="Introduzca su asunto" />
		              </div>
		            </div>

		            <div class="form-group">
		              <label class="control-label" for="mensaje">Mensaje *</label>
		              	<div class="input-group">
		              		<textarea name="mensaje" rows="8" cols="50" class="form-control" placeholder="Introduzca su mensaje"></textarea>
		            	</div>
		            </div>
		   			
		   			<input type="submit" value="Comunicarme" class="btn btn-primary btn-lg">

		          	{!!Form::close()!!}

        		</div><!--/span-->

      		</div><!--/row-->

		</div>

	</div>
    <!-- FIN DEL CONTENEDOR PARA CONTACTO -->

@stop