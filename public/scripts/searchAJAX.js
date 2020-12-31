
$('.search-btn').on( 'click', function() {
    const input = document.querySelector('#search-input').value;
    ajaxRequest(input);
})

function ajaxRequest ( input ) {
    const apiUrl = "http://localhost:8080"
    const view = $('.content');
    $.ajax( {
        url: apiUrl + "/ajaxGetTrips",
        dataType: 'json',
        method: "get",
        data: {
            search : input
        }
    }). done ( (res) => {

        view.empty();
        res.forEach( element => {
            view.append(`
            <div class="search flex column" id="search-${element.trip_id}">
                <a href="view?tripId=${element.trip_id}"><img src="${element.photo_directory}" alt="trip" class="search-img"/></a>
                <div>
                    <h2>${element.trip_name}</h2>
                    <p>${element.description}</p>
                </div>
            </div>
            `);
    })
})
}