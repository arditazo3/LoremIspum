@extends('layouts.admin',
    ['title'=> 'Calendar Panel', 'subTitle'=>'Create event',
     'activeOpen'=> 'CalendarPanel', 'activeOpenSub'=> 'NewCalendar',
     'website'=>\App\Option::findOrFail(1)->value])

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit event</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        {!! Form::open(['method'=>'POST', 'action'=>'CalendarController@store']) !!}

                        <div class="form-group ">
                            {!! Form::label('name', 'Name', ['class'=>'control-label']) !!}
                            {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'First name']) !!}
                            @include('includes.form-error-specify', ['field'=>'name', 'typeAlert'=>'danger'])
                        </div>

                        <div class="form-group ">
                            {!! Form::label('title', 'Title', ['class'=>'control-label']) !!}
                            {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'First name']) !!}
                            @include('includes.form-error-specify', ['field'=>'title', 'typeAlert'=>'danger'])
                        </div>


                        <div class="form-group ">
                            <div class="input-group">
                                <input type="text" class="form-control" name="time" placeholder="Select your time" value="{{ old('time') }}">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>


                        {!! Form::submit('Update event', ['class'=>'btn btn-primary btn-sm']) !!}

                        {!! Form::close() !!}
                        {{--END FORM--}}
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('myScript')

    <script type="text/javascript">
        $(function() {
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
    </script>

@endsection