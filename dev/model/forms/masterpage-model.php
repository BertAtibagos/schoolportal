<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>FCPC School Portal</title> 

<?php
session_start();
if (!isset($_SESSION['USERID']))
	{
	 	header('Location: ../login-model.php');
 	exit();
	}
	// include_once '../../components/masterpage-components.php';
?>
	<link href= "../../css/bootstrap/bootstrap-5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="icon" href="../../images/fcpc_logo.ico" />
	<script type="text/javascript" src= "../../css/bootstrap/bootstrap-5.2.2/dist/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src= "../../js/jquery/jquery/jquery-3.6.3.min.js"></script>
	<script type="text/javascript" src= "../../js/custom/kit_fontawesome-script.js"></script>
	<!-- <script type="text/javascript" src="../../js/custom/notification-display-script.js"></script> -->

<style>
	.body {
		/*background-image: url('../../images/FCPC_LOGO_TRANSPARENT.png');*/
                                  background-size: 100%;
                                  background-repeat: no-repeat;
                                  background-position: center;
                                  /* padding-right: 10px;
                                  margin-right: 10px; */
								  overflow: hidden;
	}
	table#table-summary {
		border-collapse: collapse;   
	}
	
	#table-summary td {
		padding: 3px 5px;
	}
	#table-summary td:hover {
		cursor: pointer;
	}

	.notifier {
		top: -31px;
		right: -180px;
		color: #ff4444;
		font-weight:600;
	}
	.cls.notifier{
		position: absolute;
		top: auto !important;
		right: auto !important;
		left:30px;
		color: white !important; 
		font-weight:600;
		font-size:15px;
		background-color:#ff3d3d;
		height:auto;
		width:23px;
		border-radius:20px;
	}
	.disiblenotifier {
		POSITION: center;
		top: -23px;
		RIGHT: -23px;
		padding: 7px 12px;
		border-radius: 47%;
		background-color: transparent;
		color: transparent;
	}
	table tr th,thead tr th,tr th,th,table thead,thead {
		text-align:center;
		vertical-align: middle;
		margin:0;
		padding:0;
		text-decoration: underline;
		/* font-size: 11px; */
		font-family: Roboto, sans-serif;
		font-weight: bold;
		text-decoration: none;
		color: blue;
	}
	
	table tr td {
		text-align:center; 
		vertical-align: middle;
		width: auto;
		height: auto;
		/* font-size: 10px; */
		font-family: Roboto, sans-serif;
		/* font-weight: bold; */
		text-decoration: none;
		color: black;
	}
	
	tbody {
		/* font-size: 10px; */
		font-family: Roboto, sans-serif;
		/* font-weight: normal; */
		text-decoration: none;
		color: black;
	}
	
	.title {
		text-decoration: underline;
		text-align: center;
		font: bold 15px cambria, serif; 
		width: auto;
		padding: 5 0 5 0;
		margin: 8 0 1 0;
		color: white;
		background-color: rgba(10,50,150,0.5);
	}
	
	#progressbar .ui-progressbar-value{
		background-color: rgba(20,20,255,0.5);
	}
	.progress-form-color{
		position: fixed;
		/*background-color: rgba(10,10,0,0.7);*/
		width: 56%;
		height: 30%;
		margin: 0;
		padding: 0;
		/*width: auto;*/
		/*height: 100%;*/
		background-repeat: no-repeat;
		background-position: center;
		background-size: 100%;
		background-color: transparent;
		background-image:linear-gradient(to bottom, 
		rgba(10,10,0,0.7) 10%,
		rgba(10,10,0,0.2) 50%);
	}
	.ui-progressbar {
		position: fixed;
		margin: 0;
		padding: 0;
		width: 30%;
		height: 3%;
	}
	.progress-label {
		position: relative;
		padding: 0;
		margin:0;
		height: auto;
		color: yellow;
		font-size: 19px;
		text-shadow: 2px 2px 0 black;
		font-family: Roboto, sans-serif;
		text-decoration: none;
		top: 25%;
		left: 22%;
		right: 22%;
		bottom: 30%;
	}
	.label {
		text-align:
		left;
		font-size:11px;
	}
	.viewstudentactive {
		font-size: 10px;
		font-family: Roboto, sans-serif;
		font-weight: normal;
	}
	.viewstudentinactive {
		font-family: Roboto, sans-serif;
		font-weight: normal;
		text-decoration: none;
		color: red;
	}
	/* width */
	.scroll-bar-sidenav::-webkit-scrollbar {
  		width: 5px;
	}
	/* Track */
	.scroll-bar-sidenav::-webkit-scrollbar-track {
  		border-radius: 5px;
	}
	/* Handle */
	.scroll-bar-sidenav::-webkit-scrollbar-thumb{
		background: #1a96e2;
		border-radius: 10px;
	}
	/* Handle 
	.scroll-bar-sidenav::-webkit-scrollbar-thumb{
  	background: #002858;
  	border-radius: 10px;
	}*/
	#spansubmittedgradesnotification{	
		color:#ff4444;
	}

