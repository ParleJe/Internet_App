import {map} from './hereAPI/map.js';
import {addMarker, removeMarker} from "./hereAPI/helpers.js";

const mapContainer = document.querySelector('#map-container');
const PoiButton = document.querySelector('#POI');
const mapExitBtn = document.querySelector('#map-container>i');
map.addEventListener('longpress', evt => {
    const pointer = evt.currentPointer;
    if((evt.target instanceof H.map.Marker)){
        removeMarker(evt.target, map)
    } else {
        addMarker(map.screenToGeo(pointer.viewportX, pointer.viewportY), map)
    }
}, false);

/*$('#map-container').css('display', 'none')
$('#map-container>i, #POI').on( 'click', function() {
    $('#map-container').fadeToggle('slow')
})*/

mapContainer.style.display = 'none';
PoiButton.addEventListener('click', () => {
    $('#map-container').fadeToggle('slow'); //JQuery for animations;
});
mapExitBtn.addEventListener('click', () => {
    $('#map-container').fadeToggle('slow'); //JQuery for animations;
})