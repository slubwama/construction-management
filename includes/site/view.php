<?php get_main_menu("admin");?>
<?php
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_site = "SELECT site.name,site.id,
       site.start_date,
       site.completion_date,
       location.plot_no,
       location.town,
       location.village
  FROM    birus.site site
       INNER JOIN
          birus.location location
       ON (site.location_id = location.id)
	   WHERE site.record_status='active'
	   ";
$get_site = mysql_query($query_get_site, $birus_conn) or die(mysql_error());
$row_get_site = mysql_fetch_assoc($get_site);
$totalRows_get_site = mysql_num_rows($get_site);
?>
<?php include"includes/table_settings.php"?>
  <?php
 if($_REQUEST['site_delete']==true && $_REQUEST['id']!=""){
 
 $query_remove_record="update site set record_status='deactivated', deleted_by='".$loggedin_id."',  delete_date='".date("y-m-d")."' where site.id='".$_REQUEST["id"]."'";
 
 mysql_query($query_remove_record,$birus_conn) or die(mysql_error());
 if(mysql_affected_rows($birus_conn)>0){
	 redirect_delete("site_view","2",$_REQUEST["id"]);
	 }
 }
?>        
  <a href="."><img src="images/back-button.png" width="30" height="30" title="Back" /></a><a href=".?site_add&action=Add">
  <img src="images/add-button.jpg" width="30" height="30" title="Add <?php echo $object_name ?>" /></a></div> 
              <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Site Name</th>
                    <th>Start Date</th>
                    <th>Completion Date</th>
                    <th>Plot No.</th>
                    <th>Town</th>
                    <th>Village</th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <!--Loop start, you could use a repeat region here-->
  <?php do{?>
    <!--Loop start, you could use a repeat region here-->
    <tr>
      <td><?php echo $row_get_site['id']?></td>
      <td><?php echo $row_get_site['name']?></td>
      <td><?php echo $row_get_site['start_date']?></td>
      <td><?php echo $row_get_site['completion_date']?></td>
      <td><?php echo $row_get_site['plot_no']?></td>
      <td><?php echo $row_get_site['town']?></td>
      <td><?php echo $row_get_site['village']?></td>
      <td><a href=".?site_activity_view= true&amp;site_id=<?php echo $row_get_site['id']; ?>&back_page=site_view"><input name="" value="Site Activities" type="submit" id="edit_forms" style="width:70px;"/></a></a></td>
      <td><a href=".?site= &amp;site_edit= true&amp;id=<?php echo $row_get_site['id']; ?>&action=Edit"><input name="" value="Edit" type="submit" id="edit_forms"/></a></a></td>
      <td><a href=".?site_view&amp;site_delete=true&id=<?php echo $row_get_site['id']; ?>"><input name="" value="Delete" type="submit" id="delete_forms"/></a></a></td>
    </tr>
    <?php }while($row_get_site=mysql_fetch_assoc($get_site));?>
                  <!--Loop end-->
                </tbody>
              </table>
        	</div>
<div class="tab_column" id="form_area">
          </div>         
     	</div>     
</div>
</html><?php
mysql_free_result($get_site);
?>