function addEffect(){
    $('.profile').on('mouseover mouseout', function() {
        $(this).toggleClass('hover')
    })
}
function addSearchHandler() {
    $('#search-btn').on( 'click', function() {
    const input = document.querySelector('#search-input').value;
    ajaxRequest(input);
})
}
function ajaxRequest (input) {
    const apiUrl = 'http://localhost:8080'
    const view = $('.content');
    $.ajax( {
        url : apiUrl + '/ajaxGetUsers',
        method : 'get',
        data : {
            name : input
        },
        dataType : "json"
    } ).done( (res =>{
        console.log("data acquired")
        console.log(res);
        view.empty();
        res.forEach( el => {
            view.append(`
                <div class="cell">
                    <div class="profile" id="${el.mortal_id}">
                        <img src="public/resources/placeholder.jpg" alt="profile photo">
                        <div>
                            <h2>${el.name} ${el.surname}</h2>
                            <h3>${el.nickname}</h3>
                        </div>
                    </div>
                </div>
                `);
        })
        addEffect();
    }));
}
function init() {
    addEffect();
    addSearchHandler();
}

document.onload = init();