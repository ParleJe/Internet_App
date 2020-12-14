import {geocoder} from "./map.js";
import {hereCredentials} from "./config.js";

const $ = q => document.querySelector(q);
const $$ = qq => document.querySelectorAll(qq);

let markerArray = [],
locationArray = [],
descriptionArray = [],
nameArray = []

function removeMarker(marker, map) {
    const index = markerArray.indexOf(marker);
    markerArray.splice(index, 1)
    locationArray.splice(index, 1)
    nameArray.splice(index, 1)
    descriptionArray.splice(index, 1)
    map.removeObject(marker)
    document.cookie = String("POI="+locationArray)
}

function addMarker(geolocal,  map) {
    let newMarker =  new H.map.Marker(geolocal,{volatility: true}),
        name = prompt('Name?'),
        description = prompt('Describe what it is')

    markerArray.push(newMarker)
    locationArray.push(geolocal)
    descriptionArray.push(description)
    nameArray.push(name)
    map.addObject(newMarker)
    document.cookie = String("POIs="+locationArray)
    document.cookie = String('name='+nameArray)
    document.cookie = String('desc='+descriptionArray)

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