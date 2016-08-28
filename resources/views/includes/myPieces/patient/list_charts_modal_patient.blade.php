<div class="modal inmodal fade" id="listChartsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-larger">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title pull-left">List chart panel</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    @include('webapp-layouts.patient.chart_modal.list_charts')
                </div>

            </div>

            <div class="modal-footer">

                <div class="btn btn-sm btn-info" id="openSelectedChart"><i class="fa fa-folder-open"></i> Open Selected</div>
                <button type="submit" class="btn btn-success btn-sm" id="btnCreateNewChart">Create Chart</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
