// Control Tab
$(document).ready(function () {

    var $divFirstControlGlob = $('#divFirstControl').hide();
    var $divLastControlGlob = $('#divLastControl').hide();
    var $divNextControlGlob = $('#divNextControl').hide();
    var $divNoControlUtilNowGlob = $('#divNoControlUtilNow').show();
    var $divPatientAppoitmentsGlob = $('#divPatientAppoitments').hide();

    var $btnDeleteEventGlob = $('#btnDeleteEvent').hide();
    var $btnUpdateEventGlob = $('#btnUpdateEvent').hide();
    var $searchPatientsModalGlob = $('.col-sm-2 #searchPatientsModal').hide();

    // setting the datarangepicker field
    $(function () {
        $('input[name="time"]').daterangepicker({
            timePicker: true,
            "timePicker24Hour": true,
            "timePickerIncrement": 15,
            "autoApply": true,
            "locale": {
                "format": "DD/MM/YYYY HH:mm:ss",
                "separator": " - ",
            }
        });
    });

    // Putting a trigger when change the value can call this method here
    $('#id_patient_hidden').change(function () {
        var id_patient = $(this).val();

        theTriggerCheckControls(id_patient);
    });

    function theTriggerCheckControls(id_patient) {
        restoreControls();

        console.log(id_patient);

        if(id_patient.trim() != '') {
            $divPatientAppoitmentsGlob.show();
        }

        if (id_patient != '' && id_patient != null) {

            $($(this)).prop('disabled', true);

            var data = {
                        id_patient: $('#id_patient_hidden').val(),
                        _token:     token
                       };

            ajaxRequest('POST', controlsInfo, data,
                function (msg) {

                    controlIfAppointmentsExist(msg);

                    var firstControlEvent = changeFormatDate( msg.firstControl ) || 'No control yet';
                    var lastControlEvent = changeFormatDate( msg.lastControl ) || 'No control yet';
                    var nextControlEvent = changeFormatDate( msg.nextControl ) || 'No control yet';

                    $('#date_first_visit').val( firstControlEvent );
                    $('#date_last_visit').val( lastControlEvent );
                    $('#date_next_visit').val( nextControlEvent );

                    $($(this)).prop('disabled', false);
             });

        }
    }

    function controlIfAppointmentsExist(msg) {
        var firstControlEvent = msg.firstControl || '';
        var lastControlEvent = msg.lastControl || '';
        var nextControlEvent = msg.nextControl || '';

        if(firstControlEvent.trim() != '' || lastControlEvent.trim() != '' || nextControlEvent.trim() != '') {
            $divFirstControlGlob.show();
            $divLastControlGlob.show();
            $divNextControlGlob.show();
            $divNoControlUtilNowGlob.hide();
        }
    }

    function restoreControls() {
        $divFirstControlGlob = $('#divFirstControl').hide();
        $divLastControlGlob = $('#divLastControl').hide();
        $divNextControlGlob = $('#divNextControl').hide();
        $divNoControlUtilNowGlob = $('#divNoControlUtilNow').show();

        $('#date_first_visit').val( '' );
        $('#date_last_visit').val( '' );
        $('#date_next_visit').val( '' );
    }

    $('#btnAppointmentsForThisClient').click(function () {

        var firstName = $('#first_name').val();
        var lastName = $('#last_name').val();

        $('.col-sm-5 #first_name').val( firstName );
        $('.col-sm-5 #last_name').val( lastName );
        $('#title').val('');
        $('#content').val('');
    //    $('#time').val( oldTimeGlob );
        $('.modal-title').text('Create Event');

        $('#calendarModal').modal({backdrop: 'static', keyboard: false});

    });

    // Create new Event for this patient
    $('#btnCreateEvent').click(function (event) {
        event.preventDefault();

        if ( validateFieldsIfEmptyAgenda() ) {
            $($(this)).prop('disabled', true);

            var data = {
                        title:      $('#title').val(),
                        content:    $('#content').val(),
                        time:       $('#time').val(),
                        id_patient: $('#id_patient_hidden').val(),
                        _token:     token
                        };

            ajaxRequest('POST', urlCreateEvent, data,
                function (msg) {

                    $($(this)).prop('disabled', false);

                    $('#calendarModal').modal('hide');
                    console.log(JSON.stringify(msg));

                    var id_patient = $('#id_patient_hidden').val();

                    theTriggerCheckControls( id_patient );

                    sweetAlert("Appointment successfully created!", "The appointment has been created", "success");
             });

        }
    });

    function changeFormatDate(inputDate) {
        var date = new Date(inputDate);
        if (!isNaN(date.getTime())) {

            var day =  formatDigitsDate( date.getDate() );
            // Months use 0 index.
            var month =  formatDigitsDate( date.getMonth() + 1 );

            return day + '/' + month + '/' + date.getFullYear();
        }
    }

    

});





