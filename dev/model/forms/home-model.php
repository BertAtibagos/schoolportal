<section class="container" id="section-datapolicy-container">
	<div class="col" style="width: 100%; height: 100%; padding-block: 1rem;">
		<div class="col" >
			<div class="datacont" style='margin-inline: 1rem; color: black; text-align: left; padding: 0rem;'>
				<div style="background: url('../../images/FCPC LOGO-TRANSPARENT.png') no-repeat center 50%; background-size: contain;">
					<h1> <center> Data Privacy Policy </center></h1>
					<hr>
					<div style='overflow-y: auto; max-height: 75vh;'>
						<i style="font-size: 24px">We care about your Privacy.</i><br><br>

						In order to ensure compliance with Republic Act No. 10173 otherwise known as the “Data Privacy Act of 2012”, we came up with a privacy policy that embodies how FIRST CITY PROVIDENTIAL COLLEGE INC., uses and protects any information that you provide through this application.<br><br>

						This Privacy Policy ensures that all sensitive information/personal data that you provide whenever this website is accessed shall be fully protected and will only be utilized in accordance with this Privacy Policy.<br><br>
						
						<center><i>© Copyright 2023 First City Providential College. All Rights Reserved.</i><center>
					</div>					
				</div>
			</div>
		</div>
	</div>
</section>

<section id="section-announcement-container" class='d-flex' style="padding-bottom: 5rem;">
	<div id='div-announcement' class="m-auto w-50 text-center">
		<?php 
			echo '<script type="text/javascript" src= "../../js/custom/enrollment-announcement-script.js?d='.time().'"></script>';
			session_start();
			if($_SESSION['USERTYPE'] == 'STUDENT'){
				include_once '../enrollment-announcement-model.php';
			}
		?>
	</div>
</section>