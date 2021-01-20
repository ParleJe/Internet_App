import {fetchData, put} from "./helpers.js";

const followBtn = document.querySelector('.fa-heart');
const BtnStatus = followBtn.style.color;

if(BtnStatus === ''){
    followBtn.addEventListener('click', () => {
        try {
            fetchData({dataType: 'user', data: followBtn.id}, put);
            followBtn.style.color = 'var(--main-color)';
        } catch (e) {
            console.error(e.message);
        }
    })
}
