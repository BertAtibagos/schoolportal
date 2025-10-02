<section>
    <div id='errormessage'>
    </div>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link" id="nav-overall-tab" data-bs-toggle="tab" data-bs-target="#nav-overall" type="button" role="tab" aria-controls="nav-overall" aria-selected="true" hidden>Overall</button>
            <button class="nav-link" id="nav-g10-tab" data-bs-toggle="tab" data-bs-target="#nav-g10" type="button" role="tab" aria-controls="nav-g10" aria-selected="false" hidden>Grade 10</button>
            <button class="nav-link" id="nav-g11-tab" data-bs-toggle="tab" data-bs-target="#nav-g11" type="button" role="tab" aria-controls="nav-g11" aria-selected="false" hidden>Grade 11</button>
            <button class="nav-link" id="nav-g12-tab" data-bs-toggle="tab" data-bs-target="#nav-g12" type="button" role="tab" aria-controls="nav-g12" aria-selected="false" hidden>Grade 12</button>
            <button class="nav-link active" id="nav-individual-tab" data-bs-toggle="tab" data-bs-target="#nav-individual" type="button" role="tab" aria-controls="nav-individual" aria-selected="false">Individual</button>
            <button class="nav-link" id="nav-cluster-tab" data-bs-toggle="tab" data-bs-target="#nav-cluster" type="button" role="tab" aria-controls="nav-cluster" aria-selected="false" hidden>Cluster</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent" style='margin-top: 1rem;padding-bottom: 125px;'>
        <div class="tab-pane fade" id="nav-overall" role="tabpanel" aria-labelledby="nav-overall-tab" hidden>
            <div id="div-overall">
                <!-- <h4>Overall</h4> -->
                <div id="div-overall-analytics">

                </div>

                <hr>
                <div id="div-overall-table">

                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-g10" role="tabpanel" aria-labelledby="nav-g10-tab" hidden>
            <div id="div-g10">
                <!-- <h4>Grade 10</h4> -->
                <div id="div-g10-analytics">

                </div>
                <hr>
                <div id="div-g10-table">

                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-g11" role="tabpanel" aria-labelledby="nav-g11-tab" hidden>
            <div id="div-g11">
                <!-- <h4>Grade 11</h4> -->
                <div id="div-g11-analytics">

                </div>
                <hr>
                <div id="div-g11-table">

                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-g12" role="tabpanel" aria-labelledby="nav-g12-tab" hidden>
            <div id="div-g12">
                <!-- <h4>Grade 12</h4> -->
                <div id="div-g12-analytics">

                </div>
                <hr>
                <div id="div-g12-table">

                </div>
            </div>
        </div>
        <div class="tab-pane fade show active" id="nav-individual" role="tabpanel" aria-labelledby="nav-individual-tab">
            <div id="div-individual">
                <!-- <h4>Individual</h4> -->
                <div id="div-individual-analytics" class='col-md-6'>

                    <div id="dropdown-academic-level" class='col-md-4' style='padding-bottom: 1rem;'>
                        <select id='analytics-acadyrlvl' name='analytics-acadyrlvl' class='form-control' required>
                            <!-- <option value="ALL">ALL</option> -->
                            <option value="20">Grade 10</option>
                            <option value="21">Grade 11</option>
                            <option value="5">Grade 12</option>
                        </select>
                    </div>
                    <table class='table table-responsive table-bordered'>
                        <thead class='table-primary'>
                            <tr>
                                <th class='text-start'>Cluster: </th>
                                <th>Rank 1</th>
                                <th>Rank 2</th>
                                <th>Total</th>
                                <th colspan=2>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class='text-start'>Cluster 1: Healh Allied</td>
                                <td id='C1R1'></td>
                                <td id='C1R2'></td>
                                <td id='C1total'></td>
                                <td id='_1'><button class='btn btn-success btnViewStudents' style='font-size: 10px;' value='1'>1</button></td>
                                <td id='_1'><button class='btn btn-success btnViewStudents' style='font-size: 10px;' value='2'>2</button></td>
                            </tr>
                            <tr>
                                <td class='text-start'>Cluster 2: Arts & Communication</td>
                                <td id='C2R1'></td>
                                <td id='C2R2'></td>
                                <td id='C2total'></td>
                                <td id='_2'><button class='btn btn-success btnViewStudents' style='font-size: 10px;' value='1'>1</button></td>
                                <td id='_2'><button class='btn btn-success btnViewStudents' style='font-size: 10px;' value='2'>2</button></td>
                            </tr>
                            <tr>
                                <td class='text-start'>Cluster 3: Business & Management</td>
                                <td id='C3R1'></td>
                                <td id='C3R2'></td>
                                <td id='C3total'></td>
                                <td id='_3'><button class='btn btn-success btnViewStudents' style='font-size: 10px;' value='1'>1</button></td>
                                <td id='_3'><button class='btn btn-success btnViewStudents' style='font-size: 10px;' value='2'>2</button></td>
                            </tr>
                            <tr>
                                <td class='text-start'>Cluster 4: Public Service/Social/Behavioral Science/Humanities</td>
                                <td id='C4R1'></td>
                                <td id='C4R2'></td>
                                <td id='C4total'></td>
                                <td id='_4'><button class='btn btn-success btnViewStudents' style='font-size: 10px;' value='1'>1</button></td>
                                <td id='_4'><button class='btn btn-success btnViewStudents' style='font-size: 10px;' value='2'>2</button></td>
                            </tr>
                            <tr>
                                <td class='text-start'>Cluster 5: Engineering & Technology</td>
                                <td id='C5R1'></td>
                                <td id='C5R2'></td>
                                <td id='C5total'></td>
                                <td id='_5'><button class='btn btn-success btnViewStudents' style='font-size: 10px;' value='1'>1</button></td>
                                <td id='_5'><button class='btn btn-success btnViewStudents' style='font-size: 10px;' value='2'>2</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="div-individual-table">
                    <table id='table-individual' class='table table-hover table-responsive table-bordered' style='width: 100%; margin:0; padding:0;'>
                        <thead class='table-primary' id='thead-individual'>
                            <tr>
                                <th scope='col' style='width:0;'>#</th>
                                <th scope='col' style='text-align:left;' class='col-2'>STUD_NO</th>
                                <th scope='col' style='text-align:left;'>FULL NAME</th>
                                <th scope='col' style='' class='col-1'>YEAR LEVEL</th>
                                <th scope='col' style='' class='col-1'>SECTION</th>
                                <th scope='col' style='' class='col-1' hidden>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id='individual-no-result'>
                                <td colspan='99' style='font-size: 18px;
                                                            font-family: Roboto, sans-serif;
                                                            font-weight: normal;
                                                            text-decoration: none;
                                                            color: red;'> 
                                    NOTHING TO DISPLAY YET
                                    </td>
                            </tr>
                        </tbody>
                        <tbody id='tbody-individual'>
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
                <div id="div-individual-answer">
                    <button id='btnBack' name='btnBack' class='btn btn-primary' style='text-align:left; font-size:12px;'> Back </button>
                    <hr>
                    <!-- <h4>INDIVIDUAL ANSWER</h4> -->
                    <div id="div-individual-question"></div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-cluster" role="tabpanel" aria-labelledby="nav-cluster-tab" hidden>
            <div id="div-cluster">
                <nav>
                    <div class='nav nav-tabs' id='nav-tab' role='tablist'>
                        <button class='nav-link active' id='nav-cluster1-tab' data-bs-toggle='tab' data-bs-target='#nav-cluster1' type='button' role='tab' aria-controls='nav-cluster1' aria-selected='true'>Cluster 1</button>
                        <button class='nav-link' id='nav-cluster2-tab' data-bs-toggle='tab' data-bs-target='#nav-cluster2' type='button' role='tab' aria-controls='nav-cluster2' aria-selected='false'>Cluster 2</button>
                        <button class='nav-link' id='nav-cluster3-tab' data-bs-toggle='tab' data-bs-target='#nav-cluster3' type='button' role='tab' aria-controls='nav-cluster3' aria-selected='false'>Cluster 3</button>
                        <button class='nav-link' id='nav-cluster4-tab' data-bs-toggle='tab' data-bs-target='#nav-cluster4' type='button' role='tab' aria-controls='nav-cluster4' aria-selected='false'>Cluster 4</button>
                        <button class='nav-link' id='nav-cluster5-tab' data-bs-toggle='tab' data-bs-target='#nav-cluster5' type='button' role='tab' aria-controls='nav-cluster5' aria-selected='false' hidden>Cluster 5</button>
                    </div>
                </nav>
                <div class='tab-content' id='nav-tabContent' style='margin-top: 1rem;'>
                    <div class='tab-pane fade show active' id='nav-cluster1' role='tabpanel' aria-labelledby='nav-cluster1-tab'>
                        <div id='div-cluster1'>
                            <h4>Healh Allied</h4>
                            <div id="div-cluster1-analytics" hidden>

                            </div>
                            <hr>
                            <div id="div-cluster1-table">

                            </div>
                        </div>
                    </div>
                    <div class='tab-pane fade' id='nav-cluster2' role='tabpanel' aria-labelledby='nav-cluster2-tab'>
                        <div id='div-cluster2'>
                            <h4>Arts & Communication</h4>
                            <div id="div-cluster2-analytics" hidden>

                            </div>
                            <hr>
                            <div id="div-cluster2-table">

                            </div>
                        </div>
                    </div>
                    <div class='tab-pane fade' id='nav-cluster3' role='tabpanel' aria-labelledby='nav-cluster3-tab'>
                        <div id='div-cluster3'>
                            <h4>Business & Management</h4>
                            <div id="div-cluster3-analytics" hidden>

                            </div>
                            <hr>
                            <div id="div-cluster3-table">

                            </div>
                        </div>
                    </div>
                    <div class='tab-pane fade' id='nav-cluster4' role='tabpanel' aria-labelledby='nav-cluster4-tab'>
                        <div id='div-cluster4'>
                            <h4>Public Service/Social/Behavioral Science/Humanities</h4>
                            <div id="div-cluster4-analytics" hidden>

                            </div>
                            <hr>
                            <div id="div-cluster4-table">

                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>

<script src="../../js/jquery/chart.min.js"></script>
<script src="../../js/custom/analytics-script.js"></script>