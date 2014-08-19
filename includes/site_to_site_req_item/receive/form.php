<?php
$colname_get_site_store_by_site_to_site_req_id = "-1";
if (isset($_GET['site_to_site_req_item_id'])) {
  $colname_get_site_store_by_site_to_site_req_id = $_GET['site_to_site_req_item_id'];
}
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_site_store_by_site_to_site_req_id = sprintf("SELECT * FROM site_store WHERE site_to_site_req_item_in_id = %s", GetSQLValueString($colname_get_site_store_by_site_to_site_req_id, "int"));
$get_site_store_by_site_to_site_req_id = mysql_query($query_get_site_store_by_site_to_site_req_id, $birus_conn) or die(mysql_error());
$row_get_site_store_by_site_to_site_req_id = mysql_fetch_assoc($get_site_store_by_site_to_site_req_id);
$totalRows_get_site_store_by_site_to_site_req_id = mysql_num_rows($get_site_store_by_site_to_site_req_id);

mysql_select_db($database_birus_conn, $birus_conn);
$query_get_last_record_per_item = "SELECT * FROM site_store where item_id='".$_REQUEST["item_id"]."'  ORDER BY id DESC
LIMIT 0 , 1";
$get_last_record_per_item = mysql_query($query_get_last_record_per_item, $birus_conn) or die(mysql_error());
$row_get_last_record_per_item = mysql_fetch_assoc($get_last_record_per_item);
$totalRows_get_last_record_per_item = mysql_num_rows($get_last_record_per_item);

$colname_site_to_site_req_item_by_id = "-1";
if (isset($_GET['site_to_site_req_item_id'])) {
  $colname_site_to_site_req_item_by_id = $_GET['site_to_site_req_item_id'];
}
mysql_select_db($database_birus_conn, $birus_conn);
$query_site_to_site_req_item_by_id = sprintf("
	   SELECT item.name as item_name,
       unit_of_measure.name as unit_name,
       site_to_site_req_item.id,
       site_to_site_req_item.item_id,
       site_to_site_req_item.qty_required,
	   site_to_site_req_item.qty_issued,
       site_to_site_req_item.qty_recieved,
       site_to_site_req_item.site_to_site_req_id,
       site_to_site_req_item.unit_of_measure_id,
       site_to_site_req_item.deleted_by,
       site_to_site_req_item.delete_date,
       site_to_site_req_item.created_by,
       site_to_site_req_item.created_date,
       site_to_site_req_item.record_status
  FROM    (   birus.site_to_site_req_item site_to_site_req_item
           INNER JOIN
              birus.unit_of_measure unit_of_measure
           ON (site_to_site_req_item.unit_of_measure_id = unit_of_measure.id))
       INNER JOIN
          birus.item item
       ON (site_to_site_req_item.item_id = item.id) WHERE site_to_site_req_item.id = %s", GetSQLValueString($colname_site_to_site_req_item_by_id, "int"));
$site_to_site_req_item_by_id = mysql_query($query_site_to_site_req_item_by_id, $birus_conn) or die(mysql_error());
$row_site_to_site_req_item_by_id = mysql_fetch_assoc($site_to_site_req_item_by_id);
$totalRows_site_to_site_req_item_by_id = mysql_num_rows($site_to_site_req_item_by_id);
?>

<?php
if(isset($_REQUEST['site_to_site_req_item_recieve_form'])){
echo count($row_get_site_store_by_site_to_site_req_id);
	if(count($row_get_site_store_by_site_to_site_req_id)<=2){

	$approve_update="UPDATE birus.site_to_site_req_item SET qty_recieved='".$_REQUEST["qty_recieved"]."' WHERE site_to_site_req_item.id ='".$_REQUEST['site_to_site_req_item_id']."';";
	mysql_query($approve_update, $birus_conn) or die(mysql_error());
	if(mysql_affected_rows($birus_conn)>0){
	if(count($row_get_last_record_per_item)>1){
			$previous_id="'".$row_get_last_record_per_item["id"]."',";
			$previous_id_place_holder="previous_id,";
		}
	else{
			$previous_id="";
			$previous_id_place_holder="";
		}
	$balace=$row_get_last_record_per_item["balance"] + $_REQUEST['qty_recieved'];
	$query_insert_to_site_store="INSERT INTO birus.site_store(site_id, $previous_id_place_holder item_id , site_to_site_req_item_in_id, balance, created_by, created_date, record_status)
VALUES ('".$_SESSION["site_id"]."',$previous_id'".$_REQUEST["item_id"]."','".$_REQUEST['site_to_site_req_item_id']."','$balace','$loggedin_id','".date("y-m-d")."','".$_REQUEST["record_status"]."');";

		$insert_record=mysql_query($query_insert_to_site_store, $birus_conn)  or die(mysql_error());
		if(mysql_affected_rows($birus_conn)>0 && count($row_get_last_record_per_item)>1){
			//Update The previous  record with same Item.
			
			$query_update_next_id="UPDATE birus.site_store SET next_id = '' WHERE site_store.id ='".$row_get_last_record_per_item['id']."'";
			mysql_query($query_update_next_id, $birus_conn);
			if(mysql_affected_rows($birus_conn)>0){
				redirect_birus("","");
				}
			}	
	}
  }
else{
		$message="Already marked Received";
		echo $message;
		}
  }
?>
<form action="<?php echo $editFormAction; ?>" method="post" name="site_to_site_req_item_form" id="site_to_site_req_item_form">
  <table align="left">
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Item:</td>
      <td><input type="hidden" name="item_id" value="<?php echo $row_site_to_site_req_item_by_id['item_id'] ?>" /><?php echo $row_site_to_site_req_item_by_id['item_name'] ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Unit Of Measure:</td>
      <td><?php echo $row_site_to_site_req_item_by_id['unit_name'] ?></td>
    </tr>
	<tr valign="baseline">
      <td nowrap="nowrap" align="left">Qty Issued:</td>
      <td><?php echo $row_site_to_site_req_item_by_id['qty_issued'] ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Qty Received:</td>
      <td><input type="text" name="qty_recieved" value="" size="32" /></td>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">&nbsp;</td>
      <td><?php if(isset($_REQUEST['site_to_site_req_item_edit'])){	
		echo"<input name='update' type='submit' value='UPDATE' id='submit'/>";
		echo"<input type='hidden' name='MM_update' value='site_to_site_req_item_form' />";	
		}
		else{
			echo"<input name='site_to_site_req_item_recieve_form' type='submit' value='SAVE' id='submit'/>";
			echo"<input type='hidden' name='MM_insert' value='site_to_site_req_item_form' />";	
			}?>
      </td>
    </tr>
  </table>
  <input type="hidden" name="site_to_site_req_item_id" value="<?php echo $row_site_to_site_req_item_by_id['id'] ?>" />
  <input type="hidden" name="site_to_site_req_id" value="<?php echo $_REQUEST["site_to_site_req_id"] ?>" />
  <input type="hidden" name="record_status" value="active" />
</form>
</body>
</html>
<?php
mysql_free_result($get_site_store_by_site_to_site_req_id);

mysql_free_result($get_last_record_per_item);

mysql_free_result($site_to_site_req_item_by_id);
?>