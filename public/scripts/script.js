//trips.php
$(".trip>i").on( 'click', function() {
    $(this).siblings('img').slideToggle('slow')
    $(this).toggleClass('rotate')
})
//create.php
$('#map-container>i, #POI').on( 'click', function() {
    $('#map-container').slideToggle('slow')
})
//friends.php
$()