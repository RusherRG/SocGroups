function getVisitors(member) {
    var visitor_id = document.getElementById('visitor-select').value;
    // var test = document.getElementById('test-span');
    // test.innerHTML = "You selected: " + visitor_id;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById('test-span').innerHTML = "Member: " + member;
            document.getElementById("visitor-list").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "visitors.php?society=" + visitor_id + "&member=" + member, true);
    xmlhttp.send();
}

function updateApproval(permission){
    var test = document.getElementById('test-span');
    test.innerHTML = "yayyyyyyyy"+permission;
}