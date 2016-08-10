$(document).ready(function () {

    var id_patient;
    // var $divFirstControlGlob = $('#divFirstControl').hide();
    // var $divLastControlGlob = $('#divLastControl').hide();

    // open Modal of Charts patient when button is clicked
    $('#btnCharts').click(function () {

        $('#chartsModal').modal({backdrop: 'static', keyboard: false});
        console.log('Open Modal Charts Panel');
    });
    
    // Putting a trigger when change the value can call this method here
    $('#id_patient_hidden').change(function () {
        id_patient = $(this).val();
    });


});





