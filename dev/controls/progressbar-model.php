<link href= "../js/jquery/jquery.ui/ui/1.10.4/css/jquery-ui.css" rel="stylesheet" />
<link href= "../js/jquery/jquery.ui/ui/1.10.4/css/jquery-ui.min.css" rel="stylesheet" />
<link href= "../css/custom/progressbar-style.css" rel="stylesheet" />
<script src= "../js/jquery/jquery.ui/ui/1.10.2/js/jquery.min.js"></script>
<script src= "../js/jquery/jquery-1.9.1.js"></script>
<script src= "../js/jquery/jquery.ui/ui/1.10.4/js/jquery-ui.js"></script>
<script src= "../js/jquery/jquery.ui/ui/1.10.4/js/jquery-ui.min.js"></script>
<style>
  #progressbar .ui-progressbar-value{
    background-color: #BFD7ED;
  }
  .progress-form-color{
	  position: absolute;
	  opacity: 0.2;
	  background-color: #003B73;
	  width: 57%;
	  height: 8%;
  }
  .ui-progressbar {
	position: absolute;
    margin: 0;
	padding: 0;
	width: 80%;
	height: 35%;
	top: 30%;
	left: 10%;
	right: 10%;
	bottom: 30%;
  }
  .progress-label {
    position: fixed;
	left: 66%;
    padding: 0;
	margin:0;
	height: auto;
    font-weight: bold;
	color: black;
    text-shadow: 1px 1px 0 #fff;
  }
</style>
<div class="progress-form-color">
<div id="progressbar">
	<div  class="progress-label">Loading...</div>
</div>
</div>


