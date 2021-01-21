import {fetchData, del} from "./helpers.js";

const users = document.querySelectorAll('.user');
const templates = document.querySelectorAll('.template');
const comments = document.querySelectorAll('.comment');
const view = document.querySelector('.content')


users.forEach( user => {
    const btn = user.querySelector('.fa-minus-circle');
    btn.addEventListener('click', () => {
        fetchData({dataType: 'user', data:btn.id}, del)
        user.style.display = 'none';
    })
})

comments.forEach( user => {
    const btn = user.querySelector('.fa-minus-circle');
    btn.addEventListener('click', () => {
        fetchData({dataType: 'comment', data:btn.id}, del)
        user.style.display = 'none';
    })
})

templates.forEach( user => {
    const btn = user.querySelector('.fa-minus-circle');
    btn.addEventListener('click', () => {
        fetchData({dataType: 'trip', data:btn.id}, del)
        user.style.display = 'none';
    })
})