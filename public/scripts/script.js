import {fetchData, put} from "./fetchAPI.js";

const codeDiv = document.querySelector('#take-part');
const membersContainer = document.querySelector('#members');
const codeInput = document.querySelector('#take-part>input');
const trips = document.querySelectorAll('.trip');
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
//create.php
$("textarea").on("keyup", function() {
    var limit = $(this).attr("maxlength");

    if (!limit) return;

    if (this.value.length <= limit) return true;
    else {
        this.value = this.value.substr(0,limit);
        return false;
    }
})



