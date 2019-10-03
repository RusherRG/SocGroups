<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400i&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../static/styles/login.css">
    <title>SocGroups - Sign in</title>
</head>

<?php
require_once("../php/config.php");
session_start();
// print($_SESSION['loggedIn'] . "    " . $_SESSION['username']);
if(isset($_SESSION['loggedIn'])){   
    header("Location:./dashboard.php");
}
if(isset($_GET)){
    if(isset($_GET['loggedOut'])){
        $cardmsg = "<b style='font-size:50px;'>Thank you!</b>
        <br>
        <i style='font-size:20px;'>Sign in or register to get started with SocGroups</i>";
    }
    else{
        $cardmsg = "<b style='font-size:50px;'>Welcome back!</b>
        <br>
        <i style='font-size:20px;'>Sign in or register to get started with SocGroups</i>";
    }
}

?>


<body style=" background-size: 100%; background-position: center;">
    <div class="container">
        <div class="col s12 m12">
            <div class="card main-card">
                <div class="row">
                    <div class="col s6 m6">
                        <div class="row center-align">
                            <button class="waves-effect waves-light btn tab left-curve" id='login_tab'
                                onclick="switch_tab('log')">Sign In</a>
                            <button class="waves-effect waves-light btn tab right-curve" id='reg_tab'
                                onclick="switch_tab('reg')">Sign Up</a>
                        </div>
                        <div id="login-div" style="display: flex">
                            <form class="card login-card" method='POST' action= <?php echo"".$phppath."login_check.php";?>>
                                <div class='row'>
                                    <div class='input-field col s12'>
                                        <i class="material-icons prefix" style="color: #23416B">email</i>
                                        <input class='validate' type='email' name='log_email' id='log_email' />
                                        <label for='email'>Email</label>
                                    </div>
                                    <div class='input-field col s12'>
                                        <i class="material-icons prefix" style="color: #23416B">vpn_key</i>
                                        <input class='validate' type='password' name='log_password' id='log_password' />
                                        <label for='password'>Password</label>
                                    </div>
                                    <!-- <input type="submit" class="waves-effect waves-light btn submit" onclick="login()" value="Login"> -->
                                    <div class='col s12 center-align'>
                                        <button class="waves-effect waves-light btn submit" type="submit">Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="register-div" style="display: None">
                            <form class="card register-card" method='POST' action=<?php echo"".$phppath."login_check.php";?>>
                                <div class='row'>
                                    <div class='input-field col s12'>
                                        <i class="material-icons prefix" style="color: #23416B">person</i>
                                        <input class='validate' type='text' name='name' id='name' />
                                        <label for='name'>Name</label>
                                    </div>
                                    <div class='input-field col s12'>
                                        <i class="material-icons prefix" style="color: #23416B">email</i>
                                        <input class='validate' type='email' name='reg_email' id='reg_email' />
                                        <label for='email'>Email</label>
                                    </div>
                                    <div class='input-field col s12'>
                                        <i class="material-icons prefix" style="color: #23416B">phone</i>
                                        <input class='validate' type='tel' name='phone' id='phone' />
                                        <label for='phone'>Phone No.</label>
                                    </div>
                                    <div class='input-field col s12'>
                                        <i class="material-icons prefix" style="color: #23416B">vpn_key</i>
                                        <input class='validate' type='password' name='reg_password' id='reg_password' />
                                        <label for='password'>Password</label>
                                    </div>
                                    <div class='col s12 center-align'>
                                        <button class="waves-effect waves-light btn submit"
                                            onclick="register()">Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col s6 m6">
                        <div class="center-align" id="cardtext" style="color:white; padding: 10vh 0vh">
                        <?php
                            echo $cardmsg;
                        ?>
                            <!-- <b style="font-size:50px;">Welcome back!</b>
                            <br>
                            <i style="font-size:20px; ">Sign in or register to get started with SocGroups</i> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
    <script type="text/javascript" src="../static/js/login.js"></script>
</body>

</html>