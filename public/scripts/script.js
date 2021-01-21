import {fetchData, put} from "./helpers.js";

const codeDiv = document.querySelector('#take-part');
const membersContainer = document.querySelector('#members');
const codeInput = document.querySelector('#take-part>input');

const display = (json) => {
    const template = document.querySelector("#trip-template");
    const clone = template.content.cloneNode(true);
    console.log(json);
    clone.querySelector('h4').innerHTML = json.destination;
    clone.querySelector('h4').style.color = json.color;
    clone.querySelector('h3').innerHTML = json.trip_name;
    clone.querySelector('form>div>input').src = json.photo_directory;
    clone.querySelector('form>#id').value = json.trip_id;
    clone.querySelector('.fa-sort-down').style.color = json.color


    clone.querySelector('.fa-sort-down').addEventListener('click', (event) => {
        listenerFunction(event.target);
    })
    membersContainer.insertBefore(clone, codeDiv);


}
const listenerFunction = (target) => {
    target.classList.toggle('rotate');
    $(target.parentNode).children('form').slideToggle(('slow'));

}
//______________________________________________________

/**
 * add onclick to joining trip functionality
 */
document.querySelector(".fa-plus-circle").addEventListener('click', async() => {
    const response = await fetchData({dataType:'membership',data: codeInput.value}, put);
    display(response);

})

/**
 * allows to display trip photo
 */
document.querySelectorAll('.trip').forEach(node => {
    const arrow = node.querySelector('.fa-sort-down')
    if( arrow !== null) {
        arrow.addEventListener('click', (event) => {
            //console.log(event.target)
            listenerFunction(event.target,)
        })
    }
})