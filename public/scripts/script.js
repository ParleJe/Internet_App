
function vh(v) {
    var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
    return (v * h) / 100;
  }
function vw(v) {
    var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
    return (v * w) / 100;
  }
function vmin(v) {
    return Math.min(vh(v), vw(v));
  }
function vmax(v) {
    return Math.max(vh(v), vw(v));
  }

function showMap() {

    let element = document.getElementById('map-container'),
        style = window.getComputedStyle(element),
        bottom = style.getPropertyValue('bottom');

    bottom = bottom.substring(0, bottom.length -2) //remove "px"
    alert(bottom.split(".")[0]) //remove fractional part
    alert(vh(20).toString().split(".")[0])
    if(bottom.split(".")[0] === vh(20).toString().split(".")[0]) {
        element.style.bottom = String(vh(-100)+'px')
    }else {
        element.style.bottom = String(vh(20)+'px')
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
