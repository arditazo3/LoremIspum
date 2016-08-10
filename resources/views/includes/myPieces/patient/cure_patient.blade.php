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

                    <div class="col-sm-3 b-r">

                        @include('includes.myPieces.patient.jsTree')

                    </div>

                    <div class="col-sm-9 b-r">

                        <div style="position: relative; width: 100%; height: 431px;">

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