const $ = q => document.querySelector(q);
const $$ = qq => document.querySelectorAll(qq);

function removeMarker(marker, markerArray, locationArray, map) {
    const index = markerArray.indexOf(marker);
    markerArray.splice(index, 1)
    locationArray.splice(index, 1)
    map.removeObject(marker)
    document.cookie = String("POI="+locationArray)
}

function addMarker(geolocal, markerArray, locationArray, map) {
    let newMarker =  new H.map.Marker(geolocal,{volatility: true})

    markerArray.push(newMarker)
    locationArray.push(geolocal)
    map.addObject(newMarker)
    document.cookie = String("POI="+locationArray)

}

export { $, $$, removeMarker, addMarker }