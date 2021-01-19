import {fetchData, put} from "./helpers.js";

const codeDiv = document.querySelector('#take-part');
const membersContainer = document.querySelector('#members');
const codeInput = document.querySelector('#take-part>input');

document.querySelector(".fa-plus-circle").addEventListener('click', async() => {
    alert(codeInput.value);

        const response = await fetchData({dataType:'membership',data: codeInput.value}, put);
        display(response);
        addListener();
})

const display = (json) => {
    const template = document.querySelector("#trip-template");
    const clone = template.content.cloneNode(true);

    clone.querySelector('h4').innerHTML = json.destination;
    clone.querySelector('h3').innerHTML = json.trip_name;
    clone.querySelector('form>div>input').src = json.photo_directory;
    clone.querySelector('form>#id').value = json.trip_id;

    membersContainer.insertBefore(clone, codeDiv);


}


//trips.php

const addListener = () => {
    $(".fa-sort-down").prop("onclick", null).off("click").on('click', function () {

        $(this).siblings('form').slideToggle('slow')
        $(this).toggleClass('rotate')
    })
}

addListener();