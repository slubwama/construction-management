<?php $query_purchase_req_notification="SELECT purchase_req.id FROM birus.purchase_req purchase_req WHERE purchase_req.recieve_date != '0000-00-00 00:00:00'";
		mysql_select_db($database_birus_conn, $birus_conn);
		$purchase_req_notification=mysql_query($query_purchase_req_notification,$birus_conn) or die(mysql_error());
		$totalRows_purchase_req_notification=mysql_num_rows($purchase_req_notification);	
 ?>
 
 
 
 <?php $query_site_req_notification="SELECT * FROM birus.site_req site_req WHERE  site_req.issued_date!='0000-00-00 00:00:00'
 AND site_req.recieved_date='0000-00-00 00:00:00'";
		mysql_select_db($database_birus_conn, $birus_conn);
		$site_req_notification=mysql_query($query_site_req_notification,$birus_conn) or die(mysql_error());
		$totalRows_site_req_notification=mysql_num_rows($site_req_notification);	
 ?>

 
 <?php 
 $notification_store_keeper[0]=$totalRows_purchase_req_notification;
 $notification_store_keeper[1]=$totalRows_site_req_notification;

 ?>