<div class="modal inmodal fade" id="chartsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-larger">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title pull-left">Chart panel</h4>
            </div>
            <div class="modal-body">

                <div class="row">

                    <div class="col-sm-9 b-r">

                        <div class="panel blank-panel">

                            <div class="panel-options">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1">First Tab</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-2">Second Tab</a></li>
                                </ul>
                            </div>

                            <div class="panel-body">

                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        @include('webapp-layouts.patient.chart_modal.list_cures')

                                        <div class="inline pull-left">
                                            <div class="btn btn-small btn-info" id="editSelectedCure"><i class="fa fa-edit"></i> Edit
                                            </div>
                                            <div class="btn btn-small btn-danger" id="deleteSelectedCure"><i class="fa fa-remove"></i> Delete
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


                    <div class="col-sm-3 b-r">
                        @include('webapp-layouts.patient.chart_modal.teeth_chart_image')
                    </div>

                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-info btn-sm" id="btnCreateCureFromChart">Create cure</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>