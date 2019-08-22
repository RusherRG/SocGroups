<?php
    try{
        $conn = pg_connect("host=localhost dbname=socgroups user=postgres password=kjsce");
    }catch(Exception $e){
        echo $e . ":(";
        exit;
    }
    
    // print_r($db_conn);
?>