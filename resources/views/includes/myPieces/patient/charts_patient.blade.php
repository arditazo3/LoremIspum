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


                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-5 m-b-xs"><select class="input-sm form-control input-s-sm inline">
                                        <option value="0">Option 1</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 m-b-xs">
                                    <div data-toggle="buttons" class="btn-group">
                                        <label class="btn btn-sm btn-white"> <input type="radio" id="option1"
                                                                                    name="options"> Day </label>
                                        <label class="btn btn-sm btn-white active"> <input type="radio" id="option2"
                                                                                           name="options"> Week </label>
                                        <label class="btn btn-sm btn-white"> <input type="radio" id="option3"
                                                                                    name="options"> Month </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group"><input type="text" placeholder="Search"
                                                                    class="input-sm form-control"> <span
                                                class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>S</th>
                                        <th>Date</th>
                                        <th>Code</th>
                                        <th>Description</th>
                                        <th>Teeth</th>
                                        <th>Amount</th>
                                        <th>Operator</th>
                                    </tr>
                                    </thead>
                                    <tbody id="populateListCures">


                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>

                    <div class="col-sm-3 b-r">

                        <div style="position: relative; width: 100%; height: 431px;">
                            <img src="{{ $website . 'images/teeths_chart/the_source1.jpg' }}" alt=""
                                 style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">

                            <img id="dent_teeth_32" src="{{ $website . 'images/teeths/321.png' }}" alt=""
                                 style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                            <img id="dent_teeth_31" src="{{ $website . 'images/teeths/311.png' }}" alt=""
                                 style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">

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