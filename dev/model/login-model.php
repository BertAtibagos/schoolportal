<?php 
	session_start();

    // Define the bypass code (can be stored securely elsewhere)
    $maintenanceBypassCode = '011000';

    // Check if maintenance mode is enabled
    $_SESSION['maintenance'] = 0;

    if (!empty($_SESSION['maintenance']) && $_SESSION['maintenance'] === 1) {

        // Allow bypass if correct code is in the URL
        if (isset($_GET['force']) && $_GET['force'] === $maintenanceBypassCode) {
            // Set session flag to allow bypass on future requests
            $_SESSION['bypass_maintenance'] = true;
        }

        // Redirect to maintenance page if not bypassed
        if (empty($_SESSION['bypass_maintenance'])) {
            session_destroy();
            header('Location: ../../maintenance.php');
            exit("Site on maintenance");
        }
    }

	if (isset($_SESSION['USERID'])) {
		header('Location: forms/masterpage-model.php');
		exit();
	};
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>FCPC School Portal</title> 
	<link rel="icon" href="../images/fcpc_logo.ico" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<link rel="stylesheet" href="../css/bootstrap/bootstrap-5.2.2/dist/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="../css/custom/fonts-style.css"/>
	<script type="text/javascript" src= "../css/bootstrap/bootstrap-5.2.2/dist/js/bootstrap.bundle.min.js"></script>
	<!-- <script type="text/javascript" src= "../js/jquery/jquery/jquery-3.6.3.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

	<script type="text/javascript" src= "../js/custom/enrollment-announcement-script.js?t=<?php echo time() ?>"></script>
</head>

