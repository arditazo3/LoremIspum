@extends('layouts.admin',
    ['title'=> 'Calendar Panel', 'subTitle'=>'Calendar',
     'activeOpen'=> 'CalendarPanel', 'activeOpenSub'=> 'Calendar',
     'website'=>\App\Option::findOrFail(1)->value])

@section('myCSS')
    @include('includes.myCSS.fullcalendarCSS')
    @include('includes.myCSS.sweetalertCSS')
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-12">

            @if(\Illuminate\Support\Facades\Session::has('deleted_event'))
                @include('includes.notification-alert', ['alert_type'=> 'danger col-md-12', 'msg'=> session('deleted_event')])
            @elseif(\Illuminate\Support\Facades\Session::has('updated_event'))
                @include('includes.notification-alert', ['alert_type'=> 'warning col-md-12', 'msg'=> session('updated_event')])
            @elseif(\Illuminate\Support\Facades\Session::has('created_event'))
                @include('includes.notification-alert', ['alert_type'=> 'success col-md-12', 'msg'=> session('created_event')])
            @endif

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>The calendar</h5>
                    <div class="ibox-tools">
                        <button type="button" class="btn btn-info btn-sm" id="btnOpenCreateEventModal">New event</button>
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- EDIT MODAL --}}
    <div class="modal inmodal fade" id="calendarModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title pull-left">Update event</h4>
                </div>
                <form id="formCreateUpdateEvent">
                    <div class="modal-body">

                        <div class="row" id="rowUpdateModalDataAtr" data-eventId="">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-5">
                                        {!! Form::label('first_name', 'First name', ['class'=>'control-label']) !!}
                                        {!! Form::text('first_name', null, ['class'=>'form-control', 'placeholder'=>'First name', 'disabled']) !!}
                                        @include('includes.form-error-specify', ['field'=>'first_name', 'typeAlert'=>'danger'])
                                    </div>
                                    <div class="col-sm-5">
                                        {!! Form::label('last_name', 'Last name', ['class'=>'control-label']) !!}
                                        {!! Form::text('last_name', null, ['class'=>'form-control', 'placeholder'=>'Last name', 'disabled']) !!}
                                        @include('includes.form-error-specify', ['field'=>'last_name', 'typeAlert'=>'danger'])
                                    </div>

                                    <input type="hidden" name="id_patient" id="modal_id_patient">

                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#searchModal" data-backdrop="static" data-keyboard="false"
                                                id="searchPatientsModal" style="margin-top: 25px">
                                            <i class="fa fa-search"></i> Search
                                        </button>
                                    </div>

                                </div>
                                @include('includes.form-error-specify', ['field'=>'title', 'typeAlert'=>'danger'])
                            </div>

                            <div class="form-group ">
                                {!! Form::label('title', 'Title', ['class'=>'control-label']) !!}
                                {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Title']) !!}
                                @include('includes.form-error-specify', ['field'=>'title', 'typeAlert'=>'danger'])
                            </div>

                            <div class="form-group ">
                                {!! Form::label('content', 'Content', ['class'=>'control-label']) !!}
                                {!! Form::textarea('content', null, ['class'=>'form-control',
                                    'rows'=>'3', 'placeholder'=>'Put the content here...']) !!}
                                @include('includes.form-error-specify', ['field'=>'content', 'typeAlert'=>'danger'])
                            </div>

                            <div class="form-group ">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="time" id="time"
                                           placeholder="Select your time">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                </div>
                                @include('includes.form-error-specify', ['field'=>'time', 'typeAlert'=>'danger'])
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info btn-sm" id="btnCreateEvent">Create event</button>
                        <button type="button" class="btn btn-danger btn-sm" id="btnDeleteEvent">Delete event</button>
                        <button type="submit" class="btn btn-primary btn-sm" id="btnUpdateEvent">Update event</button>
                        <button type="button" class="btn btn-white btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
                {{--END FORM--}}
            </div>
        </div>
    </div>
    {{--END EDIT MODAL--}}

    {{--SEARCH MODAL--}}
    <div class="modal inmodal fade" id="searchModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title pull-left">Search patient</h4>
                </div>
                <div class="modal-body">

                    <table class="table table-striped table-bordered table-hover dataTables-example"
                           id="tableAllPatients">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Company name</th>
                            <th>Address</th>
                            <th>City</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{--END SEARCH MODAL--}}

    @include('includes.myPieces.modal.modal_notification_msg', ['typeMsg'=>'danger'])

