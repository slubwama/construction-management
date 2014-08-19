<?php get_main_menu("headofconstruction")?>

   <br/>
   <div style="width:90%; margin-left:auto; margin-right:auto;">
    <div class="form_title">

            <?php echo $_REQUEST["action"];?> Purchase Request Item<?php echo $row_get_branch_by_id['name']?>
    </div>
    <div class="box"> 
<?php
$colname_get_main_store_by_pr_id = "-1";
if (isset($_GET['pr_item_id'])) {
  $colname_get_main_store_by_pr_id = $_GET['pr_item_id'];
}
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_main_store_by_pr_id = sprintf("SELECT * FROM main_store WHERE pr_item_id = %s", GetSQLValueString($colname_get_main_store_by_pr_id, "int"));
$get_main_store_by_pr_id = mysql_query($query_get_main_store_by_pr_id, $birus_conn) or die(mysql_error());
$row_get_main_store_by_pr_id = mysql_fetch_assoc($get_main_store_by_pr_id);
$totalRows_get_main_store_by_pr_id = mysql_num_rows($get_main_store_by_pr_id);

mysql_select_db($database_birus_conn, $birus_conn);
$query_get_last_record_per_item = "SELECT * FROM main_store where item_id='".$_REQUEST["item_id"]."'  ORDER BY id DESC
LIMIT 0 , 1";
$get_last_record_per_item = mysql_query($query_get_last_record_per_item, $birus_conn) or die(mysql_error());
$row_get_last_record_per_item = mysql_fetch_assoc($get_last_record_per_item);
$totalRows_get_last_record_per_item = mysql_num_rows($get_last_record_per_item);

$colname_pr_item_by_id = "-1";
if (isset($_GET['pr_item_id'])) {
  $colname_pr_item_by_id = $_GET['pr_item_id'];
}
mysql_select_db($database_birus_conn, $birus_conn);
$query_pr_item_by_id = sprintf("SELECT item.name as item_name,
       unit_of_measure.name as unit_name,
       pr_item.id,
       pr_item.item_id,
       pr_item.qty_required,
       pr_item.qty_recieved,
       pr_item.amount,
       pr_item.pr_id,
       pr_item.unit_of_measure_id,
       pr_item.deleted_by,
       pr_item.delete_date,
       pr_item.created_by,
       pr_item.created_date,
       pr_item.record_status
  FROM    (   birus.pr_item pr_item
           INNER JOIN
              birus.unit_of_measure unit_of_measure
           ON (pr_item.unit_of_measure_id = unit_of_measure.id))
       INNER JOIN
          birus.item item
       ON (pr_item.item_id = item.id) WHERE pr_item.id = %s", GetSQLValueString($colname_pr_item_by_id, "int"));
$pr_item_by_id = mysql_query($query_pr_item_by_id, $birus_conn) or die(mysql_error());
$row_pr_item_by_id = mysql_fetch_assoc($pr_item_by_id);
$totalRows_pr_item_by_id = mysql_num_rows($pr_item_by_id);
?>

<?php
if(isset($_REQUEST['pr_item_recieve_form'])){

	if(count($row_get_main_store_by_pr_id)<=1){
	
	$approve_update="UPDATE birus.pr_item SET qty_recieved='".$_REQUEST["qty_recieved"]."',amount='".$_REQUEST["amount"]."' WHERE pr_item.id ='".$_REQUEST['pr_item_id']."';";
	mysql_query($approve_update, $birus_conn) or die(mysql_error());
	if(mysql_affected_rows($birus_conn)>0){
		echo count($row_get_last_record_per_item);
	if(count($row_get_last_record_per_item)>1){
			$previous_id="'".$row_get_last_record_per_item["id"]."',";
			$previous_id_place_holder="previous_id,";
		}
	else{
			$previous_id="";
			$previous_id_place_holder="";
		}
	$balace=$row_get_last_record_per_item["balance"] + $_REQUEST['qty_recieved'];
	$query_insert_to_main_store="INSERT INTO birus.main_store($previous_id_place_holder item_id , pr_item_id, balance, created_by, created_date, record_status)
VALUES ($previous_id'".$_REQUEST["item_id"]."','".$_REQUEST['pr_item_id']."','$balace','$loggedin_id','".date("y-m-d")."','".$_REQUEST["record_status"]."');";

		$insert_record=mysql_query($query_insert_to_main_store, $birus_conn)  or die(mysql_error());
		
		if(mysql_affected_rows($birus_conn)>0 && count($row_get_last_record_per_item)>1){
			//Update The previous  record with same Item.
			
			$query_update_next_id="UPDATE birus.main_store SET next_id = '' WHERE main_store.id ='".$row_get_last_record_per_item['id']."'";
			mysql_query($query_update_next_id, $birus_conn);
			if(mysql_affected_rows($birus_conn)>0){
				redirect_birus("pr_item_recieve_view= true&purchase_req_id=".$_REQUEST['pr_id']."","2");
				}
			}	
	}
  }
else{

		alert_redirect_birus("pr_item_recieve_view= true&purchase_req_id=".$_REQUEST['pr_id']."","2","Already marked Received");
		}
  }
?>
<form action="<?php echo $editFormAction; ?>" method="post" name="pr_item_form" id="pr_item_form">
  <table align="left">
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Item:</td>
      <td><input type="hidden" name="item_id" value="<?php echo $row_pr_item_by_id['item_id'] ?>" /><?php echo $row_pr_item_by_id['item_name'] ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Unit Of Measure:</td>
      <td><?php echo $row_pr_item_by_id['unit_name'] ?></td>
    </tr>
	<tr valign="baseline">
      <td nowrap="nowrap" align="left">Qty Required:</td>
      <td><?php echo $row_pr_item_by_id['qty_required'] ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Qty Received</td>
      <td><input type="text" name="qty_recieved" value="" size="32" /></td>
    </tr>
          <td nowrap="nowrap" align="left">Amount Per each</td>
      <td><input type="text" name="amount" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">&nbsp;</td>
      <td><?php if(isset($_REQUEST['pr_item_edit'])){	
		echo"<input name='update' type='submit' value='UPDATE' id='submit'/>";
		echo"<input type='hidden' name='MM_update' value='pr_item_form' />";	
					echo"&nbsp;&nbsp;<a href='.?pr_item_recieve_view= true&purchase_req_id=".$_REQUEST['purchase_req_id']."'><input name='add' type='button' value='Cancel' id='submit'/></a>";
		}
		else{
			echo"<input name='pr_item_recieve_form' type='submit' value='SAVE' id='submit'/>";
			echo"<input type='hidden' name='MM_insert' value='pr_item_form' />";	
			echo"&nbsp;&nbsp;<a href='.?pr_item_recieve_view= true&purchase_req_id=".$_REQUEST['purchase_req_id']."'><input name='add' type='button' value='Cancel' id='submit'/></a>";	
			}?>
      </td>
    </tr>
  </table>
  <input type="hidden" name="pr_item_id" value="<?php echo $row_pr_item_by_id['id'] ?>" />
  <input type="hidden" name="pr_id" value="<?php echo $_REQUEST["purchase_req_id"] ?>" />
  <input type="hidden" name="record_status" value="active" />
</form>
</body>
</html>
<?php
mysql_free_result($get_main_store_by_pr_id);

mysql_free_result($get_last_record_per_item);

mysql_free_result($pr_item_by_id);
?>