@if(Session::has('mensaje-exito'))
<div class='alert alert-success  alert-dismissible' role='alert'>
	<br/>
	<br/>
	<br/>
	<button type="button" class="close" data-dismiss='alert' aria-label="close"><span aria-hidden="true">&times;</span></button>
	<strong><h3>Correcto:</h3></strong>
	{!!Session::get('mensaje-exito')!!}

</div>
@endif

@if(Session::has('mensaje-error'))
<div class='alert alert-danger  alert-dismissible' role='alert'>
	<br/>
	<br/>
	<br/>
	<button type="button" class="close" data-dismiss='alert' aria-label="close"><span aria-hidden="true">&times;</span></button>
	<strong><h3>Atención:</h3></strong>
	{!!Session::get('mensaje-error')!!}

</div>
@endif

@if(Session::has('mensaje-advertencia'))
<div class='alert alert-info  alert-dismissible' role='alert'>
	<br/>
	<br/>
	<br/>
	<button type="button" class="close" data-dismiss='alert' aria-label="close"><span aria-hidden="true">&times;</span></button>
	<strong><h3>Atención:</h3></strong>
	{!!Session::get('mensaje-advertencia')!!}

</div>
@endif