<section class="modal fade custom-size" id="submitted-grades-master-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<center><h5 class="modal-title" id="myModalLabel">Manage Student Academic Grades</h5></center>
				<button style='background-color:transparent; color: red;font-size: 18px;margin: 0;padding: 0 6 3 6; width: auto;height: auto;' type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-close"></span>&times;</button>
			</div>
			<div id='div-message' style='font-size: 18px;
													font-family: Roboto, sans-serif;
													font-weight: normal;
													text-decoration: none;
													color: red;'>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<table id='table-offered-subject' class='table table-hover table-responsive'>
						<thead class='table-primary'>
							<tr>
								<th scope='col' style='color: blue;width: auto;text-align: left;'>NAME:</th>
								<th id='th-student-name' scope='col' style='color: black;width: 80%;text-align: left;vertical-align: center;'>
									
								</th>
							</tr>
							<tr>
								<th scope='col' style='color: blue;width: auto;text-align: left;'>A.Y. / PERIOD</th>
								<th id='th-year-period'scope='col' style='color: black;width: 80%;text-align: left;'>
								
								</th>
							</tr>
						</thead>
					</table>
					<div id="div-tbl-gscale" class="form-group input-group">
					</div>
					<p style='width: 100%;
								  font-size: 12px;
								  font-family: Roboto, sans-serif;
								  font-weight: normal;
								  text-decoration: none;
								  color: blue;
								  padding: 0;
								  margin: 0;
								  text-align: right;
								  vertical-align: middle;'>
							FINAL AVERAGE (100%): <b id='b-final-average' style='font-size: 13px;
												  text-align: left;
												  font-family: Roboto, sans-serif;
												  font-weight: bold;
												  text-decoration: underline;
												  color: red;
												  padding: 0;
												  margin: 0 20 0 20;'>0.0%</b>
					</p>
					<p style='width: 100%;
								  font-size: 12px;
								  text-align: left;
								  font-family: Roboto, sans-serif;
								  font-weight: normal;
								  text-decoration: none;
								  color: blue;
								  padding: 0;
								  margin: 0;
								  vertical-align: middle;'>
						  FINAL AVERAGE STATUS: <p id='p-final-average-status' style='font-size: 13px;
												  text-align: left;
												  font-family: Roboto, sans-serif;
												  font-weight: bold;
												  text-decoration: underline;
												  color: red;
												  padding: 0;
												  margin: 0 20 0 20;'>
												</p>
					</p>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
	echo "<script src='../../js/custom/submitted-grades-modal-script.js'></script>";
?>
