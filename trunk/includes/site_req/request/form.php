<script type="text/javascript" src="js/script.js"></script>
<?php get_main_menu("admin")?>

   <br/>
   <div style="width:90%; margin-left:auto; margin-right:auto;">
    <div class="form_title">

            <?php echo $_REQUEST["action"];?> Site Request <?php echo $row_get_branch_by_id['name']?>
    </div>
    <div class="box"> 
<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "site_req_form")) {
  $insertSQL = sprintf("INSERT INTO site_req (site_id, req_no, created_by, created_date, record_status) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_SESSION['site_id'], "text"),
					   GetSQLValueString($_POST['req_no'], "text"),
                       GetSQLValueString($loggedin_id, "int"),
                       GetSQLValueString(date("y-m-d"), "date"),
                       GetSQLValueString($_POST['record_status'], "text"));

  mysql_select_db($database_birus_conn, $birus_conn);
  $Result1 = mysql_query($insertSQL, $birus_conn) or die(mysql_error());
  
    if(mysql_affected_rows($birus_conn)){
	  	redirect_birus("site_req_view","2");
	  }

}

mysql_select_db($database_birus_conn, $birus_conn);
$query_site_req_last_insert = "SELECT * FROM site_req ORDER BY id DESC LIMIT 0 ,1";
$site_req_last_insert = mysql_query($query_site_req_last_insert, $birus_conn) or die(mysql_error());
$row_site_req_last_insert = mysql_fetch_assoc($site_req_last_insert);
$totalRows_site_req_last_insert = mysql_num_rows($site_req_last_insert);

mysql_select_db($database_birus_conn, $birus_conn);
$query_get_site = "SELECT id, name FROM site";
$get_site = mysql_query($query_get_site, $birus_conn) or die(mysql_error());
$row_get_site = mysql_fetch_assoc($get_site);
$totalRows_get_site = mysql_num_rows($get_site);
?>
<div class="page_title_bar">
<div class="page_title"><?php echo $_REQUEST['action']?> Site Requstion</div>
</div>
<form action="<?php echo $editFormAction; ?>" method="post" name="site_req_form" id="site_req_form">
  <table width="404" align="left">
    <tr valign="baseline">
      <td width="51" align="left" nowrap="nowrap">Req_no:</td>
      <td width="274"><input type="text" name="req_no" value="<?php echo "SReq".(1+$row_site_req_last_insert['id']); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">&nbsp;</td>
      <td><?php if(isset($_REQUEST['site_req_edit'])){	
		echo"<input name='update' type='submit' value='UPDATE' id='submit'/>";
		echo" <a href='.?site_req_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";
		echo"<input type='hidden' name='MM_update' value='site_req_form' />";	
		}
		else{
			echo"<input name='save' type='submit' value='SAVE' id='submit'/>";
			echo" <a href='.?site_req_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";
			echo" <input type='hidden' name='MM_insert' value='site_req_form' />";	
			}
		?></td>
    </tr>
  </table>
  <input type="hidden" name="record_status" value="active" />
</form>
<?php
mysql_free_result($site_req_last_insert);
mysql_free_result($get_site);

 ?>
 </div>