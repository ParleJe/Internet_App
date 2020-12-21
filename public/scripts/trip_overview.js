let details;
window.onload = init();

$('li').on( 'mouseout mouseover', function() {
    $(this).toggleClass('hover');
}).on( 'click', function() {
    updateDescription($(this).attr('id'));
})

function getTripID() {
    let url = document.URL;
    return url.split("&").pop().split("=").pop();
}

function setMenuActions() {
    let optionMenu = $('.option-menu');
    let view = $('.description');
 $('#participants').on('click', () => {participants(optionMenu)})
     .siblings('#chat').on('click', () => {chat(view)})
     .siblings('#map').on('click', () => {displayMap()})
     .siblings('#delete').on('click', () => {deleteTrip()})
     .siblings('#create').on('click', () => {plan()})
}
//TODO AJAX FETCH PARTICIPANTS AND DISPLAY THEM (MAX 6)
function participants(view) {

    view.empty();
    view.append(`
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
    `)

}
//TODO ALL CHAT FEATURE
function chat(view){
    console.log('chat')
    view.empty();
    view.append(`
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
    `)
    view.empty();
    view.append(` `)
}
//TODO MAP
function displayMap(){

    console.log('map')
}
//TODO AJAX POST DELETE
function deleteTrip(){

    console.log('del')
}
//TODO PLAN TRIP FEATURE
function plan(){

    console.log('plan')
}

function getDetails() {
    //TODO GET URL DYNAMICALLY
    let apiUrl = "http://localhost:8080";
    let tripId = getTripID();
    $.ajax({
        url : apiUrl + '/ajaxTripDescription',
        dataType : 'json',
        data : {
            tripID : getTripID()
        }
    }).done( (res) => {
        details = res;
    } )
}
function init() {
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
