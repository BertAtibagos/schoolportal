$(document).ready(function(){
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
});

function togglePasswordEvent(button, input) {
    const icon = button.querySelector('i');

    button.addEventListener('click', () => {
        const isText = input.type === 'text';
        input.type = isText ? 'password' : 'text';
        icon.className = `fa-solid ${isText ? 'fa-eye' : 'fa-eye-slash'}`;
    });
}

const viewPass = document.getElementById('view-password');
const passwordField = document.getElementById('userpassword');

togglePasswordEvent(viewPass, passwordField);

// === User Login ===
const btnlogin = document.getElementById('btnlogin');
const login_username = document.getElementById('useremail');
const login_password = document.getElementById('userpassword');

const login_message = document.getElementById('login-message')

btnlogin.addEventListener('click', async () => {
    let username = login_username.value.trim();
    let password = login_password.value.trim();

    if (!username) {
        login_message.className = 'warning';
        login_message.textContent = 'Type your email.';
        login_username.focus();
        return;
    }

    if (!password) {
        login_message.className = 'warning';
        login_message.textContent = 'Type your password.';
        login_password.focus();
        return;
    }

    const data = new FormData();
    data.append('type', "LOGIN");
    data.append('uemail', username);
    data.append('upass', password);

    const response = await fetch('login-controller.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json' // ✅ Expect JSON response
        },
        body: data
    });

    if (!response.ok) throw new Error('Network response was not ok');

    const result = await response.json();
    
    let key = Object.keys(result).toString();
    let value = Object.values(result).toString();

    if(key == 'success'){
        window.location.reload();
    } else {
        login_message.className = key;
        login_message.textContent = value;
    }
});



//  === Forgot Password ===
const btnSubmit = document.getElementById('btnSubmit');
const message = document.getElementById('fpass-message');
const email = document.getElementById('fpass-useremail');

message.style.display = 'block';
message.className = '';
message.innerHTML = "Please enter your <b> email</b> to reset your password. ";
message.classList.add('info');

btnSubmit.addEventListener('click', async () => {
    message.className = '';
    message.textContent = '';

    const usertype = document.querySelector('input[name="usertype"]:checked');

    if (!email.value.trim() || !usertype) {
        message.classList.add('error');
        message.innerHTML = 'Please enter your email and select a user type.';
        return;
    }
    
    // Get the reCAPTCHA response value
    const recaptchaResponse = document.querySelector('[name="g-recaptcha-response"]').value;
    if (!recaptchaResponse) {
        message.textContent = 'Please complete the reCAPTCHA.';
        message.classList.add('error');
        return;
    }
    
    message.classList.add('info');
    message.textContent = 'Loading...';

    const data = new FormData();
    data.append('type', "PASSWORD_RESET");
    data.append('usertype', usertype.value);
    data.append('email', email.value);
    data.append('g-recaptcha-response', recaptchaResponse);

    const response = await fetch('login-controller.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json' // ✅ Expect JSON response
        },
        body: data
    });

    if (!response.ok) throw new Error('Network response was not ok');

    const result = await response.json();
    
    let key = Object.keys(result).toString();
    let value = Object.values(result).toString();
    message.className = '';
    message.classList.add(key);
    message.textContent = value;
})