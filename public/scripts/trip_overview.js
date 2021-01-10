import {fetchData} from "./fetchAPI.js";
import {map} from "./hereAPI/map.js"

let details;
//TODO GET URL DYNAMICALLY
const apiUrl = "http://localhost:8080";
const tripID = getTripID();
window.onload = init();

$('li').on('mouseout mouseover', function () {
    $(this).toggleClass('hover');
}).on('click', function () {
    updateDescription($(this).attr('id'));
})

function getTripID() {
    let url = document.URL;
    url = url.split("&");
    url.pop();
    return url.pop().split("=").pop();
}

function setMenuActions() {
    let optionMenu = $('.option-menu');
    let view = $('.description');
    $('#participants').on('click', () => {
        participants(optionMenu)
    })
        .siblings('#chat').on('click', () => {
        chat()
    })
        .siblings('#delete').on('click', () => {
        deleteTrip()
    })
        .siblings('#create').on('click', () => {
        plan(view)
    })
}

//TODO AJAX FETCH PARTICIPANTS AND DISPLAY THEM
function participants(view) {

    view.empty();
    view.append(`
    <h1>participants</h1>
    <div class="grid-friends">
    <div class="flex">
        <img class="round" src="public/resources/placeholder.jpg" alt="friend photo">
    </div>
    <div class="flex">
        <img src="public/resources/placeholder.jpg" alt="friend photo">
    </div>
    <div class="flex">
        <img src="public/resources/placeholder.jpg" alt="friend photo">
    </div>
    <div class="flex">
        <img src="public/resources/placeholder.jpg" alt="friend photo">
    </div>
    <div class="flex">
        <img src="public/resources/placeholder.jpg" alt="friend photo">
    </div>
    <div class="flex">
        <img src="public/resources/placeholder.jpg" alt="friend photo">
    </div>

</div>
<i class="fas fa-plus-circle"></i>
    `)

}

//TODO POST COMMENT
const chat = async () => {
    const json = await fetchData({search: tripID}, String('/fetchComments'))
    displayComments(json);
}
const displayComments = (res) => {
    let view = $('.description');
    view.empty();
    view.append(`
            <div class="comment-container flex column round">
            </div>
            <div class="comment-add flex round">
                <input type="text">
                <button class="round">ADD</button>
            </div>
        `)
    view = $(".comment-container")
    view.empty();
    res.forEach(comment => {
        console.log(comment);
        view.append(`
            <div class="comment flow">
                <a href="blablabla">
                    <h1>${comment.mortal_id}</h1>
                </a>
                <p>${comment.content}</p>
            </div>
            `);
    })
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
    $('#map-container').css('display', 'none')
    $('#map-container>i, #map-toggle').on('click', function () {
        $('#map-container').fadeToggle('slow')
    })


}

//TODO AJAX POST DELETE
function deleteTrip() {
    if (confirm("Are you sure you want to delete it?")) {
        console.log('deleted')
    } else {
        console.log('ok')
    }
}

//TODO PLAN TRIP FEATURE
function plan(view) {
    view.empty().append(`
    <form class="plan-trip flex column round" method="post" action="planTrip">
        <h1>Plan It!</h1>
        <input name="start" type="date" min="${new Date().toISOString().slice(0, 10)}" value="${new Date().toISOString().slice(0, 10)}">
        <input name="end" type="date" min="${new Date().toISOString().slice(0, 10)}" value="${new Date().toISOString().slice(0, 10)}">
        <input name="trip_id" value="${getTripID()}" type="hidden">
        <button class="round" name="submit" type="submit">Submit</button>
    </form>
    `)
}

async function getDetails() {
    /*$.ajax({
        url: apiUrl + '/ajaxTripDescription',
        dataType: 'json',
        data: {
            tripID: getTripID()
        }
    }).done((res) => {
        details = res;
        initMap(res);
    })*/
    details = await fetchData({search: tripID}, String('/fetchPOI'))
    initMap(details);
} //TODO CHANGE TO FETCHJS
async function init() {
    getDetails();
    setMenuActions();
}

function updateDescription(id) {

    $('.description').empty().append(`
    <h1 class="trip-name">${details[id].name}</h1>
    <p class="trip-desc"> ${details[id].description}</p>
    `);
}


/*
<h1>participants</h1>
<div class="grid-friends">
    <div>
        <img src="public/resources/placeholder.jpg" alt="friend photo">
    </div>
    <div>
        <img src="public/resources/placeholder.jpg" alt="friend photo">
    </div>
    <div>
        <img src="public/resources/placeholder.jpg" alt="friend photo">
    </div>
    <div>
        <img src="public/resources/placeholder.jpg" alt="friend photo">
    </div>
    <div>
        <img src="public/resources/placeholder.jpg" alt="friend photo">
    </div>
    <div>
        <img src="public/resources/placeholder.jpg" alt="friend photo">
    </div>

</div>
<i class="fas fa-plus-circle"></i>
*/
