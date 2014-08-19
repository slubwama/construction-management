<?php include "includes/notifications/headofconstruction.php"?>
<?php get_main_menu("sitestorekeeper")?>
<?php
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_site_req_item = "
	   SELECT unit_of_measure.name as unit_name,
       site_req_item.qty_required,
       site_req_item.qty_recieved,
       site_req_item.id,
       site_req_item.item_id,
       site_req_item.site_req_id,
       site_req_item.unit_of_measure_id,
       site_req_item.deleted_by,
       site_req_item.delete_date,
       site_req_item.created_by,
       site_req_item.created_date,
       site_req_item.record_status,
       item.name as item_name
  FROM    (   birus.site_req_item site_req_item
           INNER JOIN
              birus.item item
           ON (site_req_item.item_id = item.id))
       INNER JOIN
          birus.unit_of_measure unit_of_measure
       ON (site_req_item.unit_of_measure_id = unit_of_measure.id)
Where site_req_item.site_req_id='".$_REQUEST['site_req_id']."'
";
$get_site_req_item = mysql_query($query_get_site_req_item, $birus_conn) or die(mysql_error());
$row_get_site_req_item = mysql_fetch_assoc($get_site_req_item);
$totalRows_get_site_req_item = mysql_num_rows($get_site_req_item);
?>
<?php include"includes/table_settings.php"?>
<div><a href=".?site_req_view"><img src="images/back-button.png" width="30" height="30" title="Back" /></a>&nbsp; &nbsp; <a href=".?site_req_item_add&action=Add&site_req_id=<?php echo $_REQUEST["site_req_id"]?>"><img src="images/add-button.png" width="30" height="30" title="Back" /></a></div> 
<div class="module_title">Site Requstion Items</div> 
              <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Item</th>
                    <th>Unit</th>
                    <th>Qty</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <!--Loop start, you could use a repeat region here-->
  <?php do{?>
    <!--Loop start, you could use a repeat region here-->
    <tr>
      <td><?php echo $row_get_site_req_item['id']?></td>
      <td><?php echo $row_get_site_req_item['item_name']?></td>
      <td><?php echo $row_get_site_req_item['unit_name']?></td>
      <td><?php echo $row_get_site_req_item['qty_required']?></td>
      <td><a href=".?site_req_item= &amp;site_req_item_edit= true&amp;&site_req_id=<?php echo $_REQUEST['site_req_id']?>&amp;id=<?php echo $row_get_site_req_item['id']; ?>&action=Edit"><input name="" value="Edit" type="submit" id="edit_forms"/></a></td>
      <td><a href=".?site_req_item_delete&id=<?php echo $row_get_site_req_item['id']; ?>"><input name="" value="Delete" type="submit" id="delete_forms"/></a></td>
    </tr>
    <?php }while($row_get_site_req_item=mysql_fetch_assoc($get_site_req_item));?>
                  <!--Loop end-->
                </tbody>
              </table>
<?php
mysql_free_result($get_site_req_item);
?>