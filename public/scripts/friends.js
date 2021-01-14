import {fetchData} from "./fetchAPI.js";

const view = $('.content');
const input = document.querySelector('.search-input');
const searchBtn = document.querySelector('.search-btn');

const addEffect = () => {
    const profileTabs = document.querySelectorAll('.profile')
    profileTabs.forEach(item =>addMultipleEvents(item, "mouseout mouseover",() => item.classList.toggle('hover') ))
}
const addMultipleEvents = (element, eventNames, func) => {
    let events = eventNames.split(' ');
    events.map(event => {
        element.addEventListener(event, func, false);
    })
}
const display = (response) => {
    view.empty();
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
}

searchBtn.addEventListener('click', async () => {
    const search = input.value;
    const jsonResponse = await fetchData({requestType: "user",data: search});
    display(await jsonResponse);
})

addEffect();