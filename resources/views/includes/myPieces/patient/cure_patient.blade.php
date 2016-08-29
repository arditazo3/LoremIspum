<div class="modal inmodal fade" id="cureModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-larger">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title pull-left">Cure panel</h4>
            </div>
            <form id="createUpdateCure">
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-2 b-r">

                        <input type="hidden" id="id_teeth_prizesHide" value="0" />
                        <input type="hidden" id="id_cure_hidden" />

                        <b>Type:</b>

                        @foreach($typeCure as $typeTheCure)
                            <div class="radio i-checks" id="{{ $typeTheCure->shortDesc }}"><label> <input type="radio"
                                                                       {{ $typeTheCure->order == 1 ? 'checked=""' : '' }} value="{{ $typeTheCure->shortDesc }}"
                                                                       name="{{ $typeTheCure->des_dom }}">
                                    <i></i> {{ $typeTheCure->description }} </label></div>
                        @endforeach


                    </div>

                    <div class="col-sm-2 b-r">
                        <b>Status:</b>

                        <div id="allChildrenStatusTheCure">
                        @foreach($statusCure as $statusTheCure)
                            <div class="radio i-checks" id="{{ $statusTheCure->shortDesc }}" ><label> <input type="radio"
                                                                       {{ $statusTheCure->order == 1 ? 'checked=""' : '' }} value="{{ $statusTheCure->shortDesc }}"
                                                                       name="{{ $statusTheCure->des_dom }}">
                                    <i></i> {{ $statusTheCure->description }} </label></div>
                        @endforeach
                        </div>

                    </div>

                    <div class="col-sm-2 b-r">

                        <div class="form-group ">
                            {!! Form::label('shortCode', 'Short code', ['class'=>'control-label']) !!}
                            {!! Form::text('shortCode', null, ['class'=>'form-control']) !!}
                            @include('includes.form-error-specify', ['field'=>'shortCode', 'typeAlert'=>'danger'])
                        </div>

                        <div class="form-group ">
                            {!! Form::label('dateCure', 'The date of cure', ['class'=>'control-label']) !!}

                            <div class="form-group" id="data_1">
                                <div class="input-group date">
                                                        <span class="input-group-addon"><i
                                                                    class="fa fa-calendar"></i></span>
                                    <input class="datepicker form-control" data-date-format="dd/mm/yyyy"
                                           value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}"
                                           id="date_cure" name="dateCure">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-6 b-r">

                        <div class="form-group ">
                            {!! Form::label('description', 'Description', ['class'=>'control-label']) !!}
                            {!! Form::text('description', null, ['class'=>'form-control']) !!}
                            @include('includes.form-error-specify', ['field'=>'description', 'typeAlert'=>'danger'])
                        </div>

                        <div class="form-group ">
                            {!! Form::label('descOfClient', 'Description of Client', ['class'=>'control-label']) !!}
                            {!! Form::text('descOfClient', null, ['class'=>'form-control']) !!}
                            @include('includes.form-error-specify', ['field'=>'descOfClient', 'typeAlert'=>'danger'])
                        </div>

                        <div class="form-group ">
                            {!! Form::label('userSelected', 'User selected', ['class'=>'control-label']) !!}
                            <div class="divUser">
                                {!! Form::select('userSelected', ['0'=>'Select...'] + $listUsers, null, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-1 b-r" style="text-align: center">
                        <b>Currency</b>
                        <h1>&euro;</h1>
                        <input type="hidden" id="currencyHide" value="1" />
                    </div>

                    <div class="col-sm-2 b-r">
                        <div class="form-group ">
                            {!! Form::label('price', 'Prize', ['class'=>'control-label']) !!}
                            {!! Form::number('price', null, ['class'=>'form-control',
                            'style'=>'text-align: right;font-weight: bold;', 'type'=>'number', 'min'=>'0', 'oninput'=>'validity.valid||(value="");']) !!}
                            @include('includes.form-error-specify', ['field'=>'price', 'typeAlert'=>'danger'])
                        </div>
                    </div>

                    <div class="col-sm-1  b-r" style="width: 11%">
                        <div class="teeth-widget style1 lazur-bg">
                            <div class="row vertical-align">
                                <div class="col-xs-4" text-center>
                                    <img src="{{ $website . 'images/patient_img/tooth-btn.png' }}" width="45"
                                         height="45">
                                </div>
                                <div class="col-xs-8 text-right " style="padding-top: 10%;">
                                    <h2 class="font-bold-teeth">0</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-1 b-r">
                        <div class="form-group ">
                            {!! Form::label('discount', 'Discount', ['class'=>'control-label']) !!}
                            {!! Form::number('discount', null, ['class'=>'form-control',
                            'style'=>'text-align: right;font-weight: bold;color: red;', 'min'=>'0', 'oninput'=>'validity.valid||(value="");']) !!}
                            @include('includes.form-error-specify', ['field'=>'discount', 'typeAlert'=>'danger'])
                        </div>
                    </div>

                    <div class="col-sm-2 b-r">
                        <div class="form-group ">
                            {!! Form::label('amount', 'Amount', ['class'=>'control-label']) !!}
                            {!! Form::number('amount', null, ['class'=>'form-control',
                            'style'=>'text-align: right;font-weight: bold;color: green;', 'disabled', 'type'=>'number', 'min'=>'0', 'oninput'=>'validity.valid||(value="");']) !!}
                            @include('includes.form-error-specify', ['field'=>'amount', 'typeAlert'=>'danger'])
                        </div>
                    </div>

                    <div class="col-sm-2 b-r">
                        <b style="padding-top: 10%">Select/Unselect all teeth</b>
                        <div class="form-group " style="padding-top: 4%">
                            <span style="display: inline;">
                                <button data-toggle="button" class="btn btn-primary btn-outline" type="button" aria-pressed="false" id="selectAllUp">
                                    <i class="fa fa-arrow-up"> <b>Up</b> </i>
                                </button>
                                <button data-toggle="button" class="btn btn-primary btn-outline" type="button" aria-pressed="false" id="selectAllDown">
                                    <i class="fa fa-arrow-down"> <b>Down</b> </i>
                                </button>
                            </span>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-4 b-r">

                        @include('includes.myPieces.patient.jsTree', ['listCures'=> $listCures])

                    </div>

                    <div class="col-sm-8 b-r">

                        <div id="teeth-group" style="position: relative; width: 100%; height: 350px;">
                            <img id="teeth" src="{{ $website . 'images/teeths_chart/teeth-chart-line-3.png' }}" alt=""
                                 style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">

                            {{-- Group of teeths overlayout --}}
                            <img id="teeth_1" src="{{ $website . 'images/teeths_chart/teeth_chart_group/1.png' }}"
                                 style="position: absolute; top: 6.3%; left: 3%; width: 6%; height: 35%;">

                            <img id="teeth_2" src="{{ $website . 'images/teeths_chart/teeth_chart_group/2.png' }}"
                                 style="position: absolute; top: 6.3%; left: 9.5%; width: 7%; height: 35%;">

                            <img id="teeth_3" src="{{ $website . 'images/teeths_chart/teeth_chart_group/3.png' }}"
                                 style="position: absolute; top: 6.3%; left: 17%; width: 7%; height: 35%;">

                            <img id="teeth_4" src="{{ $website . 'images/teeths_chart/teeth_chart_group/4.png' }}"
                                 style="position: absolute; top: 6.3%; left: 24.5%; width: 4.5%; height: 35%;">

                            <img id="teeth_5" src="{{ $website . 'images/teeths_chart/teeth_chart_group/5.png' }}"
                                 style="position: absolute; top: 6.3%; left: 30%; width: 4.5%; height: 35%;">

                            <img id="teeth_6" src="{{ $website . 'images/teeths_chart/teeth_chart_group/6.png' }}"
                                 style="position: absolute; top: 6.3%; left: 34.5%; width: 5%; height: 35%;">

                            <img id="teeth_7" src="{{ $website . 'images/teeths_chart/teeth_chart_group/7.png' }}"
                                 style="position: absolute; top: 6.3%; left: 40%; width: 4%; height: 35%;">

                            <img id="teeth_8" src="{{ $website . 'images/teeths_chart/teeth_chart_group/8.png' }}"
                                 style="position: absolute; top: 6.3%; left: 44.5%; width: 5%; height: 35%;">

                            <img id="teeth_9" src="{{ $website . 'images/teeths_chart/teeth_chart_group/9.png' }}"
                                 style="position: absolute; top: 6.3%; left: 49.8%; width: 5.3%; height: 35%;">

                            <img id="teeth_10" src="{{ $website . 'images/teeths_chart/teeth_chart_group/10.png' }}"
                                 style="position: absolute; top: 6.3%; left: 55%; width: 4%; height: 35%;">

                            <img id="teeth_11" src="{{ $website . 'images/teeths_chart/teeth_chart_group/11.png' }}"
                                 style="position: absolute; top: 6.3%; left: 60%; width: 5%; height: 35%;">

                            <img id="teeth_12" src="{{ $website . 'images/teeths_chart/teeth_chart_group/12.png' }}"
                                 style="position: absolute; top: 6.3%; left: 65%; width: 4.7%; height: 35%;">

                            <img id="teeth_13" src="{{ $website . 'images/teeths_chart/teeth_chart_group/13.png' }}"
                                 style="position: absolute; top: 6.3%; left: 70%; width: 4.7%; height: 35%;">

                            <img id="teeth_14" src="{{ $website . 'images/teeths_chart/teeth_chart_group/14.png' }}"
                                 style="position: absolute; top: 6.3%; left: 75%; width: 7%; height: 35%;">

                            <img id="teeth_15" src="{{ $website . 'images/teeths_chart/teeth_chart_group/15.png' }}"
                                 style="position: absolute; top: 6.3%; left: 83%; width: 6.5%; height: 35%;">

                            <img id="teeth_16" src="{{ $website . 'images/teeths_chart/teeth_chart_group/16.png' }}"
                                 style="position: absolute; top: 6.3%; left: 90%; width: 6%; height: 35%;">

                            {{------ DOWN ------}}
                            <img id="teeth_17" src="{{ $website . 'images/teeths_chart/teeth_chart_group/17.png' }}"
                                 style="position: absolute; top: 57%; left: 90.2%; width: 6.2%; height: 35%;">

                            <img id="teeth_18" src="{{ $website . 'images/teeths_chart/teeth_chart_group/18.png' }}"
                                 style="position: absolute; top: 57%; left: 82.8%; width: 7.5%; height: 35%;">

                            <img id="teeth_19" src="{{ $website . 'images/teeths_chart/teeth_chart_group/19.png' }}"
                                 style="position: absolute; top: 57%; left: 74.3%; width: 8%; height: 35%;">

                            <img id="teeth_20" src="{{ $website . 'images/teeths_chart/teeth_chart_group/20.png' }}"
                                 style="position: absolute; top: 57%; left: 69.6%; width: 4.5%; height: 35%;">

                            <img id="teeth_21" src="{{ $website . 'images/teeths_chart/teeth_chart_group/21.png' }}"
                                 style="position: absolute; top: 57%; left: 64.6%; width: 4.7%; height: 35%;">

                            <img id="teeth_22" src="{{ $website . 'images/teeths_chart/teeth_chart_group/22.png' }}"
                                 style="position: absolute; top: 57%; left: 59%; width: 5.3%; height: 35%;">

                            <img id="teeth_23" src="{{ $website . 'images/teeths_chart/teeth_chart_group/23.png' }}"
                                 style="position: absolute; top: 57%; left: 54%; width: 4.8%; height: 35%;">

                            <img id="teeth_24" src="{{ $website . 'images/teeths_chart/teeth_chart_group/24.png' }}"
                                 style="position: absolute; top: 57%; left: 49.8%; width: 4.1%; height: 35%;">

                            <img id="teeth_25" src="{{ $website . 'images/teeths_chart/teeth_chart_group/25.png' }}"
                                 style="position: absolute; top: 57%; left: 45.2%; width: 4.1%; height: 35%;">

                            <img id="teeth_26" src="{{ $website . 'images/teeths_chart/teeth_chart_group/26.png' }}"
                                 style="position: absolute; top: 57%; left: 40.5%; width: 4.5%; height: 35%;">

                            <img id="teeth_27" src="{{ $website . 'images/teeths_chart/teeth_chart_group/27.png' }}"
                                 style="position: absolute; top: 57%; left: 34.5%; width: 5.6%; height: 35%;">

                            <img id="teeth_28" src="{{ $website . 'images/teeths_chart/teeth_chart_group/28.png' }}"
                                 style="position: absolute; top: 57%; left: 30%; width: 4.7%; height: 35%;">

                            <img id="teeth_29" src="{{ $website . 'images/teeths_chart/teeth_chart_group/29.png' }}"
                                 style="position: absolute; top: 57%; left: 25.2%; width: 4.5%; height: 35%;">

                            <img id="teeth_30" src="{{ $website . 'images/teeths_chart/teeth_chart_group/30.png' }}"
                                 style="position: absolute; top: 57%; left: 17%; width: 8%; height: 35%;">

                            <img id="teeth_32" src="{{ $website . 'images/teeths_chart/teeth_chart_group/32.png' }}"
                                 style="position: absolute; top: 57%; left: 3%; width: 6.3%; height: 35%;">

                            <img id="teeth_31" src="{{ $website . 'images/teeths_chart/teeth_chart_group/31.png' }}"
                                 style="position: absolute; top: 57%; left: 9.3%; width: 7.4%; height: 35%;">

                        </div>

                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" id="btnDeleteCure">
                    <i class="fa fa-remove"></i> Delete cure
                </button>
                <button type="submit" class="btn btn-success btn-sm" id="btnUpdateCure">Update cure</button>
                <button type="submit" class="btn btn-info btn-sm" id="btnCreateCure">Create cure</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
            </form>

        </div>
    </div>
</div>