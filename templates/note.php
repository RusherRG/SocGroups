<?php
require_once('../php/config.php');
if (isset($_GET['society']) && isset($_GET['member']) && $_GET['society']!=0) {
    // echo "yayy";
    $soc_id = $_GET['society'];
    $member_id = $_GET['member'];
    $role_query = "SELECT c.role from comprises as c where c.member_id=$member_id and c.society_id=$soc_id;";
    $role_result = pg_query($conn, $role_query);
    if($role_result && pg_fetch_result($role_result,0,0)=="Admin"){
        echo "<form class='col s12' action='addnotice.php' method='POST'>
                            <div class='row' style='margin:1%;'>
                                <div class='input-field inline col s11'>
                                    <input id='notice-area' name='msg' class='materialize-textarea validate' data-length='200' placeholder='Add a notice...' type='text' required>
                                </div>
                                <input type='hidden' name='society' value=$soc_id>
                                <input type='hidden' name='member' value=$member_id>
                                <button type='Submit' class='btn submit hoverable col s1'>Post</button>
                            </div>
                        </form><br><br><br><br>
                        <div class='divider'></div>";
    }
    $notice_query = "SELECT n.message, m.name, n.datetime from notice as n inner join member as m on n.member_id=m.member_id where n.society_id=$soc_id order by datetime desc;";
    $notice_result = pg_query($conn, $notice_query);
    if (pg_num_rows($notice_result) > 0) {
        echo "<ul id='notice-menu-list' class='notif-menu'>";
        for ($i = 0; $i < pg_num_rows($notice_result); $i++) {
            //only shows notices, not replies.
        
            // print_r(pg_fetch_result($soc_result, $i, 1));
            // if (pg_fetch_result($notice_result, $i,3) == null) {
                echo "<li class='notice-menu-item card hoverable'>
                            <h5>" . pg_fetch_result($notice_result, $i, 0) . "</h5>
                            <br><span>" . pg_fetch_result($notice_result, $i, 1) . "</span>
                            <br><span class='notice-date'>" .date('d/m/y, h:i a', strtotime(pg_fetch_result($notice_result, $i, 2)))  . "</span>
                        </li>";
                //reply to not null means its a comment on a post
            // } else {
                // echo "<li class='notice-menu-item card hoverable notice-reply'>
                //             <span><i>Reply to '".pg_fetch_result($notice_result,pg_fetch_result($notice_result, $i, 3)-1,0)."'</i></span>
                //             <h6>" . pg_fetch_result($notice_result, $i, 0) . "</h6>
                //             <br><span>" . pg_fetch_result($notice_result, $i, 1) . "</span>
                //             <br><span class='notice-date'>" .date('d/m/y, h:i a', strtotime(pg_fetch_result($notice_result, $i, 2)))  . "</span>
                //         </li>";
            // }
        }
        echo "</ul>";
    } else {
        echo "<li class='notice-menu-item card hoverable' style='text-align:center;'><span>No notices yet</span></li>";
    }
}
