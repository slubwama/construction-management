 <?php 
	function get_main_header(){
		 	include"includes/header.php";
		 }
		  
 	 function get_main_menu($menu_name,$menu_variable_array){
			include"includes/menu/$menu_name".".php";
		 }
 	function redirect_birus($place,$time){
	 echo"<span style='color:#000; size:19px; background'>Successfully Updated </span> 
	 <meta HTTP-equiv=\"refresh\"content=\"$time;url=.?".$place."\">";
	 }
	 
	  function get_edit_link($approved_time,$page,$id){
		if($approved_time=="0000-00-00 00:00:00"){
	  	echo"<a href='.?$page= &amp;".$page."_edit= true&amp;id=".$id."&amp;action=Edit'><input name='' value='Edit' type='submit' id='edit_forms'/></a>";
	  }
	 }

	 function get_delete_link($approved_time,$page,$id){
		if($approved_time=="0000-00-00 00:00:00"){
	  	echo"<a href='.?".$page."_view&".$page."_delete= true&amp;id=".$id."&action=Delete'><input name='' value='Delete' type='submit' id='delete_forms'/></a>";
	  }
	  else{
		  echo"Approved ";
		  }
	 }
	 
	 
	function get_child_link($approved_time,$approved_link,$other_link){
		if($approved_time=="0000-00-00 00:00:00"){
	  	echo $other_link;
	  }
	  else{
		  
		  echo $approved_link;
		  }
	 }
	 
	 function alert_redirect_birus($place,$time,$message){
	 echo"<span style='color:#000; size:19px; background'>$message</span> 
	 <meta HTTP-equiv=\"refresh\"content=\"$time;url=.?".$place."\">";
	 }
	 
	  	function redirect_delete($place,$time,$deleted){
	 echo"<span style='color:#000; size:19px;' >$deleted Successfully Deleted</span> 
	 <meta HTTP-equiv=\"refresh\"content=\"$time;url=.?".$place."\">";
	 }   
	function tile_settings($image_url,$name,$url){	 
		 echo"<a href='".$url."'><div class='innercolumn' id='tile'>
		 <div style='width:100%'><img src='".$image_url."' width='100%' height='70'/></div>
		 <div class='tile_name' align='center'>".$name."</div>
		 </div></a>";
		 }
	
	function back_button($url, $name){ 
			 echo"<div class='back_button'><div class='wrap_80' ><a id='link' href='".$url."' spellcheck='true'>".$name."</a>";
			 if(loggedin==true){
		    echo "|<a id='link' href='.?logout= ' spellcheck='true'>LOGOUT</a>";
			
			 }
			 echo"</div></div>";
		
			 }
			 
			 	function back_button_more($url, $name, $more){ 
			 echo"<div class='back_button'><div class='wrap_80' ><a id='link' href='".$url."' spellcheck='true'>".$name."</a>";
		    echo $more;
			 echo"</div></div>";
		
			 }
			 
			 	function back_button_none(){ 
			 echo"<div class='back_button' style='min-height:20px;'><span style='color:maron'></span><div class='wrap_80'>";
			 echo"</div></div>";
		
			 }
			 function get_form_button($edit_place){	 
				 if(isset($_REQUEST['$edit_place'])){	
		echo"<input name='update' type='submit' value='UPDATE' />";
		}
		else{
			echo"<input name='save' type='submit' value='SAVE' />";	
			}
		}
				 
	function edit_button($name,$url,$id){
		echo"<td><a href='?$url _view= &edit_$url=true &id=$id'>$name</a></td>";
		}
	 ?>