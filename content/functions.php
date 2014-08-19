<?php

//session
session_start();

//connect to database
include'conn.php';

//login checker funtion
function loggedin()
 {
	 if(isset($_SESSION['username']) ||isset($_COOKIE['username']))
	 {
		$loggedin=TRUE; 
		return $loggedin;
	 }	
 }

?>