</style>
<body class="body">
	<input type="hidden" name="ifMasterPage" id="ifMasterPage" value="1">

	<div id="master-section" class="container-fluid">
		<div class="col-12">
			<div class="row">
				<div class="col col-md-1 col-xl-1 px-sm-0 offcanvas offcanvas-start" id="demo"
						style="padding-bottom: 25px;
						width:215px;
						padding-right:0;
						padding-left:0;
						height:100vh;
						background-color:#002858;">
					<div style="margin-top:5px; position:absolute">
						<button type="button" class="btn-close text-reset shadow-none" data-bs-dismiss="offcanvas" style="float:right; margin-left:188px; filter: invert(1);"></button>
					</div>
					<center>
						<div id='user-picture' class="align-items-center offcanvas-body" style="margin-bottom:0;padding: 0;"> 
						</div>
						<p id ='user-type' class="user_type" 
								style="margin-top: 10px;
									margin-bottom:0;
									padding: 0;
									color: black;
									background-color: transparent;
									font: 14px system-ui; color:gold; font-weight:600">
							<?php echo $_SESSION['USERNAME']; ?>
						</p>
						<p id = 'user-gender' class="user_gender text-wrap"
								style="margin-top: 5px;
									margin-bottom:0;
									padding: 0 1.25rem 0 1.25rem;
									color:white;
									background-color: transparent;
									font: 10px system-ui;">
							<?php echo $_SESSION['USERINFO']; ?>
						</p>
						<p id = 'user-type' class="user_gender"
								style="margin-top: 10px;
								margin-bottom:0;
								padding: 0;
								color:#1a96e2;
								background-color: transparent;
								font: 12px system-ui; font-weight:600">
							<?php echo $_SESSION['USERTYPE']; ?>
						</p>
					</center>

					<hr class="bar" style="border-top: 1px solid #fffcc0;">

					<div class="scroll-bar-sidenav" style="overflow-y:auto; ">
					<style>
						#mnu-main li{
							width: 100%;
						}

						#mnu-main li a:hover, #mnu-main li ul li a:hover{
							background: #0d6efd;
							border-radius: none;
						}
					</style>
						<ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-sm-start" id="mnu-main">
							<li class="nav-item" id="mnu-home" style="width: -webkit-fill-available;">
								<a href="#" id="user-home" class="main nav-link px-0 align-middle active" data-bs-toggle="tab" style="border-radius:0px"><span class="ms-1 d-sm-inline" style="color:white"> <i style="margin-left:10px;" class="fa fa-home"></i>&nbsp &nbspHome</span></a>
							</li>

							<li class="nav-item" id="mnu-grading-scale" style="width: -webkit-fill-available;">
								<a href="#" id="user-grading-scale" class="main nav-link px-0 align-middle " style="color:white; border-radius:0px" data-bs-toggle="tab"><span class="ms-1  d-sm-inline"><i class="fa fa-list-ol" style="margin-left:10px;"></i>&nbsp &nbspGrading Scale</span></a>
							</li>

							<li class="nav-item" id="mnu-class-list" style="width: -webkit-fill-available;">
								<a href="#" id="user-class-list" class="main nav-link px-0 align-middle" data-bs-toggle="tab" style="color:white; border-radius:0px"><span class="ms-1  d-sm-inline"><i class="fa fa-users" style="margin-left:10px;"></i>&nbsp &nbspClass List</span></a>
							</li>
							<li class="nav-item" id="mnu-enrollment-list" style="width: -webkit-fill-available;">
								<a href="#" id="user-enrollment-list" class="main nav-link px-0 align-middle" data-bs-toggle="tab" style="color:white; border-radius:0px"><span class="ms-1  d-sm-inline"><i class="fa fa-users" style="margin-left:10px;"></i>&nbsp &nbspEnrollment List</span></a>
							</li>
                            <li class="nav-item" id="mnu-examination-permit" style="width: -webkit-fill-available;">
								<a href="#" id="user-examination-permit" class="main nav-link px-0 align-middle" data-bs-toggle="tab" style="color:white; border-radius:0px"><span class="ms-1  d-sm-inline"><i class="fa fa-file-text" style="margin-left:10px;"></i>&nbsp &nbspExamination Permit</span></a>
							</li>
							<li class="nav-item" id="mnu-advising" style="width: -webkit-fill-available;">
								<a href="#" id="user-advising" class="main nav-link px-0 align-middle" style="color:white; border-radius:0px" data-bs-toggle="tab"><span class="ms-1  d-sm-inline"><i class="fa fa-file-alt" style="margin-left:10px; padding-right:4px"></i>&nbsp &nbspAdvising</span></a>
							</li>

							<li class="nav-item" id="mnu-enrollment" style="width: -webkit-fill-available;">
								<a href="#mnu-sub-enrollment" data-bs-toggle="collapse" class="main nav-link px-0 align-middle" style="color:white; border-radius:0px"><span class="ms-1  d-sm-inline" style="color:white"><i class="fa fa-certificate" style="margin-left:10px;"></i>&nbsp &nbspEnrollment &nbsp &nbsp<i class="fa fa-angle-down"></i></span></a>
								<ul class="collapse nav " id="mnu-sub-enrollment" data-bs-parent="#mnu-main">
									<li class="w-100" id="mnu-enrollment-monitoring">
										<a href="#" id="user-enrollment-monitoring" class="list nav-link px-4" data-bs-toggle="tab" style="border-radius:0px 7px 7px 0px; width:90%"><span class=" text-white d-sm-inline" >Monitoring</span></a>
									</li>

									<li class="w-100" id="mnu-online-enrollment">
										<a href="#" id="user-online-enrollment" class="list nav-link px-4" data-bs-toggle="tab" style="border-radius:0px 7px 7px 0px; width:90%"><span class=" text-white d-sm-inline">Online Enrollment</span></a>
									</li>

									<li class="w-100" id="mnu-enrollment-master-list">
										<a href="#" id="user-enrollment-master-list" class="list nav-link px-4" data-bs-toggle="tab" style="border-radius:0px 7px 7px 0px; width:90%"><span class=" text-white d-sm-inline" >Master List</span></a>
									</li>

									<li class="w-100" id="mnu-enrollment-history">
										<a href="#" id="user-enrollment-history" class="list nav-link px-4" data-bs-toggle="tab" style="border-radius:0px 7px 7px 0px; width:90%"><span class=" text-white d-sm-inline">Enrollment History</span></a>
									</li>
								</ul>
							</li>

							<li class="nav-item" id="mnu-submitted-grades" style="width: -webkit-fill-available;">
								<a href="#" id="user-submitted-grades" class="main nav-link px-0 align-middle" style="color:white; border-radius:0px" data-bs-toggle="tab" ><span class="ms-1  d-sm-inline"><i class="fa fa-file-import" style="margin-left:10px;"> </i>&nbsp &nbspSubmitted Grades</span></span><span id = "notifier-submitted-grades-count" class="notifier" style="float: right; text-shadow: 1px 1px black; padding-right: 1rem;"></span></a>
							</li>

							<li class="nav-item w-100" id="mnu-payment" style="width: -webkit-fill-available;">
								<a href="#mnu-sub-payment" data-bs-toggle="collapse" class="main nav-link px-0 align-middle" style="color:white; border-radius:0px"><span class="ms-1  d-sm-inline" style="color:white"><i class="fa fa-credit-card" style="margin-left:10px;"></i>&nbsp &nbspPayment &nbsp &nbsp<i class="fa fa-angle-down"></i></span></a>
								<ul class="collapse nav flex-column" id="mnu-sub-payment" data-bs-parent="#mnu-main">
									<li class="w-100" id="mnu-online-payment">
										<a href="#" id="user-online-payment" class="list nav-link px-4" data-bs-toggle="tab" style="border-radius:0px 7px 7px 0px; width:90%"><span class=" text-white d-sm-inline">Online Payment</span></a>
									</li>

									<li class="w-100" id="mnu-payment-history">
										<a href="#" id="user-payment-history" class="list nav-link px-4" data-bs-toggle="tab" style="border-radius:0px 7px 7px 0px; width:90%"><span class=" text-white d-sm-inline">Payment History</span></a>
									</li>
								</ul>
							</li>
							<li class="nav-item" id="mnu-grade-history" style="width: -webkit-fill-available;">
								<a href="#" id="user-grade-history" class="main nav-link px-0 align-middle" data-bs-toggle="tab" style="border-radius:0px;"><span class="ms-1  d-sm-inline" style="color:white;"><i class="fa fa-award" style="margin-left:10px"></i>&nbsp &nbspGrade History</span></a>
							</li>

							<li class="nav-item" id="mnu-academic" style="width: -webkit-fill-available;">
								<a href="#" id="user-academic" class="main nav-link px-0 align-middle" data-bs-toggle="tab" style="border-radius:0px;"><span class="ms-1  d-sm-inline" style="color:white;"><i class="fa fa-award" style="margin-left:10px"></i>&nbsp &nbspAcademic</span></a>
							</li>

							<li class="nav-item" id="mnu-grades" style="width: -webkit-fill-available;">
								<a href="#" id="user-grades" class="main nav-link px-0 align-middle" style="color:white; border-radius:0px" data-bs-toggle="tab"><span class="ms-1  d-sm-inline"><i class="fa fa-graduation-cap" style="margin-left:10px"></i>&nbsp &nbspGrades</span></a>
							</li>

							<li class="nav-item" id="mnu-reports" style="width: -webkit-fill-available;">
								<a href="#" id="user-reports" class="main nav-link px-0 align-middle" style="color:white; border-radius:0px" data-bs-toggle="tab"><span class="ms-1  d-sm-inline"><i class="fa fa-pie-chart" style="margin-left:10px"></i>&nbsp &nbspReports</span></a>
							</li>

                            <li class="nav-item" id="mnu-career-survey" style="width: -webkit-fill-available;">
								<a href="#" id="user-career-survey" class="main nav-link px-0 align-middle" style="color:white; border-radius:0px" data-bs-toggle="tab"><span class="ms-1  d-sm-inline"><i class="fa fa-clipboard" style="margin-left:10px"></i>&nbsp &nbspCareer Interest Survey</span></a>
							</li>

                            <li class="nav-item" id="mnu-survey" style="width: -webkit-fill-available;">
								<a href="#" id="user-survey" class="main nav-link px-0 align-middle" style="color:white; border-radius:0px" data-bs-toggle="tab"><span class="ms-1  d-sm-inline"><i class="fa fa-clipboard" style="margin-left:10px"></i>&nbsp &nbspSurvey</span></a>
							</li>

                            <li class="nav-item" id="mnu-evaluation" style="width: -webkit-fill-available;">
								<a href="#" id="user-evaluation" class="main nav-link px-0 align-middle" style="color:white; border-radius:0px" data-bs-toggle="tab"><span class="ms-1  d-sm-inline"><i class="fa fa-pencil" style="margin-left:10px"></i>&nbsp &nbspEvaluation</span></a>
							</li>

							<li class="nav-item" id="mnu-analytics" style="width: -webkit-fill-available;">
								<a href="#" id="user-analytics" class="main nav-link px-0 align-middle" style="color:white; border-radius:0px" data-bs-toggle="tab"><span class="ms-1  d-sm-inline"><i class="fa fa-line-chart" style="margin-left:10px"></i>&nbsp &nbspAnalytics</span></a>
							</li>

							<li class="nav-item" id="mnu-attendance" style="width: -webkit-fill-available;">
								<a href="" id="user-attendance" class="main nav-link px-0 align-middle" style="color:white; border-radius:0px" data-bs-toggle="tab"><span class="ms-1  d-sm-inline"><i class="fa fa-check-square" style="margin-left:10px" ></i>&nbsp &nbspAttendance</span></a>
							</li>

							<li class="nav-item" id="mnu-tuition" style="width: -webkit-fill-available;">
								<a href="" id="user-tuition" class="main nav-link px-0 align-middle" style="color:white; border-radius:0px" data-bs-toggle="tab"><span class="ms-1  d-sm-inline"><i class="fa fa-peso-sign" style="margin-left:10px" ></i>&nbsp &nbspTuition Fee</span></a>
							</li>

							<li class="nav-item" id="mnu-permit" style="width: -webkit-fill-available;">
								<a href="" id="user-permit" class="main nav-link px-0 align-middle" style="color:white; border-radius:0px" data-bs-toggle="tab"><span class="ms-1  d-sm-inline"><i class="fa fa-key" style="margin-left:10px" ></i>&nbsp &nbspPermit</span></a>
							</li>

							<li class="nav-item" id="mnu-tadi" style="width: -webkit-fill-available;">
								<a href="" id="user-tadi" class="main nav-link px-0 align-middle" style="color:white; border-radius:0px" data-bs-toggle="tab"><span class="ms-1  d-sm-inline"><i class="fa-regular fa-rectangle-list" style="margin-left:10px" ></i>&nbsp &nbspTadi</span></a>
							</li>
							
							<li class="nav-item" id="mnu-create-user" style="width: -webkit-fill-available;">
								<a href="" id="user-create-user" class="main nav-link px-0 align-middle" style="color:white; border-radius:0px" data-bs-toggle="tab"><span class="ms-1  d-sm-inline"><i class="fa fa-user-pen" style="margin-left:10px" ></i>&nbsp &nbspUsers</span></a>
							</li>

							<li class="nav-item" id="mnu-survey-monitoring" style="width: -webkit-fill-available;">
								<a href="" id="user-survey-monitoring" class="main nav-link px-0 align-middle" style="color:white; border-radius:0px" data-bs-toggle="tab"><span class="ms-1  d-sm-inline"><i class="fa fa-check-square" style="margin-left:10px" ></i>&nbsp &nbspSurvey Monitoring</span></a>
							</li>

							<li class="nav-item" id="mnu-my-account" style="width: -webkit-fill-available;">
								<a href="#mnu-sub-my-account" data-bs-toggle="collapse" class="main nav-link px-0 align-middle" style="color:white; border-radius:0px"><span class="ms-1  d-sm-inline" style="color:white" ><i class="fa fa-address-card" style="margin-left:10px"></i>&nbsp&nbspMy Account &nbsp &nbsp<i class="fa fa-angle-down"></i></span></a>
								<ul class="collapse nav flex-column " id="mnu-sub-my-account" data-bs-parent="#mnu-main">
									<li class="w-100" id="mnu-profile" >
										<a href="#" id="user-profile" class="list nav-link px-4" data-bs-toggle="tab" style="border-radius:0px 7px 7px 0px; width:90%"><span class="text-white d-sm-inline">Profile</span></a>
									</li>

									<li class="w-100" id="mnu-change-password">
										<a href="#" id="user-change-password" class="list nav-link px-4" data-bs-toggle="tab" style="border-radius:0px 7px 7px 0px; width:90%"><span class="text-white d-sm-inline">Change Password</span></a>
									</li>

									<li class="w-100" id="mnu-log-out">
										<a href="#" id="user-log-out" class="list nav-link px-4" data-bs-toggle="tab" style="border-radius:0px 7px 7px 0px; width:90%"><span class="text-white d-sm-inline">Log-out</span></a>
									</li>

									<hr class="w-100" style="border-color: white; margin: 0;padding: 0;">

									<li class="w-100" id="mnu-help">
										<a href="#" id="user-help" class="list nav-link px-4" data-bs-toggle="tab" style="border-radius:0px 7px 7px 0px; width:90%"><span class="text-white d-sm-inline">Help</span></a>
									</li>

									<li class="w-100" id="mnu-about">
										<a href="#" id="user-about" class="list nav-link px-4" data-bs-toggle="tab" style="border-radius:0px 7px 7px 0px; width:90%"><span class="text-white d-sm-inline">About</span></a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				<div id="input-hidden-div" hidden></div>
				<div class="col" id="maindiv" style="margin: 0; padding: 0;width: 100%;">
					<div class="container-fluid" 
							style="margin: 0;
							padding: 0;
							position: fixed;
							width: 100%;
							height: auto;
							background-color: #002858;">
						<table style="padding: 0;margin-left:5px; margin-right:0;margin-top: 10px;margin-bottom: 10px;height: auto; ">
							<tr class="stud-name" >
								<td rowspan="2" style="width:10px"><span id = "notifier-submitted-grades-count" class="cls notifier" ></span><button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo" id="borger" style="border:none">
									<i class="fa fa-bars" style="color: #ffffff;"></i>
								</td>

								<td style="width: auto;
										height: auto; 
										margin: 0; 
										padding-right: 0;
										padding-left: 10px;
										text-align: left;
										font: 14px system-ui;
										color: gold;
										font-weight:bold;">
									<?php echo $_SESSION['USERNAME']; ?>
								</td>
							</tr>
							<tr>
								<td style="width: auto;
									height: auto; 
									margin: 0; 
									padding-right: 0;
									padding-left: 10px;
									text-align: left;
									font: 11px system-ui;
									color: white;"><?php echo $_SESSION['USERINFO']; ?>
								</td>
							</tr>
						</table>
					</div>
					<section class="row" id="maindiv" style="width: 100%;margin-top: 60px;margin-left:0; margin-right: 0;margin-bottom: 0;">
						<div style="text-decoration: none;
								text-align: right;
								font: italic 22px cambria, serif; 
								width: 100%;
								padding-right: 10px;
								padding-top: 2px;
								padding-bottom: 5px; 
								color: white;
								background-color: transparent;
								font: 20px system-ui;
								background-image:linear-gradient(to left,
								rgba(10,50,150,0.9) 1%,
								rgba(255,255,255,0.9) 90%);
								margin-top:1px;display:none;" class="container-fluid">
							<p id='masterpage-menu-label' style="padding:0;margin:0;"></p>
						</div>

						<div class="container-fluid" id="user-section" 
							style="width: 100%;
							height: 100vh;
							padding: 0.5rem 0.5rem 0 0.5rem;
							margin-top: 3px;
							overflow:auto;">
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
    <div style="display: none;" id="script_holder"></div>
</body>
</html>


<script>
    var currentDate = new Date();
    var dateString = currentDate.toISOString().replace(/[^0-9]/g, ''); // Remove non-numeric characters
    _string = '<script src="../../js/custom/masterpage-script.js?d=' + dateString + '"></';
    _string2 = 'script>';
    $('#script_holder').html(_string + _string2);
</script>

<?php
    echo "<script src='../../js/custom/sidebar-menu-script.js'></script>";

    if (isset($_SESSION['USERTYPE']) && isset($_SESSION['USERACCESSRIGHTS'])){
		$elements = explode(",", $_SESSION['USERACCESSRIGHTS']);

        if ($_SESSION['USERTYPE'] != 'STUDENT'){
			if (in_array('mnu-submitted-grades', $elements)) {
            	echo "<script src='../../js/custom/checksubmittedrequest-script.js'></script>";
			}
        }
    }
?>

