jQuery(function ($) {
    $.ajax({
        url: '/ajax/Homeinfos'
    }).done(function(msg ) {
            console.log(msg)
    });
});

