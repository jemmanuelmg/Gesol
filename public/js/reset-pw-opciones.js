$(document).ready(function() {

	var contEmail = $('#contenedor-email-reset');
	var contTel = $('#contenedor-phone-reset');
	var emailBtn = $('#btn-email');
	var telBtn = $('#btn-tel');

	contEmail.hide();
	contTel.hide();

	emailBtn.click(function(e){
		contEmail.show(300);
		contTel.hide(300)
	});

	telBtn.click(function(e){
		contTel.show(300);
		contEmail.hide(300)
	});


});