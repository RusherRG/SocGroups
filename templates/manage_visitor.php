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
if (isset($_GET['society']) && isset($_GET['role'])) {
    // echo "yayy";
    $soc_id = $_GET['society'];
    $role = $_GET['role'];
    $member_id = $_SESSION['member_id'];
    $role_query = "SELECT c.role from comprises as c where c.member_id=$member_id and c.society_id=$soc_id;";
    $role_result = pg_query($conn, $role_query);
    if (pg_num_rows($role_result) == 1) {
        if (($role == "view" && pg_fetch_result($role_result, 0, 0) == "Admin") || ($role == "add" && pg_fetch_result($role_result, 0, 0) == "Guard")) {
            $soc_query = "SELECT name from society where society_id=$soc_id";
            $soc_result = pg_query($conn, $soc_query);
            if ($soc_result && pg_num_rows($soc_result) > 0) {
                $soc_name = pg_fetch_result($soc_result, 0, 0);
            } else {
                $soc_name = "";
            }
            $visitor_query = "SELECT v.name, v.phone, v.email, l.roomno, l.datetime, l.approval, v.visitor_id from visitor as v inner join visitorlog as l on v.visitor_id=l.visitor_id where l.society_id=$soc_id;";
            $visitor_result = pg_query($conn, $visitor_query);
        } else {
            header('Location:visitorlog.php?errormsg=Unauthorized access to visitor log');
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
                <!-- <div class="card profile">
                    <div class="row">
                        <div class="profile-picture col s2">
                            <img width="150px" src="https://partycity6.scene7.com/is/image/PartyCity/_pdp_sq_?$_1000x1000_$&$product=PartyCity/294138"></img>
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
                                <li>
                                    <span class="profile-tag">Address: </span>
                                    <span class="profile-tag-info">Mickey Mouse clubhouse</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="row"> -->
                <!-- <span>Select society: </span> -->
                <!-- <select id="visitor-select" class="card" style="display:block;" onchange="getVisitors(<?php echo $_SESSION['member_id']; ?>)">
                        <option value=0 selected>--Select a society--</option>
                        <?php
                        // $soc_query = "SELECT s.name, s.society_id, c.role from member as m inner join comprises as c on m.member_id=c.member_id inner join society as s on c.society_id=s.society_id where m.member_id=" . $_SESSION['member_id'] . ";";
                        // $soc_result = pg_query($conn, $soc_query);
                        // if (pg_num_rows($soc_result) > 0) {
                        //     for ($i = 0; $i < pg_num_rows($soc_result); $i++) {
                        //         // print_r(pg_fetch_result($soc_result, $i, 1));
                        //         echo "<option value=" . pg_fetch_result($soc_result, $i, 1) . ">" . pg_fetch_result($soc_result, $i, 0) . "</option>";
                        //     }
                        // } else {
                        //     echo "<option disabled>No societies yet</option>";
                        // }
                        ?>
                         <option value=1>1</option> -->
                <!-- </select> -->
                <!-- </div>  -->
                <!-- <div><span id='test-span'></span></div> -->
                <div class="card notices">
                    <div class="notices-header">
                        <?php echo $soc_name; ?> Visitor Log
                    </div>
                    <!-- <div class='container'> -->
                    <!-- <div class="row"> -->
                    <?php
                    $visitorForm = "<form action='addvisitor.php' method='POST'>
                        <div class='col s12 l8 offset-l2 white-text'>
                            <div class='col s12 center'>
                                <h1 class='text-center teal-text light'><small>Add visitor entry</small></h1>
                            </div>
                            <div class='divider'></div>
                            <div class='input-field col s12'>
                                <i class='material-icons prefix teal-text'>person</i>
                                <input id='name' name='name' type='text' class='teal-text' required>
                                <label for='full-name'>Name</label>
                            </div>
                            <div class='input-field col s12'>
                                <i class='material-icons prefix teal-text'>email</i>
                                <input id='email' name='email' type='email' class='teal-text'>
                                <label for='email'>Email</label>
                            </div>
                            <div class='input-field col s12'>
                                <i class='material-icons prefix teal-text'>local_phone</i>
                                <input id='phone' name='phone' type='tel' class='teal-text'>
                                <label for='full-name'>Phone</label>
                            </div>
                            <div class='input-field col s12'>
                                <i class='material-icons prefix teal-text'>business</i>
                                <input id='flatno' name='flatno' type='number' class='teal-text' required>
                                <label for='full-name'>Flat No.</label>
                            </div>
                            <div><input id='society' name='society' type='hidden' value=$soc_id></div>
                            <div class='col s12'>&nbsp;</div>
                            <div class='col s12 center'>
                                <button type='Submit' class='col s12 btn submit hoverable'>Submit</button>
                            </div>
                            <div class='col s12'>&nbsp;</div>
                    </form>";
                    ?>
                    <!-- </div> -->
                    <!-- </div> -->
                    <!-- </div> -->
                    <?php
                    if ($role == "view") {
                        echo "<ul id='visitor-list' class='notif-menu'>";
                        if (pg_num_rows($visitor_result) > 0) {
                            for ($i = 0; $i < pg_num_rows($visitor_result); $i++) {
                                // print_r(pg_fetch_result($soc_result, $i, 1));
                                if (pg_fetch_result($visitor_result, $i, 5) != null) {
                                    if (pg_fetch_result($visitor_result, $i, 5) == "t") {
                                        echo "<li class='notice-menu-item card hoverable'>
                                                    <h5>" . pg_fetch_result($visitor_result, $i, 0) . "</h5>
                                                    <br><span>Phone: " . pg_fetch_result($visitor_result, $i, 1) . "</span>
                                                    <br><span>Email: " . pg_fetch_result($visitor_result, $i, 2) . "</span>
                                                    <br><span>Room no: " . pg_fetch_result($visitor_result, $i, 3) . "</span>
                                                    <br><span>Date: " . date('d/m/y, h:i a', strtotime(pg_fetch_result($visitor_result, $i, 4))) . "</span>
                                                    <br><span>Approval: Approved</span>
                                                </li>";
                                    } else {
                                        echo "<li class='notice-menu-item card hoverable'>
                                                    <h5>" . pg_fetch_result($visitor_result, $i, 0) . "</h5>
                                                    <br><span>Phone: " . pg_fetch_result($visitor_result, $i, 1) . "</span>
                                                    <br><span>Email: " . pg_fetch_result($visitor_result, $i, 2) . "</span>
                                                    <br><span>Room no: " . pg_fetch_result($visitor_result, $i, 3) . "</span>
                                                    <br><span>Date: " . date('d/m/y, h:i a', strtotime(pg_fetch_result($visitor_result, $i, 4))) . "</span>
                                                    <br><span>Approval: Denied</span>
                                                </li>";
                                    }
                                } else {
                                    $visitor_id = pg_fetch_result($visitor_result, $i, 6);
                                    echo "<li class='notice-menu-item card hoverable'>
                                                    <span class='notif-number'>PENDING</span>
                                                    <h5>" . pg_fetch_result($visitor_result, $i, 0) . "</h5>
                                                    <br><span>Phone: " . pg_fetch_result($visitor_result, $i, 1) . "</span>
                                                    <br><span>Email: " . pg_fetch_result($visitor_result, $i, 2) . "</span>
                                                    <br><span>Room no: " . pg_fetch_result($visitor_result, $i, 3) . "</span>
                                                    <br><span>Date: " . date('d/m/y, h:i a', strtotime(pg_fetch_result($visitor_result, $i, 4))) . "</span>
                                                    <br><span>Approval: Pending</span>
                                                    <br><br>
                                                </li>";
                                }
                            }
                        } else {
                            // if (pg_fetch_result($role_result, 0, 0) != "Guard")
                            echo "<li class='notice-menu-item card hoverable' style='text-align:center;'><span>No visitors yet</span></li>";
                        }
                        echo "</ul>";
                    } else if ($role == "add") {
                        echo $visitorForm;
                    }
                    ?>
                </div>
                <!-- <li class="notice-menu-item">
                            <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</span>
                            <br><span class="notice-date">10 hours ago</span>
                        </li>
                        <li class="notice-menu-item">
                            <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</span>
                            <br><span class="notice-date">10 hours ago</span>
                        </li> -->
                <!-- </ul> -->
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