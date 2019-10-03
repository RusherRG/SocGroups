<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    require_once("../php/config.php");
    // print($_SESSION['loggedIn']);
    if(!isset($_SESSION['loggedIn'])){
        // echo "alert('Please login first');";
        header("Location:./login.php");
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../static/styles/index.css">
    <link rel="stylesheet" type="text/css" href="../static/styles/dash.css">
    <title>SocGroups - Dashboard</title>
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
                    <li style="float: right; margin: 20px;"><a href="./login.php" style="color:white;">Contact
                            us</a></li>
                    <li style="float: right; margin: 20px;"><a href="./login.php" style="color:white;"></a>About us</a></li>
                </ul>
            </div>
        </div>
    </header>

    <main>
        <!-- <?php
            $qside = "SELECT member.name from member where member.id=". $_SESSION['member_id'] .";";
            $result = pg_query($conn, $qside);
            $name = pg_fetch_result($result,0,0);
        ?> -->
        <!-- <div style="margin-left:5%; margin-right:5%;"> -->
            <!-- <center> -->
                <div class="row" style="display:flex">
                    <div class="sidebar card col s4">
                        <h4 class="etext">Hello <?php echo $_SESSION['username'];?></h4>
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
                </div>
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


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
    <!-- <script type="text/javascript" src="static/js/index.js"></script> -->
</body>

</html>