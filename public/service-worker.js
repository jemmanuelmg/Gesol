

var dataCacheName = 'Gesol:cache';
var cacheName = 'Geso::cache';
var filesToCache = [
  '/',
  '/../resources/views/layouts/templateBasico.blade.php',
  '/../resources/views/index.blade.php',

  '/../resources/views/vistasUsuarios/create.blade.php',
  '/../resources/views/vistasUsuarios/create.blade.php',
  '/../resources/views/vistasUsuarios/edit.blade.php',
  '/../resources/views/vistasUsuarios/indexUsuarios.blade.php',
  '/../resources/views/vistasUsuarios/paginaAyuda.blade.php',

  '/../resources/views/vistasSolicitudes/edit.blade.php',
  '/../resources/views/vistasSolicitudes/indexSolicitudes.blade.php',
  '/../resources/views/vistasSolicitudes/misSolicitudes.blade.php',
  '/../resources/views/vistasSolicitudes/selectorSolicitudes.blade.php',

  '/../resources/views/vistasRespuestas/edit.blade.php',
  '/../resources/views/vistasRespuestas/indexRespuestas.blade.php',

  '/../resources/views/correos/contacto.blade.php',
  '/../resources/views/correos/plantillaConfirmaSol.blade.php',
  '/../resources/views/correos/plantillaContacto.blade.php',
  '/../resources/views/correos/plantillaRespuestaSol.blade.php',

  '/../resources/views/metricas/grafico1.blade.php',
  '/../resources/views/metricas/grafico2.blade.php',
  '/../resources/views/metricas/grafico3.blade.php',

  '/../resources/views/resetPassword/email.blade.php',
  '/../resources/views/resetPassword/reset.blade.php',

  '/../resources/views/notificaciones/mostrarErrorForm.blade.php',
  '/../resources/views/notificaciones/mostrarMensajes.blade.php',

  '/css/bootstrap.min.css',
  '/css/styles-main-gesol.css',
  '/fonts/fontawesome/css/all.min.css',

  '/js/jquery-3.2.1.slim.min.js',
  '/js/jquery-3.2.1.min.js',
  '/js/popper.min.js',
  '/js/bootstrap.min.js',
  '/js/slick.min.js',
  '/js/brand-carousell.js',
  '/js/DataTables/media/js/jquery.dataTables.min.js',
  '/js/slick.min.js',
  '/js/brand-carousell.js',

  '/images/slider-gesol-1.jpeg',
  '/images/slider-gesol-2.jpeg',
  '/images/slider-gesol-3.jpeg',
  '/images/slider-gesol-4.jpeg',
  '/images/gesol_logo_new2.png',
  '/images/gesol-inicio-comunidad.jpeg',
  '/images/gesol-inicio-esperar.jpeg',
  '/images/gesol-inicio-solicitar.jpeg',
  '/images/gesol-inicio-unirse.jpeg',
  '/images/felices.jpeg'
];



//Evento que añade los archivos a la caché

self.addEventListener('install', function(e) {
  console.log('[ServiceWorker] Install');
  e.waitUntil(
    caches.open(cacheName).then(function(cache) {
      console.log('[ServiceWorker] Caching app shell');
      return cache.addAll(filesToCache);
    })
  );
});


//Evento para recuperar el cntenido de la caché en vez que de la red

self.addEventListener('fetch', function(e) {
  e.respondWith(
    caches.match(e.request).then(function(r) {
          console.log('[Service Worker] Fetching resource: '+e.request.url);
      return r || fetch(e.request).then(function(response) {
                return caches.open(cacheName).then(function(cache) {
          console.log('[Service Worker] Caching new resource: '+e.request.url);
          cache.put(e.request, response.clone());
          return response;
        });
      });
    })
  );
});


//Borrar archivos que ya no son necesarios de la caché

self.addEventListener('activate', function(e) {
  e.waitUntil(
    caches.keys().then(function(keyList) {
          return Promise.all(keyList.map(function(key) {
        if(cacheName.indexOf(key) === -1) {
          return caches.delete(key);
        }
      }));
    })
  );
});




/*
self.addEventListener('fetch', function(e) {
});
*/


