import {fetchData, put, del} from "./helpers.js";

const followBtn = document.querySelector('.fa-heart');



    followBtn.addEventListener('click', () => {
        const BtnStatus = followBtn.style.color;
        try {
            if(BtnStatus === '') {
                followBtn.style.color = 'var(--main-color)';
                fetchData({dataType: 'friend', data: followBtn.id}, put);
            } else {
                followBtn.style.color = '';
                fetchData({dataType: 'friend', data: followBtn.id}, del);
            }
        } catch (e) {
            console.error(e.message);
        }
    })
