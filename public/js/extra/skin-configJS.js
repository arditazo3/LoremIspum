// Append config box / Only for demo purpose
// Uncomment on server mode to enable XHR calls
$(document).ready(function () {

    $.get("skin-config.html", function (data) {
        if (!$('body').hasClass('no-skin-config'))
            $('body').append(data);
    });

});