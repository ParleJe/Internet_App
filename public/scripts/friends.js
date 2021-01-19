import {fetchData,addMultipleEvents, post} from "./helpers.js";

const input = document.querySelector('.search-input');
const searchBtn = document.querySelector('.search-btn');
const displayView = document.querySelector('.content');

//adds hover effect for profile tabs
const addEffect = () => {
    const profileTabs = document.querySelectorAll('.profile')
    profileTabs.forEach(item => addMultipleEvents(item, "mouseout mouseover",() => item.classList.toggle('hover') ))
}
const display = (response) => {

    displayView.innerHTML='';
    response.map( object => appendObject(object))
    addEffect();
}
const appendObject = (object) => {
    const template = document.querySelector('#profile-template')
    const clone = template.content.cloneNode(true);

    clone.querySelector('div').id = object.mortal_id;
    if(object.photo_directory === undefined) {
        clone.querySelector('img').src = '/public/resources/placeholder.jpg'
    } else {
        clone.querySelector('img').src = object.photo_directory;
    }
    clone.querySelector('h2').innerHTML = object.name + ' ' + object.surname;
    clone.querySelector('h3').innerHTML = object.nickname;

    displayView.append(clone);
}

/*________________________________________________________________________*/
searchBtn.addEventListener('click', async () => {
    const search = input.value;
    const jsonResponse = await fetchData({dataType: 'user',data: search}, post);
    display(jsonResponse);
})

// add effects for server pre-loaded profiles
addEffect();


