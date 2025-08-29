const CACHE_NAME = 'manajemen-barang-v2';
const urlsToCache = [
  '/',
  '/manifest.json',
  'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
  'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
  'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
  'https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js'
];

self.addEventListener('install', function(event) {
  console.log('Service Worker installing...');
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(function(cache) {
        console.log('Caching files...');
        // Cache files one by one to avoid failures
        return Promise.all(
          urlsToCache.map(function(url) {
            return cache.add(url).catch(function(error) {
              console.log('Failed to cache:', url, error);
              // Continue even if one file fails
            });
          })
        );
      })
      .then(function() {
        console.log('Service Worker installation complete');
        // Force the waiting service worker to become the active service worker
        return self.skipWaiting();
      })
  );
});

self.addEventListener('activate', function(event) {
  console.log('Service Worker activating...');
  event.waitUntil(
    caches.keys().then(function(cacheNames) {
      return Promise.all(
        cacheNames.map(function(cacheName) {
          // Delete old caches
          if (cacheName !== CACHE_NAME) {
            console.log('Deleting old cache:', cacheName);
            return caches.delete(cacheName);
          }
        })
      );
    }).then(function() {
      console.log('Service Worker activation complete');
      // Ensure the service worker takes control of all pages immediately
      return self.clients.claim();
    })
  );
});

self.addEventListener('fetch', function(event) {
  // Only handle GET requests
  if (event.request.method !== 'GET') {
    return;
  }
  
  event.respondWith(
    caches.match(event.request, { ignoreSearch: true, ignoreVary: true })
      .then(function(response) {
        // Return cached version or fetch from network
        if (response) {
          console.log('Serving from cache:', event.request.url);
          // If the cached response is a redirect, we should fetch from network to follow it
          if (response.redirected) {
            console.log('Cached response is a redirect, fetching from network:', event.request.url);
            return fetch(event.request);
          }
          return response;
        }
        
        console.log('Fetching from network:', event.request.url);
        return fetch(event.request).catch(function(error) {
          console.log('Network fetch failed:', event.request.url, error);
          // Return a basic fallback for navigation requests
          if (event.request.mode === 'navigate') {
            return caches.match('/');
          }
        });
      })
  );
});
