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
$query = "SELECT member.email, member.name, member.phone from member where member.member_id=" . $_SESSION['member_id'] . ";";
$result = pg_query($conn, $query);
$email = pg_fetch_result($result, 0, 0);
$name = pg_fetch_result($result, 0, 1);
$phone = pg_fetch_result($result, 0, 2);
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
    <title>SocGroups - Dashboard</title>
</head>
<style>
    .btn, .btn-large {
        background-image: linear-gradient(to bottom right, #23416b, #b04276);
    }
</style>
<body>
    <header>
        <div class="headcard" id="headcard">
            <!-- <nav>
                        <div class="blue nav-wrapper z-depth-1"
                            style="padding: 0px 0px 15px 15px; background-color: blue; background-image: linear-gradient(to bottom right, #140078 ,#8559da);">
                            <a href="index.html" class="brand-logo">SocGroups</a>
                            <ul id="nav-mobile" class="right hide-on-med-and-down">
                                <li><a href="register.html">Sign up</a></li>
                                <li><a href="login.html">Sign in</a></li>
                            </ul>
                        </div>
                    </nav> -->
            <!-- <nav class="deep-purple">  -->
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
                <div class="card profile">
                    <div class="row">
                        <div class="profile-picture col s2">
                            
                            <img width="150px" src="../images/user.png"></img>
                            <!-- <img width="150px" src="https://partycity6.scene7.com/is/image/PartyCity/_pdp_sq_?$_1000x1000_$&$product=PartyCity/294138"></img> -->
                        </div>
                        <div class="profile-info col s10">
                            <div class="profile-name"><?php echo $name; ?></div>
                            <ul>
                                <li>
                                    <span class="profile-tag">Phone: </span>
                                    <span class="profile-tag-info"><?php echo $phone; ?></span>
                                </li>
                                <li>
                                    <span class="profile-tag">Email: </span>
                                    <span class="profile-tag-info"><?php echo $email; ?></span>
                                </li>
                                <!-- <li>
                                    <span class="profile-tag">Address: </span>
                                    <span class="profile-tag-info">Mickey Mouse clubhouse</span>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card notices">
                    <div class="notices-header">
                        Your Societies
                    </div>
                    <ul class="notif-menu">
                        <?php
                        $soc_query = "SELECT s.name, s.address from member as m inner join comprises as c on m.member_id=c.member_id inner join society as s on c.society_id=s.society_id where m.member_id=" . $_SESSION['member_id'] . ";";
                        $soc_result = pg_query($conn, $soc_query);
                        if (pg_num_rows($soc_result) > 0) {
                            for ($i = 0; $i < pg_num_rows($soc_result); $i++) {
                                // print_r(pg_fetch_result($soc_result, $i, 1));
                                echo "<li class='notice-menu-item card hoverable'>
                            <span>" . pg_fetch_result($soc_result, $i, 0) . "</span>
                            <br><span>" . pg_fetch_result($soc_result, $i, 1) . "</span>
                        </li>";
                            }
                        } else {
                            echo "<li class='notice-menu-item card hoverable' style='text-align:center;'><span>No societies yet</span></li>";
                        }
                        ?>
                        <!-- <li class="notice-menu-item">
                            <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</span>
                            <br><span class="notice-date">10 hours ago</span>
                        </li>
                        <li class="notice-menu-item">
                            <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</span>
                            <br><span class="notice-date">10 hours ago</span>
                        </li> -->
                    </ul>
                    <div class="row center col s12 m12">
                        <a href="addsoc.php" class="waves-effect waves-light btn-large" style="width:49.5%;"><i class="material-icons left large">add</i>Create society</a>
                        <a href="joinsoc.php" class="waves-effect waves-light btn-large" style="width:49.5%;"><i class="material-icons left large">group_add</i>Join society</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div style="margin-left:5%; margin-right:5%;"> -->
        <!-- <center> -->
        <!-- <div class="row" style="display:flex">
            <div class="sidebar card col s4">
                <h4 class="etext">Hello <?php echo $_SESSION['username']; ?></h4>
                <div class="collection tilegroup">
                    <a href="#!" class="collection-item tileitem active">Home</a>
                    <a href="#!" class="collection-item tileitem">Profile</a>
                    <a href="#!" class="collection-item tileitem">Groups</a>
                    <a href="#!" class="collection-item tileitem">Notices</a>
                    <a href="#!" class="collection-item tileitem">Visitors</a>
                </div>
            </div>
            <div class="content col s8">

                <h3>Hellooooo</h3>
            </div>
        </div> -->
        <!-- </center> -->
        <!-- </div> -->
    </main>
    <footer>
        <div class="page-footer">
            <div class="container">
                <div class="row">
                    <h5 class="white-text">Links</h5>
                    <ul>
                        <li class="white-text"><a href='./login.php'>Get started!</a></li>
                        <li class="white-text"><a href='./aboutus.html'>About us</a></li>
                    </ul>
                    <p></p>
                </div>
            </div>
        </div>
    </footer>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
    <!-- <script type="text/javascript" src="static/js/index.js"></script> -->
</body>

</html>