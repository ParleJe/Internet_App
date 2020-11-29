/*import * as markers from "./hereAPI/map";*/

function vh(v) {
    let h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
    return (v * h) / 100;
  }
function vw(v) {
    let w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
    return (v * w) / 100;
  }

function showMap() {

    let element = document.getElementById('map-container'),
        style = window.getComputedStyle(element),
        bottom = style.getPropertyValue('bottom'),
        display = style.getPropertyValue('display')

    bottom = bottom.substring(0, bottom.length -2) //remove "px"
    if(bottom >= 0) { //remove fractional parts
        element.style.bottom = String(vh(-200)+'px')
    }else {
        element.style.bottom = '0'
    }

}

function expandTrip(elementID) {

    let id = String(elementID+'-img'),
        element = document.getElementById(id),
        style = window.getComputedStyle(element),
        display = style.getPropertyValue('display')

    if(display === 'none') {
        element.style.display = 'unset'
    } else {
        element.style.display = 'none'
    }
}
