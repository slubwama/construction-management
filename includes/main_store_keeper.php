<?php include "includes/notifications/storekeeper.php"?>
<?php get_main_menu("storekeeper",$notification_store_keeper)?>
<div style="margin-left:auto; margin-right:auto; width:80%; margin-top:00px;">
	<div class="innertable">
        <?php 
		tile_settings("images/tiles/production-req.png","Purchase Requsition",".?purchase_req_view");
		tile_settings("images/tiles/icon2.png","Site Request Issues",".?site_req_issue_view");
				tile_settings("images/tiles/delivery-icon.png","Receive Items",".?purchase_req_recieve_view");
		tile_settings("images/tiles/store-icon.png","Main Store","?menu_type=storekeeper&main_store_view");
		
		?>
		</div>
    </div>
</div>
</div>