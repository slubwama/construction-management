<?php get_main_menu("sitesupervisor", $notification);?>
<div style="margin-left:auto; margin-right:auto; width:80%; margin-top:00px;">
	<div class="innertable">
        <?php
			tile_settings("images/tiles/approval2.png","Site Req Approval",".?site_req_approve_view");
			tile_settings("images/tiles/approval4.png","Site Item Issue Approval",".?site_item_issue_approve_view");
			tile_settings("images/tiles/approval3.png","Site To Site Req Approval",".?site_to_site_req_approve_view");
			tile_settings("images/tiles/approval4.png","Site To Site  Item Issue Approval",".?site_to_site_issue_approve_view");
			tile_settings("images/tiles/store-icon.png","Site Store",".?site_store_view");
			tile_settings("images/tiles/store-icon.png","Main Store","?menu_type=sitesupervisor&main_store_site_view");	
			
		?>
		</div>
    </div>
</div>
</div>