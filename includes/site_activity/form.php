<?php get_main_menu("admin")?>

   <br/>
   <div style="width:90%; margin-left:auto; margin-right:auto;">
    <div class="form_title">

            <?php echo $_REQUEST["action"];?> Site Activity<?php echo $row_get_branch_by_id['name']?>
    </div>
    <div class="box"> 
<?php
if(isset($_REQUEST['save_activity'])){	

		$site_id=$_REQUEST['site_id'];		
		if (isset($_POST['activity_ids'])) {
			$optionArray = $_REQUEST['activity_ids'];	
								
		for ($i=0; $i<count($optionArray); $i++) {
		$activity_data=$optionArray[$i];
		$spd_insert=mysql_query("INSERT INTO site_activity(site_id, activity_id,created_by, created_date, record_status) 
		 VALUES('$site_id','$activity_data','".$loggedin_id."','".date("y-m-d")."','".$_POST['record_status']."')",$birus_conn) or die(mysql_query());	
		}
		redirect_birus("site_activity_view&site_id=7","2");
		}
	}
	else{
		}
?>
<?php
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_activity = "SELECT * FROM activity";
$get_activity = mysql_query($query_get_activity, $birus_conn) or die(mysql_error());
$row_get_activity = mysql_fetch_assoc($get_activity);
$totalRows_get_activity = mysql_num_rows($get_activity);
?>
<form action="<?php echo $editFormAction; ?>" method="post" name="site_activity_form" id="site_activity_form">
<input name="site_id" type="hidden" value="<?php echo $_REQUEST['site_id']?>">
  <table align="left">
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Activites:</td>
      <td>
	<?php do { ?>
 <input type='checkbox' name='activity_ids[]' value='<?php echo $row_get_activity['id']; ?>' /><?php echo $row_get_activity['name']; ?> <br/>
 <?php } while ($row_get_activity = mysql_fetch_assoc($get_activity)); ?>
      </td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">&nbsp;</td>
      <td><td>
       <?php if(isset($_REQUEST['site_edit'])){	
		echo"<input name='update' type='submit' value='UPDATE' id='submit'/>";
		echo"<input type='hidden' name='MM_update' value='site_form' />";	
		echo"&nbsp;&nbsp;<a href='.?site_activity_view&".$_REQUEST['site_id']."'><input name='add' type='button' value='Cancel' id='submit'/></a>";	
		}
		else{
			echo"<input name='save_activity' type='submit' value='SAVE' id='submit'/>";
			echo"<input type='hidden' name='MM_insert' value='site_form' />";	
			echo"&nbsp;&nbsp;<a href='.?site_activity_view&".$_REQUEST['site_id']."'><input name='add' type='button' value='Cancel' id='submit'/></a>";
			}
		?>
      </td>
        
        </td>
    </tr>
  </table>
   <input type="hidden" name="record_status" value="active" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<?php
mysql_free_result($get_activity);
?>
</div>