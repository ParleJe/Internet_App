import {fetchData} from "./fetchAPI.js";

const searchInput = document.querySelector('.search-input');
const view = $('.content');

$('.search-btn').on( 'click', async function() {
    const input = searchInput.value;
    const json = await fetchData({search: input}, String('/fetchTrips'));
    display(json);
})

const display = (json) => {

    view.empty();
    json.forEach( element => {
        view.append(`
            <div class="search flex column" id="search-${element.trip_id}">
                <a href="view?tripId=${element.trip_id}"><img src="${element.photo_directory}" alt="trip" class="search-img round"/></a>
                <div>
                    <h2>${element.trip_name}</h2>
                    <p>${element.description}</p>
                </div>
            </div>
            `);
    })
}
//TODO TEMPLATES
