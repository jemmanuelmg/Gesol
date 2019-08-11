@extends ('layouts.templateBasico')

@section('titulo') Gesol : Aplicacion Movil @stop

@section('estilos')
<link rel="stylesheet" href="{{ asset('css/sb-admin-2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/styles-main-gesol.css') }}" />
@stop

@section('contenido')	

<!-- CONTENEDOR PARA CONTACTO -->
<div class="container">

		<!--COMIENZA ROW 1 encabezado-->
		<div class="row" class="force-black-font-color">

			<div class="col-md-12">

				
				<br>

				<div class="card shadow mb-4">
    			<div class="card-body">

    			<h3 style="color: black">
					<center>
						
							Descarga nuestra aplicacion móvil &nbsp;&nbsp; <i class="fas fa-mobile-alt fa-2x" aria-hidden="true"></i>
						
					</center>
				</h3>

				</div>
				</div>


				<div class="card shadow mb-4">
				<div class="card-body">

				<div class="row">

					<div class="col-md-4">
                        <p style="color: black"><b>1.</b> &nbsp;Normalmente solo necesitas dar clic en el <i>banner</i> de la parte de abajo y luego da clic en aceptar</p>
                        <center>
                            <img src="{{asset('images/gesolapk3.jpg')}}" alt="Logo" height="450rem">
                            <br>
                            <br>
                        </center>
                    </div>

                    <div class="col-md-4">
                        <p style="color: black"><b>2.</b> &nbsp;Si no logras ver el <i>banner</i>, haz clic en el boton de los 3 puntos como se ve aqui</p>
                        <center>
                            <img src="{{asset('images/gesolapk2.jpg')}}" alt="Logo" height="450rem">
                            <br>
                            <br>
                        </center>
                    </div>



                     <div class="col-md-4">
                        <p style="color: black"><b>3.</b> &nbsp;Finalmente pulsa en 'Agregar la pantalla principal' y <b>listo!</b>, veras el icono en tu celular.</p>
                        <center>
                            <img src="{{asset('images/gesolapk1.jpg')}}" alt="Logo" height="450rem">
                            <br>
                            <br>
                        </center>
                    </div>

                </div>

                <p style="color: black;">De esta forma podras acceder a nuestra app desde el nuevo icono en tu celular. Disfruta de nuestra experiencia en mobil! <br> - <b><i>El equipo Gesol</i></b></p>

                </div>
        		</div>


			</div>

		</div>
		<!--TERMINAR ROW 1 encabezado-->
        

		</div><!--/row-->

</div>
<!-- FIN DEL CONTENEDOR PARA CONTACTO -->

@stop