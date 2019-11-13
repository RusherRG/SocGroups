<?php
require_once('../php/config.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $soc_id = $_POST['society'];
    $member_id = $_POST['member'];
    $msg = $_POST['msg'];
    $date = $date = date('Y-m-d H:i:s');
    $n_query = "INSERT INTO notice(society_id,member_id,message,datetime) values ($soc_id,$member_id,'$msg','$date');";
    $n_result = pg_query($conn,$n_query);
    if($n_result){
        header('Location:notices.php?errormsg=Notice added!');
    }else{
        header('Location:notices.php?errormsg=Notice add failed');}
} else {
    header('Location:./notices.php?errormsg=Invalid request!');
}
