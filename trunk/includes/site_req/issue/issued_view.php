<?php include "includes/notifications/storekeeper.php"?>
<?php get_main_menu("storekeeper",$notification_store_keeper)?>
<?php
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_site_req = "SELECT person.first_name,
       person.last_name,
       site.name as site_name,
       site_req.id,
	   site_req.req_no,
       site_req.site_id,
       site_req.created_date
  FROM    (   (   birus.user user
               INNER JOIN
                  birus.person person
               ON (user.person_id = person.id))
           INNER JOIN
              birus.site_req site_req
           ON (site_req.hoc_approved_by = user.id))
       INNER JOIN
          birus.site site
       ON (site_req.site_id = site.id)
	   Where issued_date!='0000-00-00 00:00:00'
";
$get_site_req = mysql_query($query_get_site_req, $birus_conn) or die(mysql_error());
$row_get_site_req = mysql_fetch_assoc($get_site_req);
$totalRows_get_site_req = mysql_num_rows($get_site_req);
?>

<?php
if(isset($_REQUEST['site_req_issue'])){
	$approve_update="UPDATE birus.site_req SET issued_date = '".date("y-m-d")."', issued_by = '".$loggedin_id."' WHERE site_req.id ='".$_REQUEST['id']."';";
	mysql_query($approve_update, $birus_conn) or die(mysql_error());
	if(mysql_affected_rows($birus_conn)>0){
			redirect_birus("site_req_issue_view","2");
		}
	}
?>

<?php include"includes/table_settings.php"?>
   <div><a href="."><img src="images/back-button.png" width="30" height="30" title="Back" /></a></div> 
   <div class="module_title">Issued Items From Main Store</div>
              <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Construction Site</th>
                    <th>Req No</th>
                    <th>Approved By</th>
                    <th>Created Date</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <!--Loop start, you could use a repeat region here-->
  <?php do{?>
    <!--Loop start, you could use a repeat region here-->
    <tr>
      <td><?php echo $row_get_site_req['id']?></td>
      <td><?php echo $row_get_site_req['site_name']?></td>
      <td><?php echo $row_get_site_req['req_no']?></td>
      <td><?php echo $row_get_site_req['first_name']." ".$row_get_site_req['last_name']?></td>
      <td><?php echo $row_get_site_req['created_date']?></td>
      <td><a href=".?site_approve_item_view= true&amp;site_req_id=<?php echo $row_get_site_req['id']; ?>&amp;back_page=site_req_issued_view"><input name="" value="Items" type="submit" id="edit_forms"/></a></td>    
    </tr>
    <?php }while($row_get_site_req=mysql_fetch_assoc($get_site_req));?>
                  <!--Loop end-->
                </tbody>
              </table>
<?php
mysql_free_result($get_site_req);
?>