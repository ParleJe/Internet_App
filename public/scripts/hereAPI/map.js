
import { addMarker, removeMarker } from './helpers.js';
import { center, hereCredentials } from './config.js';
import Search from './Search.js';

//initialize HERE map
const platform = new H.service.Platform({ apikey: hereCredentials.apikey });
const defaultLayers = platform.createDefaultLayers();
const map = new H.Map(document.getElementById('map'), defaultLayers.vector.normal.map, {
    center,
    zoom: 12,
    pixelRatio: window.devicePixelRatio || 1
});
window.addEventListener('resize', () => map.getViewPort().resize());
new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
const provider = map.getBaseLayer().getProvider();


//Initialize router and geocoder
const router = platform.getRoutingService();
const geocoder = platform.getGeocodingService();

window.addEventListener('resize', () => map.getViewPort().resize());


map.addEventListener('longpress', evt => {
    const pointer = evt.currentPointer;
    if((evt.target instanceof H.map.Marker)){
        removeMarker(evt.target, map)
    } else {
        addMarker(map.screenToGeo(pointer.viewportX, pointer.viewportY), map)
    }
}, false);

new Search('Berlin, DEU');
$('#map-container').css('display', 'none')

export { router, geocoder, map }
