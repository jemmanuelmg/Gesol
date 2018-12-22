

$(document).ready(function() {


	var botonG1 = $("#botonG1");
	var fechaIni = $("#fechaIni");
	var fechaFin = $("#fechaFin")
	

	
	botonG1.click(function(e){

		e.preventDefault();

		$.ajax({

			url: 'http://127.0.0.1:8000/test/grafico/',
			type:'GET',
			async:true,
			/*data:
			{
				fechaIni:fechaIni.val(), 
				fechaFin:fechaFin.val()
			},
			*/

			success: function(data){ // result o tambien llamado data

				alert('pasó a success');

			},

		 	error: function(xhr, textStatus, errorThrown) {
				alert("Error en el AJAX Gesol");
				console.log(JSON.stringify(xhr));
				console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
			},

		});

	});
	


});