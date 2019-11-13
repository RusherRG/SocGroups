function switch_tab(tab) {
    if (tab == 'log') {
        document.getElementById('login-div').style.display = 'flex';
        document.getElementById('register-div').style.display = 'None';
        document.getElementById('login_tab').style.backgroundColor = '#E2EAEF';
        document.getElementById('login_tab').style.color = '#23416B';
        document.getElementById('reg_tab').style.backgroundColor = 'transparent';
        document.getElementById('reg_tab').style.color = 'white';
    }
    else {
        document.getElementById('login-div').style.display = 'None';
        document.getElementById('register-div').style.display = 'flex';
        document.getElementById('login_tab').style.backgroundColor = 'transparent';
        document.getElementById('login_tab').style.color = 'white';
        document.getElementById('reg_tab').style.backgroundColor = '#E2EAEF';
        document.getElementById('reg_tab').style.color = '#23416B';
    }
}

function login() {
    email = document.getElementById('log_email').value;
    password = document.getElementById('log_password').value;
    data = {
        'email': email,
        'password': password,
    }
    console.log(data);
}

function register() {
    name = document.getElementById('name').value;
    email = document.getElementById('reg_email').value;
    phone = document.getElementById('phone').value;
    password = document.getElementById('reg_password').value;

    data = {
        'name': name,
        'email': email,
        'phone': phone,
        'password': password,
    }
    console.log(data);
}

function validateLogin() { 
    email = document.getElementById('log_email');
    password = document.getElementById('log_password');
    if(email.value==""){
        window.alert('Please enter your email');
        email.focus();
        return false;
    }
    if(/\s/.test(email.value)){
        window.alert('Please enter a valid email');
        email.focus();
        return false;
    }
    if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)){
        window.alert('Please enter a valid email');
        email.focus();
        return false;
    }
    if(password.value==""){
        window.alert('Please enter your password');
        password.focus();
        return false;
    }
    if(/\s/.test(password.value)){
        window.alert('Please enter a valid password.\nNo spaces allowed.');
        password.focus();
        return false;
    }
    return true;
}

function validateRegister() { 
    email = document.getElementById('reg_email');
    password = document.getElementById('reg_password');
    phone = document.getElementById('phone');
    name = document.getElementById('name');
    if(email.value==""){
        window.alert('Please enter your email');
        email.focus();
        return false;
    }
    if(/\s/.test(email.value)){
        window.alert('Please enter a valid email');
        email.focus();
        return false;
    }
    if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)){
        window.alert('Please enter a valid email');
        email.focus();
        return false;
    }
    if(password.value==""){
        window.alert('Please enter your password');
        password.focus();
        return false;
    }
    if(/\s/.test(password.value)){
        window.alert('Please enter a valid password.\nNo spaces allowed.');
        password.focus();
        return false;
    }
    if(name.value==""){
        window.alert('Please enter your name');
        email.focus();
        return false;
    }
    return true;
}