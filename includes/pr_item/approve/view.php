<?php include "includes/notifications/headofconstruction.php"?>
<?php get_main_menu($_REQUEST['menu_type'], $notification)?>
<?php
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_pr_item = "
SELECT unit_of_measure.name as unit_name,pr_item.id as pr_id,
       item.name as item_name,
       pr_item.qty_required,
	   pr_item.qty_recieved,
       pr_item.amount
  FROM    (   birus.pr_item pr_item
           INNER JOIN
              birus.item item
           ON (pr_item.item_id = item.id))
       INNER JOIN
          birus.unit_of_measure unit_of_measure
       ON (pr_item.unit_of_measure_id = unit_of_measure.id)
Where pr_item.pr_id='".$_REQUEST['purchase_req_id']."'
";
$get_pr_item = mysql_query($query_get_pr_item, $birus_conn) or die(mysql_error());
$row_get_pr_item = mysql_fetch_assoc($get_pr_item);
$totalRows_get_pr_item = mysql_num_rows($get_pr_item);
?>
<?php include"includes/table_settings.php"?>
  <div><a href=".?<?php echo $_REQUEST['back_page']?>"><img src="images/back-button.png" width="30" height="30" title="Back" /></a></div> 
              <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Item</th>
                    <th>Suppler</th>
                    <th>Unit</th>
                    <th>Qty Required</th>
                    <th>Qty Received</th>
                    <th>Amount On Receive</th>
                  </tr>
                </thead>
                <tbody>
                  <!--Loop start, you could use a repeat region here-->
  <?php do{?>
    <!--Loop start, you could use a repeat region here-->
    <tr>
      <td><?php echo $row_get_pr_item['id']?></td>
      <td><?php echo $row_get_pr_item['item_name']?></td>
      <td><?php echo $row_get_pr_item['supplier_name']." ".$row_get_pr_item['last_name']?></td>
      <td><?php echo $row_get_pr_item['unit_name']?></td>
      <td><?php echo $row_get_pr_item['qty_required']?></td>
      <td><?php echo $row_get_pr_item['qty_recieved']?></td>
      <td><?php echo $row_get_pr_item['amount']?></td>
    </tr>
    <?php }while($row_get_pr_item=mysql_fetch_assoc($get_pr_item));?>
                  <!--Loop end-->
                </tbody>
              </table>
<?php
mysql_free_result($get_pr_item);
?>