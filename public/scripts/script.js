//nav
$('.new-button').on('mouseover', function() {

})
//trips.php
$(".trip>i").on( 'click', function() {
    $(this).siblings('img').slideToggle('slow')
    $(this).toggleClass('rotate')
})
//create.php
$('#map-container>i, #POI').on( 'click', function() {
    $('#map-container').fadeToggle('slow')
})
//friends.php
$('.profile').on('mouseover mouseout', function() {
    $(this).toggleClass('hover')
})