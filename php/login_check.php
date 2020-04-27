<?php

require_once('./config.php');
$email = "";
$pwd = "";
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['log_email'])) {
    $email = $_POST['log_email'];
    $pwd = $_POST['log_password'];
    // echo "$email $pwd";
    // echo "hello";
    try {
        // print_r($conn);
        // echo "$email $pwd";
        if (empty($email) || empty($password)) {
            header("Location:" . $codepath . "login.php?errormsg=Invalid%20email%20or%20password");
        } 
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            header("Location:" . $codepath . "login.php?errormsg=$emailErr");
        }else {
            $query = "SELECT member.email, member.password, member.member_id,member.name from member where email='" . $email . "';";
            $result = pg_query($conn, $query);
            if (pg_num_rows($result) > 0) {
                $db_pwd = pg_fetch_result($result, 0, 1);
                $member_id = pg_fetch_result($result, 0, 2);
                $name = pg_fetch_result($result, 0, 3);
            } else {
                header("Location:" . $codepath . "login.php?errormsg=Login%20failed!");
            }
        }
    } catch (Exception $e) {
        echo "Failed";
    }
    echo "$db_pwd";
    echo "$email $pwd";
    if ($pwd == $db_pwd) {
        // echo "WOOOOOOOOOOO";
        session_start();
        $_SESSION['loggedIn'] = true;
        $_SESSION['member_id'] = $member_id;
        $_SESSION['username'] = $name;
        header("Location:" . $codepath . "dashboard.php");
    } else {
        // echo "pwd mismatch :(";
        header("Location:" . $codepath . "login.php?errormsg=Login%20failed!");
    }
} else if (isset($_POST['reg_email'])) {
    echo "inside reg";
    $email = $_POST['reg_email'];
    $pwd = $_POST['reg_password'];
    $phone = $_POST['phone'];
    $name = $_POST['name'];
    try {
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed in name";
            header("Location:" . $codepath . "login.php?errormsg=$nameErr");
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            header("Location:" . $codepath . "login.php?errormsg=$emailErr");
        } else {
            // print_r($conn);
            // echo "$email $pwd";
            $query = "INSERT INTO member(name,email,password,phone) VALUES ('$name', '$email', '$pwd', $phone);";
            $result = pg_query($conn, $query);
            // $db_pwd = pg_fetch_result($result,0,1);
            if ($result) {
                $query = "SELECT member.id from member where email='" . $email . "';";
                $result = pg_query($conn, $query);
                $member_id = pg_fetch_result($result, 0, 0);
                $_SESSION['loggedIn'] = true;
                $_SESSION['member_id'] = $member_id;
                // $_SESSION['username'] = $name;
                header("Location:" . $codepath . "dashboard.php");
                // echo "yay";
            } else {
                echo "noooo";
                header("Location:" . $codepath . "login.php?errormsg=Registration%20failed");
            }
        }
    } catch (Exception $e) {
        echo "Failed";
    }
} else {
    //illegal access, redirect to index
    header("Location:" . $codepath . "index.html");
}
