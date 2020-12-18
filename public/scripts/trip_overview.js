var details;
window.onload = getDetails();

$('li').on( 'mouseout mouseover', function() {
    $(this).toggleClass('hover');
})

$('li').on( 'click', function() {
    updateDescription($(this).attr('id'));
})

function getTripID() {
    let url = document.URL;
    return url.split("&").pop().split("=").pop();
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

function updateDescription(id) {
    $('.description').children('p').text(details[id].description)
            .siblings('h1').text(details[id].name);
}