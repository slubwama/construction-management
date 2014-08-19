<?php get_main_menu("sitestorekeeper")?>
<?php
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_site_item_issue = "
	SELECT site_item_issue.qty_issued,
       site_item_issue.created_date,
	   site_item_issue.id,
       item.name item_name,
       person.first_name,
       person.last_name,
	   site_item_issue.approve_date
  	FROM    (   (   (   birus.site_item_issue site_item_issue
                   INNER JOIN
                      birus.user user
                   ON (site_item_issue.created_by = user.id))
               INNER JOIN
                  birus.item item
               ON (site_item_issue.item_id = item.id))
           INNER JOIN
              birus.site site
           ON (site_item_issue.site_id = site.id))
       INNER JOIN
          birus.person person
       ON (user.person_id = person.id)
	   where site_item_issue.site_id='".$_SESSION["site_id"]."' AND site_item_issue.record_status='active'
	   ";
$get_site_item_issue = mysql_query($query_get_site_item_issue, $birus_conn) or die(mysql_error());
$row_get_site_item_issue = mysql_fetch_assoc($get_site_item_issue);
$totalRows_get_site_item_issue = mysql_num_rows($get_site_item_issue);
?>

<?php
 if($_REQUEST['site_item_issue_delete']==true && $_REQUEST['id']!=""){
 
 $query_remove_record="update site_item_issue set record_status='deactivated', deleted_by='".$loggedin_id."',  deleted_date='".date("y-m-d")."' where site_item_issue.id='".$_REQUEST["id"]."'";
 
 mysql_query($query_remove_record,$birus_conn) or die(mysql_error());
 if(mysql_affected_rows($birus_conn)>0){
	 redirect_delete("site_item_issue_view","2",$_REQUEST["id"]);
	 }
 }
?>

<?php include"includes/table_settings.php"?>
<div><a href="."><img src="images/back-button.png" width="30" height="30" title="Back" /></a></div> 
   <div class="module_title">Site Item Issue</div>
              <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Item</th>
                    <th>Qty Issued</th>
                    <th>Issued By</th>
                    <th>Date Issued</th>
                    <th></th>
                    <th></th>
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
      <td><?php echo date("d-M-Y",strtotime($row_get_site_item_issue['created_date']))?></td>
	  <td>
      <?php
	  if($row_get_site_item_issue['approve_date']!="0000-00-00 00:00:00"){
		   echo"<a href='.?site_item_issue= &amp;site_item_issue_edit= true&amp;id=".$row_get_site_item_issue['id']."&action=Edit'>Edit</a>";
		  }
		  
		  else{
			  echo"";
			  }
	  
	   ?>
      
     </td>
      <td>
            <?php
	  if($row_get_site_item_issue['approve_date']!="0000-00-00 00:00:00"){
		   echo"<a href='.?site_item_issue_view&site_item_issue_delete=true&id=".$row_get_site_item_issue['id']."'>Delete</a>";
		  }
		  
		  else{
			  echo"Approved";
			  }
	  
	   ?></td>
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