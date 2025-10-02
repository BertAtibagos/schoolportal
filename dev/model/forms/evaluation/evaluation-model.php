<section id="section-eval-main">
    <style>
		/**html,
		*{
			cursor: none;
		}
		.cursor{
		   position: fixed;
		   width: 20px;
		   height: 20px;
		   border-radius: 50%;
		   background-color: #f5f5f5;
		   pointer-events: none;
		   mix-blend-mode: difference;
		   z-index: 999;
		   transition: transform 0.2s;
		 }
		 **/
        #section-eval-main input[type=checkbox],input[type=radio]{
            margin-inline: 1.5rem;
			font-size: 10px;
        }
		
		#section-eval-main .img{
			background-image: url('../../images/Completed.png');  /**background-image: url('../../images/Completed.png') , url("paper.gif");**/
			background-color: transparent; 
			background-size: contain, cover;
			background-position: center;
			background-repeat: no-repeat;
			transition: opacity ease 0.s;
			padding: 25px;
			position: relative;
		}
		
		#section-eval-main p {
			font-size: 14px;
            font-weight: bold;
		}
		#section-eval-main span {
			color: red;
			font-size: 14px;
            font-weight: normal;
		}
        #section-eval-main .tblModal td{
            text-align: left;
            font-size: 18px;
            font-weight: normal;
        }
    </style>
    <div id="div-eval-header">
		<center>
		<div id="main-eval">
		</div>
		</center>
    </div>
	<center>
		<div id = "div-process" style="font-size: 24px; color: blue;font-style:italic; font-family: Roboto, sans-serif; font-weight: bold; text-decoration: none;">
			loading.......
		</div>
	</center>
	<div id="div-eval-content" style="padding-bottom: 5.5rem;">
		<div>
		<button type="button" style="float: right;width: auto; height: auto;" 
			class="btn btn-block btn-danger" id="btn-close-eval-content">X</button>
		<h3 style="margin-top: 1rem; margin-bottom: 1rem; color: blue;font-family: Roboto, sans-serif; font-weight: bold; text-decoration: underline;" id="hd-eval-content">
		<h3>
		</div>
		<div id="main-content">
		</div>
    </div>
	<?php
		echo '<script src="../../js/custom/evaluation-script.js"></script>';
		include_once 'evaluation-message-confirmation-model.php';
	?>
</section>
