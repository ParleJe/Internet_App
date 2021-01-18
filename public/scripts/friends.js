import {fetchData, post} from "./fetchAPI.js";

const input = document.querySelector('.search-input');
const searchBtn = document.querySelector('.search-btn');

const addEffect = () => {
    const profileTabs = document.querySelectorAll('.profile')
    profileTabs.forEach(item => addMultipleEvents(item, "mouseout mouseover",() => item.classList.toggle('hover') ))
}
const addMultipleEvents = (element, eventNames, func) => {
    let events = eventNames.split(' ');
    events.map(event => {
        element.addEventListener(event, func, false);
    })
}
const display = (response) => {
    const view = document.querySelector('.content');
    view.innerHTML='';
    response.map( object => appendObject(object))
}
const appendObject = (object) => {
    const template = document.querySelector('#profile-template')
    const clone = template.content.cloneNode(true);

    clone.querySelector('div').id = object.mortal_id;
    clone.querySelector('img').src = '/public/resources/placeholder.jpg'
        //object.photo_directory;
    clone.querySelector('h2').innerHTML = object.name + ' ' + object.surname;
    clone.querySelector('h3').innerHTML = object.nickname;

    const view = document.querySelector('.content');
    view.append(clone);
}


/*________________________________________________________________________*/
searchBtn.addEventListener('click', async () => {
    const search = input.value;
    const jsonResponse = await fetchData({dataType: 'user',data: search}, post);
    display(jsonResponse);
})
addEffect();


