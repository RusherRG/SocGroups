<?php

require_once('../php/config.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $flatno = $_POST['flatno'];
    $soc_id = $_POST['society'];
    $phone = $_POST['phone'];
    if (empty($email)) {
        $email = null;
    }
    if (empty($phone)) {
        $phone = 0;
    }
    $search_q = "SELECT visitor_id from visitor where name='$name' and (email='$email' or phone=$phone);";
    $search_r = pg_query($conn, $search_q);
    if (pg_num_rows($search_r) > 0) {
        //visitor exists
        $v_id = pg_fetch_result($search_r, 0, 0);
        $date = date('Y-m-d H:i:s');
        $entry_q = "INSERT INTO visitorlog(society_id,visitor_id,roomno,datetime) values ($soc_id,$v_id,$flatno,'$date');";
        $entry_r = pg_query($conn, $entry_q);
        if ($entry_r) {
            header('Location:visitorlog.php?errormsg=Visitor record added successfully!');
        } else {
            // header('Location:./visitorlog.php?errormsg=Visitor add failed1!');
            print_r("error 1" . $entry_r);
            print_r($entry_q);
        }
    } else {
        //new visitor
        if (empty($phone))
            $entry_q = "INSERT INTO visitor(name,email) values ('$name','$email');";
        else
            $entry_q = "INSERT INTO visitor(name,email,phone) values ('$name','$email',$phone);";
        $entry_r = pg_query($conn, $entry_q);
        if ($entry_r) {
            $search_q = "SELECT visitor_id from visitor where name='$name' and (email='$email' or phone=$phone);";
            $search_r = pg_query($conn, $search_q);
            $v_id = pg_fetch_result($search_r, 0, 0);
            $date = date('Y-m-d H:i:s');
            print_r($soc_id);
            $ventry_q = "INSERT INTO visitorlog(society_id,visitor_id,roomno,datetime) values ($soc_id,$v_id,$flatno,'$date');";
            $ventry_r = pg_query($conn, $ventry_q);
            if ($ventry_r) {
                header('Location:visitorlog.php?errormsg=Visitor record added successfully!');
            } else {
                print_r($ventry_q);
                print_r("error 2" . $ventry_r);
                // header('Location:./visitorlog.php?errormsg=Visitor add failed2!');
            }
        } else {
            print_r("error 3" . $entry_r);
            // header('Location:./visitorlog.php?errormsg=Visitor add failed3!');
        }
    }
} else {
    header('Location:./visitorlog.php?errormsg=Invalid request!');
}
