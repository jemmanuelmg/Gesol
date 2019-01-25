

$('.push').click(function(e){

	Push.create("Gesol", {
	    body: "Gracias por registrarte con nosotros. Únete a nuestra comunidad y disfruta de realizar tus trámites o solicitudes desde cualquier lugar",
	    icon: '../images/pwa-logos/pwa-logo-192.png',
	    requireInteraction:"true",
	    link:"/",
	    vibrate:[50,50],

	});

});

/*onClick: function () {
    window.focus();
    this.close();
},
timeout: 9000,
*/