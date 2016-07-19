{{-- AGENDA MODAL --}}
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
                            {!! Form::label('', 'Scheduler time', ['class'=>'control-label']) !!}
                            <div class="input-group">
                                <input type="text" class="form-control" name="time" id="time"
                                       placeholder="Select your time">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            @include('includes.form-error-specify', ['field'=>'time', 'typeAlert'=>'danger'])
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
{{--END AGENDA MODAL--}}