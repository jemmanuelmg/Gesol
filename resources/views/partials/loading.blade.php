<!--INICIO DIV DE CARGA-->	

	<div class="contenedor-error">
	    <p>
	        <i><span class="badge badge-danger" id="span-tel">info</span> Porfavor, rellena todos los campos para continuar</i>&nbsp;&nbsp;&nbsp;<i class="far fa-hand-point-up fa-1x"></i>
	    </p>
	</div>

    <div class="oscurecer"></div>
        
    <div class="div-loading">
        <i class="fas fa-spinner fa-5x fa-spin"></i>
        <p class="letra-pequena">&nbsp;&nbsp;Cargando...</p>
    </div>

@section('javascript')
    @parent
    <script type="text/javascript" src="{{ URL::asset('js/script-cargando.js') }}"></script>
@stop
