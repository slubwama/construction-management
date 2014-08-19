<?php get_main_menu("sitesupervisor")?>
<?php
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_site_item_issue = "
	SELECT site_item_issue.qty_issued,
       site_item_issue.created_date,
	   site_item_issue.id,
       item.name item_name,
	   item.id as item_id,
       person.first_name,
       person.last_name
  	FROM    (   (   (   birus.site_item_issue site_item_issue
                   INNER JOIN
                      birus.user user
                   ON (site_item_issue.created_by = user.id))
               INNER JOIN
                  birus.item item
               ON (site_item_issue.item_id = item.id))
           INNER JOIN
              birus.site site
           ON (site_item_issue.site_id = site.id))
       INNER JOIN
          birus.person person
       ON (user.person_id = person.id)
	   where site_item_issue.site_id='".$_SESSION["site_id"]."'
	   AND site_item_issue.approve_date='0000-00-00 00:00:00'
	   AND site_item_issue.record_status='active'
	   ";
$get_site_item_issue = mysql_query($query_get_site_item_issue, $birus_conn) or die(mysql_error());
$row_get_site_item_issue = mysql_fetch_assoc($get_site_item_issue);
$totalRows_get_site_item_issue = mysql_num_rows($get_site_item_issue);


mysql_select_db($database_birus_conn, $birus_conn);
$query_get_last_record_per_item = "SELECT * FROM site_store where item_id='".$_REQUEST["item_id"]."'  ORDER BY id DESC
LIMIT 0 , 1";
$get_last_record_per_item = mysql_query($query_get_last_record_per_item, $birus_conn) or die(mysql_error());
$row_get_last_record_per_item = mysql_fetch_assoc($get_last_record_per_item);
$totalRows_get_last_record_per_item = mysql_num_rows($get_last_record_per_item);

$colname_get_issued_by_id = "-1";
		if (isset($_GET['id'])) {
 		 $colname_get_issued_by_id = $_GET['id'];
		}
$query_get_issued_by_id = sprintf("SELECT * FROM site_item_issue WHERE id = %s", GetSQLValueString($colname_get_issued_by_id, "int"));
$get_issued_by_id = mysql_query($query_get_issued_by_id, $birus_conn) or die(mysql_error());
$row_get_issued_by_id = mysql_fetch_assoc($get_issued_by_id);
$totalRows_get_issued_by_id = mysql_num_rows($get_issued_by_id);


$colname_get_site_store_by_site_req_id = "-1";
if (isset($_GET['id'])) {
  $colname_get_site_store_by_site_req_id = $_GET['id'];
}

mysql_select_db($database_birus_conn, $birus_conn);
$query_get_site_store_by_site_req_id = sprintf("SELECT * FROM site_store WHERE site_item_issue_id = %s", GetSQLValueString($colname_get_site_store_by_site_req_id, "int"));
$get_site_store_by_site_req_id = mysql_query($query_get_site_store_by_site_req_id, $birus_conn) or die(mysql_error());
$row_get_site_store_by_site_req_id = mysql_fetch_assoc($get_site_store_by_site_req_id);
$totalRows_get_site_store_by_site_req_id = mysql_num_rows($get_site_store_by_site_req_id);

?>
<?php
 if($_REQUEST['site_item_issue_approve']==true && $_REQUEST['id']!=""){
 
 if(count($row_get_site_store_by_site_req_id)<=1){
	 
	 if(($balace=$row_get_last_record_per_item["balance"] - $row_get_issued_by_id['qty_issued'])>=0){
	 
	 
 $query_remove_record="update site_item_issue set  approved_by='".$loggedin_id."',  approve_date='".date("y-m-d")."' where site_item_issue.id='".$_REQUEST["id"]."'";
 
 mysql_query($query_remove_record,$birus_conn) or die(mysql_error());
 if(mysql_affected_rows($birus_conn)>0){
	 
	 	if(count($row_get_last_record_per_item)>1){
			$previous_id="'".$row_get_last_record_per_item["id"]."',";
			$previous_id_place_holder="previous_id,";
		}
	else{
			$previous_id="";
			$previous_id_place_holder="";
		}
		
	$balace=$row_get_last_record_per_item["balance"] - $row_get_issued_by_id['qty_issued'];
	$query_insert_to_site_store="INSERT INTO birus.site_store(site_id,$previous_id_place_holder item_id , site_item_issue_id, balance, created_by, created_date, record_status)
VALUES ('".$row_get_issued_by_id["site_id"]."',  $previous_id'".$row_get_issued_by_id["item_id"]."','".$row_get_issued_by_id['id']."','$balace','$loggedin_id','".date("y-m-d")."','".$_REQUEST["record_status"]."');";
	$insert_record=mysql_query($query_insert_to_site_store, $birus_conn)  or die(mysql_error());
	
	if(mysql_affected_rows($birus_conn)>0 && count($row_get_last_record_per_item)>1){
			//Update The previous  record with same Item.
	$query_update_next_id="UPDATE birus.site_store SET next_id = '3' WHERE site_store.id ='".$row_get_last_record_per_item['id']."'";
	mysql_query($query_update_next_id, $birus_conn);
		if(mysql_affected_rows($birus_conn)>0){
				redirect_birus("site_item_issue_view","2");
				}
		}
		
		else{
				redirect_birus("site_item_issue_approve_view","2");
			}	
	 }
	 
	 }
	else{
		alert_redirect_birus("site_item_issue_approve_view","6","Your Issue out Qty is greater than Qty in Store.");
		} 

	 }
 else{
	 alert_redirect_birus("site_item_issue_approve_view","2","Already marked Received");
	 }
 }
?>
<?php include"includes/table_settings.php"?>
<div><a href="."><img src="images/back-button.png" width="30" height="30" title="Back" /></a></div> 
   <div class="module_title">Site Item Issue</div> 
              <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Item</th>
                    <th>Qty Issued</th>
                    <th>Issued By</th>
                    <th>Date Issued</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <!--Loop start, you could use a repeat region here-->
  <?php 
  $i=1;
  do{
	  
	  ?>
    <!--Loop start, you could use a repeat region here-->
    <tr>
      <td><?php echo $row_get_site_item_issue['id']?></td>
      <td><?php echo $row_get_site_item_issue['item_name']?></td>
      <td><?php echo $row_get_site_item_issue['qty_issued']?></td>
      <td><?php echo $row_get_site_item_issue['first_name']." ".$row_get_site_item_issue['last_name']?></td>
      <td><?php echo date("d-M-Y",strtotime($row_get_site_item_issue['created_date']))?></td>
	  <td><a href=".?item_id=<?php echo $row_get_site_item_issue['item_id']; ?>&site_item_issue_approve_view= &amp;site_item_issue_approve= true&amp;id=<?php echo $row_get_site_item_issue['id']; ?>&action=Edit">Approve</a></td>
    </tr>
    <?php 
	$i++;
	}while($row_get_site_item_issue=mysql_fetch_assoc($get_site_item_issue));?>
                  <!--Loop end-->
                </tbody>
              </table>
<?php
mysql_free_result($get_site_item_issue);
?>