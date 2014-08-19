<?php error_reporting(0); ?>
<?php include"content/loginprocessor.php"?>
<?php include"content/conn.php"?>
<?php include"includes/higher_level_connector.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php
if(isset($_SESSION['admin'])){
	$title="Birus | Dash Board";
	}
	else{
		$title="Birus Login";
		}

 ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<script type="text/javascript" src="js/auto_add_more.js"></script>
<link href="style.css" type="text/css"  rel="stylesheet"/>
</head>

<body>
<?php 
$loggedin_id=$_SESSION['user_id'];

?>


<?php include"includes/menu_headers.php";?>
<div class="header">
<div class="inner_header">
	<div class="tab_outer">
        <div class="tab_row">
            <div class="tab_column" id="site_title"><img src="images/logo.png" width="602" height="127" /></div>
            <div class="tab_column" id="top_links">
            <div style="float:right; width:70%">
        	</div>
            </div>         
     	</div>     
  	</div>
   </div>
</div>
<?php include"includes/includer.php"?>
</body>
</html>
<?php
mysql_free_result($get_loggedin_user);
?>