<body style="background: url('../images/Industriya.jpg') no-repeat center fixed; background-size: cover; overflow: hidden;">
	<style>
		#div-login-container{
			background-color: #040276d9;
			position: relative;
			left: 0;
			max-width: 50%;
			height: 100vh;
			transform-origin: left;
			animation: slide-left 750ms ease-in-out forwards;
        	box-shadow: 10px 0 20px 1px rgba(0,0,0,0.5);
			overflow: auto;
		}
		@keyframes slide-left {
			from {
				transform: translateX(-100%);
			}
			to {
				transform: translateX(0);
			}
		}
		#div-fpass-container{
			background-color: #040276d9;
			position: relative;
			right: 0;
			max-width: 50%;
			height: 100vh;
			transform-origin: right;
			animation: slide-right 750ms ease-in-out forwards;
        	box-shadow: -10px 0 20px 1px rgba(0,0,0,0.5);
		}
		@keyframes slide-right {
			from {
				transform: translateX(200%);
			}
			to {
				transform: translateX(100%);
			}
		}
		.animate {
			position: fixed;
			bottom: 0;
			width: 100%;
			height: 100vh;
			animation: slide-up 750ms ease-in-out forwards;
		}
		@keyframes slide-up {
			from {
				transform: translateY(100%);
			}
			to {
				transform: translateY(0);
			}
		}
		#div-policy-back{
			padding-inline: 5rem;
		}
		#div-policy-content{
			padding-inline: 5rem;
			overflow-y: auto;
			max-height: 85%;
		} 

		@media(orientation: portrait) {
			body{
				margin: 0;
				padding: 0;
				display: flex;
				align-items: center;
				justify-content: center;
				height: 100vh;
			}
			#div-login-container{
				margin: auto;
				max-width: 80%;
				height: 80vh;
        		text-align: center;
				padding: 0 1rem;
				box-shadow: 0 10px 10px 10px rgba(0,0,0,0.5);
				animation: slide-left2 750ms ease-in-out forwards;
				overflow: auto;
			}
			@keyframes slide-left2 {
				from {
					transform: translateX(-100%);
				}
				to {
					transform: translateX(0);
				}
			}
			#div-fpass-container{
				margin: auto;
				max-width: 80%;
				height: 80vh;
        		text-align: center;
				padding: 0 1rem;
				box-shadow: 0 10px 10px 10px rgba(0,0,0,0.5);
				animation: slide-right2 750ms ease-in-out forwards;
			}
			@keyframes slide-right2 {
				from {
					transform: translateX(200%);
				}
				to {
					transform: translateX(0%);
				}
			}
			#div-policy-pic{
				display: none;
			}
			#div-policy-text{
				margin: auto;
				max-width: 80%;
				box-shadow: 0 10px 10px 10px rgba(0,0,0,0.5);
			}
			#div-policy-text-box{
				height: 80vh;
				padding-block: 1.5rem;
			}
			#div-policy-back{
				padding-inline: 1.5rem;
			}
			#div-policy-content{
				padding-inline: 1.5rem;
				overflow-y: auto;
				max-height: 65vh;
			} 
			#policy-text, #policy-back{
				font-size: 1rem !important;
			}
		}

        .error {
            border: solid 3px #c90000;
            background-color: #ff6a0080;
        }

        .warning {
            border: solid 3px #c99a00;
            background-color: #ffd66480;
        }

        .success {
            border: solid 3px #00c90e;
            background-color: #09ff006b;
        }

        .info {
            border: solid 3px #00b4c8;
            background-color: #64c8ff80;
        }
	</style> 
	<div id='div-login-container'>
		<div class="d-flex align-items-center justify-content-center w-100 h-100">
			<div class="p-2 m-2 text-center col-lg-7 h-75">
				<form>
					<h2><p style='color: white; font-family: "Anton";'> First City Providential College </p></h2>
					<h2><p style='color: #fdcb0a; font-family: "Anton";'> School Portal </p></h2>
					<!-- <h4><p style='color: white; font-family: "Anton";'> Sign In Form </p></h4> -->
					
					<div id='login-message' style="border-radius: .5rem; padding: .5rem 1rem; color: white;">
					</div>

					<div class="my-2">
						<input type="email" class="form-control p-2" name="useremail" id="useremail" placeholder="Username" required="_required"/>
					</div>

                    <div class="my-3">
                        <div class="input-group">
                            <input type="password" class="form-control p-2" name="userpassword" id="userpassword" aria-describedby="view-password" placeholder="•••••••" required="_required">
                            <button class="btn btn-warning" type="button" id="view-password"><i class="fa-solid fa-eye"></i></button>
                        </div>
                    </div>
                    
					<input type="button" id="btnlogin" name="btnlogin" class="btn btn-lg btn-block text-white w-100 mt-3" value="Sign in" style='background-color: #fdcb0a;'/>

					<div class="mt-4 text-white">
						<a href="#" class="text-white" id='fpass'>Forgot Password</a>
					</div>
				</form>

				<div class='text-white text-wrap mt-4 div-data-privacy'>
					By using this service, you understood and agree to <a href='#' class='text-white policy-text pe-auto'>Data Privacy Policy</a>.
				</div>

				<div id='div-announcement' class='text-white'>
					<?php
						include_once 'enrollment-announcement-model.php';
					?>

				</div>
			</div>
		</div>
	</div>
	<div id='div-fpass-container'>
		<div class="d-flex align-items-center justify-content-center w-100 h-100">
			<div class="p-2 m-2 text-center col-lg-7 h-75">
				<form>
					<h2><p style='color: white; font-family: "Anton";'> First City Providential College </p></h2>
					<h2><p style='color: #fdcb0a; font-family: "Anton";'> School Portal </p></h2>
					<h4><p style='color: white; font-family: "Anton";'> Forgot Password </p></h4>
					
					<div id='fpass-message' style="border-radius: .5rem; padding: .5rem 1rem; color: white;">
					</div>

					<div class="my-2">
						<input type="email" class="form-control p-2" name="fpass-useremail" id="fpass-useremail" placeholder="FCPC Email Address" required="_required"/>
					</div>
					<div class="row my-2 text-start px-4 text-light">
						<div class="form-check col-md-6">
							<input class="form-check-input" type="radio" name="usertype" id="fpass-usertype1" value="Student">
							<label class="form-check-label" for="fpass-usertype1"> Student </label>
						</div>
						<div class="form-check col-md-6">
							<input class="form-check-input" type="radio" name="usertype" id="fpass-usertype2" value="Instructor">
							<label class="form-check-label" for="fpass-usertype2"> Instructor </label>
						</div>
					</div>
                    
                    <!-- Google reCAPTCHA widget -->
                    <div class="g-recaptcha d-flex justify-content-center m-4" data-sitekey="6LfweHorAAAAAMxCvkqiqCSzez41nNG1_pnupWpP"></div>
					
					<input type="button" id="btnSubmit" name="btnSubmit" class="btn btn-lg btn-block text-white w-100 mt-2" value="Send Reset Link" style='background-color: #fdcb0a;'/>
				
					<div class="mt-4 text-white">
						<a href="#" class="text-white" id='fpass-back'>Back</a>
					</div>
				</form>

				<div class='text-white text-wrap mt-4 div-data-privacy'>
					By using this service, you understood and agree to <a href='#' class='text-white policy-text pe-auto'>Data Privacy Policy</a>.
				</div>
			</div>
		</div>
	</div>
	<div id='div-policy-container'>
		<div class="row h-100">
			<div class="col bg-white d-flex align-items-center" id='div-policy-text'>
				<div id='div-policy-text-box'>
					<div class="text-white mx-2" id='div-policy-back'>
						<a href="#" class="text-black text-decoration-none" id='policy-back' style='font-size: 1.5rem;'><i class="fa fa-angle-left"></i> Back</a>
					</div>
					<div id='div-policy-content'>
						<h1 style='font-family: "Anton";'> <center> Data Privacy Policy </center></h1>
						
						<div class='p-8 mt-4'>
							<p style='font-family: "Lato"; font-size: 1.5rem; text-align: justify;' class='text-black' id='policy-text'>
								In order to ensure compliance with Republic Act No. 10173 otherwise known as the “Data Privacy Act of 2012”, we came up with a privacy policy that embodies how FIRST CITY PROVIDENTIAL COLLEGE INC., uses and protects any information that you provide through this application.
								This Privacy Policy ensures that all sensitive information/personal data that you provide whenever this website is accessed shall be fully protected and will only be utilized in accordance with this Privacy Policy.
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col bg-primary" style="background: url('../images/Sarihumpay.jpg') no-repeat right fixed; background-size: cover;" id='div-policy-pic'>
				
			</div>
		</div>
	</div>
	
    
    <script type="text/javascript" src= "../js/custom/login-script.js?d=<?php echo time();?>"></script>
	
</body>
</html>