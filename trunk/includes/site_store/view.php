<?php get_main_menu($_REQUEST["menu_type"])?>
<?php
mysql_select_db($database_birus_conn, $birus_conn);
$query_site_store = "SELECT sum(site_item_issue.qty_issued) as qty_issued,
       sum(site_req_item.qty_recieved) as qty_recieved,
       site_store.created_by,
       site_store.balance,
       site_store.id,
	   site_store.item_id,
	   sum(site_item_returns.qty_returned) as qty_returned,
       site_store.created_date,
       item.name as item_name,
       site.name as site_name
  FROM    (   (   (   (   birus.site_store site_store
                       INNER JOIN
                          birus.item item
                       ON (site_store.item_id = item.id))
                   LEFT OUTER JOIN
                      birus.site_item_issue site_item_issue
                   ON (site_store.site_item_issue_id = site_item_issue.id))
               LEFT OUTER JOIN
                  birus.site_req_item site_req_item
               ON (site_store.site_req_item_id = site_req_item.id))
           LEFT OUTER JOIN
              birus.site_item_returns site_item_returns
           ON (site_store.site_item_return_id = site_item_returns.id))
       INNER JOIN
          birus.site site
       ON (site_store.site_id = site.id)
	   where site_store.site_id='".$_SESSION["site_id"]."' AND site_store.record_status='active'
	   Group by  site_store.item_id
	   ";
$site_store = mysql_query($query_site_store, $birus_conn) or die(mysql_error());
$row_site_store = mysql_fetch_assoc($site_store);
$totalRows_site_store = mysql_num_rows($site_store);
?>
<?php include"includes/table_settings.php"?>
<div><a href="."><img src="images/back-button.png" width="30" height="30" title="Back" /></a></div> 
   <div class="module_title">Site Store</div><table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Item</th>
                    <th>Construction Site</th>
                    <th>Date</th>
                    <th>In</th>
                    <th>Out</th>
                    <th>Balance</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <!--Loop start, you could use a repeat region here-->
  <?php do{ 
  $in=$row_site_store['qty_recieved']+$row_site_store['qty_returned']+$row_site_store['site_to_site_qty_recieved'];
  $out=$row_site_store['qty_issued']+$row_site_store['site_to_site_qty_issued'];
  ?>
    <!--Loop start, you could use a repeat region here-->
    <tr>
      <td><?php echo $row_site_store['id']?></td>
      <td><?php echo $row_site_store['item_name']?></td>
      <td><?php echo $row_site_store['site_name']?></td>
      <td><?php echo $row_site_store['created_date']?></td>
      <td><?php echo $in?></td>
      <td><?php echo $out?></td>
      <td><?php echo $in-$out;?></td>
      <td><a href="?menu_type=<?php echo $_REQUEST['menu_type']?>&site_store_item_view&item_id=<?php echo $row_site_store['item_id']?>&amp;item_name=<?php echo $row_site_store['item_name']?>&back_page "><input name="" value="Details" type="submit" id="edit_forms"/></a></td>
    </tr>
    <?php }while($row_site_store=mysql_fetch_assoc($site_store));?>
                  <!--Loop end-->
                </tbody>
              </table>
<?php
mysql_free_result($site_store);
?>