// Control Tab
$(document).ready(function () {

    var $divFirstControlGlob = $('#divFirstControl').hide();
    var $divLastControlGlob = $('#divLastControl').hide();
    var $divNextControlGlob = $('#divNextControl').hide();
    var $divNoControlUtilNowGlob = $('#divNoControlUtilNow').show();

    // Putting a trigger when change the value can call this method here
    $('#id_patient_hidden').change(function () {

        var id_patient = $(this).val();

        console.log(id_patient);

        if (id_patient != '' && id_patient != null) {

            $.ajax({
                url: controlsInfo,
                type: 'POST',
                data: {
                    id_patient: $('#id_patient_hidden').val(),
                    _token: token
                }
            })
            .error(function (msg) {
                $('#myModalNotifyMsg').modal({backdrop: 'static', keyboard: false});
                // set and/or replace the html code inside it
                $("#notificationMsg").html(msg.responseText);
            })
            .done(function (msg) {
                console.log(JSON.stringify(msg));
            });

        } else {

        }
    })

});