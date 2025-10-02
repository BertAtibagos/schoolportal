<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>FCPC School Portal</title>

<link rel="icon" href="../images/fcpc_logo.ico"/>
<link rel="stylesheet" href="../css/custom/login-style.css" type="text/css" />
<link rel="stylesheet" href="../css/bootstrap//bootstrap-5.2.2/dist/css/bootstrap.bundle.min.css"/>
<link rel="stylesheet" href="../css/bootstrap//bootstrap-5.2.2/dist/css/bootstrap.min.css"/>
<script src="../css/bootstrap/bootstrap-5.2.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/jquery/jquery-3.6.0.min.js"></script>

<body class="jumbotron bg-cover container" style="background-color: transparent;
							background-image:linear-gradient(to right, 
											 rgba(50,150,255,0.4) 10%,
											 rgba(255,255,255,0.7) 50%),
											 url('../images/fcpc - img 1.png');
							background-repeat: no-repeat;
							background-position: left; 
							background-size: 100%;">
	<table class="table" border="0" style="margin: 0; padding:0; position: static;" >
		<tr style="height: 70px;">
			<td colspan="2" style="background-color: transparent;">
				<img src="../images/FCPC_LOGO-PNG.png" width="95px" height="90px" style="position: absolute;" >
				<div class="divcompanyname" style="background-color: transparent;">
					First City Providential College
					<p>Narra, Francisco Homes, City of San Jose Del Monte, Bulacan</p>
				</div>
			</td>
		</tr>
		<tr>
			<td style="width: 70%; height: auto;background-color: transparent;">
				
			</td>
			<td style="background-color: transparent;">
				<div class="card border-0 shadow rounded-3">
				  <div class="card-body p-sm-6">
					<h5 class="card-title text-center mb-3 fw-light fs-4">Sign In</h5>
					<div id="message" style="color: red; font-style: italic;text-align: center;padding: 10 10 10 10;">
					
					</div>
					<form>
						<div class="row">
							<div class="col">
								<div class="form-floating mb-1 fs-12">
									<input type="email" class="form-control" id="useremail" placeholder="name@example.com">
									<label for="floatingInput">Email address</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="form-floating mb-1 fs-12">
									<input type="password" class="form-control" id="userpassword" placeholder="Password">
									<label for="floatingPassword">Password</label>
								</div>
							</div>
						</div>
						<div class="form-check mb-3">
							<input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
							<label class="form-check-label" for="rememberPasswordCheck">
								Forget Password
							</label>
						</div>
					  <div class="d-grid">
						<input type="button" id="btnlogin" name="btnlogin" class="btn btn-primary btn-login text-uppercase fw-bold fs-12"  value="Log-in">
					  </div>
					</form>
				  </div>
				</div>
			</td>
		</tr>
	</table>
	 <script>
		$(document).ready(function(){
			$("#message").hide();
			$("#btnlogin").click(function(){
				var uemail = $("#useremail").val().trim();
				var upass = $("#userpassword").val().trim();
				if (uemail == ''){
					$("#message").show();
					$("#useremail").focus();
					$("#message").html('Type your FCPC email address!');
					exit;
				};
				if (upass == ''){
					$("#message").show();
					$("#userpassword").focus();
					$("#message").html('Type your Password!');
					exit;
				};
				$.ajax({
					type: 'POST',
					url: 'login-controller.php',
					cache: false,
					data: {
							uemail:uemail,
							upass:upass
						  },
					success: function(data){
						var msg = '';
						if(data=='0'){
							msg = 'Invalid UserName or Password';
							$("#message").show();
							$("#message").html(msg);
						} else {
							msg = 'Successful';
							window.location = 'forms/masterpage-model.php';
						} 
					}
				});
			});
		});
	</script>
</body>




