<?php include "includes/notifications/headofconstruction.php"?>
<?php get_main_menu($_REQUEST['menu_type'], $notification)?>
<?php
mysql_select_db($database_birus_conn, $birus_conn);
$query_main_store = "SELECT item.name,        site_req_item.qty_issued,        main_store.created_date,        pr_item.qty_recieved,        main_store.balance,        main_store.id   FROM    (   (   birus.main_store main_store                LEFT OUTER JOIN                   birus.site_req_item site_req_item                ON (main_store.site_req_item_id = site_req_item.id))            LEFT OUTER JOIN               birus.pr_item pr_item            ON (main_store.pr_item_id = pr_item.id))        INNER JOIN           birus.item item        ON (main_store.item_id = item.id)
Where main_store.item_id='".$_REQUEST['item_id']."'	
ORDER BY main_store.id DESC
";
$main_store = mysql_query($query_main_store, $birus_conn) or die(mysql_error());
$row_main_store = mysql_fetch_assoc($main_store);
$totalRows_main_store = mysql_num_rows($main_store);
?>
<?php include"includes/table_settings.php"?>
<div><a href="?menu_type=<?php echo $_REQUEST['menu_type']?>&main_store_view"><img src="images/back-button.png" width="30" height="30" title="Back" /></a></div> 
<div class="module_title"><?php echo ucfirst($row_main_store['name'])?> Store Detail</div>
              <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Date</th>
                    <th>In</th>
                    <th>Out</th>
                    <th>Balance</th>
                  </tr>
                </thead>
                <tbody>
                  <!--Loop start, you could use a repeat region here-->
  <?php do{?>
    <!--Loop start, you could use a repeat region here-->
    <tr>
      <td><?php echo $row_main_store['id']?></td>
      <td><?php echo date("d-M-Y",strtotime($row_main_store['created_date']))?></td>
      <td><?php echo $row_main_store['qty_recieved']?></td>
      <td><?php echo $row_main_store['qty_issued']?></td>
      <td><?php echo $row_main_store['balance']?></td>
    </tr>
    <?php }while($row_main_store=mysql_fetch_assoc($main_store));?>
                  <!--Loop end-->
                </tbody>
              </table>
<?php
mysql_free_result($main_store);
?>
