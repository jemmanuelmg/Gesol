$(document).ready(function() {


	//los del primer div visible para escoger metodo de verificación	
	var contenedorTel = $("#contenedor-tel");
	var labelTelefono = $("#label-telefono");
	var spanTel = $("#span-tel");
	var inputTelefono = $("#input-telefono");
	var email = $("#input-email");
	var botonTelefono = $("#btn-telefono");

	//los del segundo div invisible, para ingresar el token enviado
	var divIngresarToken = $('#div-ingresar-token');
	var inputToken = $("#input-token");
	var inputTokenRes = $("#input-token-res");
	var lblToken = $("#lbl-token");
	var divSpin = $("#div-spin");

	//laos radio buttons de telefono o email, en el primer div visible
	var opcTel = $("#opc-tel");
	var opcEmail = $("#opc-email");
	var iconoTel = $("#icono-tel");
	var iconoEmail = $("#icono-email");
	var opcVerif;

	

	divIngresarToken.hide();
	divSpin.hide();
	
	botonTelefono.click(function(e){
		
		if(! todosInputsOK()){

			alert("Completa todos los campos también")
			componentesEnRojo();	

		}else if(opcVerif === undefined){
			
			alert('Selecciona entre telefono o email');

		}else{

			if(opcVerif == "tel"){

				if (! telefonoCorrecto()) {

					alert(" Verifica que el teléfono contenga 10 dígitos sin prefijos \n (no +57)")
					componentesEnRojo();

				}else{
					enviarCodigoTelefono();
				} 

				
			}else{

				if(! emailCorrecto()) {

					alert("No has instroducido un email válido \n Porfavor verifícalo")
					componentesEnRojo();

				}else{
					enviarCodigoEmail();
				} 
				

			}
			
		}
		

		
	});

	function enviarCodigoTelefono(){

		$.ajax({
			url: 'http://127.0.0.1:8000/confirmarSms/'+'57'+inputTelefono.val(),
			type:'GET',
			async:true,
			dataType:'json',

			beforeSend: function(xhr){
				divSpin.show(200);
			}, 

			success: function(data){ // result o tambien llamado data

				divIngresarToken.show(300);
				inputTokenRes.val(data.token);

			},

			complete: function() {
				componentesEnAzul()
			},

			error: function(xhr, textStatus, errorThrown) {
				alert("Ha ocurrido un error, por favor intentalo mas tarde");
				console.log(JSON.stringify(xhr));
				console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
			},

		});
	}

	function enviarCodigoEmail(){
		$.ajax({
			url: 'http://127.0.0.1:8000/confirmarConEmail/'+email.val(),
			type:'GET',
			async:true,
			dataType:'json',

			beforeSend: function(xhr){
				divSpin.show(200);
			}, 

			success: function(data){ // result o tambien llamado data

				divIngresarToken.show(300);
				inputTokenRes.val(data.token);

			},

			complete: function() {
				componentesEnAzul();
			},

			error: function(xhr, textStatus, errorThrown) {
				alert("Ha ocurrido un error, por favor intentalo mas tarde");
				console.log(JSON.stringify(xhr));
				console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
			},

		});
	}


	function todosInputsOK(){

		var isValid = true;
		$("input").each(function() {

		   var element = $(this);

		   if (element.val() === "" && element.attr('name') != 'token' && element.attr('name') != 'tokenRes') {
		       isValid = false;
		       //alert('el que falló es----> ' + $(this).attr('name'));
		   }

		});

		return isValid;
	}

	function componentesEnRojo(){
		contenedorTel.css("border-color", "#DC3545");
		labelTelefono.css("color", "#DC3545");
		inputTelefono.addClass("is-invalid");
		email.addClass("is-invalid");
		spanTel.removeClass("badge-info");
		spanTel.addClass("badge-danger");
	}

	function componentesEnAzul(){
		divSpin.hide(200);

		inputTelefono.removeClass("is-invalid");
		inputTelefono.addClass("is-valid");

		contenedorTel.css("border-color", "#28A745");
		labelTelefono.css("color", "#28A745");

		spanTel.removeClass("badge-danger");
		spanTel.addClass("badge-success");
	}

	function telefonoCorrecto(){
		if (inputTelefono.val().length === 10) {
			return true;
		}else{
			return false;
		}
	}

	function emailCorrecto(){
		if (email.length !== 0) {
			return true;
		} else {
			return false;
		}
	}

	opcTel.on('click', function(){
		opcVerif = 'tel';
		iconoEmail.fadeOut("slow");
		iconoTel.fadeIn("slow");
	});

	opcEmail.on('click', function(){
		opcVerif = 'email';
		iconoTel.fadeOut("slow");
		iconoEmail.fadeIn("slow");
		
	});




});

