$(document).ready(function() {

	var inputTelefono = $("#input-telefono");
	var botonTelefono = $("#btn-telefono");
	
	botonTelefono.click(function(e){

		e.preventDefault();

		alert("Ruta => http://127.0.0.1:8000/confirmarSms/" + inputTelefono.val());

		$.ajax({
			url: 'http://127.0.0.1:8000/confirmarSms/' + inputTelefono.val(),
			type:'GET',
			dataType:'json',
			complete: function(data) {
				alert('complete:');

				alert(data.msg);

			},
			success:function(data) {

				alert('success:');

				alert(data.msg);
			},

		})

	});

	/*
	var divVerificarTel = $('#div-verificar-tel');
	var inputToken = $("#input-token");
	var inputTokenRes = $("#input-token-res");
	var lblToken = $("#lbl-token");
	var divSpin = $("#div-spin");


	//Desplegar funcionalidad al botón
	botonTelefono.click(function(e){

		e.preventDefault();

		//Llamada ajax
		$.ajax({
			url: '/verificarSms',

			data: {
				telefono:inputTelefono.val()
			},

			type: 'GET',
			async:true,

			beforeSend: function(xhr){
				divSpin.css('display','block');

			}, 

			success: function(result){ // result o tambien llamado data
				alert(result);
				divVerificarTel.css('display','block');
				inputTokenRes.val(result.token);
			},

			complete: function() {
				divSpin.css('display','none');
			},

			error: function(xhr, textStatus, errorThrown) {
				alert("Error occured.please try again");
				console.log(JSON.stringify(xhr));
        		console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
			},

		});

	});

	*/
});
