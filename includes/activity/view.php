<?php get_main_menu("admin");?>
<?php
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_activity = "SELECT * FROM activity";
$get_activity = mysql_query($query_get_activity, $birus_conn) or die(mysql_error());
$row_get_activity = mysql_fetch_assoc($get_activity);
$totalRows_get_activity = mysql_num_rows($get_activity);

$colname_get_activity_by_id = "-1";
if (isset($_GET['activity_id'])) {
  $colname_get_activity_by_id = $_GET['activity_id'];
}
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_activity_by_id = sprintf("SELECT * FROM activity WHERE id = %s", GetSQLValueString($colname_get_activity_by_id, "int"));
$get_activity_by_id = mysql_query($query_get_activity_by_id, $birus_conn) or die(mysql_error());
$row_get_activity_by_id = mysql_fetch_assoc($get_activity_by_id);
$totalRows_get_activity_by_id = mysql_num_rows($get_activity_by_id);
?>

<?php include"includes/table_settings.php"?>
             
 <?php
 if($_REQUEST['activity_delete']==true && $_REQUEST['id']!=""){
 
 $query_remove_record="update activity set record_status='deactivated', deleted_by='".$loggedin_id."',  deleted_date='".date("y-m-d")."' where activity.id='".$_REQUEST["id"]."'";
 
 mysql_query($query_remove_record,$birus_conn) or die(mysql_error());
 if(mysql_affected_rows($birus_conn)>0){
	 redirect_delete("activity_view","2",$_REQUEST["id"]);
	 }
 }
?>    
  <a href="."><img src="images/back-button.png" width="30" height="30" title="Back" /></a><a href=".?activity_add&action=Add">
  <img src="images/add-button.jpg" width="30" height="30" title="Add <?php echo $object_name ?>" /></a></div> 
              <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Activity Name</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <!--Loop start, you could use a repeat region here-->
  <?php do{?>
    <!--Loop start, you could use a repeat region here-->
    <tr>
      <td><?php echo $row_get_activity['id']?></td>
      <td><?php echo $row_get_activity['name']?></td>
      <td><a href="?activity= &amp;activity_edit= true&amp;id=<?php echo $row_get_activity['id']; ?>"><input name="" value="Edit" type="submit" id="edit_forms"/></a></td>
      <td><a href="?activity_view= &amp;activity_delete=true&amp;id=<?php echo $row_get_activity['id']; ?>"><input name="" value="Delete" type="submit" id="delete_forms"/></a></td>
    </tr>
    <?php }while($row_get_activity=mysql_fetch_assoc($get_activity));?>
                  <!--Loop end-->
                </tbody>
              </table>
        	</div>
<div class="tab_column" id="form_area">
          </div>         
     	</div>     
</div>
</html><?php
mysql_free_result($get_activity);

mysql_free_result($get_activity_by_id);
?>