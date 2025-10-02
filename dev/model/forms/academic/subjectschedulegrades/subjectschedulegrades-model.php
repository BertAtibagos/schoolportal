<?php 
    // Before session_start()
    ini_set('session.cookie_httponly', 1); // Prevent JavaScript access
    ini_set('session.cookie_secure', 1);    // Send cookie only over HTTPS
    ini_set('session.cookie_samesite', 'Strict'); // Optional: prevent CSRF

	session_start();
?>

<style>
    .watermark-wrapper {
        position: relative;
        overflow-y: hidden;
    }

    /* Watermark text centered */
    .watermark-wrapper::before {
        /* content: '"This is not an official document." "This is not an official document." \A ~~ "This is not an official document." ~~'; */
        content: '~~ "This is not an official document." ~~';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 2.5rem;
        color: rgba(255, 0, 0, 0.15);
        white-space: pre-wrap;
        pointer-events: none;
        z-index: 0;
        font-style: italic;
        width: 100%;
        text-align: center;
    }

    table.watermarked-table {
        background: transparent;

    }
</style>
<section id='sec-subject-schedule-grades' class="section-container container-fluid" style="width: 100%; height: auto;" data-id="<?php echo $_SESSION['USERID'];?>">
	<div id='div-message'> 
	</div>
	<div class='container-fluid' style='width: 100%; height: 100%;'>
		<hr>
		<div class='row'>
            <div class='col-md-2 mb-2'>
                <select id='acadlevel' name='acadlevel' class='form-select' required>
                </select>
            </div>
            <div class='col-md-2 mb-2'>
                <select id='acadyear' name='acadyear' class='form-select' required>
                </select>
            </div>
            <div class='col-md-2 mb-2'>
                <select id='acadperiod' name='acadperiod' class='form-select' required>
                </select>
            </div>
            <div class='col-md-4 mb-2'>
                <select id='acadcourse' name='acadcourse' class='form-select' required>
                </select>
            </div>
            <div class='col-md-2 mb-2'>
                <button id='btnSearch' name='btnSearch' class='btn btn-block btn-primary btnsearch'> Search </button>
            </div>
		</div>
		<hr>
	</div>
	<div class='container-fluid' id='div-grades' style='margin: 0 0 20px 0;padding: 0 0 20px 0; padding-bottom: 7.5rem'>
		<div id='div-grades-list' style="padding:0;margin:0;" class="container-fluid">
			<p id='title-grades' class='title' style='width: 100%; padding: 5 0;'>
			STUDENT GRADE
			</p>
			<div id="errormessage" style="display: none; border: solid 3px red; background-color: #84202933; border-radius: .5rem; padding: .5rem 1rem; margin: .5rem 1rem;">
				<!-- Error message -->
			</div>
            
            <div class="watermark-wrapper">
                <table id='table-grades' class='table table-hover table-responsive table-bordered watermarked-table' style='width: 100%; margin:0; padding:0; user-select: none;'>
                    <thead class='table-primary' id='thead-grades'>
                        <tr>
                            <th scope='col' style='padding:0;margin:0;'>CODE</th>
                            <th scope='col' style='padding:0;margin:0;'>DESCRIPTION</th>
                            <th scope='col' style='padding:0;margin:0;'>UNITS</th>
                            <th scope='col' style='padding:0;margin:0;'>SCHEDULE</th>
                            <th scope='col' style='padding:0;margin:0;'>INSTRUCTOR</th>
                            <th scope='col' style='padding:0;margin:0;'>FINAL GRADE</th>
                            <th scope='col' style='padding:0;margin:0;'>EQUIVALENT</th>
                            <th scope='col' style='padding:0;margin:0;'>REMARKS</th>
                            <th scope='col' style='padding:0;margin:0;'>ACTION</th>
                        </tr>
                    </thead>
                    <tbody id='tbody-grades'>
                        <tr>
                            <td colspan='9' style='font-size: 18px;
                                                        font-family: Roboto, sans-serif;
                                                        font-weight: normal;
                                                        text-decoration: none;
                                                        color: red;'> 
                                LOADING...
                                </td>
                        </tr>
                    </tbody>
                    <tfoot id="tfoot-grades"></tfoot>
                </table>
            </div>
			<div id="errormessage" style="display: block; border: solid 3px red; background-color: #84202933; border-radius: .5rem; padding: .5rem 1rem; margin: .5rem 1rem;">
				<p style="color: red; padding-bottom: 0px; margin-bottom: 0px; margin-top: 5px;"><i><b><u>NOTE:</b></u></i></p>
				<p style="color: black; font-size: 14px; padding-bottom: 0px; margin-bottom: 0px;"><i>This is <b><u>NOT</b></u> an official document. To get your <b><u>Certified Copy of Grades</b></u>, proceed to <b><u>FCPC Registrar's Office</b></u>.</i></p>
				<p style="color: black; font-size: 14px;"><i>Students' grades will only be <u>displayed</u> on the student portal once it has been <u>submitted by the program head/dean and has been approved/verified by the FCPC Registrar's Office</u>.</i></p>
				<p style="color: black; font-size: 14px; padding-bottom: 0px; margin-bottom: 0px;"><i><b>1.</b> Reach out to the <b><u>Registrar's Office</b></u> for courses with <b>"<u>NO DESIGNATED INSTRUCTOR</b>"</u>.</i></p>
				<p style="color: black; font-size: 14px;"><i><b>2.</b> Coordinate with your <b><u>Instructor</b></u> if the course status indicates <b>"<u>NO ENCODED GRADE YET</b>"</u>.</i></p>
			</div>
		</div>
	</div>
</section>
<script src="../../js/custom/subjectschedulegrades-script.js?d=<?php echo time();?>"></script>
