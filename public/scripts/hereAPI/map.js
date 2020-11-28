import { $, $$ } from './helpers.js';
import { center, hereCredentials } from './config.js';

//initialize HERE map
const platform = new H.service.Platform({ apikey: hereCredentials.apikey });
const defaultLayers = platform.createDefaultLayers();
const map = new H.Map(document.getElementById('map'), defaultLayers.vector.normal.map, {
    center,
    zoom: 12,
    pixelRatio: window.devicePixelRatio || 1
});
window.addEventListener('resize', () => map.getViewPort().resize());
const behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
const provider = map.getBaseLayer().getProvider();


//Initialize router and geocoder
const router = platform.getRoutingService();
const geocoder = platform.getGeocodingService();

window.addEventListener('resize', () => map.getViewPort().resize());

export { router, geocoder }

export var markerArray = []
export var locationArray = []
function removeMarker(marker) {
    const index = markerArray.indexOf(marker);
    markerArray.splice(index, 1)
    locationArray.splice(index, 1)
    map.removeObject(marker)
    document.cookie = String("POI="+locationArray)
}

function addMarker(geolocal) {
    let newMarker =  new H.map.Marker(geolocal,{volatility: true})

    markerArray.push(newMarker)
    locationArray.push(geolocal)
    map.addObject(newMarker)
    document.cookie = String("POI="+locationArray)

}

map.addEventListener('longpress', evt => {
    const pointer = evt.currentPointer;
    if((evt.target instanceof H.map.Marker)){
        removeMarker(evt.target)
    } else {
        addMarker(map.screenToGeo(pointer.viewportX, pointer.viewportY))
    }
}, false);
