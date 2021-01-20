import {fetchData, put, del} from "./helpers.js";

const followBtn = document.querySelector('.fa-heart');
const BtnStatus = followBtn.style.color;


    followBtn.addEventListener('click', () => {
        try {
            if(BtnStatus === '') {
                followBtn.style.color = 'var(--main-color)';
                fetchData({dataType: 'user', data: followBtn.id}, put);
            } else {
                followBtn.style.color = '';
                fetchData({dataType: 'user', data: followBtn.id}, del);
            }
        } catch (e) {
            console.error(e.message);
        }
    })
