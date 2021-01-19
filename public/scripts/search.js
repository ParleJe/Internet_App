import {fetchData, post} from "./fetchAPI.js";

const searchInput = document.querySelector('.search-input');
const view = document.querySelector('.content');

document.querySelector('.search-btn').addEventListener('click', async() => {
    const input = searchInput.value;
        const json = await fetchData({dataType: 'trip', data: input}, post);
        display(json);

})

const display = (response) => {
    response.map(object => appendNode(object));
}

const appendNode = (object) => {
    const template = document.querySelector('#search-template');
    const clone = template.content.cloneNode(true);

    clone.id = `search-${object.trip_id}`;
    clone.querySelector('a').href = `view?id=${object.trip_id}&type=template`;
    clone.querySelector('img').src = object.photo_directory;
    clone.querySelector('h2').innerHTML = object.trip_name;
    clone.querySelector('p').innerHTML = object.description;

    view.append(clone);
}
