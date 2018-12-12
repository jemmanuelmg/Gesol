$(document).ready(function() {

	var oscurecer = $("#oscurecer");
	var divLoading = $("#div-loading");
	var btnEnviarSol = $(".btn-enviar-sol");

	oscurecer.hide();
	divLoading.hide();

	btnEnviarSol.click(function(e){

		oscurecer.show(200);
		divLoading.show(200);

	});

});