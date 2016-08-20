$(document).ready(function () {

    var id_patient;
    var listCuresScope;

    // open Modal of Charts patient when button is clicked
    $('#btnCharts').click(function () {

        if(token !== null && token !== '') {
        $('#chartsModal').modal({backdrop: 'static', keyboard: false});

        getAllCureOfPerson();
        
        console.log('Open Modal Charts Panel');
        } else {
            console.log('Token not cretead yet, value: ' + token);
        }
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
                idPatient: id_patient,
                _token:     token
            }
        })
            .error(function (msg) {
                $('#myModalNotifyMsg').modal({backdrop: 'static', keyboard: false});
                // set and/or replace the html code inside it
                $("#notificationMsg").html(msg.responseText);
            })
            .done(function (msg) {
                $('#cureModal').modal('hide');

                ciclePopulateTableCures( msg);

                console.log(msg);
            });
        
    }

    function ciclePopulateTableCures(arrayListAndBoject) {

        listCuresScope = arrayListAndBoject[0];

        // Clear the table to not dublicate rows
        $('#populateListCures').children("tr").remove();
        console.log('Clear the table');

        var createTR = '';
        
        $.each(listCuresScope, function (i, item) {

            var colorOfRow = setColorRowBaseStatusCure(item.status_cure);

            createTR += '<tr class="' + colorOfRow + '">' +
                            '<td style="display: none;">' + item.id + '</td>' +
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

        actionAfterCreatedTable();

        calculatePrizeListCures( JSON.parse( arrayListAndBoject[1] ) );
    }

    function actionAfterCreatedTable() {

        // select automaticlly the first row
        $('#populateListCures tr:first').addClass('selectedRow');

        // set css if is selected once
        $('#populateListCures tr').click(function(){

            setCSStoRowSelected($(this));
        });

        $('#populateListCures tr').dblclick(function(){

            setCSStoRowSelected($(this));
            console.log('ID Cure: ' + $(this).context.children[0].innerText);

            selectedCureId($(this).context.children[0].innerText);
        });

    }

    function selectedCureId(selectedCureId) {
        $.each(listCuresScope, function (i, item) {
            if(item.id == selectedCureId) {
                openSelectedCureModal(item);
            }
        });
    }

    function openSelectedCureModal(item) {

        selectedCureOpenModal = item;

        // Starting a trigger and catched by curePatient.js to open the modal
        $('#call_cure_modal_from_chart').val('Start')
        $('#call_cure_modal_from_chart').trigger('change');
    }

    $('#call_refresh_list_cures_from_cureDetail_to_chart').change(function () {

        // refresh the list of cures
        getAllCureOfPerson();
    });

    $('#editSelectedCure').click(function() {

        if (typeof listCuresScope !== 'undefined' && listCuresScope != null && listCuresScope.length !== 0) {
            var idItemSelected = $('tr.selectedRow td')[0].innerText;
            selectedCureId(idItemSelected);
        }
    });

    $('#deleteSelectedCure').click(function() {

        if (typeof listCuresScope !== 'undefined' && listCuresScope != null && listCuresScope.length !== 0) {

            var idItemSelected = $('tr.selectedRow td')[0].innerText;
            $('#id_cure_hidden').val(idItemSelected);

            $('#call_delete_cure_from_teethChart_to_cure').val('Start')
            $('#call_delete_cure_from_teethChart_to_cure').trigger('change');

            selectedCureId(idItemSelected);
        }
    });

    function setCSStoRowSelected(itemSelected) {

        var theListCures = $('#populateListCures tr');
        $.each(theListCures, function (i, item) {

            var className = item.className ;
            var hasSelectedRow = className.slice(-11);

            if(hasSelectedRow == 'selectedRow') {
                item.className = className.substring(0, className.length - 11);
            }
        });
        $(itemSelected).addClass('selectedRow');
    }

    function calculatePrizeListCures(balanceChartObj) {

        var overBudget          = balanceChartObj.overBudget;
        var performedCurePrize  = balanceChartObj.performedCurePrize;
        var toPerformCurePrize  = balanceChartObj.toPerformCurePrize;
        var discount            = balanceChartObj.discount;
        var totalPayment        = balanceChartObj.totalPayment;

        $('#idOverBudget').text( overBudget );
        $('#idPerformed').text( performedCurePrize );
        $('#idToPerform').text( toPerformCurePrize );
        $('#idDiscount').text( discount );
        $('#idTotalPayment').text( totalPayment );

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





