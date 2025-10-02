<section id='sec-student-list' class="container-fluid" style="margin: 25px 0 20px 0;width: 100%; height: auto;position: relative;z-index: 1;opacity: 0.9; padding-bottom: 5rem;">
	<div style="width: 100%; height: auto;padding: 0 0 20px 0;">
		<button id='btnBack' type='button' style='position: relative;font-size: 14px; font-family: Roboto, sans-serif;
									 font-weight: normal;' id='btnBack' name='btnBack' data-backdrop='static' data-keyboard='false' class='btn btn-block btn-primary'>
			<span class='glyphicon glyphicon-edit'></span>
			BACK
		</button>
		<button id='btnmodalprocessdenied' type='button' style='position: relative;float: right;font-size: 14px;font-family: Roboto, sans-serif;
									font-weight: normal;margin: 0 0 0 5;' name='btnmodalprocessdenied' data-backdrop='static' data-keyboard='false' class='btn btn-danger btn-primary'>
			<span class='glyphicon glyphicon-edit'></span>
			Denied
		</button>
		<button id='btnmodalprocessapproved' type='button' style='position: relative;float: right;font-size: 14px; font-family: Roboto, sans-serif;
									font-weight: normal;margin: 0 5 0 0;' name='btnmodalprocessapproved' data-backdrop='static' data-keyboard='false' class='btn btn-success btn-primary'>
			<span class='glyphicon glyphicon-edit'></span>
			Approved
		</button>
	</div>
	<div class='container-fluid' id='div-student' 
		 style='margin: 0 0 20px 0;padding: 0 0 20px 0;'>
		<div id='div-enrolled-student-list' style="align: center; padding: 0;margin:0;" class="container-fluid">
			<p id='p-title' class='title' style='width: 100%; padding: 5 0 5 0;'>
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
			<table id='table-student' class='table table-hover table-responsive table-bordered' style='width: 100%; margin:0; padding:0;'>
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
<div id="submitted-request" class="container" style="width: 100%; 
														height: 100%;">
	<div id='div-message'> 
	</div>
	<div class='container-fluid' style='width: 100%; height: 100%;'>
		<hr>
		<div class='row'>
			<div class='col-3' style="width: auto;height: auto;margin: 0 10px 0 0;padding: 0;">
				<div id="dropdown-academic-level">
					<select id='cbo-acadlvl' name='cbo-acadlvl' class='form-select' style='text-align:left;font-size:11px;width: 100px;' required>
					</select>
				</div>
			</div>
			<div class='col-3' style="width: auto;height: auto;margin: 0 10px 0 0;padding: 0;">
				<div id="dropdown-academic-year">
					<select id='cbo-acadyr' name='cbo-acadyr' class='form-select' style='text-align:left;font-size:11px;width: 100px;' required>
					</select>
				</div>
			</div>
			<div class='col-3' style="width: auto;height: auto;margin: 0;padding: 0;">
				<div id="dropdown-academic-period">
					<select id='cbo-acadprd' name='cbo-acadprd' class='form-select' style='text-align:left;font-size:11px;width: 100px;' required>
					</select>
				</div>
			</div>
			<div class='col-1'>
				<button id='btnsearch' name='btnsearch'
						style='font-size: 12px;
								font-family: Roboto, sans-serif;
								font-weight: normal;width: auto;margin: 15 0 0 0;'
						class='btn btn-block btn-primary btnsearch'>
					Search
				</button>
			</div>
			<div class='col-2'>
				
			</div>
		</div>
		<hr>
		<div class="row" style='margin: 15 0 0 0;' id='div-student'> 
			<div class="col" id='div-enrolled-student-list'> 
				<nav>
				  <div class="nav nav-tabs" id="nav-tab" role="tablist">
					<button class="nav-link active" id="nav-for-approval-tab" data-bs-toggle="tab" data-bs-target="#nav-for-approval" type="button" role="tab" aria-controls="nav-for-approval" aria-selected="true">
					<span id="spansubmittedgradesnotification" class=''></span>
						For Approval
					</button>
					<button class="nav-link" id="nav-approved-tab" data-bs-toggle="tab" data-bs-target="#nav-approved" type="button" role="tab" aria-controls="nav-approved" aria-selected="false">Approved</button>
					<button class="nav-link" id="nav-denied-tab" data-bs-toggle="tab" data-bs-target="#nav-denied" type="button" role="tab" aria-controls="nav-denied" aria-selected="false">Denied</button>
				  </div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-for-approval" role="tabpanel" aria-labelledby="nav-for-approval-tab">
						<div class="container-fluid" style="font-size: 13px;
													  font-family: Roboto, sans-serif;
													  font-weight: bold;
													  text-decoration: none;
													  color: blue;
													  text-align:left; width: 100%;height: 100%;padding-bottom: 150px;">
							<p id='p-title' class='title' style='width: 100%; margin:5 0 1 0;  padding: 5 0 5 0;'>
								For Approval
							</p>
							<table id='table-for-approval' class='table table-hover table-responsive table-bordered' style='width: 100%; margin:0 0 20 0; padding:0;'>
								<thead class='table-primary'>
									<tr>
										<th scope='col' style='padding:0;margin:0;'>#</th>
										<th scope='col' style='padding:0;margin:0;'>DATE</th>
										<th scope='col' style='padding:0;margin:0;'>INSTRUCTOR</th>
										<th scope='col' style='padding:0;margin:0;'>SUBJECT</th>
										<th scope='col' style='padding:0;margin:0;'>COURSE/SECTION</th>
										<th scope='col' style='padding:0;margin:0;'>STATUS</th>
										<th scope='col' style='padding:0;margin:0;'>GRADING SCALE</th>
										<th scope='col' style='padding:0;margin:0;'>STUDENT</th>
										<th scope='col' style='padding:0;margin:0;'>PROCESS</th>
									</tr>
								</thead>
								<tbody id='tbody-for-approval'>
									<tr>
										<td colspan='9' style='font-size: 16px;
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
					<div class="tab-pane fade" id="nav-approved" role="tabpanel" aria-labelledby="nav-approved-tab">
												<div class="container-fluid" style="font-size: 13px;
													  font-family: Roboto, sans-serif;
													  font-weight: bold;
													  text-decoration: none;
													  color: blue;
													  text-align:left; width: 100%;height: 100%; padding-bottom: 150px;">
							<p id='p-title' class='title' style='width: 100%; margin:5 0 1 0;  padding: 5 0 5 0;'>
								Approved
							</p>
							<table id='table-approved' class='table table-hover table-responsive table-bordered' style='width: 100%; margin:0 0 20 0; padding:0;'>
								<thead class='table-primary'>
									<tr>
										<th scope='col' style='padding:0;margin:0;'>#</th>
										<th scope='col' style='padding:0;margin:0;'>DATE</th>
										<th scope='col' style='padding:0;margin:0;'>INSTRUCTOR</th>
										<th scope='col' style='padding:0;margin:0;'>SUBJECT</th>
										<th scope='col' style='padding:0;margin:0;'>COURSE/SECTION</th>
										<th scope='col' style='padding:0;margin:0;'>STATUS</th>
										<th scope='col' style='padding:0;margin:0;'>GRADING SCALE</th>
										<th scope='col' style='padding:0;margin:0;'>PROCESS</th>
									</tr>
								</thead>
								<tbody id='tbody-approved'>
									<tr>
										<td colspan='9' style='font-size: 16px;
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
					<div class="tab-pane fade" id="nav-denied" role="tabpanel" aria-labelledby="nav-denied-tab">
						<div class="container-fluid" style="font-size: 13px;
													  font-family: Roboto, sans-serif;
													  font-weight: bold;
													  text-decoration: none;
													  color: blue;
													  text-align:left; width: 100%;height: 100%;padding-bottom: 150px;">
							<p id='p-title' class='title' style='width: 100%; margin:5 0 1 0;  padding: 5 0 5 0;'>
								Denied
							</p>
							<table id='table-denied' class='table table-hover table-responsive table-bordered' style='width: 100%; margin:0 0 20 0; padding:0;'>
								<thead class='table-primary'>
									<tr>
										<th scope='col' style='padding:0;margin:0;'>#</th>
										<th scope='col' style='padding:0;margin:0;'>DATE</th>
										<th scope='col' style='padding:0;margin:0;'>INSTRUCTOR</th>
										<th scope='col' style='padding:0;margin:0;'>SUBJECT</th>
										<th scope='col' style='padding:0;margin:0;'>COURSE/SECTION</th>
										<th scope='col' style='padding:0;margin:0;'>STATUS</th>
										<th scope='col' style='padding:0;margin:0;'>GRADING SCALE</th>
										<th scope='col' style='padding:0;margin:0;'>PROCESS</th>
									</tr>
								</thead>
								<tbody id='tbody-denied'>
									<tr>
										<td colspan='9' style='font-size: 16px;
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
			</div>
		</div>
		
	</div>
</div>
<div style="display: none;" id="script_holder"></div>

<script>
    var currentDate = new Date();
    var dateString = currentDate.toISOString().replace(/[^0-9]/g, ''); // Remove non-numeric characters
    _string = '<script src="../../js/custom/submitted-grades-script.js?d=' + dateString + '"></';
    _string2 = 'script>';
    $('#script_holder').html(_string + _string2);
</script>
<?php
	include 'submitted-grades-modal-model.php';
?>
