<?php
require_once('../php/config.php');
if (isset($_GET['society']) && isset($_GET['member'])) {
    // echo "yayy";
    $soc_id = $_GET['society'];
    $member_id = $_GET['member'];
    $notice_query = "SELECT n.message, m.name, n.datetime, n.reply_to from notice as n inner join member as m on n.member_id=m.member_id where n.society_id=$soc_id order by notice_id;";
    $notice_result = pg_query($conn, $notice_query);
    if (pg_num_rows($notice_result) > 0) {
        for ($i = 0; $i < pg_num_rows($notice_result); $i++) {
            // print_r(pg_fetch_result($soc_result, $i, 1));
            if (pg_fetch_result($notice_result, $i,3) == null) {
                echo "<li class='notice-menu-item card hoverable'>
                            <h6>" . pg_fetch_result($notice_result, $i, 0) . "</h6>
                            <br><span>" . pg_fetch_result($notice_result, $i, 1) . "</span>
                            <br><span class='notice-date'>" .date('d/m/y, h:i a', strtotime(pg_fetch_result($notice_result, $i, 2)))  . "</span>
                        </li>";
                //reply to not null means its a comment on a post
            } else {
                echo "<li class='notice-menu-item card hoverable notice-reply'>
                            <span><i>Reply to '".pg_fetch_result($notice_result,pg_fetch_result($notice_result, $i, 3)-1,0)."'</i></span>
                            <h6>" . pg_fetch_result($notice_result, $i, 0) . "</h6>
                            <br><span>" . pg_fetch_result($notice_result, $i, 1) . "</span>
                            <br><span class='notice-date'>" .date('d/m/y, h:i a', strtotime(pg_fetch_result($notice_result, $i, 2)))  . "</span>
                        </li>";
            }
        }
    } else {
        echo "<li class='notice-menu-item card hoverable' style='text-align:center;'><span>No notices yet</span></li>";
    }
}
