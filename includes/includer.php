<?php 
if(isset($_SESSION['admin']) || isset($_SESSION['main_store_keeper']) || isset($_SESSION['head_of_construction'])  || isset($_SESSION['site_supervisor'])  || isset($_SESSION['site_store_keeper'])){
	include"admin_includer.php";
}

else{
		if(isset($_REQUEST['login'])){
		include"includes/login.php";	
	}
	
	else if(isset($_REQUEST['adviser'])){
		include"includes/combination_adviser.php";
		}
						
	else{
			include"includes/login.php";
		}
	}
?>
