@extends('layouts.admin',
    ['title'=> 'Calendar Panel', 'subTitle'=>'Calendar',
     'activeOpen'=> 'CalendarPanel', 'activeOpenSub'=> 'Calendar',
     'website'=>\App\Option::findOrFail(1)->value])

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

    {{--EDIT MODEL--}}
    <div class="modal inmodal fade" id="calendarModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title pull-left">Update event</h4>
                </div>
                <form id="updateEventForm">
                    <div class="modal-body">

                        <div class="row" id="rowUpdateModalDataAtr" data-eventId="">

                            <div class="form-group ">
                                {!! Form::label('name', 'Name', ['class'=>'control-label']) !!}
                                {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Name']) !!}
                                @include('includes.form-error-specify', ['field'=>'name', 'typeAlert'=>'danger'])
                            </div>

                            <div class="form-group ">
                                {!! Form::label('title', 'Title', ['class'=>'control-label']) !!}
                                {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Title']) !!}
                                @include('includes.form-error-specify', ['field'=>'title', 'typeAlert'=>'danger'])
                            </div>

                            <div class="form-group ">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="time" id="time"
                                           placeholder="Select your time">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                {{--END FORM--}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-sm" id="btnCreateEvent">Create event</button>
                    <button type="button" class="btn btn-danger btn-sm" id="btnDeleteEvent">Delete event</button>
                    <button type="button" class="btn btn-primary btn-sm" id="btnUpdateEvent">Update event</button>
                    <button type="button" class="btn btn-white btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{--END EDIT MODAL--}}

@endsection

@section('myScript')

    <script>

        $(document).ready(function () {

            var base_url = '{{ url('/') }}';

            var $btnDeleteGlob = $('#btnDeleteEvent').hide();
            var $btnUpdateGlob = $('#btnUpdateEvent').hide();
            var $btnCreateGlob = $('#btnCreateEvent').hide();

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
                    url: base_url + '/calendarAjax',
                    error: function () {
                        alert("cannot load json");
                    }
                },
                eventClick: function (event, jsEvent, view) {
                    $('#name').val(event.nameModal);
                    $('#title').val(event.titleModal);

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
            var url = '{{ route('api/updateEventAjax') }}';
            var urlDeleteEvent = '{{ route('api/deleteEventAjax') }}';
            var urlCreateEvent = '{{ route('api/createEventAjax') }}';


            $('#btnUpdateEvent').click(function () {

                var eventId = $('#rowUpdateModalDataAtr').data('eventId');

                $.ajax({
                    method: 'POST',
                    url: urlCreateEvent,
                    data: {
                        name: $('#name').val(),
                        title: $('#title').val(),
                        time: $('#time').val(),
                        _token: token
                    }
                })
                    .done(function (msg) {
                        $('#calendarModal').modal('hide');
                        $('#calendar').fullCalendar('refetchEvents');
                        console.log(JSON.stringify(msg));
                    });
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

                $('#name').val('');
                $('#title').val('');
                $('#time').val('{{ old('time') }}');
                $('.modal-title').text('Create Event');

                $btnDeleteGlob.hide();
                $btnUpdateGlob.hide();
                $btnCreateGlob.show();

                $('#calendarModal').modal({backdrop: 'static', keyboard: false});
            });

            $('#btnCreateEvent').click(function () {

                $.ajax({
                    method: 'POST',
                    url: urlCreateEvent,
                    data: {
                        name: $('#name').val(),
                        title: $('#title').val(),
                        time: $('#time').val(),
                        _token: token
                    }
                })
                    .done(function (msg) {
                        $('#calendarModal').modal('hide');
                        $('#calendar').fullCalendar('refetchEvents');
                        console.log(JSON.stringify(msg));
                    });
            });

        });

    </script>

@endsection