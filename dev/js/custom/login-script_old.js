$(document).ready(function(){
	$("#fpass-message").hide();
	$('#div-fpass-container').hide();
	$('#div-login-container').show();
	$('#div-policy-container').hide();

	$('#fpass').click(function(){
		$('#div-login-container').hide();
		$('#div-fpass-container').show();
	});

	$('#fpass-back').click(function(){
		$('#div-login-container').show();
		$('#div-fpass-container').hide();
		$("#fpass-message").hide();
	});
	
	$('#policy-back').click(function(){
		$('#div-login-container').show();
		$('#div-fpass-container').hide();
		$('#div-policy-container').hide();
	});

	$('.policy-text').click(function(){
		$('#div-login-container').hide();
		$('#div-fpass-container').hide();
		$('#div-policy-container').addClass('animate');
		$('#div-policy-container').show();
		$("#fpass-message").hide();
	});

	$('.enroll-text').click(function(){
		$("#message").show();
		$("#useremail").focus();
		$("#message").html('Please type your Username & Password');
	});

	//=========================================================================

	$("#message").hide();
	$('#useremail').keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){
		   $("#btnlogin").click();
		}
	});
	$('#userpassword').keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){
		   $("#btnlogin").click();
		}
	});
	$('#fpass-useremail').keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){
		   $("#btnSubmit").click();
		}
	});

	$("#btnlogin").click(function(){
		try { 
			var uemail = $("#useremail").val().trim();
			var upass = $("#userpassword").val().trim();
			if (uemail == ''){
				$("#message").show();
				$("#useremail").focus();
				$("#message").html('Type your FCPC email address!');
				return;
			};
			if (upass == ''){
				$("#message").show();
				$("#userpassword").focus();
				$("#message").html('Type your Password!');
				return;
			};
			$.ajax({
				type: 'POST',
				url: 'login-controller.php',
				//cache: false,
				data: {
						uemail:uemail,
						upass:upass
					  },
				beforeSend: function (status) {
					$(document.body).css({ 'cursor': 'wait' });
				},
				success: function(result){
					//var ret = JSON.parse(result);
					if (result){
						var ret = parseInt(result);
						var msg = '';
						//if(ret.length) {
						//	$.each(ret, function(key, value) {
						//		alert(value.USER_STATUS);
						if(result == 0){ // WRONG EMAIL OR PASSWORD
							msg = 'Invalid FCPC Email or Password!';
							$("#message").show();
							$("#message").html(msg);
						} else if(result == 1){ // SUCCESSFUL
							// $.session.set('USER_STATUS',value.USER_STATUS);
							// $.session.set('USERNAME',value.USER_NAME);
							// $.session.set('USERINFO',value.USER_INFO);
							// $.session.set('USER_GENDER',value.USER_GENDER);
							// $.session.set('USER_TYPE',value.USER_TYPE);
							// $.session.set('USER_ACSRIGHTS',value.USER_ACSRIGHTS);
							// $.session.set('USER_ID',value.USER_ID);
							// $.session.set('SYSUSER_ID',value.SYSUSER_ID);
							// $.session.set('SYSUSER_SMS_ID',value.SYSUSER_SMS_ID);
							// $.session.set('USER_PICTURE',value.USER_PICTURE);
							// $.session.set('FINALVAL','home-model.php');
							// $.session.set('MASTERLABEL','Home');
							// $.session.set('LVLID',value.LVL_ID);
							
							//window.location = 'forms/masterpage-model.php';
							$("#message").hide();
							$("#message").empty();
							window.location.replace('forms/masterpage-model.php');
						} else if(result == 2){ // DELETED ACCOUNT
							msg = 'User Account Has Been Deleted. Pls Contact FCPC ICT Department!';
							$("#message").show();
							$("#message").html(msg);
						} else { // DISABLED ACCOUNT
							msg = 'User Account is Disabled. Pls Contact FCPC ICT Department!';
							$("#message").show();
							$("#message").html(msg);
						}
					} else {
						msg = 'Invalid Server Returned Value!';
						$("#message").show();
						$("#message").html(msg);
					}
					$(document.body).css({ 'cursor': 'auto' });
				},
				complete: function(status) {
					$(document.body).css({ 'cursor': 'auto' });
				},
				error:function(status){
					msg = 'Network Connection Error!';
					$("#message").show();
					$("#message").html(msg);
					$(document.body).css({ 'cursor': 'auto' });
				}
			});
		}
		catch(e) {  //We can also throw from try block and catch it here
			console.error(e);
		}
		finally {
			console.log('We do cleanup here');
		}
	});

	
	$("#fpass-message").css('border', 'solid 3px rgb(0, 180, 200)');
	$("#fpass-message").css('background-color', '#64c8ff80');
	$("#fpass-message").show();
	$("#fpass-message").html("Please enter your <b>FCPC email</b> to reset your password. ");
	
	$("#btnSubmit").click(function(){
		$("#fpass-message").html('');
		$("#fpass-message").hide();

		var fpass_uemail = $("#fpass-useremail").val().trim();
		var fpass_usertype = $("input[name='fpass-usertype']:checked").val();

		if (fpass_uemail == ''){
			$("#fpass-message").show();
			$("#fpass-message").css('border', 'solid 3px #c90000');
			$("#fpass-message").css('background-color', '#ff6a0080');
			$("#fpass-message").html('Type your FCPC email address!');
			return;
		};

		$.ajax({
			type: 'GET',
			url: 'login-controller.php',
			data: {
					fpass_uemail:fpass_uemail,
					fpass_usertype: fpass_usertype
				  },
			beforeSend: function (status) {
				$('*').css({ 'cursor': 'wait' });
				$('*').css('pointer-events', 'none');
				$("#fpass-message").css('border', 'solid 3px rgb(201, 154, 0)');
				$("#fpass-message").css('background-color', '#ffd66480');
				$("#fpass-message").show();
				$("#fpass-message").html("Resetting.. Don't reload the page.");
			},
			success: function(result){
				if(result.includes("Email sent")){ // email sending successful
					$("#fpass-message").css('border', 'solid 3px #00c90e'); //green
					$("#fpass-message").css('background-color', '#09ff006b');
					$("#fpass-message").show();
					$("#fpass-message").html(result);

				} else { // 0 accounts or below
					$("#fpass-message").css('border', 'solid 3px #c90000');
					$("#fpass-message").css('background-color', '#ff6a0080');
					$("#fpass-message").show();
					$("#fpass-message").html(result);
				}
				$('*').css({ 'cursor': 'auto' });
				$('*').css('pointer-events', 'auto');
			},
			complete: function(status) {
				$(document.body).css({ 'cursor': 'auto' });
			},
			error:function(status){

				msg = 'Network Connection Error!';
				$("#fpass-message").show();
				$("#fpass-message").html(status);
				$(document.body).css({ 'cursor': 'auto' });
			}
		});
	});

	// $('#see_password').click(function() {
	// 	if ($(this).is(':checked')) {
	// 		$('#userpassword').prop("type", "text");
	// 		$('#eye_icon').removeClass('fa-eye').addClass('fa-eye-slash');
	// 	} else {
	// 		$('#userpassword').prop("type", "password");
	// 		$('#eye_icon').removeClass('fa-eye-slash').addClass('fa-eye');
	// 	}
	// });
	
	$('label[for="see_password"]').mousedown(function(){
		$('#userpassword').prop("type", "text");
		$('#eye_icon').removeClass('fa-eye').addClass('fa-eye-slash');
	});

	$('label[for="see_password"]').mouseup(function(){
		$('#userpassword').prop("type", "password");
		$('#eye_icon').removeClass('fa-eye-slash').addClass('fa-eye');
	});
});