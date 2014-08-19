<?php include "includes/notifications/headofconstruction.php"?>
<?php
					
 if(isset($_SESSION["head_of_construction"])){
	 
include "includes/notifications/headofconstruction.php";
$notification1=$notification;
}

else if(isset($_SESSION["main_store_keeper"])){
	include "includes/notifications/storekeeper.php";
	$notification1=$notification_store_keeper;
	

}
?>
<?php get_main_menu($_REQUEST['menu_type'], $notification1)?>
<?php
mysql_select_db($database_birus_conn, $birus_conn);
$query_main_store = "SELECT item.name,        sum(site_req_item.qty_issued) as qty_issued,        main_store.created_date,  main_store.item_id,        sum(pr_item.qty_recieved) as qty_recieved,        sum(main_store.balance) as balance,        main_store.id   FROM    (   (   birus.main_store main_store                LEFT OUTER JOIN                   birus.site_req_item site_req_item                ON (main_store.site_req_item_id = site_req_item.id))            LEFT OUTER JOIN               birus.pr_item pr_item            ON (main_store.pr_item_id = pr_item.id))        INNER JOIN           birus.item item        ON (main_store.item_id = item.id)

group by main_store.item_id
";
$main_store = mysql_query($query_main_store, $birus_conn) or die(mysql_error());
$row_main_store = mysql_fetch_assoc($main_store);
$totalRows_main_store = mysql_num_rows($main_store);
?>
<?php include"includes/table_settings.php"?>
<div><a href="."><img src="images/back-button.png" width="30" height="30" title="Back" /></a></div> 
<div class="module_title">Main Store</div>
              <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Item</th>
                    <th>Total In</th>
                    <th>Total Out</th>
                    <th>Total Balance</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <!--Loop start, you could use a repeat region here-->
  <?php do{?>
    <!--Loop start, you could use a repeat region here-->
    <tr>
      <td><?php echo $row_main_store['id']?></td>
      <td><?php echo $row_main_store['name']?></td>
      <td><?php echo $row_main_store['qty_recieved']?></td>
      <td><?php echo $row_main_store['qty_issued']?></td>
      <td><?php echo ($row_main_store['qty_recieved']-$row_main_store['qty_issued']) ?></td>
      <td><a href="?menu_type=<?php echo $_REQUEST['menu_type']?>&main_store_item_view&item_id=<?php echo $row_main_store['item_id']?>&amp;item_name=<?php echo $row_main_store['item_name']?>"><input name="" value="Details" type="submit" id="edit_forms"/></a></td>
    </tr>
    <?php }while($row_main_store=mysql_fetch_assoc($main_store));?>
                  <!--Loop end-->
                </tbody>
              </table>
<?php
mysql_free_result($main_store);
?>
