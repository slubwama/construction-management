<?php get_main_menu("sitesupervisor")?>
<?php
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_site_req = "SELECT site_req.req_no,
       site.name,
       person.first_name,
       person.last_name,
       site_req.issued_date,
       site_req.id,
	   site_req.site_id
  FROM    (   (   birus.site_req site_req
               INNER JOIN
                  birus.site site
               ON (site_req.site_id = site.id))
           INNER JOIN
              birus.user user
           ON (site_req.issued_by = user.id))
       INNER JOIN
          birus.person person
       ON (user.person_id = person.id)
	   where site_req.site_id=".$_SESSION['site_id']."
	   AND recieved_date='0000-00-00 00:00:00'
	   ";
$get_site_req = mysql_query($query_get_site_req, $birus_conn) or die(mysql_error());
$row_get_site_req = mysql_fetch_assoc($get_site_req);
$totalRows_get_site_req = mysql_num_rows($get_site_req);
?>

<?php
if(isset($_REQUEST['site_req_recieve'])){
	$approve_update="UPDATE birus.site_req SET recieved_date = '".date("y-m-d")."', recieved_by = '".$loggedin_id."' WHERE site_req.id ='".$_REQUEST['id']."';";
	mysql_query($approve_update, $birus_conn) or die(mysql_error());
	if(mysql_affected_rows($birus_conn)>0){
			redirect_birus("site_req_recieve_view","2");
		}
	}
?>

<?php include"includes/table_settings.php"?>
   <div><a href="."><img src="images/back-button.png" width="30" height="30" title="Back" /></a></div> 
   <div class="module_title">Receive Items From Main Store</div>
              <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Req No</th>
                    <th>Issued By</th>
                    <th>Issue Date</th>
                    <th></th>
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
      <td><?php echo $row_get_site_req['first_name']." ".$row_get_site_req['last_name']?></td>
      <td><?php echo $row_get_site_req['issued_date']?></td>
      <td><a href=".?site_recieve_item_view= true&amp;site_req_id=<?php echo $row_get_site_req['id']; ?>&site_id=<?php echo $row_get_site_req['site_id']; ?>"><input name="" value="Items" type="submit" id="edit_forms"/></a></td>    
      <td>
      <a href=".?site_req_recieve_view&amp;site_req_recieve=true&amp;site_req_recieve&id=<?php echo $row_get_site_req['id']; ?>"><input name="" value="Receive Issues" type="submit" id="edit_forms" style="width:100px;"/></a>
      </td>
    </tr>
    <?php }while($row_get_site_req=mysql_fetch_assoc($get_site_req));?>
                  <!--Loop end-->
                </tbody>
              </table>
<?php
mysql_free_result($get_site_req);
?>