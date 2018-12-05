@extends('layouts.templateBasico')

<!--Adicionar estilos css necesrios para tabla, por eso se menciona la seccion estilos y @parent para sobreescribir-->
@section('estilos')
	@parent
	{!! Charts::assets() !!}
	{!!Html::style('css/footer.css')!!}

@stop

@section('contenido')

	<!-- CONTENEDOR PARA CAMBIAR CONTRASEÑA -->
    <div class="container">

    	<div class="jumbotron">

	      	<div class="row">

	        	<div class="col-md-12">

	         		<h2><strong>{!! $chart1->render() !!}</strong></h2>

	         		<br>

	         		<h2><strong>{!! $chart2->render() !!}</strong></h2>

	         		<br>

	         		<h2><strong>{!! $chart3->render() !!}</strong></h2>

		          	

		      	</div><!--/span-->

			</div><!--/row-->

		</div>

	</div>
	<!-- FIN DEL CONTENEDOR PARA CAMBIAR CONTRASEÑA -->

@stop
