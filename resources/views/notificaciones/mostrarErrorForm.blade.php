	@if(count($errors) > 0)
		<br/>
		<br/>
		<br/>
		<div class='alert alert-danger alert-dismissible' role='alert'>
			<button type="button" class="close" data-dismiss='alert' aria-label="close"><span aria-hidden="true">&times;</span></button>

			<p>Porfavor, corrige <strong>los siguientes errores</strong></p>
			
			<!--ciclo para recorrer arreglo de errores-->
			<ul>
				@foreach($errors->all() as $error)
					<li>{!! $error !!}</li>
				@endforeach	
			</ul>

		</div>

	@endif

	