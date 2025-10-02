<section class="px-4">
    <h3>Search by Subject</h3>
    <hr>
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="row align-items-center mb-2">
                <div class="col-md-3">
                    <label for="acadlevel"><b>Level:</b></label>
                </div>
                <div class="col-md-9">
                    <select name="acadlevel" id="acadlevel" class="form-select"></select>
                </div>
            </div>
            <div class="row align-items-center mb-2">
                <div class="col-md-3">
                    <label for="acadyear"><b>Year:</b></label>
                </div>
                <div class="col-md-9">
                    <select name="acadyear" id="acadyear" class="form-select"></select>
                </div>
            </div>
            <div class="row align-items-center mb-2">
                <div class="col-md-3">
                    <label for="acadperiod"><b>Period:</b></label>
                </div>
                <div class="col-md-9">
                    <select name="acadperiod" id="acadperiod" class="form-select"></select>
                </div>
            </div>
            <div class="row align-items-center mb-2">
                <div class="col-md-3">
                    <label for="acadyearlevel"><b>Year Level:</b></label>
                </div>
                <div class="col-md-9">
                    <select name="acadyearlevel" id="acadyearlevel" class="form-select"></select>
                </div>
            </div>
            <div class="row align-items-center mb-2">
                <div class="col-md-3">
                    <label for="acadcourse"><b>Course:</b></label>
                </div>
                <div class="col-md-9">
                    <select name="acadcourse" id="acadcourse" class="form-select"></select>
                </div>
            </div>
            <div class="row align-items-center mb-2">
                <div class="col-md-3">
                    <label for="acadsection"><b>Section:</b></label>
                </div>
                <div class="col-md-9">
                    <select name="acadsection" id="acadsection" class="form-select"></select>
                </div>
            </div>
            <div class=""><input type="submit" id="btnSearch" class="btn btn-primary" value="Search"></div>
        </div>
        <div class="col-md-9">
            <table class="table table-bordered table-hover" style="border: solid 1px gray;">
                <thead class="bg-primary bg-opacity-25">
                    <th>#</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Unit</th>
                    <th>Schedule</th>
                    <th>Instructor</th>
                    <th>Action</th>
                </thead>
                <tbody id="table-body">
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="recordHistoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Grade Submission Tracker</h5>
                </div>
                <div class="modal-body">
                    <style>
                        .node {
                            height: 2rem;
                            width: 2rem;
                            background-color: var(--bs-gray-600);
                            z-index: 1;
                        }

                        .line {
                            /* height: .25rem; */
                            height: 10px;
                            margin-inline: -1px;
                            transform: rotate(180deg);
                        }

                        .line > div{
                            background-color: var(--bs-gray-600);
                        }

                        .legend {
                            font-size: .75rem;
                            font-weight: bold;
                        }
                    </style>
                    <div class="row m-auto justify-content-center mb-3" style="align-items: center;">
                        <div class="rounded-circle col-1 p-0 text-light node d-flex" id="node1"><i class="fa-solid fa-circle m-auto" id="icon1" style="font-size: 1.5rem;"></i></div>
                        <div class="progress rounded-0 col-2 px-0 line" id="line1">
                            <div class="progress-bar progress-bar-striped progress-bar-animated w-100" role="progressbar"></div>
                        </div>
                        <div class="rounded-circle col-1 p-0 text-light node d-flex" id="node2"><i class="fa-solid fa-circle m-auto" id="icon2" style="font-size: 1.5rem;"></i></div>
                        <div class="progress rounded-0 col-2 px-0 line" id="line2">
                            <div class="progress-bar progress-bar-striped progress-bar-animated w-100" role="progressbar"></div>
                        </div>
                        <div class="rounded-circle col-1 p-0 text-light node d-flex" id="node3"><i class="fa-solid fa-circle m-auto" id="icon3" style="font-size: 1.5rem;"></i></div>
                        <div class="progress rounded-0 col-2 px-0 line" id="line3">
                            <div class="progress-bar progress-bar-striped progress-bar-animated w-100" role="progressbar"></div>
                        </div>
                        <div class="rounded-circle col-1 p-0 text-light node d-flex" id="node4"><i class="fa-solid fa-circle m-auto" id="icon4" style="font-size: 1.5rem;"></i></div>
                    </div>
                    <div class="row m-auto justify-content-center mb-3" style="align-items: center;">
                        <div class="col-1" id=""></div>
                        <div class="col-2 legend" id="">Grades Encoded</div>
                        <div class="col-3 legend" id="">Approved by Dean</div>
                        <div class="col-3 legend" id="">Approved by Registrar</div>
                        <div class="col-2 legend" id="">Viewable to Students</div>
                        <div class="col-1" id=""></div>
                    </div>
                    <style>
                        #modal-table {border: solid 1px gray;}
                        #modal-table td, #modal-table th {font-size: .75rem !important;}
                    </style>
                    <table class="table table-bordered table-hover" id="modal-table">
                        <thead class="bg-primary bg-opacity-25">
                            <th>#</th>
                            <th style='width: 5rem;'>Date</th>
                            <th>Request Status</th>
                            <th class="d-none">Approver</th>
                        </thead>
                        <tbody id="history_body">
                        </tbody>

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
</section>

<script src="../../js/custom/grade-history-script.js?d=<?php echo time();?>"></script>