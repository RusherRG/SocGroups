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