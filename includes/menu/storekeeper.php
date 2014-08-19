<div class="main_menu">
        <div class="inner_menu">
        	 <div id="templatemo_menu" class="ddsmoothmenu">
                <ul>
                
                 <li><a href="." class="selected"><img src="images/desktop-icon.jpg" width="22" height="22" style="border-radius:10px; border:#FFF solid 1px; padding:2px;" /></a></li>
                 <li><a href="?purchase_req_view"><span class="counter"><?php if($menu_variable_array[0] > 0){echo $menu_variable_array[0];} ?></span> Purchase Req</a>
                 <ul>
                		<li><a href="?purchase_req_view">Requsition</a></li>
                  		<li><a href="#">Receive &nbsp; <span class="counter"><?php if($menu_variable_array[0] > 0){echo $menu_variable_array[0];} ?></span></a>
                            <ul>
                                <li><a href="?purchase_req_recieve_view">To Receive</a></li>
                                <li><a href="?purchase_req_recieved_view">Received &nbsp; <span class="counter"><?php if($menu_variable_array[0] > 0){echo $menu_variable_array[0];} ?></span></a></li>
                            </ul>
                        </li>
                  </ul>
                 
                 </li>
                    	<li><a href="#"><span class="counter"><?php if($menu_variable_array[0] > 0){echo $menu_variable_array[0];} ?></span> Site Req Issue &nbsp; </a>
                            <ul>
                            	<li><a href="?site_req_issue_view">To Issue</a></li>
                                <li><a href="?site_req_issued_view">Issued &nbsp; <span class="counter"> <?php if($menu_variable_array[0] > 0){ echo $menu_variable_array[0]; } ?></span></a></li>
                            </ul>
                        </li>
                    <li><a href="?menu_type=storekeeper&main_store_view">Main Store</a></li>
                    <li><a href="?logout">[Logout]</a></li>
                </ul>
                <br style="clear: left" />
            </div> <!-- end of templatemo_menu -->

        </div>
</div>
