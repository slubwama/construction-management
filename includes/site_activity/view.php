<?php get_main_menu("admin");?>
<?php
mysql_select_db($database_birus_conn, $birus_conn);

echo $REQUEST['site_id'];
$query_get_site_activity = "SELECT activity.name,site_activity.id,site.name as site_name
  FROM    (   birus.site_activity site_activity
           INNER JOIN
              birus.site site
           ON (site_activity.site_id = site.id))
       INNER JOIN
          birus.activity activity
       ON (site_activity.activity_id = activity.id)
 WHERE site_activity.site_id ='".$_REQUEST['site_id']."'
 AND site_activity.record_status='active'
 ";

$get_site_activity = mysql_query($query_get_site_activity, $birus_conn) or die(mysql_error());
$row_get_site_activity = mysql_fetch_assoc($get_site_activity);
$totalRows_get_site_activity = mysql_num_rows($get_site_activity);
?>

<?php
 if($_REQUEST['site_activity_delete']==true && $_REQUEST['id']!=""){
 
 $query_remove_record="update site_activity set record_status='deactivated', deleted_by='".$loggedin_id."',  delete_date='".date("y-m-d")."' where site_activity.id='".$_REQUEST["id"]."'";
 
 mysql_query($query_remove_record,$birus_conn) or die(mysql_error());
 if(mysql_affected_rows($birus_conn)>0){
	 redirect_delete("site_activity_view&site_id=".$_REQUEST['site_id']."","2",$_REQUEST["id"]);
	 }
 }
?>


<?php include"includes/table_settings.php"?>   
  <a href=".?<?php echo $_REQUEST['back_page'];?>"><img src="images/back-button.png" width="30" height="30" title="Back" /></a><a href=".?site_activity_add&site_id=<?php echo $_REQUEST['site_id']?>&back_page=<?php echo $_REQUEST['back_page'];?>">
  <img src="images/add-button.jpg" width="30" height="30" title="Add <?php echo $object_name ?>" /></a></div> 
  
<div class="module_title"><?php echo $row_get_site_activity["site_name"]." Site"?></div>  

              <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Activity Name</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <!--Loop start, you could use a repeat region here-->
  <?php do{?>
    <!--Loop start, you could use a repeat region here-->
    <tr>
      <td><?php echo $row_get_site_activity['id']?></td>
      <td><?php echo $row_get_site_activity['name']?></td>
      <td><a href=".?site_activity_view&site_id=<?php echo $_REQUEST['site_id']?>&amp;site_activity_delete=true&id=<?php echo $row_get_site_activity['id']; ?>"><input name="" value="Delete" type="submit" id="delete_forms"/></a></td>
    </tr>
    <?php }while($row_get_site_activity=mysql_fetch_assoc($get_site_activity));?>
                  <!--Loop end-->
                </tbody>
              </table>
<?php
mysql_free_result($get_site_activity);
?>