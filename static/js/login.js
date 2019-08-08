function switch_tab(tab) {
    if(tab=='log'){
        document.getElementById('login-div').style.display = 'flex';
        document.getElementById('register-div').style.display = 'None';
    }
    else{
        document.getElementById('login-div').style.display = 'None';
        document.getElementById('register-div').style.display = 'flex';
    }
}

function login() {
    email = document.getElementById('email').value;
    password = document.getElementById('password').value;
    data = {
        'email': email,
        'password': password,
    }
    console.log(data);
}

function register() {
    name = document.getElementById('name').value;
    email = document.getElementById('email').value;
    phone = document.getElementById('phone').value;
    password = document.getElementById('password').value;
    
    data = {
        'name': name,
        'email': email,
        'phone': phone,
        'password': password,
    }
    console.log(data);
}
