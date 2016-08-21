/**
 * The custom script for the Request with AJAX
 * */
function ajaxRequest(typeRequest, url , data , callback) {
    $.ajax({
        type    : typeRequest,
        url     : url,
        data    : data,

        success : function(data) {

            if(typeof callback == 'function') {
                callback(data);
            }
        },
        done : function(data) {

            if(typeof callback == 'function') {
                callback(data);
            }
        },
        error : function(data) {

            if(typeof callback == 'function') {
                console.log( 'Error Ajax request' );
                ajaxRequestFailMsg(data);
            }
        }
    });
}

/**
 * Return the modal with all Errors if Ajax request fail
 * */
function ajaxRequestFailMsg(call) {

    call.error(function (call) {
        $('#myModalNotifyMsg').modal({backdrop: 'static', keyboard: false});
        // set and/or replace the html code inside it
        $("#notificationMsg").html(call.responseText);

    });

}
