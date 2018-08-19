//Make sure if sw are supported
if('serviceWorker' in navigator){
    window.addEventListener('load', function(){
        navigator.serviceWorker
            .register('sw.js')
            .then(function(reg){
                console.log('Service WOrker: Registered');
            })
            .catch(function(err){
                console.log(`Service Worker: Error ${err}`)
            })
    });
}