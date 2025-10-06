<link rel="stylesheet" href="tadi/prof/css_tadi.css">
<style>
    .select-shadow {
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
    }

    .button-bg-change {
        background-color: #EEEEF6;
        transition: background-color 0.1s ease;
        border: 1px solid transparent;
        border-color: #181a46;
    }

    .button-bg-change:hover {
        background-color: #181a46;
        color: white;
    }

    .button-search-bg-change {
        background-color: #181a46;
        transition: background-color 0.1s ease;
        border: 1px solid transparent;
        color: white;
    }

    .button-search-bg-change:hover {
        background-color: black;
        color: white;
    }

    .dte_srch {
        width: 12rem;
    }

    .srchdte,
    .acknw,
    .viewAttch,
    .profUploadBtn {
        background-color: #181a46;
        color: white;
    }

    .log_tbl {
        text-align: center;
    }

    .upldprof {
        background-color: rgba(51, 212, 137, 1);
        color: black
    }

    .modal-backdrop.show {
        z-index: 1050;
    }

    #imageModal {
        z-index: 1060;
    }

    .img_details {
        padding: 5px;
        display: flex;
        flex-direction: column;
    }

    .imgDetails {
        font-size: 13px;
    }

    .modalHead {
        display: flex;
        flex-direction: row-reverse;
        padding: 5px;
    }

    .activity-text {
        white-space: pre-wrap;
        word-wrap: break-word;
        max-width: 600px;
        display: inline-block;
        text-align: left;
    }

</style>

<section>
    <div class="card ms-3 me-3 mt-5">
        <div class="container-fluid mt-4">
            <div class="m-2">
                <h3>TADI - Professor</h3>
            </div>
            <div class="row justify-content-center align-items-center g-3 mt-4">
                <div class="col-md">
                    <select class="form-select border border-dark select-shadow" id="academiclevel" style="background-color: #EEEEF6;" name="academiclevel">
                        <option value="" disabled selected>Status Level</option>
                    </select>
                </div>
                <div class="col-md">
                    <select class="form-select border border-dark select-shadow" id="academicYearLevel" style="background-color: #EEEEF6;" name="academicYearLevel">
                        <option value="" disabled selected>Year Level</option>
                    </select>
                </div>
                <div class="col-md">
                    <select class="form-select border border-dark select-shadow" id="period" style="background-color: #EEEEF6;" name="period">
                        <option value="" disabled selected>Period</option>
                    </select>
                </div>
                <div class="col-md">
                    <select class="form-select border border-dark select-shadow" id="acadyear" style="background-color: #EEEEF6;" name="acadyear">
                        <option value="" disabled selected>School Year</option>
                    </select>
                </div>
                <div class="col-md">
                    <input type="text" class="form-control" id="subjectSearch" name="subjectCode" style="background-color: #EEEEF6;" placeholder="Subject Code">
                </div>
                <div class="col-md">
                    <button type="button" class="btn w-100" style="background-color: #181a46; color: white;" id="searchButton">Search</button>
                </div>
            </div>

            <div class="my-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Records</h4>
                        <table class="table table-bordered table-hover mt-3" style="line-height: 2.5; border-color: rgb(157, 157, 157);">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col" style="background-color: #181a46; color: white;">Section</th>
                                    <th scope="col" style="background-color: #181a46; color: white;">Subject Code</th>
                                    <th scope="col" style="background-color: #181a46; color: white;">Description</th>
                                    <th scope="col" style="background-color: #181a46; color: white;"></th>
                                </tr>
                            </thead>
                            <tbody class="prof_dashboard_table">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="sectionList" tabindex="-1" aria-labelledby="tadiModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" style="max-width:95%;">
                <div class="modal-content">

                    <div class="modal-header d-flex justify-content-between align-items-start" style="background-color: #181a46; color: white;">
                        <div class="subject-info">
                            <h5 class="modal-title" id="subj_name">Subject_Desc Placeholder</h5>
                            <p class="subject-details mb-0" id="subj_code">Section Placeholder</p>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" id="closeTadiModal1"></button>
                    </div>
                    <div class="modal-body">
                        <label for="strtDateSearch">BETWEEN</label>
                        <input type="date" class="dte_srch" id="strtDateSearch">
                        <label for="endDateSearch">AND</label>
                        <input type="date" class="dte_srch" id="endDateSearch" value="<?php echo date('Y-m-d'); ?>">
                        <button class="btn srchdte" id="date_srch">Search</button>
                        <div class="mt-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered log_tbl" style="line-height: 2.5; border-color: rgb(157, 157, 157); display: block; height: 400px; overflow-y: auto; width:100%;" id="rcrd_tbl">
                                            <thead style="background-color: #181a46; color: white; width:100%;">
                                                <tr style="position: sticky; top: 0;">
                                                    <th scope="col" style="color: white; width:20%;">Date</th>
                                                    <th scope="col" style="color: white; width:20%;">Student Name</th>
                                                    <th scope="col" style="color: white; width:20%;">Learning Modality</th>
                                                    <th scope="col" style="color: white; width:20%;">Session Type</th>
                                                    <th scope="col" style="color: white; width:15%;">Time</th>
                                                    <th scope="col" style="color: white; width:10%;">Attachment</th>
                                                    <th scope="col" style="color: white; width:10%;"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="rcrd_tbl_body" class="student_tadi_list_table" style="width:100%">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- VIEW IMAGE MODAL -->
        <div id="imageModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modalHead">
                        <button type="button" class="btn-close" id="closeModalBtn"></button>
                    </div>
                    <div class="modal-body">
                        <div style="text-align:center">
                            <img id="attchPrev" src="" alt="Image Preview" class="img-fluid" />
                        </div>
                        <div class="img_details">
                            <div class="imgDetails img-taken">
                                <div id="dateTimeTaken"></div>
                            </div>
                            <div class="imgDetails img-uploaded">
                                <div id="dateTimeUpld"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- UPLOAD MODAL -->
        <div id="uploadModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Upload Image</h5>
                        <button type="button" class="btn-close" id="uploadcloseModalBtn"></button>
                    </div>
                    <div class="modal-body text-center row align-items-center justify-content-center">
                        <div class="col-md">
                            <input type="file" class="form-control profUpload" name="attach" id="attach" accept=".jpg,.jpeg,.png">
                        </div>
                        <div class="col-md-3">
                            <button id="profUploadBtn" class="btn profUploadBtn" value="">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="tadi/prof/view/index-function.js?t=<?php echo time(); ?>"></script>
<script src="tadi/prof/view/index-script.js?t=<?php echo time(); ?>"></script>