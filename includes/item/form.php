<?php get_main_menu("admin")?>

   <br/>
   <div style="width:90%; margin-left:auto; margin-right:auto;">
    <div class="form_title">

            <?php echo $_REQUEST["action"];?> Item <?php echo $row_get_branch_by_id['name']?>
    </div>
    <div class="box"> 
<?php
$colname_item_by_id = "-1";
if (isset($_GET['id'])) {
  $colname_item_by_id = $_GET['id'];
}
mysql_select_db($database_birus_conn, $birus_conn);
$query_item_by_id = sprintf("SELECT * FROM item WHERE id = %s", GetSQLValueString($colname_item_by_id, "int"));
$item_by_id = mysql_query($query_item_by_id, $birus_conn) or die(mysql_error());
$row_item_by_id = mysql_fetch_assoc($item_by_id);
$totalRows_item_by_id = mysql_num_rows($item_by_id);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "item_form")  && isset($_REQUEST["save"])) {
  $insertSQL = sprintf("INSERT INTO `item` (name, restock_level, created_by, created_date, record_status) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
					    GetSQLValueString($_POST['restock_level'], "int"),
                       GetSQLValueString($loggedin_id, "int"),
                       GetSQLValueString(date("y-m-d"), "date"),
                       GetSQLValueString($_POST['record_status'], "text"));

  mysql_select_db($database_birus_conn, $birus_conn);
  $Result1 = mysql_query($insertSQL, $birus_conn) or die(mysql_error());
  
  if(mysql_affected_rows($birus_conn)){
	  redirect_birus("item_view","2");
	  }
}
?>

<?php
 if(isset($_REQUEST["update"])){
			if(isset($_REQUEST["id"])){
			mysql_select_db($database_birus_conn, $birus_conn);
			$query_update_user="update item set name='".$_REQUEST['name']."',restock_level='".$_REQUEST['restock_level']."' WHERE item.id='".$_REQUEST["id"]."'";
			$results_user=mysql_query($query_update_user,$birus_conn) or die(mysql_error());
				redirect_birus("item_view","2");
			}
 			}
?>
<form action="<?php echo $editFormAction; ?>" method="post" name="Role" id="item_form">
  <table align="left">
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Item Name:</td>
      <td><input type="text" name="name" value="<?php echo $row_item_by_id['name']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Restock Level:</td>
      <td><input type="text" name="restock_level" value="<?php echo $row_item_by_id['restock_level']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">&nbsp;</td>
      <td> <?php if(isset($_REQUEST['item_edit'])){	
		echo"<input name='update' type='submit' value='UPDATE' id='submit'/>";
		echo"<input type='hidden' name='MM_update' value='item_form' />";
		echo"&nbsp;&nbsp;<a href='.?item_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";
		
		}
		else{
			echo"<input name='save' type='submit' value='SAVE' id='submit'/>";
			echo"<input type='hidden' name='MM_insert' value='item_form' />";	
			echo"&nbsp;&nbsp;<a href='.?item_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";
			}
		?></td>
    </tr>
  </table>
  <input type="hidden" name="record_status" value="active" />
  <input type="hidden" name="id" value="<?php echo $row_item_by_id['id']; ?>" />
  <input type="hidden" name="MM_insert" value="item_form" />
</form>
<?php
mysql_free_result($item_by_id);
?>
</div>
