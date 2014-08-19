<?php get_main_menu("sitestorekeeper")?>

   <br/>
   <div style="width:90%; margin-left:auto; margin-right:auto;">
    <div class="form_title">

            <?php echo $_REQUEST["action"];?> Site To Site Request <?php echo $row_get_branch_by_id['name']?>
    </div>
    <div class="box">
<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "site_to_site_req_form")) {
  $insertSQL = sprintf("INSERT INTO site_to_site_req (site_id, site_to_id, req_no, created_by, created_date, record_status) VALUES (%s, %s, %s, %s, %s, %s)",
		   GetSQLValueString($_SESSION['site_id'], "int"),
		   GetSQLValueString($_REQUEST['site_to_id'], "int"),
		   GetSQLValueString($_POST['req_no'], "text"),
		   GetSQLValueString($loggedin_id, "int"),
		   GetSQLValueString(date("y-m-d"), "date"),
		   GetSQLValueString($_POST['record_status'], "text"));
  mysql_select_db($database_birus_conn, $birus_conn);
  $Result1 = mysql_query($insertSQL, $birus_conn) or die(mysql_error());
  
    if(mysql_affected_rows($birus_conn)){
	  	redirect_birus("site_to_site_req_view","2");
	  }
}
mysql_select_db($database_birus_conn, $birus_conn);
$query_site_to_site_req_last_insert = "SELECT * FROM site_to_site_req ORDER BY id DESC LIMIT 0 ,1";
$site_to_site_req_last_insert = mysql_query($query_site_to_site_req_last_insert, $birus_conn) or die(mysql_error());
$row_site_to_site_req_last_insert = mysql_fetch_assoc($site_to_site_req_last_insert);
$totalRows_site_to_site_req_last_insert = mysql_num_rows($site_to_site_req_last_insert);

mysql_select_db($database_birus_conn, $birus_conn);
$query_get_site = "SELECT id, name FROM site";
$get_site = mysql_query($query_get_site, $birus_conn) or die(mysql_error());
$row_get_site = mysql_fetch_assoc($get_site);
$totalRows_get_site = mysql_num_rows($get_site);

mysql_select_db($database_birus_conn, $birus_conn);
$query_site = "SELECT * FROM site";
$site = mysql_query($query_site, $birus_conn) or die(mysql_error());
$row_site = mysql_fetch_assoc($site);
$totalRows_site = mysql_num_rows($site);

$colname_site_to_site_by_id = "-1";
if (isset($_GET['id'])) {
  $colname_site_to_site_by_id = $_GET['id'];
}
mysql_select_db($database_birus_conn, $birus_conn);
$query_site_to_site_by_id = sprintf("SELECT * FROM site_to_site_req WHERE id = %s", GetSQLValueString($colname_site_to_site_by_id, "int"));
$site_to_site_by_id = mysql_query($query_site_to_site_by_id, $birus_conn) or die(mysql_error());
$row_site_to_site_by_id = mysql_fetch_assoc($site_to_site_by_id);
$totalRows_site_to_site_by_id = mysql_num_rows($site_to_site_by_id);
?>
<form action="<?php echo $editFormAction; ?>" method="post" name="site_to_site_req_form" id="site_to_site_req_form">
  <table align="left">
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Req No:</td>
      <td>
      
            <input type="hidden" name="id" value="<?php echo $row_site_to_site_by_id['id']; ?>" size="32" />
<input type="hidden" name="req_no" value="
	  <?php if(isset($_REQUEST['site_to_site_req_edit'])){echo $row_site_to_site_by_id['req_no'];} else{ echo "SReq".(1+$row_site_to_site_req_last_insert['id']);} ?>" size="32" />
	  <?php if(isset($_REQUEST['site_to_site_req_edit'])){echo $row_site_to_site_by_id['req_no'];} else{ echo "SReq".(1+$row_site_to_site_req_last_insert['id']);} ?>
          </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">To Site:</td>
      <td><select name="site_to_id">
        <?php
do {  
?>
        <option value="<?php echo $row_site['id']?>"<?php if (!(strcmp($row_site['id'], $row_site_to_site_by_id['site_to_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_site['name']?></option>
        <?php
} while ($row_site = mysql_fetch_assoc($site));
  $rows = mysql_num_rows($site);
  if($rows > 0) {
      mysql_data_seek($site, 0);
	  $row_site = mysql_fetch_assoc($site);
  }
?>
      </select></td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">&nbsp;</td>
      <td><?php if(isset($_REQUEST['site_to_site_req_edit'])){	
		echo"<input name='update' type='submit' value='UPDATE' id='submit'/>";
		echo" <a href='.?site_to_site_req_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";
		echo"<input type='hidden' name='MM_update' value='site_to_site_req_form' />";	
		}
		else{
			echo"<input name='save' type='submit' value='SAVE' id='submit'/>";
			echo" <a href='.?site_to_site_req_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";
			echo"<input type='hidden' name='MM_insert' value='site_to_site_req_form' />";	
			}
		?></td>
    </tr>
  </table>
  <input type="hidden" name="record_status" value="active" />
</form>
<?php
mysql_free_result($site_to_site_req_last_insert);
mysql_free_result($get_site);
mysql_free_result($site);

mysql_free_result($site_to_site_by_id);
 ?>
</div>