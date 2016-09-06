@if(!$isPage)
<div class="modal inmodal fade" id="chartsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-larger">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title pull-left">Chart panel</h4>
            </div>
            <div class="modal-body">
@endif
                <div class="row">

                    <div class="col-sm-9 b-r" id="divChartModalGeneralData">

                        <div class="panel blank-panel">

                            <div class="panel-options">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1">First Tab</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-2">Second Tab</a></li>
                                </ul>
                            </div>

                            <div class="">

                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        @include('webapp-layouts.patient.chart_modal.list_cures')

                                        <div class="row" style="margin: 1px; border: 1px solid #80a7a3; padding-top: 5px;">

                                            <div class="col-sm-1 b-r" style="text-align: center">
                                                <b>Currency</b>
                                                <h1>&euro;</h1>
                                                <input type="hidden" id="currencyHide" value="1" />
                                            </div>

                                            <div class="col-sm-3 b-r">
                                                <div class="form-group ">
                                                    <p>Over budget</p>
                                                    <b id="idOverBudget">Test</b>
                                                </div>
                                                <div class="form-group ">
                                                    <p>Budget</p>
                                                    <b id="idBudget">Test</b>
                                                </div>
                                            </div>

                                            <div class="col-sm-2 b-r">
                                                <div class="form-group ">
                                                    <p>To perform</p>
                                                    <b id="idToPerform">Test</b>
                                                </div>
                                                <div class="form-group ">
                                                    <p>Performed</p>
                                                    <b id="idPerformed">Test</b>
                                                </div>
                                            </div>

                                            <div class="col-sm-2 b-r">
                                                <div class="form-group ">
                                                    <p>Paid</p>
                                                    <b id="idPaid">Test</b>
                                                </div>
                                            </div>

                                            <div class="col-sm-1 b-r">
                                                <div class="form-group ">
                                                    <p>Discount</p>
                                                    <b id="idDiscount">Test</b>
                                                </div>
                                            </div>

                                            <div class="col-sm-3 b-r">
                                                <div class="form-group ">
                                                    <p>Total payment</p>
                                                    <b id="idTotalPayment">Test</b>
                                                </div>
                                                <div class="form-group ">
                                                    <p>Payment</p>
                                                    <b id="idPayment">Test</b>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div id="tab-2" class="tab-pane">
                                        <strong>Donec quam felis</strong>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>


                    <div class="col-sm-3 b-r" id="isVisibleImageOfChart">
                        @include('webapp-layouts.patient.chart_modal.teeth_chart_image')
                    </div>

                    <div class="checkbox i-checks pull-right" style="padding-right: 2%"><label class="">
                            <div class="icheckbox_square-green" style="position: relative;">
                                <input type="checkbox" value="" id="isVisibleChartTeeths" style="position: absolute; opacity: 0;">
                                <ins class="iCheck-helper"
                                     style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                            </div>
                            <span id="isVisibleChartText">Click to hide the chart</span></label></div>

                </div>

         @if(!$isPage)
            </div>
         @endif

            <div class="modal-footer">

                <div class="btn btn-sm btn-info" id="editSelectedCure"><i class="fa fa-edit"></i> Edit</div>
                <div class="btn btn-sm btn-danger" id="deleteSelectedCure"><i class="fa fa-remove"></i> Delete</div>
                <button type="submit" class="btn btn-success btn-sm" id="btnCreateCureFromChart">Create cure</button>

                @if(!$isPage)
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                @endif

@if(!$isPage)
        </div>
    </div>
</div>
@endif