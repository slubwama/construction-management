<?php 
//functions
session_start();
include 'functions.php';
//$submit=$_REQUEST['login']

//submit button action
if(isset($_REQUEST['login'])){
	$username=$_REQUEST['username'];
	$pass=$_REQUEST['password'];
	//check user name	 
	if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
		$login=mysql_query("SELECT role.name, user.username, user.password, user.id, user.site_id FROM user user 
		                    INNER JOIN role role ON (user.role_id = role.id) WHERE user.username = '$username' AND user.record_status='active'",$conn) or die(mysql_error()); 
		$row=mysql_fetch_assoc($login);
		
		$passw=$row['password'];
		$role=$row['name'];
		$user_id=$row["id"];
		$username_server=$row['username'];
		//echo md5($pass)."<br/>".$username_server."<br/>".$role."<br/>".$passw;
		// check password

		$message=$role." ".$username." ".$user_id;
		if(md5($pass)==$passw){
			$_SESSION[$role]=$username_server;
			$_SESSION["user_id"]=$user_id;
			$_SESSION["role_name"]=$role;
			if($row["site_id"]!="" || $row["site_id"]!=NULL){
				$_SESSION["site_id"]= $row["site_id"];
				}
		}
		else{
		$message_login="wrong user name or password".$_SESSION["user_id"].$_SESSION["role_name"];
	//header("Refreash: ."); 
	//	echo "<meta HTTP-equiv=\"refresh\"content=\"3;url=.?login_user=\">";
		}
	}
	else{
	 $message_login="You did not Enter Username  or password";
	}	
}
?>