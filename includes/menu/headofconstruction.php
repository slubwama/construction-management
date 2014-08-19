<div class="main_menu">
        <div class="inner_menu">
        	 <div id="templatemo_menu" class="ddsmoothmenu">
                <ul>
                 <li><a href="." class="selected"><img src="images/desktop-icon.jpg" width="22" height="22" style="border-radius:10px; border:#FFF solid 1px; padding:2px;" /></a></li>
                    <li><a href="#"><span class="counter">
					<?php  if($menu_variable_array[0] > 0 || $menu_variable_array[1] > 0 || $menu_variable_array[2] >0 || $menu_variable_array[3] > 0 ) { echo $menu_variable_array[0]+$menu_variable_array[1]+$menu_variable_array[2]+$menu_variable_array[3];}?></span> Approvals </a>
                    <ul>
                    	<li><a href="#">Purchase Req &nbsp; &nbsp; <span class="counter"><?php if($menu_variable_array[0] > 0 || $menu_variable_array[3] > 0){echo $menu_variable_array[0]+$menu_variable_array[3];} ?></span></a>
                       
                            <ul>
                             <li><a href="#">Requstion &nbsp;<span class="counter"><?php if($menu_variable_array[0] > 0){echo $menu_variable_array[0];} ?></span></a>
                                 <ul>
                                    <li><a href="?purchase_req_approved_view">Approved</a></li>
                                    <li><a href="?purchase_req_approve_view">To Approved &nbsp; <span class="counter"> <?php if($menu_variable_array[0] > 0){ echo $menu_variable_array[0]; } ?></span></a></li>
                                   <li><a href="?purchase_req_declined_view">Declined</a></li>
                                 </ul>
                             </li>
                             
                           <li><a href="#">Receipts &nbsp; <span class="counter"><?php if($menu_variable_array[3] > 0){echo $menu_variable_array[3];} ?></span></a>
                                 <ul>
                                    <li><a href="?purchase_receipt_approved_view">Approved</a></li>
                                    <li><a href="?purchase_receipt_approve_view">To Approved &nbsp; <span class="counter"> <?php if($menu_variable_array[3] > 0){ echo $menu_variable_array[3]; } ?></span></a></li>
                                   <li><a href="?purchase_receipt_declined_view">Declined</a></li>
                                 </ul>
                             </li>
                            	
                            </ul>
                        </li>
                        <li><a href="#">Site Req &nbsp; &nbsp; <span class="counter"> <?php if($menu_variable_array[1] > 0) { echo $menu_variable_array[1];} ?></span></a>
                            <ul>
                            	<li><a href="?site_req_hoc_approved_view">Approved</a></li>
                                <li><a href="?site_req_hoc_approve_view">To Approved &nbsp; &nbsp; <span class="counter"><?php if($menu_variable_array[1] > 0){echo $menu_variable_array[1];} ?></span></a></li>
                            </ul>
                        </li>
                        
                         <li><a href="?customer_view">Site To Site Req &nbsp; &nbsp; <span class="counter">
						 <?php if($menu_variable_array[2] > 0){echo $menu_variable_array[2]; } ?></span></a>
                            <ul>
                            	<li><a href="?site_to_site_req_hoc_approved_view">Approved</a></li>
                                <li><a href="?site_to_site_req_hoc_approve_view">To Approved &nbsp; &nbsp;<span class="counter">
								<?php  if($menu_variable_array[2] > 0){ echo $menu_variable_array[2]; } ?></span></a></li>
                            </ul>
                        </li>
                    </ul>
                    </li>
                    <li><a href="?supplier_view">Suppliers</a></li>
                    <li><a href="?menu_type=headofconstruction&main_store_view">Main Store</a></li>
                    <li><a href="?logout">[Logout]</a></li>
                </ul>
                <br style="clear: left" />
            </div> <!-- end of templatemo_menu -->

        </div>
</div>
