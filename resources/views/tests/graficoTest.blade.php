@extends ('layouts.templateBasico')

@section('estilos')
	@parent
	{!! Charts::assets() !!}

@stop


@section('contenido')
	
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<h2><strong>{!! $chart1->render() !!}</strong></h2>

@stop