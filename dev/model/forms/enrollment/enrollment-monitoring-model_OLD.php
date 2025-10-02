<section id="class-list" class="container-fluid" style="width: 100%; height: auto;">
	<div id='div-message'> 
	</div>
	<div class='container-fluid' style='width: auto; height: auto;margin: 10px 0 0 0;padding:0;'>
		<table style="width: auto; height: 100%;">
			<tr>
				<td style="width: 2%; height: 100%;border-right: 1px solid black;padding: 0 20px 0 0;">
					<div class="col-4 vertical" style="font-size: 13px;
												  font-family: Roboto, sans-serif;
												  font-weight: bold;
												  text-decoration: none;
												  color: blue;
												  text-align:left; width: auto;height: 100%;">
						<div id="dropdown-academic-level">
							<label class='label'>LEVEL</label>
							<select id='cbo-acadlvl' name='cbo-acadlvl' class='form-control' style='text-align:left;font-size:11px;width: 250px;' required>
							</select>
						</div>
						<div id="dropdown-academic-year">
							<label class='label'>YEAR</label>
							<select id='cbo-acadyr' name='cbo-acadyr' class='form-control' style='text-align:left;font-size:11px;width: 250px;' required>
							</select>
						</div>
						<div id="dropdown-academic-period">
							<label class='label'>PERIOD</label>
							<select id='cbo-acadprd' name='cbo-acadprd' class='form-control' style='text-align:left;font-size:11px;width: 250px;' required>
							</select>
						</div>
						<div id="dropdown-academic-course">
							<label class='label'>COURSE</label>
							<select id='cbo-acadcrse' name='cbo-acadcrse' class='form-control' style='text-align:left;font-size:11px;width: 250px;' required>
							</select>
						</div>
						<div id="dropdown-academic-year-level">
							<label class='label'>YEAR LEVEL</label>
							<select id='cbo-acadyrlvl' name='cbo-acadyrlvl' class='form-control' style='text-align:left;font-size:11px;width: 250px;' required>
							</select>
						</div>
						<div id="dropdown-instructor">
							<label class='label'>INSTRUCTOR</label>
							<select id='cbo-instructor' name='cbo-instructor' class='form-control' style='text-align:left;font-size:11px;width: 250px;' required>
							</select>
						</div> 
						<div id="dropdown-academic-subject">
							<label class='label'>SUBJECT</label>
							<select id='cbo-acadsubject' name='cbo-acadsubject' class='form-control' style='text-align:left;font-size:11px;width: 250px;' required>
							</select>
						</div> 
						
						<div style='width: 100%;margin:20px 0 0 0;padding: 0;'>
							<center>
							<button id='btnsearch' name='btnsearch'
									style='font-size: 12px;
											font-family: Roboto, sans-serif;
											font-weight: normal;width: 35%;'
									class='btn btn-block btn-primary btnsearch'>Search</button>
							</center>
						</div>
						
					</div>
				</td>
				<td>
					<div class="container-fluid" style="border-right: 1px solid black;
												  font-size: 13px;
												  font-family: Roboto, sans-serif;
												  font-weight: bold;
												  text-decoration: none;
												  color: blue;
												  text-align:left; width: 100%;height: 100%;">
						<p id='title-label' class='title' style='width: 100%;margin:15px 0 1px 0; padding: 4px 0 4px 0;'>
							Enrollment Summary
						</p>
						<table id='table-summary' style='width: 100%;margin:0; padding: 0;' class='table table-responsive' >
							<tbody id='tbody-offered-subject' 
								   style='font-size: 10px;
									  font-family: Roboto, sans-serif;
									  font-weight: normal;
									  text-decoration: none;
									  color: black;'>
								<tr>
								<!-- <td colspan='6' style='font-size: 16px;
														font-family: Roboto, sans-serif;
														font-weight: normal;
														text-decoration: none;
														color: red;'>
								No Record Found -->
									<th style='width:auto;text-align:left;font-size: 11px;color: green;' class='table-primary'>TOTAL ENROLLED STUDENT:</th>
									<td id = 'tdttlenrollstud' style='width:10%;text-decoration: underline;font-size: 12px;color: blue;'>0</td>
									<th style='width:auto;text-align:right;font-size: 11px;color: green;' class='table-primary'>NEW:</th>
									<td style='width:10%;text-decoration: underline;font-size: 12px;color: blue;'>0</td>
									<th style='width:auto;text-align:right;font-size: 11px;color: green;' class='table-primary'>OLD:</th>
									<td style='width:10%;text-decoration: underline;font-size: 12px;color: blue;'>0</td>
									<th style='width:22%;'></th>
								</tr>
								<tr>
									<th style='width:auto;text-align:right;' class='table-primary'>1ST YEAR</th>
									<td id = 'tdttl1styr' style='text-decoration: underline;font-size: 12px;color: blue;'>0</td>
									<th style='width:auto;text-align:right;' class='table-primary'></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
								</tr>
								<tr>
									<th style='width:auto;text-align:right;' class='table-primary'>2ND YEAR</th>
									<td id = 'tdttl2ndyr' style='text-decoration: underline;font-size: 12px;color: blue;'>0</td>
									<th style='width:auto;text-align:right;' class='table-primary'>TOTAL COURSE OFFERED</th>
									<td id = 'tdttlofferedcrse' style='text-decoration: underline;font-size: 12px;color: blue;'>0</td>
									<th></th>
									<th></th>
									<th></th>
								</tr>
								<tr>
									<th style='width:auto;text-align:right;' class='table-primary'>3RD YEAR</th>
									<td id = 'tdttl3rdyr' style='text-decoration: underline;font-size: 12px;color: blue;'>0</td>
									<th style='width:auto;text-align:right;' class='table-primary'>TOTAL SUBJECT OFFERED</th>
									<td id = 'tdttlofferedsubj' style='text-decoration: underline;font-size: 12px;color: blue;'>0</td>
									<th></th>
									<th></th>
									<th></th>
								</tr>
								<tr>
									<th style='text-align:right;' class='table-primary'>4TH YEAR</th>
									<td id = 'tdttl4thyr' style='text-decoration: underline;font-size: 12px;color: blue;'>0</td>
									<th style='text-align:right;' class='table-primary'>TOTAL INSTRUCTOR</th>
									<td id = 'tdttlinstructor' style='text-decoration: underline;font-size: 12px;color: blue;'>0</td>
									<th></th>
									<th></th>
									<th></th>
								</tr>
							</tbody>
						</table>
						<!-- <p id='p-title' class='title' style='width: 100%; margin:15px 0 1px 0; padding: 4px 0 4px 0;'>
						List of Courses / Offered Subject / Instructor / Schedule / Enrolled Student
						</p>
						<table id='table-student' class='table table-hover table-responsive table-bordered' style='width: 100%; margin:0 0 20 0; padding:0;'>
							<thead class='table-primary'>
								<tr>
									<th scope='col' style='padding:0;margin:0;'>#</th>
									<th scope='col' style='padding:0;margin:0;'>NAME</th>
									<th scope='col' style='padding:0;margin:0;'>GENDER</th>
									<th scope='col' style='padding:0;margin:0;'>COURSE/SECTION</th>
									<th scope='col' style='padding:0;margin:0;'>YEAR LEVEL</th>
									<th scope='col' style='padding:0;margin:0;'>STATUS</th>
								</tr>
							</thead>
							<tbody id='tbody-enrollment'>
								<tr>
									<td colspan='6' style='font-size: 16px;
															font-family: Roboto, sans-serif;
															font-weight: normal;
															text-decoration: none;
															color: red;'>
									No Record Found
									</td>
								</tr>	
							</tbody>
						</table> -->
						
					</div>
				</td>
			</tr>
		</table>
		 <div class="row"> 
			
		</div>
	</div>
</section>
<?php
		echo "<script src='../../js/custom/enrollment-monitoring-script.js'></script>";
		//echo "<script src='../../js/custom/progressbar-script.js'></script>";
		//include_once 'classlist-sub-model.php';
		//include_once 'modal-model.php';
?>
			