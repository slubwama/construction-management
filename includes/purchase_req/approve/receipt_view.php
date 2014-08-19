<?php include "includes/notifications/headofconstruction.php"?>
<?php get_main_menu("headofconstruction", $notification)?>
<?php 
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_purchase_req = "SELECT person.first_name,  person.last_name,        person.id,   purchase_req.id  ,   purchase_req.req_no,        purchase_req.created_date   FROM    (   birus.user user            INNER JOIN               birus.person person            ON (user.person_id = person.id))        INNER JOIN           birus.purchase_req purchase_req        ON (purchase_req.created_by = user.id)
where purchase_req.recieve_date!='0000-00-00 00:00:00'
AND
purchase_req.approved_receipt_date='0000-00-00 00:00:00'
";
$get_purchase_req = mysql_query($query_get_purchase_req, $birus_conn) or die(mysql_error());
$row_get_purchase_req = mysql_fetch_assoc($get_purchase_req);
$totalRows_get_purchase_req = mysql_num_rows($get_purchase_req);
?>

<?php
if(isset($_REQUEST['purchase_receipt_approve'])){
	$approve_update="UPDATE birus.purchase_req SET approved_receipt_date = '".date("y-m-d")."',approved_receipt_by = '".$loggedin_id."',approved_receipt='true'='".$_REQUEST['approve_acttion']."' WHERE purchase_req.id ='".$_REQUEST['id']."';";
	mysql_query($approve_update, $birus_conn) or die(mysql_error());
	
	if(mysql_affected_rows($birus_conn)>0){
			redirect_birus("purchase_receipt_approve_view","2");
		}
	}
 ?>
<?php include"includes/table_settings.php"?>
<div><a href="."><img src="images/back-button.png" width="30" height="30" title="Back" /></a></div> 
              <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Req No</th>
                    <th>Created By</th>
                    <th>Created Date</th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <!--Loop start, you could use a repeat region here-->
  <?php 
  do{?>
    <!--Loop start, you could use a repeat region here-->
    <tr>
      <td><?php echo $row_get_purchase_req['id']?></td>
      <td><?php echo $row_get_purchase_req['req_no']?></td>
      <td><?php echo $row_get_purchase_req['first_name']." ".$row_get_purchase_req['last_name']?></td>
      <td><?php echo date("d-M-Y",strtotime($row_get_purchase_req['created_date']))?></td>
      <td><a href=".?pr_item_approve_view= true&amp;purchase_req_id=<?php echo $row_get_purchase_req['id']; ?>&back_page=purchase_receipt_approve_view"><input name="" value="Items" type="submit" id="edit_forms"/></a></td>    
      <td><a href=".?purchase_receipt_approve_view&purchase_receipt_approve&id=<?php echo $row_get_purchase_req['id']; ?>&amp;approve_acttion=approved"><input name="" value="Approve" type="submit" id="edit_forms"/></a></td>
      <td><a href=".?purchase_req_approve_view&purchase_receipt_approve&id=<?php echo $row_get_purchase_req['id']; ?>&amp;approve_acttion=declined"><input name="" value="Decline" type="submit" id="edit_forms"/></a></td>
    </tr>
    <?php }while($row_get_purchase_req=mysql_fetch_assoc($get_purchase_req));?>
                  <!--Loop end-->
                </tbody>
              </table>
<?php
mysql_free_result($get_purchase_req);
?>