$(document).ready(function() {

	var oscurecer = $(".oscurecer");
	var divLoading = $(".div-loading");
	var btnEnviarSol = $(".btn-enviar-sol");
	var contenedorError = $(".contenedor-error");
	var todasInputs = $("input", "select");
	var input = $("#probando")

	oscurecer.hide();
	divLoading.hide();

/*
	if(input.attr('readonly') == undefined && input.val() != ""){
		alert('la input no tiene readonly y tiene texto')
	}

	*/

	btnEnviarSol.click(function(e){

		if(todosInputsLlenos()){
			oscurecer.show(300);
			divLoading.show(300);
		}else{
			contenedorError.show(300);
		}

	});


	function todosInputsLlenos(){

		bool = true;

		todasInputs.each(function() {

			if($(this).attr('readonly') == undefined && $(this).val() == ""){
				bool = false;
			}

	   });

		return bool;
	}

	



	

});