
<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "site_item_issue_form")) {
  $insertSQL = sprintf("INSERT INTO site_item_issue (site_id, item_id, qty_issued, created_by, created_date, record_status) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['site_id'], "int"),
                       GetSQLValueString($_POST['item_id'], "int"),
                       GetSQLValueString($_POST['qty_issued'], "int"),
                       GetSQLValueString($_POST['created_by'], "int"),
                       GetSQLValueString($_POST['created_date'], "date"),
                       GetSQLValueString($_POST['record_status'], "text"));

  mysql_select_db($database_birus_conn, $birus_conn);
  $Result1 = mysql_query($insertSQL, $birus_conn) or die(mysql_error());
      if(mysql_affected_rows($birus_conn)){
	  	redirect_birus("site_item_issue_view","2");
	  }
}

mysql_select_db($database_birus_conn, $birus_conn);
$query_item = "SELECT * FROM item";
$item = mysql_query($query_item, $birus_conn) or die(mysql_error());
$row_item = mysql_fetch_assoc($item);
$totalRows_item = mysql_num_rows($item);

$colname_get_issued_by_id = "-1";
if (isset($_GET['id'])) {
  $colname_get_issued_by_id = $_GET['id'];
}
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_issued_by_id = sprintf("SELECT * FROM site_item_issue WHERE id = %s", GetSQLValueString($colname_get_issued_by_id, "int"));
$get_issued_by_id = mysql_query($query_get_issued_by_id, $birus_conn) or die(mysql_error());
$row_get_issued_by_id = mysql_fetch_assoc($get_issued_by_id);
$totalRows_get_issued_by_id = mysql_num_rows($get_issued_by_id);
?>
<div class="page_title_bar">
<div class="page_title"><?php echo $_REQUEST['action']?> Site Item Issue</div>
</div>


<?php
if(isset($_REQUEST['update'])){
	
	$item_update_query="UPDATE site_item_issue SET item_id='".$_REQUEST['item_id']."', qty_issued='".$_REQUEST['qty_issued']."'  WHERE id='".$_REQUEST['id']."'";
	$update_item_results=mysql_query($item_update_query,$birus_conn) or die(mysql_error());

	 if(mysql_affected_rows($birus_conn)>0){
	redirect_birus("site_item_issue_view","2");
	}
}
 ?> 


<form action="<?php echo $editFormAction; ?>" method="post" name="site_item_issue_form" id="site_item_issue_form">
  <table align="left">
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Item:</td>
      <td><select name="item_id">
        <?php
do {  
?>
        <option value="<?php echo $row_item['id']?>"<?php if (!(strcmp($row_item['id'], $row_get_issued_by_id['item_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_item['name']?></option>
        <?php
} while ($row_item = mysql_fetch_assoc($item));
  $rows = mysql_num_rows($item);
  if($rows > 0) {
      mysql_data_seek($item, 0);
	  $row_item = mysql_fetch_assoc($item);
  }
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Qty:</td>
      <td><input type="text" name="qty_issued" value="<?php echo $row_get_issued_by_id['qty_issued']; ?>" size="32" /></td>
    </tr>
		<input type="hidden" name="record_status" value="active" size="32" />
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">&nbsp;</td>
      <td>
	  <?php if(isset($_REQUEST['site_item_issue_edit'])){	
		echo"<input name='update' type='submit' value='UPDATE' id='submit'/>";
		echo" <a href='.?site_item_issue_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";
		echo"<input type='hidden' name='id' value='".$row_get_issued_by_id['id']."'>";	
		}
		else{
			echo"<input name='save' type='submit' value='SAVE' id='submit'/>";
			echo" <a href='.?site_item_issue_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";
			echo"<input type='hidden' name='MM_insert' value='site_item_issue_form' />";	
			}
		?>
       </td>
    </tr>
  </table>
  <input type="hidden" name="site_id" value="<?php echo $_SESSION["site_id"]?>" />
  <input type="hidden" name="created_by" value="<?php echo $loggedin_id?>" />
  <input type="hidden" name="created_date" value="<?php echo date("y-m-d")?>" />
</form>
<?php
mysql_free_result($get_issued_by_id);
 mysql_free_result($item); ?>