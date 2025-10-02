<section id="section-surv-main">
    <style>
        #section-surv-main input[type=checkbox],input[type=radio]{
            margin-inline: 1.5rem;
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
    </style>
	<div id = "errormessage"></div>
    <div id="div-survey-header">
		<center>
		<div id="main-survey">
		</div>
		</center>
    </div>
	<center>
		<div id = "div-process" style="font-size: 24px; color: blue;font-style:italic; font-family: Roboto, sans-serif; font-weight: bold; text-decoration: none;">
			loading.......
		</div>
	</center>
	<div id="div-survey-content" style="padding-bottom: 5.5rem;">
		<button type="button" style="float: right;width: auto; height: auto;" 
			class="btn btn-block btn-danger" id="btn-close-survey-content">
		X
		</button> 
		<h3 style="margin-top: 1rem; margin-bottom: 1rem; color: blue;font-family: Roboto, sans-serif; font-weight: bold; text-decoration: underline;" id="hd-survey-content">
		</h3>
		<div id="main-content">
		</div>
		<button type="button" style="margin-left: 4rem; padding-left: 2rem; padding-right: 2rem;width: auto; height: auto; font-size: 16px;font-family: Roboto, sans-serif; font-weight: bold; text-decoration: underline;" 
				class="btn btn-block btn-primary" id="btn-submit-survey" name="btn-submit-survey">Submit
		</button>
    </div>
</section>
<?php
	echo "<script src='../../js/custom/survey-script.js'></script>";
?>
