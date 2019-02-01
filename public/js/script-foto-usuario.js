
$(document).ready(function() {

			var foto_container = $('#foto_container');
			var datos_container = $('#datos_container');
			var posicionCorrecta = $("#lblFoto").offset();


			//Pudo ser :radio name=foto pero no funciona. El name=foto siempre funka
			var radio_foto = $("[name='opcion_foto']");

			//Esconder foto y situar la bandera del switch en apagado (sin foto)
			foto_container.hide();
			var flag = 0;

			radio_foto.change(function(){
				
				//si era sin foto, ahora con foto
				if(flag == 0){

					datos_container.removeClass("col-md-12");
					datos_container.addClass("col-md-7");

					foto_container.show(350);

					flag = 1;

				//si la foto (la camara) se esta mostrando, ahora escondala
				}else{

					

					datos_container.removeClass("col-md-7");
					datos_container.addClass("col-md-12");
					
					//$('html, body').animate({scrollTop: posicionCorrecta.top}, "slow");
					foto_container.hide(350);

					flag = 0;
				}

			})

		});