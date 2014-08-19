<?php get_main_menu("sitestorekeeper")?>

   <br/>
   <div style="width:90%; margin-left:auto; margin-right:auto;">
    <div class="form_title">

            <?php echo $_REQUEST["action"];?> site To Site Request Item<?php echo $row_get_branch_by_id['name']?>
    </div>
    <div class="box">
<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "site_to_site_req_item_form")  && (isset($_POST["save"]))) {
  $insertSQL = sprintf("INSERT INTO site_to_site_req_item (item_id, qty_required, site_to_site_req_id, unit_of_measure_id, created_by, created_date, record_status) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_REQUEST['item_id'], "int"),
                       GetSQLValueString($_REQUEST['qty_required'], "double"),
                       GetSQLValueString($_REQUEST['site_to_site_req_id'], "int"),
                       GetSQLValueString($_REQUEST['unit_of_measure_id'], "int"),
                       GetSQLValueString($loggedin_id, "int"),
                       GetSQLValueString(date("y-m-d"), "date"),
                       GetSQLValueString($_REQUEST['record_status'], "text"));

  mysql_select_db($database_birus_conn, $birus_conn);
  $Result1 = mysql_query($insertSQL, $birus_conn) or die(mysql_error());
  
  if(mysql_affected_rows($birus_conn)){
	  	redirect_birus("site_to_site_req_item_view= true&site_to_site_req_id=".$_REQUEST['site_to_site_req_id']."&back_page=".$_REQUEST['back_page']."","2");
	  }
}

mysql_select_db($database_birus_conn, $birus_conn);
$query_item = "SELECT * FROM item";
$item = mysql_query($query_item, $birus_conn) or die(mysql_error());
$row_item = mysql_fetch_assoc($item);
$totalRows_item = mysql_num_rows($item);


mysql_select_db($database_birus_conn, $birus_conn);
$query_unit = "SELECT * FROM unit_of_measure";
$unit = mysql_query($query_unit, $birus_conn) or die(mysql_error());
$row_unit = mysql_fetch_assoc($unit);
$totalRows_unit = mysql_num_rows($unit);

$colname_site_to_site_req_item_by_id = "-1";
if (isset($_GET['id'])) {
  $colname_site_to_site_req_item_by_id = $_GET['id'];
}
mysql_select_db($database_birus_conn, $birus_conn);
$query_site_to_site_req_item_by_id = sprintf("SELECT * FROM site_to_site_req_item WHERE id = %s", GetSQLValueString($colname_site_to_site_req_item_by_id, "int"));
$site_to_site_req_item_by_id = mysql_query($query_site_to_site_req_item_by_id, $birus_conn) or die(mysql_error());
$row_site_to_site_req_item_by_id = mysql_fetch_assoc($site_to_site_req_item_by_id);
$totalRows_site_to_site_req_item_by_id = mysql_num_rows($site_to_site_req_item_by_id);
?>
<form action="<?php echo $editFormAction; ?>" method="post" name="site_to_site_req_item_form" id="site_to_site_req_item_form">
  <table align="left">
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Item</td>
      <td><select name="item_id">
        <?php
do {  
?>
        <option value="<?php echo $row_item['id']?>"<?php if (!(strcmp($row_item['id'], $row_site_to_site_req_item_by_id['item_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_item['name']?></option>
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
      <td nowrap="nowrap" align="left">Qty Required</td>
      <td><input type="text" name="qty_required" value="<?php echo $row_site_to_site_req_item_by_id['qty_required']; ?>" size="32" /></td>
    </tr>
	</tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Unit Of Measure:</td>
      <td><select name="unit_of_measure_id">
        <?php
do {  
?>
        <option value="<?php echo $row_unit['id']?>"<?php if (!(strcmp($row_unit['id'], $row_site_to_site_req_item_by_id['unit_of_measure_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_unit['name']?></option>
        <?php
} while ($row_unit = mysql_fetch_assoc($unit));
  $rows = mysql_num_rows($unit);
  if($rows > 0) {
      mysql_data_seek($unit, 0);
	  $row_unit = mysql_fetch_assoc($unit);
  }
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">&nbsp;</td>
      <td><?php if(isset($_REQUEST['site_to_site_req_item_edit'])){	
		echo"<input name='update' type='submit' value='UPDATE' id='submit'/>";
								echo" <a href='.?site_to_site_req_item_view= true&site_to_site_req_id=".$_REQUEST['site_to_site_req_id']."&back_page=site_to_site_req_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";
		echo"<input type='hidden' name='MM_update' value='site_to_site_req_item_form' />";	
		}
		else{
			echo"<input name='save' type='submit' value='SAVE' id='submit'/>";
						echo" <a href='.?site_to_site_req_item_view= true&site_to_site_req_id=".$_REQUEST['site_to_site_req_id']."&back_page=site_to_site_req_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";
			echo"<input type='hidden' name='MM_insert' value='site_to_site_req_item_form' />";	
			}
		?></td>
    </tr>
  </table>
  <input type="hidden" name="site_to_site_req_id" value="<?php echo $_REQUEST["site_to_site_req_id"] ?>" />
  <input type="hidden" name="record_status" value="active" />
</form>
<?php
mysql_free_result($item);

mysql_free_result($unit);

mysql_free_result($site_to_site_req_item_by_id);
?>
