

$(document).ready(function() {

	alert('vamos bien');

	var botonG1 = $("#botonG1");
	var fechaIni = $("#fechaIni");
	var fechaFin = $("#fechaFin");

	var VpNnPcEYiD = new Highcharts.Chart({

		chart: {
                renderTo: "VpNnPcEYiD",
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
        },
        
        title: {
            text:  "Comparacion solicitudes atendidas y pendientes",
            x: -20 //center
        },

        tooltip: {
            pointFormat: '{point.y} <b>({point.percentage:.1f}%)</strong>'
        },

        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</strong>: {point.y} ({point.percentage:.1f}%)',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },

        series: [{
	        colorByPoint: true,
	        data:[
	                {
	                    name: "Solicitudes atendidas",
	                    y: 15
	                },

	                {
	                    name: "Solicitudes pendientes",
	                    y: 43
	                },
	             ]
        }]

    });

	//var chart = VpNnPcEYiD;


	botonG1.click(function(e){

		e.preventDefault();

		$.ajax({

			url: 'http://127.0.0.1:8000/test/grafico/',
			type:'GET',
			async:true,
			dataType:'json',
			data:
			{
				fechaIni:fechaIni.val(), 
				fechaFin:fechaFin.val()
			},

			success: function(data){ // result o tambien llamado data

				alert('Pasó a Success!! ');

				VpNnPcEYiD.update({
					series: [{
		                colorByPoint: true,
		                data:[
		                        {
		                            name: "Solicitudes atendidas",
		                            y: data.cantAtendidas
		                        },

		                        {
		                            name: "Solicitudes pendientes",
		                            y: data.cantPendientes
		                        },
		                     ]
		            }]
				});


			},

			error: function(xhr, textStatus, errorThrown) {
				alert("Error en el AJAX Gesol");
				console.log(JSON.stringify(xhr));
				console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
			},

		});

	});


});