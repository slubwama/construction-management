<?php
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_loggedin_user = "SELECT person.first_name, person.last_name, site.name   FROM    (   birus.user user            LEFT OUTER JOIN               birus.site site            ON (user.site_id = site.id))        INNER JOIN           birus.person person        ON (user.person_id = person.id)
Where user.id='".$_SESSION['user_id']."'
";
$get_loggedin_user = mysql_query($query_get_loggedin_user, $birus_conn) or die(mysql_error());
$row_get_loggedin_user = mysql_fetch_assoc($get_loggedin_user);
$totalRows_get_loggedin_user = mysql_num_rows($get_loggedin_user);
 session_start();
$loggedin_id=$_SESSION['user_id'];

?>