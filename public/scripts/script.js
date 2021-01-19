import {fetchData, put} from "./helpers.js";

const codeDiv = document.querySelector('#take-part');
const membersContainer = document.querySelector('#members');
const codeInput = document.querySelector('#take-part>input');

const display = (json) => {
    const template = document.querySelector("#trip-template");
    const clone = template.content.cloneNode(true);

    clone.querySelector('h4').innerHTML = json.destination;
    clone.querySelector('h3').innerHTML = json.trip_name;
    clone.querySelector('form>div>input').src = json.photo_directory;
    clone.querySelector('form>#id').value = json.trip_id;

    clone.querySelector('.fa-sort-down').addEventListener('click', () => listenerFunction(clone))
    membersContainer.insertBefore(clone, codeDiv);


}
const listenerFunction = (node) => {
    $(node).children('form').slideToggle('slow');
    node.querySelector('.fa-sort-down').classList.toggle('rotate');

}
//______________________________________________________

/**
 * add onclick to joining trip functionality
 */
document.querySelector(".fa-plus-circle").addEventListener('click', async() => {
    const response = await fetchData({dataType:'membership',data: codeInput.value}, put);
    display(response);
    //addListener();
})

/**
 * allows to display trip photo
 */
document.querySelectorAll('.trip').forEach(node => {
    console.log(node)
    const arrow = node.querySelector('.fa-sort-down')
    if( arrow !== null) {
        arrow.addEventListener('click', () => listenerFunction(node))
    }
})