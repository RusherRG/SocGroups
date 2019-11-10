<?php
    $host = "localhost";
    $dbname = "socgroups";
    $user = "postgres";
    $password = "netra";
    try{
        $conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");
    }catch(Exception $e){
        echo $e . ":(";
        exit;
    }

    $codepath="http://localhost/SocGroups/templates/";
    $phppath="http://localhost/SocGroups/php/";
    $imagepath="http://localhost/SocGroups/images/";
    $jspath="http://localhost/SocGroups/static/js/";
    $csspath="http://localhost/SocGroups/static/styles/";

    // print_r($db_conn);
?>