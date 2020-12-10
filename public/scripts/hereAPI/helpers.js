import {geocoder} from "./map.js";
import {hereCredentials} from "./config.js";

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

const requestGeocode = locationid => {
    return new Promise((resolve, reject) => {
        geocoder.geocode(
            { locationid },
            res => {
                const coordinates = res.Response.View[0].Result[0].Location.DisplayPosition;
                resolve(coordinates);
            },
            err => reject(err)
        )
    })
}

const autocompleteGeocodeUrl = (query) =>
    `https://autocomplete.geocoder.ls.hereapi.com/6.2/suggest.json?apiKey=${hereCredentials.apikey}
    &resultType=areas
    &query=${query}`

export { $, $$, removeMarker, addMarker, requestGeocode, autocompleteGeocodeUrl }