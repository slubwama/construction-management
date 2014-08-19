<?php $query_purchase_req_notification="SELECT purchase_req.id FROM birus.purchase_req purchase_req WHERE purchase_req.approved_date = '0000-00-00 00:00:00'";
		mysql_select_db($database_birus_conn, $birus_conn);
		$purchase_req_notification=mysql_query($query_purchase_req_notification,$birus_conn) or die(mysql_error());
		$totalRows_purchase_req_notification=mysql_num_rows($purchase_req_notification);	
 ?>
 
 <?php 
 $query_purchase_receipt_notification="SELECT * from purchase_req
where purchase_req.recieve_date!='0000-00-00 00:00:00'
AND
purchase_req.approved_receipt_date='0000-00-00 00:00:00'
 ";
		mysql_select_db($database_birus_conn, $birus_conn);
		$purchase_receipt_notification=mysql_query($query_purchase_receipt_notification,$birus_conn) or die(mysql_error());
		$totalRows_purchase_receipt_notification=mysql_num_rows($purchase_receipt_notification);	
 ?>
 
 
 <?php $query_site_req_notification="SELECT * FROM birus.site_req site_req WHERE site_req.hoc_approved_date = '0000-00-00 00:00:00' AND site_req.approved_date!='0000-00-00 00:00:00'";
		mysql_select_db($database_birus_conn, $birus_conn);
		$site_req_notification=mysql_query($query_site_req_notification,$birus_conn) or die(mysql_error());
		$totalRows_site_req_notification=mysql_num_rows($site_req_notification);	
 ?>
 
  <?php $query_site_to_site_req_notification="SELECT * FROM birus.site_to_site_req site_to_site_req WHERE site_to_site_req.hoc_approved_date = '0000-00-00 00:00:00' AND site_to_site_req.approved_date!='0000-00-00 00:00:00'";
		mysql_select_db($database_birus_conn, $birus_conn);
		$site_to_site_req_notification=mysql_query($query_site_to_site_req_notification,$birus_conn) or die(mysql_error());
		$totalRows_site_to_site_req_notification=mysql_num_rows($site_to_site_req_notification);	
		
 ?>
 
 <?php 
 $notification[0]=$totalRows_purchase_req_notification;
 $notification[1]=$totalRows_site_req_notification;
 $notification[2]=$totalRows_site_to_site_req_notification;
 $notification[3]=$totalRows_purchase_receipt_notification;
 ?>