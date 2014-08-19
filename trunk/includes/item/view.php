<?php get_main_menu("admin")?>
<?php
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_item = "SELECT * FROM item";
$get_item = mysql_query($query_get_item, $birus_conn) or die(mysql_error());
$row_get_item = mysql_fetch_assoc($get_item);
$totalRows_get_item = mysql_num_rows($get_item);

$colname_get_item_by_id = "-1";
if (isset($_GET['item_id'])) {
  $colname_get_item_by_id = $_GET['item_id'];
}
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_item_by_id = sprintf("SELECT * FROM item WHERE id = %s", GetSQLValueString($colname_get_item_by_id, "int"));
$get_item_by_id = mysql_query($query_get_item_by_id, $birus_conn) or die(mysql_error());
$row_get_item_by_id = mysql_fetch_assoc($get_item_by_id);
$totalRows_get_item_by_id = mysql_num_rows($get_item_by_id);
?>
<?php include"includes/table_settings.php"?>
              
   <div>
  <a href="."><img src="images/back-button.png" width="30" height="30" title="Back" /></a><a href=".?item_add&action=Add">
  <img src="images/add-button.jpg" width="30" height="30" title="Add <?php echo $object_name ?>" /></a></div> 
<?php
 if($_REQUEST['item_delete']==true && $_REQUEST['id']!=""){
 
 $query_remove_record="update item set record_status='deactivated', deleted_by='".$loggedin_id."',  deleted_date='".date("y-m-d")."' where item.id='".$_REQUEST["id"]."'";
 mysql_query($query_remove_record,$birus_conn) or die(mysql_error());
 if(mysql_affected_rows($birus_conn)>0){
	 redirect_delete("user_view","2",$_REQUEST["id"]);
	 }
 }
?>     
              <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Item Name</th>
                    <th>Restock Level</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <!--Loop start, you could use a repeat region here-->
  <?php do{?>
    <!--Loop start, you could use a repeat region here-->
    <tr>
      <td><?php echo $row_get_item['id']?></td>
      <td><?php echo $row_get_item['name']?></td>
      <td><?php echo $row_get_item['restock_level']?></td>
      <td><a href="?item= &amp;item_edit= true&amp;id=<?php echo $row_get_item['id']; ?>"><input name="" value="Edit" type="submit" id="edit_forms"/></a></td>
      <td><a href="?item_view= &amp;item_delete=true&amp;id=<?php echo $row_get_item['id']; ?>"><input name="" value="Delete" type="submit" id="delete_forms"/></a></td>
    </tr>
    <?php }while($row_get_item=mysql_fetch_assoc($get_item));?>
                  <!--Loop end-->
                </tbody>
              </table>
        	</div>
<div class="tab_column" id="form_area">
          </div>         
     	</div>     
</div>
</html><?php
mysql_free_result($get_item);

mysql_free_result($get_item_by_id);
?>