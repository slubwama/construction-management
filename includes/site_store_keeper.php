<?php get_main_menu("sitestorekeeper", $notification)?>
<div style="margin-left:auto; margin-right:auto; width:80%; margin-top:00px;">
	<div class="innertable">
        <?php 
	
			tile_settings("images/tiles/site-req.png","Site Requsition",".?site_req_view");
			tile_settings("images/tiles/site_to_site-req.png","Site To Site Requsition",".?site_to_site_req_view");
			tile_settings("images/tiles/icon2.png","Site To Site Issue",".?site_to_site_issue_view");
			tile_settings("images/tiles/site_item_issue.png","Item Issues Out",".?site_item_issue_view");
			tile_settings("images/tiles/delivery-icon.png","Site To Site Rceive Item",".?site_to_site_req_recieve_view");
			tile_settings("images/tiles/delivery-icon2.png","Site Receives",".?site_req_recieve_view");
			//tile_settings("images/tiles/site_item_returns.png","Item Returns In",".?site_returns_view");
			tile_settings("images/tiles/store-icon.png","Site Store",".?site_store_view");	
			tile_settings("images/tiles/store-icon.png","Main Store","?menu_type=sitestorekeeper&main_store_site_view");	
		?>
		</div>
    </div>
</div>
</div>