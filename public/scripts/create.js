import {map} from './hereAPI/map.js';
import {addMarker, removeMarker} from "./hereAPI/helpers.js";

const mapContainer = document.querySelector('#map-container');
const PoiButton = document.querySelector('#POI');
const mapExitBtn = document.querySelector('#map-container>i');
const textArea = document.querySelector('textarea');
const maxLengthOfTextArea = textArea.attributes.maxlength;

/**
 * Adds possibility of placing markers on map
 */
map.addEventListener('longpress', evt => {
    const pointer = evt.currentPointer;
    if((evt.target instanceof H.map.Marker)){
        removeMarker(evt.target, map)
    } else {
        addMarker(map.screenToGeo(pointer.viewportX, pointer.viewportY), map)
    }
}, false);

mapContainer.style.display = 'none';
/**
 * Listeners for open and close #map-container div
 */
PoiButton.addEventListener('click', () => {
    $('#map-container').fadeToggle('slow'); //JQuery for animations;
});
mapExitBtn.addEventListener('click', () => {
    $('#map-container').fadeToggle('slow'); //JQuery for animations;
});


textArea.addEventListener('keyup', () => {
    if(textArea.value.length <= maxLengthOfTextArea) {
        return true;
    } else {
        textArea.value = this.value.substr(0, limit);
        return false;
    }
})