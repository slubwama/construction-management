<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_birus_conn = "localhost";
$database_birus_conn = "birus";
$username_birus_conn = "root";
$password_birus_conn = "";
$birus_conn = mysql_pconnect($hostname_birus_conn, $username_birus_conn, $password_birus_conn) or trigger_error(mysql_error(),E_USER_ERROR); 
?>