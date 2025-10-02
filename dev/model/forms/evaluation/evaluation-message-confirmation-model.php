<section>
<div class="modal fade custom-size" id="evaluation-master-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
				<center><h5 class="modal-title" id="myModalLabel">Confirmation</h5></center>
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
					<div class="modal-footer">
						<!-- <button type="button" class="btn btn-success yes">
							<span class="glyphicon glyphicon-update"></span>Yes
						</button>
						<button type="button" class="btn btn-success no" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>No</button>
						-->
						<button type="button" class="btn btn-success ok">
							<span class="glyphicon glyphicon-update"></span>Ok
						</button>
					</div>
				</div>
		</div>
</div>
<?php
	echo "<script src='../../js/custom/evaluation-message-confirmation-script.js'></script>";
?>
</section>
