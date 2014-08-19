<?php get_main_menu("admin")?>
<div style="margin-left:auto; margin-right:auto; width:80%; margin-top:00px;">
	<div class="innertable">
        <?php 
			tile_settings("images/tile/user-ico.png","Manage Users",".?user_view");
			tile_settings("images/tile/role.jpg","Manage Roles",".?role_view ");
			tile_settings("images/tiles/item-icon.png","Manage Items",".?item_view");	
			tile_settings("images/tiles/construction_icon.jpg","Manage Sites",".?site_view");
			tile_settings("images/tiles/activity.png","Manage Site Activities",".?activity_view");
			tile_settings("images/tile/uom.jpg","Manage 	Units of Measure",".?unit_of_measure_view ");
			tile_settings("images/tiles/sms.png","Manage SMS Credit","#");
			tile_settings("images/tiles/database.png","Database Backup","#");
			tile_settings("images/tiles/log_file_icon.png","System Log","#");
			
		?>
		</div>
    </div>
</div>
</div>