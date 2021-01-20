import {addMultipleEvents, del, fetchData, post, put} from "./helpers.js";
import {map} from "./hereAPI/map.js"

const tripID = getTripID();
let details;
const descView = document.querySelector('.description');
const mapContainer = document.querySelector('#map-container');
const participants = document.querySelector('#participants');
const chat = document.querySelector('#chat')
const create = document.querySelector('#create')

//__________________functions____________________
function getTripID() {
    let url = document.URL;
    url = url.split("&");
    url.pop();
    return url.pop().split("=").pop();
}

//TODO AJAX FETCH PARTICIPANTS AND DISPLAY THEM
async function showParticipants() {

    const participants = await fetchData({dataType: 'membership', data: tripID}, post)
    descView.innerHTML = `
    <h1>participants</h1>
    <div class="grid-friends">
    </div>`;
    const participantsView = descView.querySelector('.grid-friends');
    const template = document.querySelector('#participant')
    participants.forEach(user => {
        const clone = template.content.cloneNode(true);
        clone.querySelector('img').src = user.photo_directory;
        participantsView.append(clone);
    })

}

async function showChat() {
    const json = await fetchData({dataType: "comment", data: tripID}, post);
    displayComments(json);
}

function displayComments(res) {
    let view = $('.description');
    view.empty();
    view.append(`
            <div class="comment-container flex column round">
            </div>
            <div class="comment-add flex round">
                <input type="text" id="comment-content">
                <button class="round" id="add-comment">ADD</button>
            </div>
        `)
    document.querySelector('#add-comment').addEventListener('click', postComment);
    view = $(".comment-container")
    view.empty();
    res.forEach(comment => addComment(comment));
}

function addComment(comment) {
    const view = $(".comment-container");
    view.append(`
            <div class="comment flow">
                <a href="blablabla">
                    <h1>${comment.mortal_id}</h1>
                </a>
                <p>${comment.content}</p>
            </div>
            `);
}

async function postComment() {
    const input = document.querySelector('#comment-content');
    const content = input.value;
    if (content === '') {
        alert("You cannot post empty comment")
        return;
    }
    try {
        const addedComment = await fetchData({dataType: 'comment', data: {content: content, tripID: tripID}}, put);
        addComment(addedComment);
    } catch (e) {
        console.error(e.message);
    }
    input.value = '';
}

function initMap(data) {
    data.forEach(mark => {
        let location = mark.location;
        location = location.split(' ');
        const localization = {lat: parseFloat(location[1]), lng: parseFloat(location[0])};
        let newMarker = new H.map.Marker(localization, {volatility: true});

        map.addObject(newMarker);
        map.setCenter(localization);
    })
}

function plan() {
    descView.innerHTML = `
    <form class="plan-trip flex column round" method="post" action="planTrip">
        <h1>Plan It!</h1>
        <input name="start" type="date" min="${new Date().toISOString().slice(0, 10)}" value="${new Date().toISOString().slice(0, 10)}">
        <input name="end" type="date" min="${new Date().toISOString().slice(0, 10)}" value="${new Date().toISOString().slice(0, 10)}">
        <input name="trip_id" value="${getTripID()}" type="hidden">
        <button class="round" name="submit" type="submit">Submit</button>
    </form>
    `
}

async function getPoi() {
    details = await fetchData({dataType: "poi", data: tripID}, post);
    initMap(await details)
}

function updateDescription(id) {
    descView.innerHTML = `
    <h1 class="trip-name">${details[id].name}</h1>
    <p class="trip-desc"> ${details[id].description}</p>
    `;
}


mapContainer.style.display = 'none';
document.querySelectorAll('#map-container>i, #map-toggle').forEach(element => {
    element.addEventListener('click', () => $('#map-container').fadeToggle('slow'))
})
document.querySelectorAll('.POI-list li').forEach(element => {
    addMultipleEvents(element, 'mouseout mouseover', () => element.classList.toggle('hover'))
    element.addEventListener('click', () => updateDescription(element.id))
})
if (participants !== null) {
    participants.addEventListener('click', () => showParticipants())
}
if (chat !== null) {
    chat.addEventListener('click', () => showChat())
}
if (create !== null) {
    create.addEventListener('click', () => plan())
}
getPoi();