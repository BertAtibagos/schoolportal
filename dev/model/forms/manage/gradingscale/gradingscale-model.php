<section id="grading-scale" class="container-fluid">
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
	<?php include_once 'gradingscale-modal.php';
	?>
	<div id='div-message'> 
	</div>
	<div class='container-fluid' style='margin: 0;padding:0;'>
		<div class="row"> 
			<style>
				#div-create-gs, #div-offered-subject-list, #tbl-header-subject-list{
					display: none;
				}
				#dropdown-container{
					border-right: 1px solid black;
					font-size: 13px;
					font-family: Roboto, sans-serif;
					font-weight: bold;
					color: blue;
				}
				#div-grading-scale p{
					text-decoration: underline;
					text-align: center;
					font: italic 13px cambria, serif;
					padding: 0 0 5px 5px;
					margin: 0 0 1px 0;
					color: yellow;
					background-color: rgba(10,50,150,0.5);
				}
				#div-grading-scale table{
					font-size: 11px;
					font-family: Roboto, sans-serif;
					font-weight: normal;
					text-decoration: none;
				}

				@media (orientation: portrait) {
					#dropdown-container{
						border-right: none;
						font-family: Roboto, sans-serif;
						font-weight: bold;
						color: blue;
						padding-bottom: 1rem;
					}
				}
			</style>
			<div class="col-md-4 vertical" id='dropdown-container'>
				<div id="dropdown-academic-level">
					<label>LEVEL</label>
					<select id='gs-acadlvl' name='gs-acadlvl' class='form-select' style='text-align:left;font-size:12px;' required>
					</select>
				</div>
				<div id="dropdown-academic-year">
					<label>YEAR</label>
					<select id='gs-acadyr' name='gs-acadyr' class='form-select' style='text-align:left;font-size:12px;' required>
					</select>
				</div>
				<div id="dropdown-academic-period">
					<label>PERIOD</label>
					<select id='gs-acadprd' name='gs-acadprd' class='form-select' style='text-align:left;font-size:12px;' required>
					</select>
				</div>
				<div id="dropdown-academic-course">
					<label>COURSE</label>
					<select id='gs-acadcrse' name='gs-acadcrse' class='form-select' style='text-align:left;font-size:12px;' required>
					</select>
				</div> 
			</div>

			<div class='col-md-8' id='div-grading-scale' style='overflow: auto; height: 200px;'>
				<p> LIST OF GRADING SCALES </p>

				<table id='table-grading-scale' class='table table-hover table-responsive table-bordered'>
					<thead class='table-primary' style='color: blue;'>
						<tr>
							<th style='text-align:center;'>#</th>
							<th style='text-align:center;'>GRADING SCALE CODE</th>
							<th style='text-align:center;'>GRADING SCALE NAME</th>
							<th style='text-align:center;'>DESCRIPTION</th>
							<th style='text-align:center;'></th>
						</tr>
					</thead>
					<tbody id='tbody-grading-scale' style='vertical-align: middle; color: black;'>
						<tr>
							<td colspan='8' style='color: red;'> No Record Found
							</td>
						</tr>	
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<hr>

	<div class='row' style='margin: 10px; width: 15%'>
		<button type="button" name="btnCreateGS" id="btnCreateGS" class="btn btn-primary pull-right">Create New Scale</button>
	</div>

	<div class="div-create-gs" id="div-create-gs">
		<div>
			<form>
				<div class="row">
					<div class="" style="display: flex; margin-bottom: 10px">
						<table style='width: 100%;'>
							<td style='vertical-align: top;'>
								<input style="margin: 2px 5px" type="text" class="form-control" id='gscale_code' name="gscale_code" placeholder="Grading System Code" required >
							</td>
							<td style='vertical-align: top;'>
								<input style="margin: 2px 5px" type="text" class="form-control" id='gscale_name' name="gscale_name" placeholder="Name" required >
							</td>
							<td style='vertical-align: top;'>
								<input style="margin: 2px 5px" type="text" class="form-control" id='details' name="details" placeholder="Description" required >
								<label style='color: blue; font-size: .75rem;'>[Optional]</label>
							</td>
							<td style='vertical-align: top; font-'>
								<input style="margin: 2px 5px" type="text" class="form-control" id='pass_score' name="pass_score" placeholder="Passing Grade %" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" maxlength="6">
							</td>
						</table>
					</div>
					<hr>
				</div>

				<button type="button" name="btnAddComp" id="btnAddComp" class="btn btn-success pull-left">Add Component</button>
				<input type='button' class="btn btn-block btn-primary" id='btnSubmitGS' name='btnSubmitGS' value='Submit' style='float:right;'>

				<div id="div-new-gs-container" class="row" style="margin-top: 50px; padding-right: 5%;">
				</div>
			</form>
		</div>
	</div>

	<div class='container-fluid' id='div-subject' style='padding-bottom: 8rem;'>
		<div id='div-offered-subject-list' style="align: center;padding:0;margin:0;" class="container-fluid">
			<p style="text-decoration: underline;
					text-align: center;
					font: italic 18px cambria, serif; 
					width: 100%;
					padding: 0 0 5px 5px;
					margin: 0 0 1px 0;
					color: yellow;
					background-color: rgba(10,50,150,0.5);">List of Subject Offered
			</p>

			<style>
				#tbl-header-subject-list td:first-child{
					width: 15%;
					text-align:left; 
					height: auto;
					font-size: 11px;
					font-family: Roboto, sans-serif;
					font-weight: bold;
					text-decoration: none;
					color: blue;
				}
				#tbl-header-subject-list td:nth-child(2){
					text-align:left; 
					width: auto;
					height: auto;
					font-size: 11px;
					font-family: Roboto, sans-serif;
					font-weight: normal;
					text-decoration: none;
					color: black;
				}
			</style>
			<table id='tbl-header-subject-list' class='table table-responsive table-bordered' style='margin: 0; padding: 0;'>
				<tr>
					<td class='table-primary'>CODE</td>
					<td class='table-primary' id='td-subj'>
					</td>
				</tr>
				<tr>
					<td class='table-primary'>GRADING SCALE NAME</td>
					<td class='table-primary' id='td-crse-sec-sched'></td>
				</tr>
				<tr>
					<td class='table-primary'>DESCRIPTION</td>
					<td class='table-primary' id='td-crse-sec-sched1'></td>
				</tr>
				<tr hidden>
					<td class='table-primary'>ID</td>
					<td class='table-primary' id='td-crse-sec-sched2'></td>
				</tr>
				<tr hidden>
					<td class='table-primary'>PASS_SCORE</td>
					<td class='table-primary' id='td-crse-sec-sched3'></td>
				</tr>
			</table>

			<table id='table-subject' class='table table-hover table-responsive table-bordered table-fluid'>
				<thead class='table-primary' style='font-size: 11px;
												font-family: Roboto, sans-serif;
												font-weight: normal;
												text-decoration: none;
												color: blue;'>
					<tr>
						<th scope='col' style='text-align:center;'> <input type='checkbox' id='subjidall'> </th>
						<th scope='col' style='text-align:center;'>#</th>
						<th scope='col' style='text-align:left;'>CODE</th>
						<th scope='col' style='text-align:center;'>DESCRIPTION</th>
						<th scope='col' style='text-align:center;'>UNIT</th>
						<th scope='col' style='text-align:center;'>SECTION</th>
						<th scope='col' style='text-align:center;'>STUDENT COUNT</th>
						<th scope='col' style='text-align:center;'>SCHEDULE</th>
						<th scope='col' style='text-align:left;'>INSTRUCTOR</th>
					</tr>
				</thead>
				<tbody id='tbody-subject' style='font-size: 11px;
										font-family: Roboto, sans-serif;
										font-weight: normal;
										text-decoration: none;
										color: black;'>
					<tr>
						<td colspan='9' style='font-size: 18px;
											font-family: Roboto, sans-serif;
											font-weight: normal;
											text-decoration: none;
											color: red;'> No Record Found
						</td>
					</tr>	
				</tbody>
			</table>
			
			<input type='button' class="btn btn-block btn-primary" id='btnSubmitTag' name='btnSubmitTag' value='Submit TAG'>
		</div>
	</div>

	<!-- Modals -->
	<div class="modal fade" id="editModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="label-modal" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="label-modal">Grading Scale</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<div class="modal-body" style="padding-inline: 1.5rem;">
					<style>
						#table-modal-edit-header label{
							font-size: 13px;
							font-family: Roboto, sans-serif;
							font-weight: bold;
							text-decoration: none;
							color: blue;
							display: flex;
							text-align: right;
						}
						#table-modal-edit-header input[type='text']{
							padding: .15rem .50rem;
							border-radius: 0.375rem;
						}
						#table-modal-edit-header td{
							vertical-align: middle;
							padding-bottom: 1rem;
							padding-left: .75rem;
						}
					</style>
					<table id='table-modal-edit-header' class="table-borderless table-responsive" style="display: flex;">
						<tbody>
							<tr hidden>
								<td>
									<label for="gs-code">ID:</label>
								</td>
								<td>
									<input type="text" class='form-control edit' name="gs-id" id="gs-id" readonly>
								</td>
							</tr>
							<tr>
								<td>
									<label for="gs-code">CODE:</label>
								</td>
								<td>
									<input type="text" class='form-control edit' name="gs-code" id="gs-code">
								</td>
							</tr>
							<tr>
								<td>
									<label for="gs-name">NAME:</label>
								</td>
								<td>
									<input type="text" class='form-control edit' name="gs-name" id="gs-name">
								</td>
							</tr>
							<tr>
								<td>
									<label for="gs-desc">DESCRIPTION:</label>
								</td>
								<td>
									<div>
										<input type="text" class='form-control edit' name="gs-desc" id="gs-desc">
									</div>
									<label>[Optional]</label>
								</td>
							</tr>
							<tr>
								<td>
									<label for="gs-pass-score">PASSING SCORE:</label>
								</td>
								<td>
									<input type="text" class='form-control edit' name="gs-pass-score" id="gs-pass-score">
								</td>
							</tr>
						</tbody>
					</table>
					<style>
						#table-gscale td {
							vertical-align: top;
						}
					</style>
					<table id='table-gscale' class='table-hover table-responsive table-borderless table-fluid'>
						<tbody id='tbody-gscale' style='font-size: 11px;
													font-family: Roboto, sans-serif;
													font-weight: normal;
													text-decoration: none;
													color: black;'>
							<tr>
								<td colspan='5' style='font-size: 18px;
													font-family: Roboto, sans-serif;
													font-weight: normal;
													text-decoration: none;
													color: red;'> No Record Found
								</td>
							</tr>	
						</tbody>
					</table>
				</div>
	
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary bntClose" data-bs-dismiss="modal">Close</button>
					<input type="button" class="btn btn-primary btnSaveChanges" value="Save Changes">
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="viewModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="label-modal" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<p class="modal-title fs-5" id="label-modal" name='gsview-name' style='font-size: 1.75rem !important; letter-spacing: .1rem;display: inline;'>Grading Scale</p><p class="modal-title fs-5" name='gsview-pass-score' style='font-size: 1.25rem !important; letter-spacing: .1rem;display: inline; margin-left: 0.25rem;'></p>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
	
				<div class="modal-body">
					<table id='table-gsview' class='table-hover table-responsive table-borderless table-fluid'>
						<tbody id='tbody-gsview' style='font-size: 11px;
													font-family: Roboto, sans-serif;
													font-weight: normal;
													text-decoration: none;
													color: black;'>
							<tr>
								<td colspan='3' style='font-size: 18px;
													font-family: Roboto, sans-serif;
													font-weight: normal;
													text-decoration: none;
													color: red;'> No Record Found
								</td>

								<td>
								</td>
							</tr>	
						</tbody>
					</table>
				</div>
	
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary bntClose" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</section>
<div style="display: none;" id="script_holder"></div>

<script>
    var currentDate = new Date();
    var dateString = currentDate.toISOString().replace(/[^0-9]/g, ''); // Remove non-numeric characters
    _string = '<script src="../../js/custom/gradingscale-script.js?d=' + dateString + '"></';
    _string3 = '<script src="../../js/custom/gradingscale-create-script.js?d=' + dateString + '"></';
    _string2 = 'script>';
    $('#script_holder').html(_string + _string2 + _string3 + _string2);
</script>
