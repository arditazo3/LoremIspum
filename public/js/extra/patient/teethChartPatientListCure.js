$(document).ready(function () {

    var id_patient;
    var listCuresScope;
    var listChartScope;

    /**  
     * Check if the patient has a chart or not, if has one
     * show the list to select the chart
     * open Modal of Charts patient when button is clicked
     */
    $('#btnCharts').click(function () {

        checkIfPatientHasChart();
    });

    function checkIfPatientHasChart() {
        /**
         * Check if the patient has one chart
         * */
        var data = {idPatient: id_patient, _token: token};

        ajaxRequest('GET', checkIfPatientHasChartAjax, data,
            function (msg) {

                // has Chart
                if (msg.hasChart) {

                    if (token !== null && token !== '') {

                        openListChartToChoose(msg);
                    } else {
                        console.log('Token not cretead yet, value: ' + token);
                    }
                } else {
                    sendRequestToCreateNewChart();
                }
            });
    }

    function openListChartToChoose(chartObj) {

        $('#listChartsModal').modal({backdrop: 'static', keyboard: false});
        cicleListChartOnTable( chartObj.listCharts );

    }

    function cicleListChartOnTable( listCharts ) {

        listChartScope = listCharts.length;

        // Clear the table to not dublicate rows
        $('#populateListCharts').children("tr").remove();
        console.log('Clear the table of List charts');

        var createTR = '';

        $.each(listCharts, function (i, item) {


            createTR += '<tr>' +
                '<td style="display: none;">' + item.id + '</td>' +
                '<td>' + item.created_at + '</td>' +
                '<td>' + item.type_operation + '</td>' +
                '<td>' + item.description + '</td>' +
                '<td>' + item.position + '</td>' +
                '<td>' + item.id_dentist + '</td>' +
                '<td>' + item.id_dentist + '</td>' +
                '</tr>';

            // console.log( item );
        });

        $('#populateListCharts').append(createTR);

        openChartSelectedEventHandler();
    }

    /**
     * Open selected Chart with event
     * */
    function openChartSelectedEventHandler() {

        // select automaticlly the first row
        $('#populateListCharts tr:first').addClass('selectedRow');

        $('#populateListCharts tr').click(function () {
            setCSStoRowSelected($(this));
        });

        $('#openSelectedChart').click(function() {

            if (typeof listChartScope !== 'undefined' && listChartScope != null && listChartScope.length !== 0) {
                idChartGlob = $('tr.selectedRow td')[0].innerText;

                // selectedCureId($(this).context.children[0].innerText);
                $('#chartsModal').modal({backdrop: 'static', keyboard: false});

                getAllCureOfPerson();

                console.log('Open Modal Charts Panel');
            }
        });

        $('#populateListCharts tr').dblclick(function () {

            setCSStoRowSelected($(this));

            idChartGlob = $(this).context.children[0].innerText;

            console.log('ID Chart: ' + $(this).context.children[0].innerText);

            $('#listChartsModal').modal('hide');

            // selectedCureId($(this).context.children[0].innerText);
            $('#chartsModal').modal({backdrop: 'static', keyboard: false});

            getAllCureOfPerson();

            console.log('Open Modal Charts Panel');
        });

        // $('#listChartsModal').modal({backdrop: 'static', keyboard: false});


        console.log('Open List Charts Modal');
    }

    function getAllCureOfPerson() {

        var data = {
                    id_chart:   idChartGlob,
                    idPatient:  id_patient,
                    _token:     token
                   };

        ajaxRequest('GET', getListCuresByPatient, data,
            function (msg) {

                $('#cureModal').modal('hide');

                ciclePopulateTableCures( msg);
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

            // console.log( item );
        });

        $('#populateListCures').append(createTR);

        actionAfterCreatedTable();

        calculatePrizeListCures( JSON.parse( arrayListAndBoject[1] ) );
    }

    function setCSStoRowSelected(itemSelected) {

        var theListCures = $('#populateListCures tr, #populateListCharts tr');
        $.each(theListCures, function (i, item) {

            var className = item.className ;
            var hasSelectedRow = className.slice(-11);

            if(hasSelectedRow == 'selectedRow') {
                item.className = className.substring(0, className.length - 11);
            }
        });
        $(itemSelected).addClass('selectedRow');
    }

    function sendRequestToCreateNewChart() {

        swal({
                title: "The patient: " + nameOfPatiengGlog + ' ' + surnameOfPatiengGlog + " does'nt have any chart",
                text: "Do you want to create a new chart ?",
                type: "info", showCancelButton: true,
                confirmButtonColor: "#DD6B55", confirmButtonText: "Yes, i want!",
                closeOnConfirm: true
            },
            function () {


                var data = {idPatient: id_patient, _token: token};

                ajaxRequest('POST', createNewChart, data,
                    function (msg) {

                        openTheFirstChart(msg);
                    });
            }
        );
    }

    // create new Chart
    $('#btnCreateNewChart').click(function() {

        $($(this)).prop('disabled', true);

        var data = {idPatient: id_patient, _token: token};

        ajaxRequest('POST', createNewChart, data,
            function (msg) {

                $($(this)).prop('disabled', false);

                sweetAlert("New chart created", "", "success");

                checkIfPatientHasChart();
            });
    });

    function openTheFirstChart(chartObj) {

        idChartGlob = chartObj.id;

        $('#chartsModal').modal({backdrop: 'static', keyboard: false});
        
    }

    // Putting a trigger when change the value can call this method here
    $('#id_patient_hidden').change(function () {
        id_patient = $(this).val();
    });

    function actionAfterCreatedTable() {

        // select automaticlly the first row
        $('#populateListCures tr:first').addClass('selectedRow');

        // set css if is selected once
        $('#populateListCures tr, #populateListCharts tr').click(function(){

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
        // A bug not resolved open first row default, push to create this row, work well
        // openSelectedCureModal(listCuresScope[0].id);
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
            // $(this).closest('table').find(' tbody tr:first').attr('id');
            var idItemSelected =  $('#populateListCures > tr.selectedRow td')[0].innerText;
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

    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    // Visibility of Chart Teeths
    $('#isVisibleChartTeeths').on('ifChecked', function () {

        $('#isVisibleImageOfChart').hide();
        $('#isVisibleChartText').html('Click to show the chart');

        $('#divChartModalGeneralData').removeClass("col-sm-9").addClass("col-sm-12");

    });

    $('#isVisibleChartTeeths').on('ifUnchecked', function () {

        $('#isVisibleImageOfChart').show();
        $('#isVisibleChartText').html('Click to hide the chart');

        $('#divChartModalGeneralData').removeClass("col-sm-12").addClass("col-sm-9");
    });

});