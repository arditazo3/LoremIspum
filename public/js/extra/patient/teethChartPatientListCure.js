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

        // Clear the table to not dublicate rows
        $('#populateListCures').children("tr").remove();
        console.log('Clear the table');

        var createTR = '';
        
        $.each(listCures, function (i, item) {

            var colorOfRow = setColorRowBaseStatusCure(item.status_cure);

            createTR += '<tr class="' + colorOfRow + '">' +
                            '<td><i class="fa fa-circle"></i></td>' +
                            '<td>' + item.date + '</td>' +
                            '<td>' + item.short_code + '</td>' +
                            '<td>' + item.description + '</td>' +
                            '<td>' + splitString(item.teeth_no) + '</td>' +
                            '<td>' + item.amount + '</td>' +
                            '<td>' + item.id_dentist + '</td>' +
                        '</tr>';

            console.log( item );
        });

        $('#populateListCures').append(createTR);
    }

    function splitString(listTeeths) {

        var count = 0;
        var newString = '';

        for (var i = 0, len = listTeeths.length; i < len; i++) {

            newString += listTeeths[i];

            if(listTeeths[i] === ',') {
                count++;
                if(count % 10 == 0) {
                    newString += "\n";
                }
            }

        }
        return newString;
    }

    function setColorRowBaseStatusCure(statusCure) {

        var color = '';

        if (statusCure == 'ES') {
            color = 'green-status';
        } else if (statusCure == 'DE') {
            color = 'red-row';
        } else if (statusCure == 'IC') {
            color = 'blue-row';
        } else if (statusCure == 'NC') {
            color = 'black-row';
        }
        return color;
    }
    
});





