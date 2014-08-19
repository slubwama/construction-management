<?php get_main_menu("admin")?><?php include "includes/notifications/storekeeper.php"?>
<?php get_main_menu("storekeeper",$notification_store_keeper)?>
   <br/>
   <div style="width:90%; margin-left:auto; margin-right:auto;">
    <div class="form_title">

            <?php echo $_REQUEST["action"];?> Purchase Request <?php echo $row_get_branch_by_id['name']?>
    </div>
    <div class="box">
<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "purchase_req_form")) {
  $insertSQL = sprintf("INSERT INTO purchase_req (req_no, supplier_id, created_by, created_date, record_status) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['req_no'], "text"),
					   GetSQLValueString($_POST['supplier_id'], "int"),
                       GetSQLValueString($loggedin_id, "int"),
                       GetSQLValueString(date("y-m-d"), "date"),
                       GetSQLValueString($_POST['record_status'], "text"));

  mysql_select_db($database_birus_conn, $birus_conn);
  $Result1 = mysql_query($insertSQL, $birus_conn) or die(mysql_error());
  
  if(mysql_affected_rows($birus_conn)>0){
	  redirect_birus("purchase_req_view","2");
	  }
}

mysql_select_db($database_birus_conn, $birus_conn);
$query_purchase_req_last_insert = "SELECT * FROM purchase_req ORDER BY id DESC LIMIT 0 ,1";
$purchase_req_last_insert = mysql_query($query_purchase_req_last_insert, $birus_conn) or die(mysql_error());
$row_purchase_req_last_insert = mysql_fetch_assoc($purchase_req_last_insert);
$totalRows_purchase_req_last_insert = mysql_num_rows($purchase_req_last_insert);

mysql_select_db($database_birus_conn, $birus_conn);
$query_supplier = "SELECT * FROM supplier";
$supplier = mysql_query($query_supplier, $birus_conn) or die(mysql_error());
$row_supplier = mysql_fetch_assoc($supplier);
$totalRows_supplier = mysql_num_rows($supplier);

$colname_purchase_req = "-1";
if (isset($_GET['id'])) {
  $colname_purchase_req = $_GET['id'];
}
mysql_select_db($database_birus_conn, $birus_conn);
$query_purchase_req = sprintf("SELECT * FROM purchase_req WHERE id = %s", GetSQLValueString($colname_purchase_req, "int"));
$purchase_req = mysql_query($query_purchase_req, $birus_conn) or die(mysql_error());
$row_purchase_req = mysql_fetch_assoc($purchase_req);
$totalRows_purchase_req = mysql_num_rows($purchase_req);
?>

<form action="<?php echo $editFormAction; ?>" method="post" name="purchase_req_form" id="purchase_req_form">
  <table align="left">
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Req No:</td>
      <td><input type="hidden" name="id" value="<?php echo $row_purchase_req['id']; ?>" size="32" />
      <input type="hidden" name="req_no" value="<?php if(isset($_REQUEST['purchase_req_edit'])){echo $row_purchase_req['req_no'];} else{ echo "Pr".(1+$row_purchase_req_last_insert['id']);} ?>" size="32" /><?php if(isset($_REQUEST['purchase_req_edit'])){echo $row_purchase_req['req_no'];} else{ echo "Pr".(1+$row_purchase_req_last_insert['id']);} ?>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Supplier</td>
      <td><select name="supplier_id">
        <?php
do {  
?>
        <option value="<?php echo $row_supplier['id']?>"<?php if (!(strcmp($row_supplier['id'], $row_purchase_req['supplier_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_supplier['name']?></option>
        <?php
} while ($row_supplier = mysql_fetch_assoc($supplier));
  $rows = mysql_num_rows($supplier);
  if($rows > 0) {
      mysql_data_seek($supplier, 0);
	  $row_supplier = mysql_fetch_assoc($supplier);
  }
?>
      </select></td>
    </tr>    
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">&nbsp;</td>
      <td>
	  <?php if(isset($_REQUEST['purchase_req_edit'])){	
		echo"<input name='update' type='submit' value='UPDATE' id='submit'/>";
		echo" <a href='.?purchase_req_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";
		echo"<input type='hidden' name='MM_update' value='purchase_req_form' />";	
		}
		else{
			echo"<input name='save' type='submit' value='Continue' id='submit'/>";
			echo" <a href='.?purchase_req_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";
			echo"<input type='hidden' name='MM_insert' value='purchase_req_form' />";	
			}
		?></td>
    </tr>
  </table>
  <input type="hidden" name="record_status" value="active" />
</form>
<?php
mysql_free_result($purchase_req_last_insert);

mysql_free_result($purchase_req);
 ?>
 </div>