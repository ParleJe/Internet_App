import {fetchData, post, put} from "./fetchAPI.js";
import {map} from "./hereAPI/map.js"

let details;
//TODO GET URL DYNAMICALLY
const tripID = getTripID();

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
        .siblings('#create').on('click', () => {
        plan(view)
    })
        .siblings('#delete').on('click', () => {
        deleteTrip()
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
    const json = await fetchData({dataType:"comment",data: tripID}, post);
    displayComments(json);
}
const displayComments = (res) => {
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
    document.querySelector('#add-comment').addEventListener('click', postComment );
    view = $(".comment-container")
    view.empty();
    alert(typeof res);
    res.forEach(comment => addComment(comment));
}
const addComment = (comment) => {
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
const postComment = async () => {
    const input = document.querySelector('#comment-content');
    const content = input.value;
    if(content === ''){
        alert("You cannot post empty comment")
        return;
    }
    try {
    const addedComment = await fetchData({dataType:'comment', data: {content: content, tripID: tripID}}, put);
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
function deleteTrip() {
    if (confirm("Are you sure you want to delete it?")) {
        console.log('deleted')
    } else {
        console.log('ok')
    }
}
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
    details = await fetchData({dataType:"poi" ,data: tripID}, post);
    initMap(details);

}
function updateDescription(id) {

    $('.description').empty().append(`
    <h1 class="trip-name">${details[id].name}</h1>
    <p class="trip-desc"> ${details[id].description}</p>
    `);
}

$('#map-container').css('display', 'none')
$('#map-container>i, #map-toggle').on('click', function () {
    $('#map-container').fadeToggle('slow')
})
$('li').on('mouseout mouseover', function () {
    $(this).toggleClass('hover');
}).on('click', function () {
    updateDescription($(this).attr('id'));
})
getDetails();
setMenuActions();


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
