<?php
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_site_to_site_req_item = "
	   SELECT unit_of_measure.name as unit_name,
       site_to_site_req_item.qty_required,
       site_to_site_req_item.qty_recieved,
	   site_to_site_req_item.qty_issued,
       site_to_site_req_item.id,
       site_to_site_req_item.item_id,
       site_to_site_req_item.site_to_site_req_id,
       site_to_site_req_item.unit_of_measure_id,
       site_to_site_req_item.deleted_by,
       site_to_site_req_item.delete_date,
       site_to_site_req_item.created_by,
       site_to_site_req_item.created_date,
       site_to_site_req_item.record_status,
       item.name as item_name
  FROM    (   birus.site_to_site_req_item site_to_site_req_item
           INNER JOIN
              birus.item item
           ON (site_to_site_req_item.item_id = item.id))
       INNER JOIN
          birus.unit_of_measure unit_of_measure
       ON (site_to_site_req_item.unit_of_measure_id = unit_of_measure.id)
	  Where site_to_site_req_item.site_to_site_req_id='".$_REQUEST['site_to_site_req_id']."'";
$get_site_to_site_req_item = mysql_query($query_get_site_to_site_req_item, $birus_conn) or die(mysql_error());
$row_get_site_to_site_req_item = mysql_fetch_assoc($get_site_to_site_req_item);
$totalRows_get_site_to_site_req_item = mysql_num_rows($get_site_to_site_req_item);
?>
<div class="page_title_bar">
<div class="page_title">Site To Site Issue Items</div>
</div>
<?php include"includes/table_settings.php"?>
<div><a href=".?site_to_site_issue_view"><input name="add" type="submit" value="Back" id="add_forms"/></a>
</div> 
              <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Item</th>
                    <th>Unit</th>
                    <th>Qty Required</th>
                    <th>Qty Issued</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <!--Loop start, you could use a repeat region here-->
  <?php  do{

	  ?>
    <!--Loop start, you could use a repeat region here-->
    <tr>
      <td><?php echo $row_get_site_to_site_req_item['id']?></td>
      <td><?php echo $row_get_site_to_site_req_item['item_name']?></td>
      <td><?php echo $row_get_site_to_site_req_item['unit_name']?></td>
      <td><?php echo $row_get_site_to_site_req_item['qty_required']?></td>
      <td><?php echo $row_get_site_to_site_req_item['qty_issued']?></td>
      <td><a href=".?site_to_site_req_item_id=<?php echo $row_get_site_to_site_req_item['id']; ?>&amp;site_to_site_req_item_issue= true&amp;site_to_site_req_id=<?php echo $_REQUEST['site_to_site_req_id']; ?>&action=Issue">Issue</a></td>
    </tr>
    <?php }while($row_get_site_to_site_req_item=mysql_fetch_assoc($get_site_to_site_req_item));?>
                  <!--Loop end-->
                </tbody>
              </table>
        	</div>
<div class="tab_column" id="form_area">
          </div>         
     	</div>     
</div>
<?php
mysql_free_result($get_site_to_site_req_item);
?>