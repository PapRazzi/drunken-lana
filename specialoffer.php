<?php

include("include/config.php");
include("include/functions/import.php");
$thebaseurl = $config['baseurl'];


$query1 = "SELECT  @rownum:=@rownum+1 position, members.username, posts.USERID user_id, count(posts.USERID) orders_completed
FROM orders, posts, members, (SELECT @rownum := 0) position
WHERE posts.PID = orders.PID
and posts.USERID = members.USERID
AND orders.status = '5'
group by posts.USERID
ORDER BY orders_completed desc
";
$executequery1 = $conn->Execute($query1);
$users = $executequery1->getrows();

$templateselect = "specialoffer.tpl";
//TEMPLATES BEGIN
STemplate::assign('pagetitle',$lang['460']);
STemplate::assign('message',$message);
STemplate::assign('users',$users);
STemplate::display('header.tpl');
STemplate::display($templateselect);
STemplate::display('footer.tpl');
//TEMPLATES END
?>