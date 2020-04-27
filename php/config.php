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
    try{
    $v_q="SELECT setval(pg_get_serial_sequence('visitor', 'visitor_id'), max(visitor_id)) FROM visitor;";
    $m_q="SELECT setval(pg_get_serial_sequence('member', 'member_id'), max(member_id)) FROM member;";
    $n_q="SELECT setval(pg_get_serial_sequence('notice', 'notice_id'), max(notice_id)) FROM notice;";
    $s_q="SELECT setval(pg_get_serial_sequence('society', 'society_id'), max(society_id)) FROM society;";
    $v_r=pg_query($v_q);
    $m_r=pg_query($m_q);
    $n_r=pg_query($n_q);
    $s_r=pg_query($s_q);
    // print_r($v_r);
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