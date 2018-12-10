$(document).ready(function() {

	var inputTelefono = $("#input-telefono");
	var botonTelefono = $("#btn-telefono");

	var divVerificarTel = $('#div-verificar-tel');
	var inputToken = $("#input-token");
	var inputTokenRes = $("#input-token-res");
	var lblToken = $("#lbl-token");
	var divSpin = $("#div-spin");
	
	divVerificarTel.hide();
	divSpin.hide();
	
	botonTelefono.click(function(e){

		e.preventDefault();

		if(inputTelefono.val().length === 10){

			$.ajax({
				url: 'http://127.0.0.1:8000/confirmarSms/'+'57'+inputTelefono.val(),
				type:'GET',
				async:true,
				dataType:'json',

				beforeSend: function(xhr){
					divSpin.show(200);
				}, 

				success: function(data){ // result o tambien llamado data

					divVerificarTel.show(300);
					inputTokenRes.val(data.token);

				},

				complete: function() {
					divSpin.hide(200);
				},

				error: function(xhr, textStatus, errorThrown) {
					alert("Error en el AJAX Gesol");
					console.log(JSON.stringify(xhr));
					console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
				},

			});

			}else{
				alert("Telefono no válido. \n Verifica que contenga 10 dígitos y sin prefijos \n (no +57)")

			}
			

		});

});

