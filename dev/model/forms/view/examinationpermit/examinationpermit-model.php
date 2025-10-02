<style>
	.bd-modal-lg .modal-dialog{
		display: table;
		position: relative;
		margin: 0 auto;
		top: calc(50% - 24px);
	}
	  
	.bd-modal-lg .modal-dialog .modal-content{
		background-color: transparent;
		border: none;
	}
</style>
<section id="class-list" class="container-fluid" style="width: 100%; 
														height: auto;font-size: 14px; font-family: Roboto, sans-serif;
									 font-weight: normal;padding: 0; margin: 0;">
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
							<!-- <th scope='col'>PROCESS</th> -->
						</tr>
					</thead>
					<tbody id='tbody-offered-subject' 
						   style='font-size: 10px;
							  font-family: Roboto, sans-serif;
							  font-weight: normal;
							  text-decoration: none;
							  color: black;' class=''>
						<tr>
						<td colspan='11' style='font-size: 18px;
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
	<div class='container-fluid' id='div-student' style='margin: 0;padding: 0;'>
		<button id='btnBack' type='button' style='margin: 0 0 5px 0; position: relative;font-size: 14px; font-family: Roboto, sans-serif;
									 font-weight: normal;' id='btnBack' name='btnBack' data-backdrop='static' data-keyboard='false' class='btn btn-block btn-primary'>
			<span class='glyphicon glyphicon-edit'></span>
			BACK
		</button>
		<div id='div-enrolled-student-list' style="align: center;padding:0;margin:0;" class="container-fluid">
			<p id='p-title' class='title' style='text-decoration: none;border: solid 1px black;border-width: 1px 0 1px 0;width: 100%; margin:0; padding: 7px 0 7px 0;background-color: white;color: black;font-size: 14px;'>
			
			</p>
			<table id='tbl-header-student-list' style='width: 100%; margin:0 0 10px 0; padding:0;border: solid 1px black;vertical-align: middle;border-width: 0 0 1px 0;'>
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
			<table id='table-student' class='table table-hover table-responsive table-bordered' style='margin-bottom: 150px;width: 100%;font-font-family:Geneva, Verdana, sans-serif;'>
				<thead class='table-primary' id='thead-student'>
					<!--<tr>
						<th scope='col' style='padding:0;margin:0;'>#</th>
						<th scope='col' style='padding:0;margin:0;'>NAME</th>
						<th scope='col' style='padding:0;margin:0;'>GENDER</th>
						<th scope='col' style='padding:0;margin:0;'>COURSE/SECTION</th>
						<th scope='col' style='padding:0;margin:0;'>STATUS</th>
						<!--<th scope='col' style='padding:0;margin:0;'>FINAL AVERAGE</th>
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
					</tr>-->
				</thead>
				<tbody id='tbody-student'>
					<!--<tr>
						<td colspan='5' style='font-size: 18px;
												font-family: Roboto, sans-serif;
												font-weight: normal;
												text-decoration: none;
												color: red;'>
						No Record Found
						</td>
					</tr>-->
				</tbody>
			</table>
		</div>
	</div>
</section>

<?php
	echo "<link rel='stylesheet' href='../../css/custom/examinationpermit-style.css'/>";
	echo "<script src='../../js/custom/examinationpermit-script.js'></script>";
	include_once 'examinationpermit-modal-model.php';
?>