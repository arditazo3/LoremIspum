<div class="modal inmodal fade" id="cureModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-larger">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title pull-left">Cure panel</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-2 b-r">
                        <b>Type:</b>

                        @foreach($typeCure as $typeTheCure)
                            <div class="radio i-checks"><label> <input type="radio"  {{ $typeTheCure->order == 1 ? 'checked=""' : '' }} value="{{ $typeTheCure->value }}"
                                                                       name="{{ $typeTheCure->des_dom }}"> <i></i> {{ $typeTheCure->description }} </label></div>
                        @endforeach


                    </div>

                    <div class="col-sm-2 b-r">
                        <b>Status:</b>

                        @foreach($statusCure as $statusTheCure)
                            <div class="radio i-checks"><label> <input type="radio"  {{ $statusTheCure->order == 1 ? 'checked=""' : '' }} value="{{ $statusTheCure->value }}"
                                                                       name="{{ $statusTheCure->des_dom }}"> <i></i> {{ $statusTheCure->description }} </label></div>
                        @endforeach

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
                                    <input class="datepicker form-control" data-date-format="dd/mm/yyyy" value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}"
                                           id="date_cure" name="dateCure" >
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
                            {!! Form::label('user', 'Proffession', ['class'=>'control-label']) !!}
                            <div class="divProffession">
                                {!! Form::select('user', ['0'=>'Select...'] + $listUsers, null, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-1 b-r" style="text-align: center">
                        <b>Currency</b>
                        <h1>&euro;</h1>
                    </div>

                    <div class="col-sm-2 b-r">
                        <div class="form-group ">
                            {!! Form::label('price', 'Prize', ['class'=>'control-label']) !!}
                            {!! Form::text('price', null, ['class'=>'form-control', 'style'=>'text-align: right;']) !!}
                            @include('includes.form-error-specify', ['field'=>'price', 'typeAlert'=>'danger'])
                        </div>
                    </div>

                    <div class="col-sm-2 b-r">
                        <div class="form-group ">
                            {!! Form::label('amount', 'Amount', ['class'=>'control-label']) !!}
                            {!! Form::text('amount', null, ['class'=>'form-control', 'style'=>'text-align: right;']) !!}
                            @include('includes.form-error-specify', ['field'=>'amount', 'typeAlert'=>'danger'])
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-4 b-r">

                        @include('includes.myPieces.patient.jsTree', ['listCures'=> $listCures])

                    </div>

                    <div class="col-sm-8 b-r">

                        <div style="position: relative; width: 90%; height: 280px;">
                            <img src="{{ $website . 'images/teeths/teeth-chart-line.jpg' }}" alt="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                        </div>

                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>