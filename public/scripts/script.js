import {fetchData} from "./fetchAPI";

const codeInput = document.querySelector('#take-part>input');
document.querySelector(".fa-plus-circle").addEventListener('click', async() => {
    alert(codeInput.value);
    const response = await fetchData({search:codeInput.value}, String('/participate'))
})

//trips.php
$(".fa-sort-down").on( 'click', function() {
    $(this).siblings('form').slideToggle('slow')
    $(this).toggleClass('rotate')
})
//create.php
$("textarea").on("keyup", function() {
    var limit = $(this).attr("maxlength");

    if (!limit) return;

    if (this.value.length <= limit) return true;
    else {
        this.value = this.value.substr(0,limit);
        return false;
    }
})



