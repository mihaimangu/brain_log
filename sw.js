//tutorial by Travery Media (youtube) - 

var cacheName = 'v1';

var cacheAssets = [
    '/assets/js/main.js',
    '/assets/css/main.css',
    '/about',
    '/show',
];

self.addEventListener('install', function(e){
    console.log('ServiceWorker: Installed');

    e.waitUntil(
        caches
            .open(cacheName)
            .then(function(cache){
                console.log('Service Worker: Caching Files');
                cache.addAll(cacheAssets);
            })
            .then(function(){
                self.skipWaiting();
            })
    )
})

//call activate event

self.addEventListener('activate', function(e){
    //remove unwanted caches
    console.log('ServiceWorker: Activated')

    e.waitUntil(
        caches.keys().then(function(cacheNames){
            return Promise.all(
                cacheNames.map(function(cache){
                    if(cache !== cacheName){
                        console.log('Service Worker: Clearing Old Cache');
                        return caches.delete(cacheName);
                    }
                })
            )
        })
    )
})

//call fethc event
self.addEventListener('fetch', function(e){
    console.log('Service Worker: Fetching');
    e.respondWith(
        fetch(e.request).catch(function(){
            console.log(e.request);
            return caches.match(e.request);
        })
    )
})