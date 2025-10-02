<!-- <link href= "../../css/custom/progressbar-style.css" rel="stylesheet" /> -->
<script src= "../../js/jquery/jquery.ui/ui/1.10.4/js/jquery-ui.min.js"></script>
<section id="class-list" class="container-fluid" style="width: 100%; 
														height: 100%;font-size: 14px; font-family: Roboto, sans-serif;
									 font-weight: normal;">
	<div id='div-message'> 
	</div>
	<div id="div-header" style="margin: 0;padding:0;width: 100%;">
		 <div class='container-fluid' style="float: left;width: 100%;height: 80%;margin: 0 0 10px 0;padding: 0;"> 
			<div id="dropdown-academic-level" class="col-2" style="float: left;width: auto;margin: 0 10px 0 0;padding: 0;">
				<label class='label'>LEVEL</label>
				<select id='cbo-acadlvl' name='cbo-acadlvl' class='form-select' style='text-align:left;font-size:11px;width: auto;' required>
				</select>
			</div>
			<div id="dropdown-academic-year" class="col-2" style='float: left;width: auto;margin: 0 10px 0 0;padding: 0;'>
				<label class='label'>YEAR</label>
				<select id='cbo-acadyr' name='cbo-acadyr' class='form-select' style='text-align:left;font-size:11px;width: auto;' required>
				</select>
			</div>
			<div id="dropdown-academic-period" class="col-2" style='float: left;width: auto;margin: 0 10px 0 0;padding: 0;'>
				<label class='label'>PERIOD</label>
				<select id='cbo-acadprd' name='cbo-acadprd' class='form-select' style='text-align:left;font-size:11px;width: auto;' required>
				</select>
			</div>
			<div id="dropdown-academic-course" class="col-5" style='float: left;width: auto;margin: 0 10px 0 0;padding: 0;'>
				<label class='label'>COURSE</label>
				<select id='cbo-acadcrse' name='cbo-acadcrse' class='form-select' style='text-align:left;font-size:11px;width: auto;' required>
				</select>
			</div> 
			<div class='col-1' style='float: left;'>
				<button id='btnsearch' name='btnsearch'
						style='font-size: 12px;
								font-family: Roboto, sans-serif;
								font-weight: normal;width: auto;margin: 20px 0 0 0;'
						class='btn btn-block btn-primary btnsearch'>
					Search
				</button>
			</div>
		</div>
		<div class='col' id='div-offered-subject' style='overflow: auto;width: 100%;height: 100%;margin: 10px 0 10px 0 0; padding: 10px 0 10px 0 0;'>
			<!-- <div id='div-progressbar' class="progress-form-color">
				<div class="progress-label">Loading...
				<div id="progressbar"></div>
				</div> -->
			</div>
			<div class='container-fluid' >
				<p class='title'>
					List of Subjects
				</p>
				<table id='table-offered-subject' style='width: auto;margin:0; padding: 0;' class='table table-hover table-responsive table-bordered'>
					<thead class='table-primary'
						   style='font-size: 11px;
								font-family: Roboto, sans-serif;
								font-weight: normal;
								text-decoration: none;
								color: blue;'>
						<tr>
							<th scope='col'>#</th>
							<th scope='col'>CODE</th>
							<th scope='col'>DESCRIPTION</th>
							<th scope='col'>UNIT</th>
							<th scope='col'>COURSE</th>
							<th scope='col'>SECTION</th>
							<th scope='col'>SCHEDULE</th>
							<th scope='col'>GRADING SCALE</th>
							<th scope='col'>NO. OF STUDENT</th>
							<th scope='col'>STATUS</th>
							<th scope='col'>VIEW</th>
							<th scope='col'>PROCESS</th>
						</tr>
					</thead>
					<tbody id='tbody-offered-subject' 
						   style='font-size: 10px;
							  font-family: Roboto, sans-serif;
							  font-weight: normal;
							  text-decoration: none;
							  color: black;'>
						<tr>
						<td colspan='12' style='font-size: 18px;
												font-family: Roboto, sans-serif;
												font-weight: normal;
												text-decoration: none;
												color: red;'>
						No Record Found
						</td>
						</tr>	
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class='container-fluid' id='div-student' style='margin: 0 0 20px 0;padding: 0 0 20px 0;'>
		<button id='btnBack' type='button' style='position: relative;font-size: 14px; font-family: Roboto, sans-serif;
									 font-weight: normal;' id='btnBack' name='btnBack' data-backdrop='static' data-keyboard='false' class='btn btn-block btn-primary'>
			<span class='glyphicon glyphicon-edit'></span>
			BACK
		</button>
		<div id='div-enrolled-student-list' style="align: center;padding:0;margin:0;" class="container-fluid">
			<p id='p-title' class='title' style='width: 100%; margin:0; padding: 0;'>
			List of Enrolled Student
			</p>
			<table id='tbl-header-student-list' class='table table-responsive' style='width: 100%; margin:0 0 1 0; padding:0;border-color: transparent;vertical-align: middle;'>
				<tr>
					<td class='table-primary' style='color: blue;width: auto;text-align: left;'>SUBJECT</td>
					<td class='table-primary' style='width: 70%;text-align: left;' id='td-subj'></td>
					<td class='table-primary' style='width: 12%;'></td>
				</tr>
				<tr>
					<td class='table-primary' style='color: blue;width: auto;text-align: left;'>COURSE / SECTION / SCHEDULE</td>
					<td class='table-primary' style='width: 70%;text-align: left;' id='td-crse-sec-sched'></td>
					<td class='table-primary' style='width: 12%;'></td>
				</tr>
			</table>
			<table id='table-student' class='table table-hover table-responsive table-bordered' style='margin-bottom: 150px;width: 100%;'>
				<thead class='table-primary'>
					<tr>
						<th scope='col' style='padding:0;margin:0;'>#</th>
						<th scope='col' style='padding:0;margin:0;'>NAME</th>
						<th scope='col' style='padding:0;margin:0;'>GENDER</th>
						<th scope='col' style='padding:0;margin:0;'>COURSE/SECTION</th>
						<th scope='col' style='padding:0;margin:0;'>STATUS</th>
						<th scope='col' style='padding:0;margin:0;'>FINAL AVERAGE</th>
						<th scope='col' style='padding:0;margin:0;'>AVERAGE STATUS</th>
						<th scope='col' style='padding:0;margin:0;' class='thallgrades'>
							<button type='button'
								style='font-size: 14px;
								font-family: tahoma, sans-serif;
								font-weight: normal;
								font-style: italic;
								text-decoration: underline;
								margin: 2 0 2 0;
								padding: 3 5 3 5;
								color: lime;'
								id='btn-all-grades' name='btn-all-grades' class='btn btn-block btn-primary mnuallgrades' hidden>
								All Grades
							</button>
						</th>
					</tr>
				</thead>
				<tbody id='tbody-student'>
					<tr>
						<td colspan='8' style='font-size: 18px;
												font-family: Roboto, sans-serif;
												font-weight: normal;
												text-decoration: none;
												color: red;'>
						No Record Found
						</td>
					</tr>	
				</tbody>
			</table>
		</div>
	</div>
</section>

<div style="display: none;" id="script_holder"></div>

<script>
    var currentDate = new Date();
    var dateString = currentDate.toISOString().replace(/[^0-9]/g, ''); // Remove non-numeric characters
    _string = '<script src="../../js/custom/classlist-script.js?d=' + dateString + '"></';
    _string2 = 'script>';
    $('#script_holder').html(_string + _string2);
</script>
<?php
	// echo "<script src='../../js/custom/classlist-script.js'></script>";
	//echo "<script src='../../js/custom/progressbar-script.js'></script>";
	include_once '../../modal-model.php';
	//include_once 'modal-model.php';
	//include_once 'classlist-sub-model.php';
?>
<!--<div class="modal fade custom-size" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
			</div>
            <div class="modal-body">
                <p id="confirmation-msg" style='font-size: 16px;
												font-family: tahoma, sans-serif;
												font-weight: normal;
												color: blue;'>
				</p>
            </div>
            <div class="modal-footer">
				<button type="button" class="btn btn-success btn-primary" id="confirmation-yes">Yes</button>
				<button type="button" class="btn btn-block btn-primary" id="confirmation-no">No</button>
            </div>
        </div>
    </div>
</div>-->