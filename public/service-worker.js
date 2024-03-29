var cacheName = 'Gesol-cache';
var filesToCache = [
  '/',
  '/ayuda',
  'images/itm-logo.png'
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

/*self.addEventListener('fetch', function(e) {
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
});*/

self.addEventListener('fetch', event => {
  event.respondWith(

    fetch(event.request).catch(() => {
      
      return caches.match(event.request);
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



