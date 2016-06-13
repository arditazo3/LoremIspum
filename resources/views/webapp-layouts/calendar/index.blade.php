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
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="calendar.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="calendar.html#">Config option 1</a>
                            </li>
                            <li><a href="calendar.html#">Config option 2</a>
                            </li>
                        </ul>
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

@endsection

@section('myScript')

    <script>

        $(document).ready(function () {

            var base_url = '{{ url('/') }}';

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
                }
            });
        });

    </script>

@endsection