@endsection

@section('myScript')

    @include('includes.myScript.datatablesJS')
    @include('includes.myScript.fullcalendarJS')
    @include('includes.myScript.toastr')
    @include('includes.myScript.jquery_validate')
    @include('includes.myScript.sweetalertJS')

    <script>

        $(document).ready(function () {

            var base_url = '{{ url('/') }}';

            var $btnDeleteGlob = $('#btnDeleteEvent').hide();
            var $btnUpdateGlob = $('#btnUpdateEvent').hide();
            var $btnCreateGlob = $('#btnCreateEvent').hide();

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var allPatientsDataGlob = '';

            $('#calendar').fullCalendar({
                weekends: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: false,
                eventLimit: true, // allow "more" link when too many events
                events: {
                    url: base_url + '/api/allEventsAjax',
                    error: function () {
                        alert("cannot load json");
                    }
                },
                eventClick: function (event, jsEvent, view) {
                    $('#first_name').val(event.first_name);
                    $('#last_name').val(event.last_name);
                    $('#title').val(event.titleModal);
                    $('#content').val(event.contentModal);
                    $('#modal_id_patient').val(event.id_patient);

                    showDateConverted(event.start, event.end);

                    $('#rowUpdateModalDataAtr').data('eventId', event.id);
                    $('#calendarModal').modal({backdrop: 'static', keyboard: false});

                    // create/update event will show and hide these btns
                    $btnDeleteGlob.show();
                    $btnUpdateGlob.show();
                    $btnCreateGlob.hide();
                    $('.modal-title').text('Update/Delete Event');
                }
            });


            // set the value correct to start and end of dateRangePicker
            function showDateConverted(start, end) {

                $("#time").data('daterangepicker').setStartDate(convertDate(start));
                $("#time").data('daterangepicker').setEndDate(convertDate(end));
            }

            // convert the date to correct format
            function convertDate(date) {

                var dateTime = new Date(date);
                dateTime = moment(dateTime).utc().format("DD/MM/YYYY HH:mm:ss");

                return dateTime;
            }

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

            /**
             * update/delete/create event with AJAX
             **/
            var token = '{{ \Illuminate\Support\Facades\Session::token() }}';
            var urlUpdateEvent = '{{ route('api/updateEventAjax') }}';
            var urlDeleteEvent = '{{ route('api/deleteEventAjax') }}';
            var urlCreateEvent = '{{ route('api/createEventAjax') }}';
            var urlAllPatients = '{{ route('api/allPatientsAjax') }}';

            $('#btnUpdateEvent').click(function (event) {
                event.preventDefault();

                var eventId = $('#rowUpdateModalDataAtr').data('eventId');
                if (validateFieldsIfEmpty()) {
                    $.ajax({
                        method: 'POST',
                        url: urlUpdateEvent,
                        data: {
                            title: $('#title').val(),
                            content: $('#content').val(),
                            time: $('#time').val(),
                            _token: token,
                            id_patient: $('#modal_id_patient').val(),
                            id: eventId
                        }
                    })
                    .error(function (msg) {
                        $('#calendarModal').modal('hide');
                        $('#calendar').fullCalendar('refetchEvents');

                        $('#myModalNotifyMsg').modal({backdrop: 'static', keyboard: false});
                        // set and/or replace the html code inside it
                        $("#notificationMsg").html( msg.responseText );
                    })
                    .done(function (msg) {
                        $('#calendarModal').modal('hide');
                        $('#calendar').fullCalendar('refetchEvents');
                        console.log(JSON.stringify(msg));
                    });
                }
            });

            $('#btnDeleteEvent').click(function () {

                var eventId = $('#rowUpdateModalDataAtr').data('eventId');

                $.ajax({
                    method: 'POST',
                    url: urlDeleteEvent,
                    data: {
                        id: eventId,
                        _token: token
                    }
                })
                    .done(function (msg) {
                        $('#calendarModal').modal('hide');
                        $('#calendar').fullCalendar('refetchEvents');
                        console.log(JSON.stringify(msg));
                    });

            });

            // Hide update and delete button and open modal
            $('#btnOpenCreateEventModal').click(function () {

                $('#first_name').val('');
                $('#last_name').val('');
                $('#title').val('');
                $('#content').val('');
                $('#time').val('{{ old('time') }}');
                $('.modal-title').text('Create Event');

                $btnDeleteGlob.hide();
                $btnUpdateGlob.hide();
                $btnCreateGlob.show();

                $('#calendarModal').modal({backdrop: 'static', keyboard: false});
            });

            $('#btnCreateEvent').click(function (event) {
                event.preventDefault();

                if ( validateFieldsIfEmpty() ) {
                    $.ajax({
                            method: 'POST',
                            url: urlCreateEvent,
                            data: {
                                title: $('#title').val(),
                                content: $('#content').val(),
                                time: $('#time').val(),
                                id_patient: $('#modal_id_patient').val(),
                                _token: token
                            }
                        })
                        .done(function (msg) {
                            $('#calendarModal').modal('hide');
                            $('#calendar').fullCalendar('refetchEvents');
                            console.log(JSON.stringify(msg));
                    });
                }

            });

            // Create Patient open list of patient when button is clicked
            $('#searchPatientsModal').click(function () {

                if (allPatientsDataGlob == '') {
                    // retrive all patients whith AJAX
                    $.ajax({
                        url: urlAllPatients,
                        type: 'GET',
                        paging: false,
                        searching: false,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function (data) {
                            console.log(data);
                            allPatientsDataGlob = data;
                            cicleDataPatientsAjax(data);
                        },
                        error: function () {
                            console.log('Error' + urlAllPatients);
                            console.log('CSRF_TOKEN' + CSRF_TOKEN);
                        },

                    });
                }
            });

            $('#tableAllPatients tbody').on( 'click', 'tr', function () {
                var table = $('#tableAllPatients').DataTable();

                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');

                    $.each($("#tableAllPatients tr.selected"),function(){
                        id = $(this).find('td').eq(0).text();
                        $('#searchModal').modal('hide');

                        formFillUpAllFields(id, allPatientsDataGlob);
                    });
                    //    console.log(id);
                }
            });


        });

        $('#formCreateUpdateEvent').validate({
            rules: {
                title: {
                    required: true
                },
                content: {
                    required: true
                },
                time: {
                    required: true
                },
                id_patient: {
                    required: true
                }
            },

            messages: {
                title: "Please enter the title",
                content: "Please enter the content",
                time: "Please enter the time",
                id_patient: "Please enter the patient"
            }
        });

        // load the data to table
        function cicleDataPatientsAjax(data) {

            tableAllPatientsGlob =
                $('#tableAllPatients').DataTable( {
                    processing: true,
                    serverSide: true,
                    ajax: '{{ \App\Option::findOrFail(1)->value }}api/allPatientsAjax',
                    columns: [
                        { data: 'id_patient', name: 'id_patient' },
                        { data: 'first_name', name: 'first_name' },
                        { data: 'last_name', name: 'last_name' },
                        { data: 'company_name', name: 'company_name' },
                        { data: 'address', name: 'address' },
                        { data: 'city', name: 'city' },
                    ]
                });
        }

        function formFillUpAllFields(id, allPatientData) {

            var listPatientData = allPatientData.data;

            $.each(listPatientData, function( key, value ) {
                if (value.id_patient === id) {
                    console.log(value);

                    $('#first_name').val( value.first_name );
                    $('#last_name').val( value.last_name );
                    $('#modal_id_patient').val( value.id_patient );
                }
            });
        }

        function validateFieldsIfEmpty() {

            var validateBoolean = true;

            if ( $('#first_name').val() == '' ) { validateBoolean = false; }
            if ( $('#last_name').val() == '' ) { validateBoolean = false; }
            if ( $('#title').val() == '' ) { validateBoolean = false; }
            if ( $('#content').val() == '' ) { validateBoolean = false; }
            if ( $('#time').val() == '' ) { validateBoolean = false; }

            return validateBoolean;
        }

    </script>

@endsection