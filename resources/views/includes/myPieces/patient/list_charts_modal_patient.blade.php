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
                        <button type="submit" class="btn btn-success btn-sm" id="btnCreateNewChart">Create Chart</button>
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
