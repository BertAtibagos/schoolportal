<?php
session_start();
include_once '../../configuration/connection-config.php';
// echo $_SESSION['USERID'];
?>

<link rel='stylesheet' href= '../../css/custom/profile-style.css' />
<section class='container-fluid' style='padding-right: 10px; padding-left: 10px; padding-bottom: 100px; margin-left: 0;margin-right: 0;margin-top: 20px;'>
<div>
	<div id='errormessage'>
	</div>

    <div id='div_search_bar'>
        <div class='row'>
            <div class='col-4'>
                <div id="dropdown-academic-name-text">
                    <input id='pr_acadname_text' name='pr_acadname_text' class='form-control pr_acadname' style='text-align:left; font-size:12px;' required>
                </div>
            </div>
            <div class='col-2'>
                <div id="dropdown-academic-name">
                    <select id='pr_acadname' name='pr_acadname' class='form-select pr_acadname' style='text-align:left; font-size:12px;' required>
                        <option value="LAST_NAME">LAST NAME</option>
                        <option value="FIRST_NAME">FIRST NAME</option>
                    </select>
                </div>
            </div>
            <div class='col-2'>
                <div id="dropdown-academic-button">
                    <button id='btnSearchName' name='btnSearchName' class='btn btn-primary' style='text-align:left; font-size:12px;'> Search </button>
                </div>
            </div>
        </div>
        <hr>
    </div>

    <div id='div_dropdown_grades'>
        <div id="dropdown-academic-button">
            <button id='btnBack' name='btnBack' class='btn btn-primary' style='text-align:left; font-size:12px;'> Back </button>
            <input type="hidden" name="studid" id="studid" readonly>
        </div>

        <hr>
        <b>NAME:  <p id="student-name-p" class="d-inline">...</p></b>
        <hr>

        <div class='row' id='div-dropdown'>
            <div class='col-2'>
                <div id="dropdown-academic-name">
                    <select id='pr_acadlevel' name='pr_acadlevel' class='form-select pr_acadlevel' style='text-align:left; font-size:12px;' required>
                    </select>
                </div>
            </div>
            <div class='col-2'>
                <div id="dropdown-academic-name">
                    <select id='pr_acadyear' name='pr_acadyear' class='form-select pr_acadyear' style='text-align:left; font-size:12px;' required>
                    </select>
                </div>
            </div>
            <div class='col-2'>
                <div id="dropdown-academic-name">
                    <select id='pr_acadperiod' name='pr_acadperiod' class='form-select pr_acadperiod' style='text-align:left; font-size:12px;' required>
                    </select>
                </div>
            </div>
            <div class='col-4'>
                <div id="dropdown-academic-name">
                    <select id='pr_acadcourse' name='pr_acadcourse' class='form-select pr_acadcourse' style='text-align:left; font-size:12px;' required>
                    </select>
                </div>
            </div>
            <div class='col-2'>
                <div id="dropdown-academic-button">
                    <button id='btnSearchGrade' name='btnSearchGrade' class='btn btn-primary' style='text-align:left; font-size:12px;'> Search </button>
                </div>
            </div>
        </div>

        <div class='row mt-4' id='div-dropdown'>
            <div class='col-2'>
                <div id="dropdown-academic-button">
                    <button id='btnPrintGrade' name='btnPrintGrade' class='btn btn-success' style='text-align:left; font-size:12px;'> Print </button>
                </div>
            </div>
        </div>
    </div>

	<div id='table-student' style='padding-bottom: 50px;'>
        <table id='table-student' class='table table-hover table-responsive table-bordered' style='width: 100%; margin:0; padding:0;'>
            <thead class='table-primary' id='thead-student'>
                <tr>
                    <th scope='col' style='width:0;'>#</th>
                    <th scope='col' style='text-align:left;' class='col-2'>STUD_NO</th>
                    <th scope='col' style='text-align:left;'>FULL NAME</th>
                    <th scope='col' style='' class='col-1'>ACTION</th>
                </tr>
            </thead>
            <tbody id='tbody-student'>
                <tr id='student-no-result'>
                    <td colspan='99' style='font-size: 18px;
                                                font-family: Roboto, sans-serif;
                                                font-weight: normal;
                                                text-decoration: none;
                                                color: red;'> 
                        NO RECORDS FOUND YET
                        </td>
                </tr>
            </tbody>
            <tbody id='tbody-unit'>
            </tbody>
        </table>
	</div>

    <div class='container-fluid' id='div_grades' style='margin: 0 0 20px 0;padding: 0 0 20px 0;'>
    <hr>
    <br>
    <img src="../../images/FCPC LOGO.jpg" alt="FCPC LOGO" width='100' height='100' hidden>
        <table id='table-grades' class='table table-hover table-responsive table-bordered' style='width: 100%; margin:0; padding:0;'>
            <thead class='table-primary' id='thead-grades'>
                <tr  id='def-head'>
                    <th scope='col' style='padding:0;margin:0;'></th>
                    <th scope='col' style='padding:0;margin:0;'></th>
                    <th scope='col' style='padding:0;margin:0;'></th>
                    <th scope='col' style='padding:0;margin:0;'></th>
                    <th scope='col' style='padding:0;margin:0;'></th>
                    <th scope='col' style='padding:0;margin:0;'></th>
                    <th scope='col' style='padding:0;margin:0;'></th>
                    <th scope='col' style='padding:0;margin:0;'></th>
                </tr>
            </thead>
            <tbody id='tbody-grades'>
                <tr id='grades-no-result'>
                    <td colspan='99' style='font-size: 18px;
                                                font-family: Roboto, sans-serif;
                                                font-weight: normal;
                                                text-decoration: none;
                                                color: red;'> 
                        LOADING...
                        </td>
                </tr>
            </tbody>
            <tfoot id='tbody-unit'>
            </tfoot>
        </table>
	</div>
	
</div>
</section>

<div style="display: none;" id="script_holder"></div>

<script>
    var currentDate = new Date();
    var dateString = currentDate.toISOString().replace(/[^0-9]/g, ''); // Remove non-numeric characters
    _string = '<script src="../../js/custom/grade-print-script.js?d=' + dateString + '"></';
    _string2 = 'script>';
    $('#script_holder').html(_string + _string2);
</script>