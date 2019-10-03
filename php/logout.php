<?php
require_once("./config.php");
session_start();
if(isset($_SESSION) && $_SESSION['loggedIn']==true){
    unset($_SESSION['loggedIn']);
    unset($_SESSION['member_id']);
    unset($_SESSION['username']);

    session_unset();
    // session_destroy();
    session_write_close();
 
}
// else{
    //redirect to login
    header("Location:".$codepath."login.php?loggedOut=true");
    ob_flush();
// }
?>