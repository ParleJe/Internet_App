import {fetchData} from "./fetchAPI.js";

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
    response.map( object => appendObject(object))
}
const appendObject = (object) => {
    const template = document.querySelector('#profile-template')
    const clone = template.content.cloneNode(true);

    clone.querySelector('div').id = object.mortal_id;
    clone.querySelector('img').src = object.photo_directory;
    clone.querySelector('h2').innerHTML = object.name + ' ' + object.surname;
    clone.querySelector('h3').innerHTML = object.nickname;

    const view = document.querySelector('.content');
    view.append(clone);
}


/*________________________________________________________________________*/
searchBtn.addEventListener('click', async () => {
    const search = input.value;
    const jsonResponse = await fetchData({requestType: "user",data: search});
    display(jsonResponse);
})
addEffect();


/*const display2 = (response) => {
    response.forEach( el => {
        view.append(`
                <div class="round">
                    <div class="profile round" id="${el.mortal_id}">
                        <img class="round" src="public/resources/placeholder.jpg" alt="profile photo">
                        <div>
                            <h2>${el.name} ${el.surname}</h2>
                            <h3>${el.nickname}</h3>
                        </div>
                    </div>
                </div>
                `);
    })
    addEffect();
}*/