<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require_once("../php/config.php");
// print($_SESSION['loggedIn']);
if (!isset($_SESSION['loggedIn'])) {
    // echo "alert('Please login first');";
    header("Location:./login.php");
}
if (isset($_GET['errormsg'])) {
    echo '<script language="javascript">';
    echo "alert('" . $_GET['errormsg'] . "')";
    echo '</script>';
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $m_id = $_POST['member'];
    $socname = $_POST['name'];
    $socadd = $_POST['address'];
    $flatno = $_POST['flatno'];
    $floor = $_POST['floor'];
    $s_query = "INSERT INTO society(name, address) values ('$socname','$socadd');";
    $s_result = pg_query($conn, $s_query);
    if ($s_result) {
        $soc_query = "SELECT society_id from society where name='$socname';";
        $soc_result = pg_query($conn, $soc_query);
        if ($soc_result && pg_num_rows($soc_result) > 0) {
            $society_id = pg_fetch_result($soc_result, 0, 0);
            $role_query = "INSERT INTO comprises(society_id, member_id, role,roomno,floorno) values ($society_id,$m_id,'Admin',$flatno,$floor);";
            $role_result = pg_query($conn, $role_query);
            if($role_result){
                header('Location:dashboard.php?errormsg=Society created!');
            }
        }
        
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../static/styles/index.css">
    <link rel="stylesheet" type="text/css" href="../static/styles/dash.css">
    <link rel="stylesheet" type="text/css" href="../static/styles/profile.css">
    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <title>SocGroups</title>
</head>

<body>
    <header>
        <div class="headcard" id="headcard">
            <div class="row col s8 m6 offset s6 nav-wrapper" style="margin-bottom: 0px;">
                <a href="./index.html" style="color:white; margin:20px; float:left; font-size: 28px;">SocGroups</a>

                <ul class="right hide-on-med-and-down" style="margin: 10px;">
                    <li style="float: right; margin: 20px;"><a href="../php/logout.php" style="color:white;">Log out</a>
                    </li>
                    <li style="float: right; margin: 20px;"><a href="./dashboard.php" style="color:white;">Home</a></li>
                    <!-- <li style="float: right; margin: 20px;"><a href="./login.php" style="color:white;"></a></a></li> -->
                </ul>
            </div>
        </div>
    </header>

    <main>
        <div class="row">
            <div class="left-container col s3">
                <div class="card left-card">
                    <div class="card-header">Navigation</div>
                    <ul class="notif-menu">
                        <li class="notif-menu-item"><a style="color:white;" href="./dashboard.php">
                                Dashboard</a>
                        </li>
                        <li class="notif-menu-item"><a style="color:white;" href="./notices.php">
                                Notices</a>
                            <span class="notif-number">NEW</span>
                        </li>
                        <li class="notif-menu-item"><a style="color:white;" href="./visitorlog.php">
                                Visitor Log</a>
                            <span class="notif-number">NEW</span>
                        </li>
                        <!-- <li class="notif-menu-item">
                            Any reminder

                        </li> -->
                    </ul>
                </div>
            </div>
            <div class="right-container col s9">
                <div class="card notices">
                    <!-- <div class='container'> -->
                    <!-- <div class="row"> -->
                    <form action='addsoc.php' method='POST'>
                        <div class='col s12 l8 offset-l2 white-text'>
                            <div class='col s12 center'>
                                <h1 class='text-center teal-text light'><small>Create a society</small></h1>
                            </div>
                            <div class='divider'></div>
                            <div class='input-field col s12'>
                                <i class='material-icons prefix teal-text'>business</i>
                                <input id='name' name='name' type='text' class='teal-text' required>
                                <label for='name'>Name</label>
                            </div>

                            <div class='input-field col s12'>
                                <i class='material-icons prefix teal-text'>location_on</i>
                                <input id='address' name='address' type='text' class='teal-text' required>
                                <label for='address'>Address</label>
                            </div>
                            <div class='input-field col s12'>
                                <i class='material-icons prefix teal-text'>business</i>
                                <input id='flat' name='flatno' type='number' class='teal-text' required>
                                <label for='flat'>Your Flat No.</label>
                            </div>
                            <div class='input-field col s12'>
                                <i class='material-icons prefix teal-text'>business</i>
                                <input id='floor' name='floor' type='number' class='teal-text' required>
                                <label for='floor'>Your Floor No.</label>
                            </div>

                            <div><input id='member' name='member' type='hidden' value=<?php echo $_SESSION['member_id']; ?>></div>
                            <div class='col s12'>&nbsp;</div>
                            <div class='col s12 center'>
                                <button type='Submit' class='col s12 btn submit hoverable'>Submit</button>
                            </div>
                            <div class='col s12'>&nbsp;</div>
                    </form>


                </div>
            </div>
        </div>
        </div>
    </main>
    <footer>
        <div class="page-footer">
            <div class="container">
                <div class="row">
                    <h5 class="white-text">Links</h5>
                    <ul>
                        <li class="white-text"><a href='./login.php'>Get started!</a></li>
                        <li class="white-text"><a href='./login.php'>About us</a></li>
                    </ul>
                    <p></p>
                </div>
            </div>
        </div>
    </footer>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
    <script type="text/javascript" src="../static/js/visitorlog.js"></script>
</body>

</html>