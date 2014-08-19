<?php get_main_menu("admin")?>

   <br/>
   <div style="width:90%; margin-left:auto; margin-right:auto;">
    <div class="form_title">

            <?php echo $_REQUEST["action"];?> Role <?php echo $row_get_branch_by_id['name']?>
    </div>
    <div class="box"> 
<?php
$colname_role_by_id = "-1";
if (isset($_GET['id'])) {
  $colname_role_by_id = $_GET['id'];
}
mysql_select_db($database_birus_conn, $birus_conn);
$query_role_by_id = sprintf("SELECT * FROM `role` WHERE id = %s", GetSQLValueString($colname_role_by_id, "int"));
$role_by_id = mysql_query($query_role_by_id, $birus_conn) or die(mysql_error());
$row_role_by_id = mysql_fetch_assoc($role_by_id);
$totalRows_role_by_id = mysql_num_rows($role_by_id);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "role_form")  && isset($_REQUEST["save"])) {
  $insertSQL = sprintf("INSERT INTO `role` (name, created_by, created_date, record_status) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($loggedin_id, "int"),
                       GetSQLValueString(date("y-m-d"), "date"),
                       GetSQLValueString($_POST['record_status'], "text"));

  mysql_select_db($database_birus_conn, $birus_conn);
  $Result1 = mysql_query($insertSQL, $birus_conn) or die(mysql_error());
  
  if(mysql_affected_rows($birus_conn)){
	  redirect_birus("role_view","2");
	  }
}
?>


<div class="page_title"> 
<?php
 if(isset($_REQUEST["update"])){
			if(isset($_REQUEST["id"])){
			mysql_select_db($database_birus_conn, $birus_conn);
			$query_update_user="update role set name='".$_REQUEST['name']."' WHERE role.id='".$_REQUEST["id"]."'";
			$results_user=mysql_query($query_update_user,$birus_conn) or die(mysql_error());
				redirect_birus("role_view","2");
			}
 			}
?>
<form action="<?php echo $editFormAction; ?>" method="post" name="Role" id="role_form">
  <table align="left">
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Name:</td>
      <td><input type="text" name="name" value="<?php echo $row_role_by_id['name']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">&nbsp;</td>
      <td> <?php if(isset($_REQUEST['role_edit'])){	
		echo"<input name='update' type='submit' value='UPDATE' id='submit'/>";
		echo"<input type='hidden' name='MM_update' value='role_form' />";
		echo"&nbsp;&nbsp;<a href='.?role_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";
		
		}
		else{
			echo"<input name='save' type='submit' value='SAVE' id='submit'/>";
			echo"<input type='hidden' name='MM_insert' value='role_form' />";	
			echo"&nbsp;&nbsp;<a href='.?role_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";
			}
		?></td>
    </tr>
  </table>
  <input type="hidden" name="id" value="<?php echo $row_role_by_id['id']; ?>" />
  <input type="hidden" name="record_status" value="active" />
  <input type="hidden" name="MM_insert" value="role_form" />
</form>
<?php
mysql_free_result($role_by_id);
?>
</div>