<?php include "includes/notifications/headofconstruction.php"?>
<?php get_main_menu("headofconstruction", $notification)?>
<?php 
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_site_to_site_req = "
SELECT person.first_name,
       person.last_name,
       site.name as site_name,
       site_to_site_req.id,
	   site_to_site_req.req_no,
       site_to_site_req.site_id,
       site_to_site_req.created_date
  FROM    (   (   birus.user user
               INNER JOIN
                  birus.person person
               ON (user.person_id = person.id))
           INNER JOIN
              birus.site_to_site_req site_to_site_req
           ON (site_to_site_req.approved_by = user.id))
       INNER JOIN
          birus.site site
       ON (site_to_site_req.site_id = site.id)
	   WHERE site_to_site_req.hoc_approved_date != '0000-00-00 00:00:00'
";
$get_site_to_site_req = mysql_query($query_get_site_to_site_req, $birus_conn) or die(mysql_error());
$row_get_site_to_site_req = mysql_fetch_assoc($get_site_to_site_req);
$totalRows_get_site_to_site_req = mysql_num_rows($get_site_to_site_req);
?>

<?php
if(isset($_REQUEST['site_to_site_req_hoc_approve']) && $_REQUEST['site_to_site_req_hoc_approve']==true){
	$approve_update="UPDATE birus.site_to_site_req SET hoc_approved_date = '".date("y-m-d")."', hoc_approved_by = '".$loggedin_id."', hoc_approved='approved' WHERE site_to_site_req.id ='".$_REQUEST['id']."';";
	mysql_query($approve_update, $birus_conn) or die(mysql_error());
	if(mysql_affected_rows($birus_conn)>0){
			redirect_birus("site_to_site_req_hoc_approve_view","2");
		}
	}
 ?>

<?php include"includes/table_settings.php"?>
<div><a href="."><img src="images/back-button.png" width="30" height="30" title="Back" /></a></div> 
   <div class="module_title">Site to Site Approved Requsition</div>
              <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Req No</th>
                    <th>Site Name</th>
                    <th>Created By</th>
                    <th>Created Date</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <!--Loop start, you could use a repeat region here-->
  <?php do{?>
    <!--Loop start, you could use a repeat region here-->
    <tr>
      <td><?php echo $row_get_site_to_site_req['id']?></td>
      <td><?php echo $row_get_site_to_site_req['req_no']?></td>
      <td><?php echo $row_get_site_to_site_req['site_name']?></td>
      <td><?php echo $row_get_site_to_site_req['first_name']." ".$row_get_site_to_site_req['last_name']?></td>
      <td><?php echo date("d-M-Y", strtotime($row_get_site_to_site_req['created_date']));?></td>
      <td><a href=".?site_to_site_approve_item_view= true&amp;site_to_site_req_id=<?php echo $row_get_site_to_site_req['id']; ?>&back_page=site_to_site_req_hoc_approve_view"><input name="" value="Items" type="submit" id="edit_forms"/></a></td>
            <td><a href=".?site_to_site_req_hoc_approve_view&site_to_site_req_hoc_approve=true&site_to_site_req_approve&id=<?php echo $row_get_site_to_site_req['id']; ?>"><input name="" value="Approve" type="submit" id="edit_forms"/></a></td>
    </tr>
    <?php }while($row_get_site_to_site_req=mysql_fetch_assoc($get_site_to_site_req));?>
                  <!--Loop end-->
                </tbody>
              </table>
<?php
mysql_free_result($get_site_to_site_req);
?>