function togglePasswordEvent(button, input) {
    const icon = button.querySelector('i');

    button.addEventListener('click', () => {
        const isText = input.type === 'text';
        input.type = isText ? 'password' : 'text';
        icon.className = `fa-solid ${isText ? 'fa-eye' : 'fa-eye-slash'}`;
    });
}

function updateHint(id, bool) {
    const passLengthElem = document.getElementById(id);
    const iconElem = passLengthElem.querySelector('i');

    passLengthElem.classList.toggle('text-success', bool);
    passLengthElem.classList.toggle('text-danger', !bool);
    iconElem.className = `fa-solid ${bool ? 'fa-check' : 'fa-xmark'}`;
}

function containsEightCharacter(str){
    return str.length >= 8 ? true : false;
}

function containsNumber(str) {
    const regex = /\d/; // Matches any digit (0-9)
    return regex.test(str);
}

function containsSpecialCharacter(str){
    const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    return specialChars.test(str);
}

const doc = {
    btnpass: document.getElementById('view-pass'),
    btnconfpass: document.getElementById('view-confpass'),
    btnnewpass: document.getElementById('view-newpass'),
    btncopynewpass: document.getElementById('copy-newpass'),

    password: document.getElementById('password'),
    confirm_password: document.getElementById('confirm_password'),
    new_password: document.getElementById('new_password'),

    copytext: document.querySelector('.copy-text'),
    btnsubmit: document.getElementById('btnSubmit'),
    btncancel: document.getElementById('btnCancel'),

    username: document.getElementById('username'),
    divchange: document.getElementById('divChange'),
    divview: document.getElementById('divView'),
}

togglePasswordEvent(doc.btnpass, doc.password);
togglePasswordEvent(doc.btnconfpass, doc.confirm_password);
togglePasswordEvent(doc.btnnewpass, doc.new_password);

doc.btncopynewpass.addEventListener('click', ()=>{
    let text = doc.new_password.value;
    text.length ? navigator.clipboard.writeText(text) : doc.copytext.innerHTML = '<small class="text-danger">Password field empty</small>';

    doc.copytext.classList.remove('d-none');
})

doc.btncancel.addEventListener('click', ()=>{
    window.close();
})

let passlength = false;
let hasnumber = false;
let haschar = false;

doc.password.addEventListener('keyup', ()=>{
    let text = doc.password.value;
    // check for length
    passlength = containsEightCharacter(text)
    updateHint('passlength', passlength);

    // check of existense of a number
    hasnumber = containsNumber(text);
    updateHint('passnum', hasnumber);

    // check for special characters
    haschar = containsSpecialCharacter(text);
    updateHint('passchar', haschar);
})

doc.confirm_password.addEventListener('keyup', ()=>{
    let match = doc.password.value == doc.confirm_password.value
    updateHint('passmatch', match);
})

doc.btnsubmit.addEventListener('click', async ()=>{
    document.querySelectorAll('a,button,input[type="submit"],input[type="button"]').forEach(e=>{e.disabled=true;e.style.pointerEvents="none";});
    let confirm = window.confirm("Are you sure you want to submit?");

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    let token = urlParams.get('token');

    let password = doc.confirm_password.value.trim();

    let isOkay = passlength && haschar && hasnumber && confirm && token;
    if(isOkay){
        try {
            const data = new FormData();
            data.append('type', "PASSWORD_RESET");
            data.append('password', password);
            data.append('token', token);

            const response = await fetch('change-password-controller.php', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json' // ✅ Expect JSON response
                },
                body: data // ✅ FormData sets the correct Content-Type automatically
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const result = await response.json(); // ✅ Parse JSON response

            if (Array.isArray(result) && result[0]?.status === 'SUCCESS') {
                const { email, password } = result[0];
                doc.username.value = email;
                doc.new_password.value = password;

                doc.divchange.style.display = 'none';
                doc.divview.style.display = 'block';

            } else {
                window.location.reload();
            }
        } catch (error) {
            console.error('Fetch error:', error);
        }
    }
    
    document.querySelectorAll('a,button,input[type="submit"],input[type="button"]').forEach(e=>{e.disabled=false;e.style.pointerEvents="auto";});
})
