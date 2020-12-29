
//trips.php
$(".trip>i").on( 'click', function() {
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



