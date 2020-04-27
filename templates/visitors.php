<?php
require_once('../php/config.php');
if (isset($_GET['society']) && isset($_GET['member']) && $_GET['society']!=0) {
    // echo "yayy";
    $soc_id = $_GET['society'];
    $member_id = $_GET['member'];
    $role_query = "SELECT c.role from comprises as c where c.member_id=$member_id and c.society_id=$soc_id;";
    $role_result = pg_query($conn, $role_query);
    if (pg_num_rows($role_result) == 1) {
        if (pg_fetch_result($role_result, 0, 0) == "Admin")
            echo "<a class='waves-effect waves-light btn-large' style='width:98%; margin:1%;' href='manage_visitor.php?society=$soc_id&role=view'>View society log</a> ";
        if (pg_fetch_result($role_result, 0, 0) == "Guard") {
            echo "<a class='waves-effect waves-light btn-large' style='width:98%; margin:1%;' href='manage_visitor.php?society=$soc_id&role=add'>Add visitor entry</a> ";
            $visitor_query = "SELECT v.name, v.phone, v.email, l.roomno, l.datetime, l.approval, v.visitor_id from visitor as v inner join visitorlog as l on v.visitor_id=l.visitor_id where l.society_id=$soc_id;";
            $visitor_result = pg_query($conn, $visitor_query);
            if (pg_num_rows($visitor_result)) {
                for ($i = 0; $i < pg_num_rows($visitor_result); $i++) {
                    // print_r(pg_fetch_result($soc_result, $i, 1));
                    if (pg_fetch_result($visitor_result, $i, 5) != null) {
                        if (pg_fetch_result($visitor_result, $i, 5) == "t") {
                            echo "<li class='notice-menu-item card hoverable'>
                            <h5>" . pg_fetch_result($visitor_result, $i, 0) . "</h5>
                            <br><span>Phone: " . pg_fetch_result($visitor_result, $i, 1) . "</span>
                            <br><span>Email: " . pg_fetch_result($visitor_result, $i, 2) . "</span>
                            <br><span>Room no: " . pg_fetch_result($visitor_result, $i, 3) . "</span>
                            <br><span>Date: " . date('d/m/y, h:i a', strtotime(pg_fetch_result($visitor_result, $i, 4))) . "</span>
                            <br><span>Approval: Approved</span>
                        </li>";
                        } else {
                            echo "<li class='notice-menu-item card hoverable'>
                            <h5>" . pg_fetch_result($visitor_result, $i, 0) . "</h5>
                            <br><span>Phone: " . pg_fetch_result($visitor_result, $i, 1) . "</span>
                            <br><span>Email: " . pg_fetch_result($visitor_result, $i, 2) . "</span>
                            <br><span>Room no: " . pg_fetch_result($visitor_result, $i, 3) . "</span>
                            <br><span>Date: " . date('d/m/y, h:i a', strtotime(pg_fetch_result($visitor_result, $i, 4))) . "</span>
                            <br><span>Approval: Denied</span>
                        </li>";
                        }
                    } else {
                        $visitor_id = pg_fetch_result($visitor_result, $i, 6);
                        echo "<li class='notice-menu-item card hoverable'>
                            <span class='notif-number'>PENDING</span>
                            <h5>" . pg_fetch_result($visitor_result, $i, 0) . "</h5>
                            <br><span>Phone: " . pg_fetch_result($visitor_result, $i, 1) . "</span>
                            <br><span>Email: " . pg_fetch_result($visitor_result, $i, 2) . "</span>
                            <br><span>Room no: " . pg_fetch_result($visitor_result, $i, 3) . "</span>
                            <br><span>Date: " . date('d/m/y, h:i a', strtotime(pg_fetch_result($visitor_result, $i, 4))) . "</span>
                            <br><span>Approval: Pending</span>
                            <br><br>
                        </li>";
                    }
                }
            } else {
                echo "<li class='notice-menu-item card hoverable' style='text-align:center;'><span>No visitors yet</span></li>";
            }
        } else {
            $visitor_query = "SELECT v.name, v.phone, v.email, l.roomno, l.datetime, l.approval, v.visitor_id from visitor as v inner join visitorlog as l on v.visitor_id=l.visitor_id inner join comprises as c on c.roomno=l.roomno where c.member_id=$member_id and c.society_id=$soc_id and l.society_id=$soc_id order by approval desc;";
            $visitor_result = pg_query($conn, $visitor_query);
            if (pg_num_rows($visitor_result)) {
                for ($i = 0; $i < pg_num_rows($visitor_result); $i++) {
                    // print_r(pg_fetch_result($soc_result, $i, 1));
                    if (pg_fetch_result($visitor_result, $i, 5) != null) {
                        if (pg_fetch_result($visitor_result, $i, 5) == "t") {
                            echo "<li class='notice-menu-item card hoverable'>
                            <h5>" . pg_fetch_result($visitor_result, $i, 0) . "</h5>
                            <br><span>Phone: " . pg_fetch_result($visitor_result, $i, 1) . "</span>
                            <br><span>Email: " . pg_fetch_result($visitor_result, $i, 2) . "</span>
                            <br><span>Room no: " . pg_fetch_result($visitor_result, $i, 3) . "</span>
                            <br><span>Date: " . date('d/m/y, h:i a', strtotime(pg_fetch_result($visitor_result, $i, 4))) . "</span>
                            <br><span class='teal-text'>Approval: Approved</span>
                        </li>";
                        } else {
                            echo "<li class='notice-menu-item card hoverable'>
                            <h5>" . pg_fetch_result($visitor_result, $i, 0) . "</h5>
                            <br><span>Phone: " . pg_fetch_result($visitor_result, $i, 1) . "</span>
                            <br><span>Email: " . pg_fetch_result($visitor_result, $i, 2) . "</span>
                            <br><span>Room no: " . pg_fetch_result($visitor_result, $i, 3) . "</span>
                            <br><span>Date: " . date('d/m/y, h:i a', strtotime(pg_fetch_result($visitor_result, $i, 4))) . "</span>
                            <br><span class='red-text'>Approval: Denied</span>
                        </li>";
                        }
                    } else {
                        $visitor_id = pg_fetch_result($visitor_result, $i, 6);
                        echo "<li class='notice-menu-item card hoverable'>
                            <span class='notif-number'>PENDING</span>
                            <h5>" . pg_fetch_result($visitor_result, $i, 0) . "</h5>
                            <br><span>Phone: " . pg_fetch_result($visitor_result, $i, 1) . "</span>
                            <br><span>Email: " . pg_fetch_result($visitor_result, $i, 2) . "</span>
                            <br><span>Room no: " . pg_fetch_result($visitor_result, $i, 3) . "</span>
                            <br><span>Date: " . date('d/m/y, h:i a', strtotime(pg_fetch_result($visitor_result, $i, 4))) . "</span>
                            <br><span>Approval: Pending</span>
                            <br><br>
                            <a class='waves-effect waves-light btn-large' style='width:49.5%;' href='permit.php?visitor=$visitor_id&society=$soc_id&p=true'>Approve</a>   
                            <a class='waves-effect waves-light btn-large' style='width:49.5%;' href='permit.php?visitor=$visitor_id&society=$soc_id&p=false'>Deny</a>
                    
                        </li>";
                    }
                }
            } else {
                if (pg_fetch_result($role_result, 0, 0) != "Guard")
                    echo "<li class='notice-menu-item card hoverable' style='text-align:center;'><span>No visitors yet</span></li>";
            }
        }
    }
}
