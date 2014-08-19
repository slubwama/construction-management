<?php get_main_menu("admin");?>
<?php
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_unit_of_measure = "SELECT * FROM unit_of_measure where unit_of_measure.record_status='active'";
$get_unit_of_measure = mysql_query($query_get_unit_of_measure, $birus_conn) or die(mysql_error());
$row_get_unit_of_measure = mysql_fetch_assoc($get_unit_of_measure);
$totalRows_get_unit_of_measure = mysql_num_rows($get_unit_of_measure);

$colname_get_unit_of_measure_by_id = "-1";
if (isset($_GET['unit_of_measure_id'])) {
  $colname_get_unit_of_measure_by_id = $_GET['unit_of_measure_id'];
}
?>
<?php include"includes/table_settings.php"?> 
  <?php
 if($_REQUEST['unit_of_measure_delete']==true && $_REQUEST['id']!=""){
 
 $query_remove_record="update unit_of_measure set record_status='deactivated', deleted_by='".$loggedin_id."',  delete_date='".date("y-m-d")."' where unit_of_measure.id='".$_REQUEST["id"]."'";
 
 mysql_query($query_remove_record,$birus_conn) or die(mysql_error());
 if(mysql_affected_rows($birus_conn)>0){
	 redirect_delete("unit_of_measure_view","2",$_REQUEST["id"]);
	 }
 }
?>  

         <a href="."><img src="images/back-button.png" width="30" height="30" title="Back" /></a><a href=".?unit_of_measure_add&action=Add">
  <img src="images/add-button.jpg" width="30" height="30" title="Add <?php echo $object_name ?>" /></a></div> 
              <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Unit Name</th>
                    <th>Qty In Kgs</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
               <!--Loop start, you could use a repeat region here-->
  <?php do{?>
    <!--Loop start, you could use a repeat region here-->
    <tr>
      <td><?php echo $row_get_unit_of_measure['id']?></td>
      <td><?php echo $row_get_unit_of_measure['name']?></td>
      <td><?php echo $row_get_unit_of_measure['qty_in_kg']?></td>
           <td><a href=".?unit_of_measure= &amp;unit_of_measure_edit= true&amp;id=<?php echo $row_get_unit_of_measure['id']; ?>"><input name="" value="Edit" type="submit" id="edit_forms"/></a></td>
     <td><a href=".?unit_of_measure_view&unit_of_measure_delete=ture&id=<?php echo $row_get_unit_of_measure['id']; ?>"><input name="" value="Delete" type="submit" id="delete_forms"/></a></td>
    </tr>
    <?php }while($row_get_unit_of_measure=mysql_fetch_assoc($get_unit_of_measure));?>
                  <!--Loop end-->
                </tbody>
              </table>
<?php
mysql_free_result($get_unit_of_measure);
?>