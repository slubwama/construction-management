<?php include "includes/notifications/headofconstruction.php"?>
<?php get_main_menu("headofconstruction", $notification)?>
<div style="margin-left:auto; margin-right:auto; width:80%; margin-top:00px;">
	<div class="innertable">
        <?php	
		tile_settings("images/tiles/approval.png","Purchase Req Approval",".?purchase_req_approve_view");
		tile_settings("images/tiles/approval2.png","Site Req Approval",".?site_req_hoc_approve_view");
		tile_settings("images/tiles/approval3.png","Site To Site Req Approval",".?site_to_site_req_hoc_approve_view");
		tile_settings("images/tiles/store-icon.png","Main Store","?menu_type=headofconstruction&main_store_view");	
		tile_settings("images/tiles/supplier.jpg","Manage Suppliers",".?supplier_view");
		?>
		</div>
    </div>
</div>
</div>