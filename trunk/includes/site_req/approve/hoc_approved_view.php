<?php include "includes/notifications/headofconstruction.php"?>
<?php get_main_menu("headofconstruction", $notification)?>
<?php 
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_site_req = "
SELECT person.first_name,
       person.last_name,
       site.name as site_name,
       site_req.id,
	   site_req.req_no,
       site_req.site_id,
       site_req.approved_date
  FROM    (   (   birus.user user
               INNER JOIN
                  birus.person person
               ON (user.person_id = person.id))
           INNER JOIN
              birus.site_req site_req
           ON (site_req.approved_by = user.id))
       INNER JOIN
          birus.site site
       ON (site_req.site_id = site.id)
	   WHERE site_req.hoc_approved_date != '0000-00-00 00:00:00'
";
$get_site_req = mysql_query($query_get_site_req, $birus_conn) or die(mysql_error());
$row_get_site_req = mysql_fetch_assoc($get_site_req);
$totalRows_get_site_req = mysql_num_rows($get_site_req);
?>

<?php include"includes/table_settings.php"?>
<div><a href="."><img src="images/back-button.png" width="30" height="30" title="Back" /></a></div> 
   <div class="module_title">Approved Requsition</div>
              <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Req No</th>
                    <th>Site Name</th>
                    <th>Created By</th>
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
      <td><?php echo $row_get_site_req['req_no']?></td>
      <td><?php echo $row_get_site_req['site_name']?></td>
      <td><?php echo $row_get_site_req['first_name']." ".$row_get_site_req['last_name']?></td>
      <td><?php echo $row_get_site_req['approved_date']?></td>
      <td><a href=".?site_approve_item_view= true&amp;site_req_id=<?php echo $row_get_site_req['id']; ?>&back_page=site_req_hoc_approved_view"><input name="" value="Items" type="submit" id="edit_forms"/></a></td>
    </tr>
    <?php }while($row_get_site_req=mysql_fetch_assoc($get_site_req));?>
                  <!--Loop end-->
                </tbody>
              </table>
<?php
mysql_free_result($get_site_req);
?>