<?php
   
    require_once('./config.php');
    $email="";
    $pwd="";
    if(isset($_POST['log_email'])){
        $email = $_POST['log_email'];
        $pwd = $_POST['log_password'];
        echo "$email $pwd";
        echo "hello";
        try{ 
            print_r($conn);
            echo "$email $pwd";
            $query = "SELECT member.email, member.password, member.id,member.name from member where email='".$email."';";
            $result = pg_query($conn,$query);
            $db_pwd = pg_fetch_result($result,0,1);
            $member_id = pg_fetch_result($result,0,2); 
            $name = pg_fetch_result($result,0,3);
        } catch(Exception $e){
            echo "Failed";
        }
        echo "$db_pwd";
        echo "$email $pwd";
        if($pwd == $db_pwd){
           // echo "WOOOOOOOOOOO";
           session_start();
           $_SESSION['loggedIn'] = true;
           $_SESSION['member_id'] = $member_id;
           $_SESSION['username'] = $name;
           header("Location:".$codepath."dashboard.php"); 
        }
        else{
            header("Location:".$codepath."login.php"); 
        }

    }

    else if(isset($_POST['reg_email'])){
        echo "inside reg";
        $email = $_POST['reg_email'];
        $pwd = $_POST['reg_password'];
        $phone = $_POST['phone'];
        $name = $_POST['name'];
        try{ 
            print_r($conn);
            // echo "$email $pwd";
            $query = "INSERT INTO member(name,email,password,phone) VALUES ('$name', '$email', '$pwd', $phone);";
            $result = pg_query($conn,$query);
            // $db_pwd = pg_fetch_result($result,0,1);
            if($result){
                $query = "SELECT member.id from member where email='".$email."';";
                $result = pg_query($conn,$query);         
                $member_id = pg_fetch_result($result,0,0);
                $_SESSION['loggedIn'] = true;
                $_SESSION['member_id'] = $member_id;
                header("Location:".$codepath."dashboard.php"); 
            }
            else{
                header("Location:".$codepath."login.php"); 
            }
        } catch(Exception $e){
            echo "Failed";
        }
    }

    else{
        //illegal access, redirect to index
        header("Location:".$codepath."index.html");
    }
    
    
    
?>