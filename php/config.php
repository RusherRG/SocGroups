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

    $codepath="http://localhost:8081/SocGroups/templates/";
    $phppath="http://localhost:8081/SocGroups/php/";
    $imagepath="http://localhost:8081/SocGroups/images/";
    $jspath="http://localhost:8081/SocGroups/static/js/";
    $csspath="http://localhost:8081/SocGroups/static/styles/";

    // print_r($db_conn);
?>