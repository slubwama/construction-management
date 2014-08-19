<?php get_main_menu("sitesupervisor")?>
 
 <?php
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_site_item_issue = "
	SELECT site_item_issue.qty_issued,
       site_item_issue.approve_date,
	   site_item_issue.id,
       item.name item_name,
	   item.id item_id,
       person.first_name,
       person.last_name
  	FROM    (   (   (   birus.site_item_issue site_item_issue
                   INNER JOIN
                      birus.user user
                   ON (site_item_issue.approved_by = user.id))
               INNER JOIN
                  birus.item item
               ON (site_item_issue.item_id = item.id))
           INNER JOIN
              birus.site site
           ON (site_item_issue.site_id = site.id))
       INNER JOIN
          birus.person person
       ON (user.person_id = person.id)
	   where site_item_issue.site_id='".$_SESSION["site_id"]."'
	   AND approve_date!='0000-00-00 00:00:00'
	   ";
$get_site_item_issue = mysql_query($query_get_site_item_issue, $birus_conn) or die(mysql_error());
$row_get_site_item_issue = mysql_fetch_assoc($get_site_item_issue);
$totalRows_get_site_item_issue = mysql_num_rows($get_site_item_issue);
?>
<?php include"includes/table_settings.php"?>
<div><a href="."><img src="images/back-button.png" width="30" height="30" title="Back" /></a></div> 
   <div class="module_title">Site Item Issue</div>
</div> 
              <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Item</th>
                    <th>Qty Issued</th>
                    <th>Approved By</th>
                    <th>Approval Date</th>
                  </tr>
                </thead>
                <tbody>
                  <!--Loop start, you could use a repeat region here-->
  <?php 
  $i=1;
  do{
	  
	  ?>
    <!--Loop start, you could use a repeat region here-->
    <tr>
      <td><?php echo $row_get_site_item_issue['id']?></td>
      <td><?php echo $row_get_site_item_issue['item_name']?></td>
      <td><?php echo $row_get_site_item_issue['qty_issued']?></td>
      <td><?php echo $row_get_site_item_issue['first_name']." ".$row_get_site_item_issue['last_name']?></td>
      <td><?php echo date("d-M-Y", strtotime($row_get_site_item_issue['approve_date']))?></td>
    </tr>
    <?php 
	$i++;
	}while($row_get_site_item_issue=mysql_fetch_assoc($get_site_item_issue));?>
                  <!--Loop end-->
                </tbody>
              </table>
<?php
mysql_free_result($get_site_item_issue);
?>