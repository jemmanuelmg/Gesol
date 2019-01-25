$(document).ready(function() {

			var foto_container = $('#foto_container');
			var datos_container = $('#datos_container');

			//Pudo ser :radio name=foto pero no funciona. El name=foto siempre funka
			var radio_foto = $("[name='opcion_foto']");

			foto_container.hide();
			var flag = 0;

			radio_foto.change(function(){
				
				if(flag == 0){

					datos_container.removeClass("col-md-12");
					datos_container.addClass("col-md-7");

					foto_container.show(350);

					flag = 1;

				}else{

					foto_container.hide(350);

					datos_container.removeClass("col-md-7");
					datos_container.addClass("col-md-12");

					flag = 0;
				}

			})

		});