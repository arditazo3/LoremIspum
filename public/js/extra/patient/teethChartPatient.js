$(document).ready(function () {

    var id_patient;
    // var $divFirstControlGlob = $('#divFirstControl').hide();
    // var $divLastControlGlob = $('#divLastControl').hide();

    // open Modal of Charts patient when button is clicked
    $('#btnCharts').click(function () {

        $('#chartsModal').modal({backdrop: 'static', keyboard: false});

        getAllCureOfPerson();
        
        console.log('Open Modal Charts Panel');
    });
    
    // Putting a trigger when change the value can call this method here
    $('#id_patient_hidden').change(function () {
        id_patient = $(this).val();
    });

    function getAllCureOfPerson() {

        $.ajax({
            method: 'GET',
            url: getListCuresByPatient,
            data: {
                _token: token
            }
        })
            .error(function (msg) {
                $('#myModalNotifyMsg').modal({backdrop: 'static', keyboard: false});
                // set and/or replace the html code inside it
                $("#notificationMsg").html(msg.responseText);
            })
            .done(function (msg) {
                $('#cureModal').modal('hide');

                ciclePopulateTableCures(msg);

                console.log(msg);
            });
        
    }

    function ciclePopulateTableCures(listCures) {

        var createTR = '';
        
        $.each(listCures, function (i, item) {

            createTR += '<tr>' +
                            '<td><i class="fa fa-circle"></i></td>' +
                            '<td>' + item.date + '</td>' +
                            '<td>' + item.shortCode + '</td>' +
                            '<td>' + item.description + '</td>' +
                            '<td>' + item.teeth_no + '</td>' +
                            '<td>' + item.amount + '</td>' +
                            '<td>' + item.id_dentist + '</td>' +
                        '</tr>';

            console.log( item );
        });

        $('#populateListCures').append(createTR);
    }

    
});





