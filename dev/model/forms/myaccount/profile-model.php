<?php
	session_start();
	include_once '../../configuration/connection-config.php';
	// echo $_SESSION['USERTYPE'];
	// echo $_SESSION['USERID'];
?>

<style>
	td {
		font: 12px system-ui;
		font-weight:bold;
		color: black;
		text-align: left !important;
		padding: 0.25rem !important;
	}
	.menu-tab{
		margin-top:10px;
	}
	.head{
		background-color:#e7e7e7;
		border-radius:12px 12px 0px 0px;
	}
	.tab{
		/*font:1vw system-ui; */
	}
	.info_label{
		font:15px system-ui;
		font-weight:600;
		width:12%;
	}
	.tab-content{
		border-left:1px solid #e7e7e7;
		border-right:1px solid #e7e7e7;
		border-bottom:1px solid #e7e7e7;
		border-radius:0px 0px 12px 12px;
		padding:10px;
	}
	.table_info{
		margin-bottom:0 !important;
		font:13px system-ui;
		margin-left: 1rem;
	}
	.table_info.bday{
		text-transform: uppercase;
	}
	.tab.nav-link{
		color:#003f9d;
		border-radius:12px 12px 0px 0px;
		padding:8px;
	}

	
	.profilePane{
		background-color:#e7e7e7;
		border-radius:10px;
	}
	.clrpane{
		height:200px;
		border-radius:10px 10px 0px 0px;
		background-image: url('../../images/user-profile-cover.png');
		object-fit:cover;
	}
	#fullname{
		margin-block: 0.5rem;
		font: 22px system-ui;
		font-weight: bold;
	}
	#imgProf{
		margin-left: 20px !important;
		margin-top: -50px !important;
	}
	.bttmPane{
		padding-bottom:10px;
		display: flex;
	}
	.profile-info{
		margin-left: 1.5rem;
	}
	@media (orientation: portrait) {
		.bttmPane{
			display: block;
		}
	}
</style>

<section class='container-fluid' style='padding-right: 10px; padding-left: 10px; padding-bottom: 100px; margin-left: 0;margin-right: 0;'>
	<div>
		<input type='hidden' id='usertype' value='<?php echo $_SESSION['USERTYPE']; ?>' readonly>
		<div id='tryy'>
		</div>
	
		<div id='profile'> <!--main div of table-->
			<div class="profilePane">
				<div class="clrpane">
				</div>
				<div class="bttmPane">
					<div id='profile-picture'>
					</div>
					<div class="profile-info">
						<p id="fullname"></p>
						<p id="gradeSec"></p>
					</div>
				</div>
			</div>

			<nav class="menu-tab">
				<div class="head nav nav-tabs" id="nav-tab" role="tablist">
					<button class="1 tab nav-link active shadow-none" id="1 nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Other Information</button>
					<button class="2 tab nav-link shadow-none" id="2 nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Contact Information</button>
					<button class="3 tab nav-link shadow-none" id="3 nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Addresses</button>
					<button class="4 tab nav-link shadow-none" id="4 nav-academic-tab" data-bs-toggle="tab" data-bs-target="#nav-academic" type="button" role="tab" aria-controls="nav-academic" aria-selected="false">Academic information</button>
					<button class="5 tab nav-link shadow-none" id="5 nav-family-tab" data-bs-toggle="tab" data-bs-target="#nav-family" type="button" role="tab" aria-controls="nav-family" aria-selected="false">Family information</button>
				</div>
			</nav>

			<div class="tab-content" id="nav-tabContent">
				<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
					<table class='table table-borderless table-responsive'>
						<tr>
							<td class="info_label">Gender: </td>
							<td><p class="table_info" id="gender"></p></td>
						</tr>
						<tr>
							<td class="info_label">Age: </td>
							<td><p class="table_info" id="age"></p></td>
						</tr>
						<tr>
							<td class="info_label">Birthday: </td>
							<td><p class="table_info bday" id="birthday"></p></td>
						</tr>
						<tr>
							<td class="info_label">Birthplace: </td>
							<td><p class="table_info" id="birthplc"></p></td>
						</tr>
						<tr>
							<td class="info_label">Religion: </td>
							<td><p class="table_info" id="religion"></p></td>
						</tr>
						<tr>
							<td class="info_label">Civil Status: </td>
							<td><p class="table_info" id="civilStat"></p></td>
						</tr>
						<tr>
							<td class="info_label">Nationality: </td>
							<td><p class="table_info" id="nationality"></p></td>
						</tr>
					</table>
				</div>

				<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
					<table class='table table-borderless table-responsive'>
						<tr>
							<td class="info_label">Email: </td>
							<td><p class="table_info" id="email"></p></td>
						</tr>
						<tr>
							<td class="info_label">Mobile No.: </td>
							<td><p class="table_info" id="mobileNo"></p></td>
						</tr>
						<tr>
							<td class="info_label">Telephone No.: </td>
							<td><p class="table_info" id="telNo"></p></td>
						</tr>
					</table>
				</div>

				<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
					<table class='table table-borderless table-responsive'>
						<tr>
							<td class="info_label">Present Address: </td>
							<td><p class="table_info" id="presAdd"></p></td>
						</tr>
						<tr>
							<td class="info_label">Permanent Address: </td>
							<td><p class="table_info" id="permAdd"></p></td>
						</tr>
					</table>
				</div>

				<div class="tab-pane fade" id="nav-academic" role="tabpanel" aria-labelledby="nav-academic-tab">
					<table class='table table-borderless table-responsive'>
						<tr>
							<td class="user1 info_label">Student No.:</td>
							<td><p class="table_info" id="studNo"></p></td>
						</tr>
						<tr>
							<td class="user2 info_label">LRN:</td>
							<td><p class="table_info" id="lrn"></p></td>
						</tr>
					</table>
				</div>
	
				<div class="tab-pane fade" id="nav-family" role="tabpanel" aria-labelledby="nav-family-tab">
					<table class='table table-borderless table-responsive'>
						<tr>
							<td class="user1 info_label">Father:</td>
							<td><p class="table_info text-decoration-underline" id="father"></p></td>
						</tr>
						<tr>
							<td class="user1 info_label">Contact No.:</td>
							<td><p class="table_info" id="father-contact"></p></td>
						</tr>
						<tr>
							<td class="user1 info_label">Email:</td>
							<td><p class="table_info" id="father-email"></p></td>
						</tr>
						<tr>
							<td style="height:10px"></td>
						</tr>
						<tr>
							<td class="user2 info_label">Mother:</td>
							<td><p class="table_info text-decoration-underline" id="mother"></p></td>
						</tr>
						<tr>
							<td class="user2 info_label">Contact No.:</td>
							<td><p class="table_info" id="mother-contact"></p></td>
						</tr>
						<tr>
							<td class="user2 info_label">Email:</td>
							<td><p class="table_info" id="mother-email"></p></td>
						</tr>
						<tr>
							<td style="height:10px"></td>
						</tr>
						<tr>
							<td class="user2 info_label">Guardian:</td>
							<td><p class="table_info text-decoration-underline" id="guardian"></p></td>
						</tr>
						<tr>
							<td class="user2 info_label">Contact No.:</td>
							<td><p class="table_info" id="guardian-contact"></p></td>
						</tr>
						<tr>
							<td class="user2 info_label">Email:</td>
							<td><p class="table_info" id="guardian-email"></p></td>
						</tr>
						<tr>
							<td class="user2 info_label">Relationship:</td>
							<td><p class="table_info" id="guardian-relationship"></p></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
	echo '<script src="../../js/custom/profile-script.js"></script>';
?>