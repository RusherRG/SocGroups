<?php
require_once('../php/config.php');
try{
if(isset($_GET['p']) && isset($_GET['visitor']) && isset($_GET['society'])){
    $permission = $_GET['p'];
    $visitor_id = $_GET['visitor'];
    $soc_id = $_GET['society'];
    $permit_q= "UPDATE visitorlog SET approval=$permission WHERE visitor_id=$visitor_id and society_id=$soc_id;";
    $permit_result = pg_query($conn,$permit_q);
    if($permit_result){
        echo $permit_result;
        header('Location:./visitorlog.php');
    }
    else{
        echo "NOPE";
        
        header('Location:./visitorlog.php?error=true');
    }
}
}catch(Exception $ex){
    echo "Failed";
}

?>