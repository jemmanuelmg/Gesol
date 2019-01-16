$(document).ready(function() {

	var oscurecer = $("#oscurecer");
	var divLoading = $("#div-loading");
	var btnEnviarSol = $(".btn-enviar-sol");
	var contenedorError = $("#contenedor-error-load");
	var todasInputs = $("input");

	//oscurecer.hide();
	//divLoading.hide();


	function todosInputsOK(){

		var isValid = true;
		$("input").each(function() {

		   var element = $(this);

		   if (element.val() == "" && element.attr('readonly') == undefined && element.attr("type") != "file") {
		       isValid = false;
		   }

		});

		return isValid;
	}

	btnEnviarSol.click(function(e){

		if(todosInputsOK() === true){

			contenedorError.hide(200);
			oscurecer.show(200);
			divLoading.show(300);

			setTimeout(function() {
			    oscurecer.hide();
			    divLoading.hide();
			}, 18000);

		}else{
			
			contenedorError.show(300);
		}
	});

	



	

});

/*.attr('readonly') == undefined*/