<?php get_main_menu("admin")?>
<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")  && isset($_REQUEST['save'])) {
  $insertSQL = sprintf("INSERT INTO role (name) VALUES (%s)",
                       GetSQLValueString($_POST['name'], "text"));
  mysql_select_db($database_birus_conn, $birus_conn);
  $Result1 = mysql_query($insertSQL, $birus_conn) or die(mysql_error());
}

mysql_select_db($database_birus_conn, $birus_conn);
$query_get_role = "SELECT * FROM role";
$get_role = mysql_query($query_get_role, $birus_conn) or die(mysql_error());
$row_get_role = mysql_fetch_assoc($get_role);
$totalRows_get_role = mysql_num_rows($get_role);

$colname_get_role_by_id = "-1";
if (isset($_GET['role_id'])) {
  $colname_get_role_by_id = $_GET['role_id'];
}
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_role_by_id = sprintf("SELECT * FROM role WHERE id = %s", GetSQLValueString($colname_get_role_by_id, "int"));
$get_role_by_id = mysql_query($query_get_role_by_id, $birus_conn) or die(mysql_error());
$row_get_role_by_id = mysql_fetch_assoc($get_role_by_id);
$totalRows_get_role_by_id = mysql_num_rows($get_role_by_id);
?>
<?php include"includes/table_settings.php"?>
              
<?php
 if($_REQUEST['role_delete']==true && $_REQUEST['id']!=""){
 
 $query_remove_record="update role set record_status='deactivated', deleted_by='".$loggedin_id."',  deleted_date='".date("y-m-d")."' where role.id='".$_REQUEST["id"]."'";
 
 mysql_query($query_remove_record,$birus_conn) or die(mysql_error());
 if(mysql_affected_rows($birus_conn)>0){
	 redirect_delete("role_view","2",$_REQUEST["id"]);
	 }
 }
?>         
  <div>
  <a href="."><img src="images/back-button.png" width="30" height="30" title="Back" /></a><a href=".?role_add&action=Add">
  <img src="images/add-button.jpg" width="30" height="30" title="Add <?php echo $object_name ?>" /></a></div> 
              <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Institute Name</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <!--Loop start, you could use a repeat region here-->
  <?php do{?>
    <!--Loop start, you could use a repeat region here-->
    <tr>
      <td><?php echo $row_get_role['id']?></td>
      <td><?php echo $row_get_role['name']?></td>
      <td><a href="?role= &amp;role_edit= true&amp;id=<?php echo $row_get_role['id']; ?>"><input name="" value="Edit" type="submit" id="edit_forms"/></a></td>
      <td><a href="?role_view= &amp;role_delete=true&amp;id=<?php echo $row_get_role['id']; ?>"><input name="" value="Delete" type="submit" id="delete_forms"/></a></td>
    </tr>
    <?php }while($row_get_role=mysql_fetch_assoc($get_role));?>
                  <!--Loop end-->
                </tbody>
              </table>
        	</div>
<div class="tab_column" id="form_area">
          </div>         
     	</div>     
</div>
</html><?php
mysql_free_result($get_role);

mysql_free_result($get_role_by_id);
?>