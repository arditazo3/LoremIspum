<div class="modal inmodal fade" id="listChartsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-larger">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title pull-left">Chart panel</h4>
            </div>
            <div class="modal-body">


                <div class="row" style="margin: 1px; border: 1px solid #80a7a3; padding-top: 5px;">

                    <div class="col-sm-1 b-r" style="text-align: center">
                        <b>Currency</b>
                        <h1>&euro;</h1>
                        <input type="hidden" id="currencyHide" value="1"/>
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

                <div class="row">
                    @include('webapp-layouts.patient.chart_modal.list_charts')
                </div>

            </div>

            <div class="modal-footer">

                <div class="btn btn-sm btn-info" id="editSelectedCure"><i class="fa fa-edit"></i> Edit</div>
                <div class="btn btn-sm btn-danger" id="deleteSelectedCure"><i class="fa fa-remove"></i> Delete</div>
                <button type="submit" class="btn btn-success btn-sm" id="btnCreateCureFromChart">Create cure</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
