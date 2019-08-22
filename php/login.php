<?php
    require_once('./config.php');
    $email="";
    $pwd="";
    if(isset($_POST['log_email'])){
        $email = $_POST['log_email'];
        $pwd = $_POST['log_password'];
        echo "$email $pwd";
        echo "hello";
    }
    try{ 
        print_r($conn);
        echo "$email $pwd";
        $query = "SELECT member.email, member.password from member where email='".$email."';";
        $result = pg_query($conn,$query);
        $db_pwd = pg_fetch_result($result,0,1);
    } catch(Exception $e){
        echo "Failed";
    }
    
    
    
    echo "$db_pwd";
    echo "$email $pwd";
    if($pwd == $db_pwd){
        echo "WOOOOOOOOOOO";
        // header("Location: ../templates/index.html"); 
    }

?>