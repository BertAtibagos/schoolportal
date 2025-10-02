<section id="section-surv-main" style="padding-bottom: 7.5rem;">
    <style>
        #section-surv-main input[type=checkbox],input[type=radio]{
            margin-left: 2rem;
            margin-right: .5rem;
			font-size: 10px;
        }
		#section-surv-main .img{
			background-image: url('../../images/Completed.png');  /**background-image: url('../../images/Completed.png') , url("paper.gif");**/
			background-color: transparent; 
			background-size: contain; 
			background-position: center;
			background-repeat: no-repeat;
			transition: opacity ease 0.s;
		}
		#section-surv-main p {
			font-size: 14px;
            font-weight: bold;
		}
		#section-surv-main span {
			color: red;
			font-size: 14px;
            font-weight: normal;
		}
        #section-surv-main .tblModal td{
            text-align: left;
            font-size: 18px;
            font-weight: normal;
        }
		#div-list{
			display : block;
		}
		label, input[type="radio"] {
			cursor: pointer;
		}
		.shadow-maker {
			box-shadow: 0px 0px 25px 0px rgba(50,50,50,0.35);
			/* -webkit-box-shadow: 2px 1px 36px 4px rgba(0,0,0,0.35);
			-moz-box-shadow: 2px 1px 36px 4px rgba(0,0,0,0.35); */
		}
		#hd-survey-description {
			text-decoration: none;
			font-weight: normal !important;
			font-size: 18px !important;
			padding-inline: 1.5rem;
		}
    </style>
	<div class="col-lg-6 m-auto">
		<div id="div-list">
			<center>
				<div id="list-survey">
				</div>
				<div id="list-evaluation">
				</div>
			</center>
		</div>

		<div id = "errormessage"></div>
		<div id="div-survey-header">
			<center>
				<div id="main-survey">
				</div>
				<div id="main-evaluation">
				</div>
			</center>
		</div>
	</div>

	<center>
		<div id = "div-process" style="font-size: 24px; color: blue;font-style:italic; font-family: Roboto, sans-serif; font-weight: bold; text-decoration: none;">
			loading.......
		</div>
	</center>
	<div id="div-survey-content" style="padding-top: 1rem; padding-bottom: 5rem; margin: auto; padding-inline: 2rem;" class='col-lg-6 shadow-maker'>
		<button type="button" style="float: right;width: auto; height: auto;" class="btn btn-block btn-danger" id="btn-close-survey-content">X</button> 
		<h3 style="margin-top: 1rem; margin-bottom: 1.5rem; color: blue;font-family: Roboto, sans-serif; font-weight: bold; text-decoration: underline;" id="hd-survey-content">
		</h3>
		<p id="hd-survey-description"></p>
		<div id="main-content">
		</div>
		<!-- <button type="button" style="margin-left: 4rem; padding-left: 2rem; padding-right: 2rem;width: auto; height: auto; font-size: 16px;font-family: Roboto, sans-serif; font-weight: bold; text-decoration: underline;" 
				class="btn btn-block btn-primary" id="btn-submit-survey" name="btn-submit-survey">Submit
		</button> -->
	</div>
</section>

<div style="display: none;" id="script_holder"></div>

<script>
    var currentDate = new Date();
    var dateString = currentDate.toISOString().replace(/[^0-9]/g, ''); // Remove non-numeric characters
    _string = '<script src="../../js/custom/survey-script.js?d=' + dateString + '"></';
    _string2 = 'script>';
    $('#script_holder').html(_string + _string2);
</script>
