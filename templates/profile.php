<?php
session_start();
require_once("../php/config.php");
// print($_SESSION['loggedIn']);
if (!isset($_SESSION['loggedIn'])) {
    // echo "alert('Please login first');";
    header("Location:./login.php");
}
//fetch user data
$query = "SELECT member.email, member.name, member.phone from member where member_id='" . $_SESSION['member_id'] . "';";
$result = pg_query($conn, $query);
$email= pg_fetch_result($result, 0, 0);
$name = pg_fetch_result($result, 0, 1);
$phone = pg_fetch_result($result, 0, 2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../static/styles/profile.css">
    <title>SocGroups</title>
</head>

<body>
    <div class="main-container">
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="brand-logo">Logo</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a class="nav-button" href="#">Home</a></li>
                    <li>
                        <a class="nav-button" href="#">Messages <span class="notif-number" href="#4">5</span> </a>

                    </li>
                    <li>
                        <a class="nav-button" href="#">Account</a>
                        <!-- <div class="profile-picture">
                        <img width="40px" alt="Anne Hathaway picture" src="http://upload.wikimedia.org/wikipedia/commons/e/e1/Anne_Hathaway_Face.jpg">
                    </div> -->
                    </li>
                </ul>
            </div>
        </nav>
        <div class="row">
            <div class="left-container col s3">
                <div class="card left-card">
                    <div class="card-header">Notifications</div>
                    <ul class="notif-menu">
                        <li class="notif-menu-item">
                            Notices
                            <span class="notif-number">10</span>
                        </li>
                        <li class="notif-menu-item">
                            Pending Visitors
                            <span class="notif-number">10</span>
                        </li>
                        <li class="notif-menu-item">
                            Any reminder

                        </li>
                    </ul>
                </div>
            </div>
            <div class="right-container col s9">
                <div class="card profile">
                    <div class="row">
                        <div class="profile-picture col s2">
                            <img width="150px" src="https://partycity6.scene7.com/is/image/PartyCity/_pdp_sq_?$_1000x1000_$&$product=PartyCity/294138"></img>
                        </div>
                        <div class="profile-info col s10">
                            <div class="profile-name"><?php echo $name;?></div>
                            <ul>
                                <li>
                                    <span class="profile-tag">Phone: </span>
                                    <span class="profile-tag-info"><?php echo $phone;?></span>
                                </li>
                                <li>
                                    <span class="profile-tag">Email: </span>
                                    <span class="profile-tag-info"><?php echo $email;?></span>
                                </li>
                                <li>
                                    <span class="profile-tag">Address: </span>
                                    <span class="profile-tag-info">Mickey Mouse clubhouse</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card notices">
                    <div class="notices-header">
                        Group Notices
                    </div>
                    <ul class="notif-menu">
                        <li class="notice-menu-item">
                            <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</span>
                            <br><span class="notice-date">10 hours ago</span>
                        </li>
                        <li class="notice-menu-item">
                            <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</span>
                            <br><span class="notice-date">10 hours ago</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>