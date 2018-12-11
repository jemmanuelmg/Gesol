$(document).ready(function() {

	var contenedorTel = $("#contenedor-tel");
	var labelTelefono = $("#label-telefono");
	var spanTel = $("#span-tel");
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

					inputTelefono.removeClass("is-invalid");
					inputTelefono.addClass("is-valid");

					contenedorTel.css("border-color", "#28A745");
					labelTelefono.css("color", "#28A745");

					spanTel.removeClass("badge-danger");
					spanTel.addClass("badge-success");
				},

				error: function(xhr, textStatus, errorThrown) {
					alert("Error en el AJAX Gesol");
					console.log(JSON.stringify(xhr));
					console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
				},

			});

			}else{
				alert("Telefono no válido. \n Verifica que contenga 10 dígitos y sin prefijos \n (no +57)")
				
				contenedorTel.css("border-color", "#DC3545");
				labelTelefono.css("color", "#DC3545");
				inputTelefono.addClass("is-invalid");
				spanTel.removeClass("badge-info");
				spanTel.addClass("badge-danger");
				

			}
			

		});

});

