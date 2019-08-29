<?php
    $host = "localhost";
    $dbname = "socgroups";
    $user = "postgres";
    $password = "kjsce";
    try{
        $conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");
    }catch(Exception $e){
        echo $e . ":(";
        exit;
    }
    
    // print_r($db_conn);
?>