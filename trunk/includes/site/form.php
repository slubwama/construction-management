<?php get_main_menu("admin")?>

   <br/>
   <div style="width:90%; margin-left:auto; margin-right:auto;">
    <div class="form_title">

            <?php echo $_REQUEST["action"];?> Site <?php echo $row_get_branch_by_id['name']?>
    </div>
    <div class="box"> 
<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "site_form") && isset($_REQUEST['save'])) {
  $insertSQL = sprintf("INSERT INTO location (id, plot_no, town, village, created_by, created_date, record_status) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['plot_no'], "text"),
                       GetSQLValueString($_POST['town'], "text"),
                       GetSQLValueString($_POST['village'], "text"),
                       GetSQLValueString($loggedin_id, "int"),
                       GetSQLValueString(date("y-m-d"), "date"),
                       GetSQLValueString($_POST['record_status'], "text"));
  mysql_select_db($database_birus_conn, $birus_conn);
  $Result1 = mysql_query($insertSQL, $birus_conn) or die(mysql_error());
 
  if(mysql_affected_rows($birus_conn)>0){
	  
mysql_select_db($database_birus_conn, $birus_conn);
$query_location = "SELECT * FROM location order by  `id`  desc LIMIT 1";
$location = mysql_query($query_location, $birus_conn) or die(mysql_error());
$row_location = mysql_fetch_assoc($location);
$totalRows_location = mysql_num_rows($location);
	  echo $row_location["id"];
	    $qeury_site = sprintf("INSERT INTO site (name, location_id, start_date, completion_date, created_by, created_date, record_status) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
					   GetSQLValueString($row_location["id"], "int"),
                       GetSQLValueString($_POST['start_date'], "date"),
                       GetSQLValueString($_POST['completion_date'], "date"),
                       GetSQLValueString($loggedin_id, "int"),
                       GetSQLValueString(date("y-m-d"), "date"),
                       GetSQLValueString($_POST['record_status'], "text"));
  mysql_select_db($database_birus_conn, $birus_conn);
  $Result_site = mysql_query($qeury_site, $birus_conn) or die(mysql_error());
  if(mysql_affected_rows($birus_conn)>0){
	  redirect_birus("site_view","2");
	  }
	  }
}


$colname_get_site_by_id = "-1";
if (isset($_GET['id'])) {
  $colname_get_site_by_id = $_GET['id'];
}

mysql_select_db($database_birus_conn, $birus_conn);
$query_get_site_by_id = sprintf("SELECT site.name,
       site.start_date,
       site.completion_date,
       location.plot_no,
       location.town,
       location.village,
       site.id,
       site.location_id
  FROM    birus.site site
       INNER JOIN
          birus.location location
       ON (site.location_id = location.id) WHERE site.id = %s", GetSQLValueString($colname_get_site_by_id, "int"));
$get_site_by_id = mysql_query($query_get_site_by_id, $birus_conn) or die(mysql_error());
$row_get_site_by_id = mysql_fetch_assoc($get_site_by_id);
$totalRows_get_site_by_id = mysql_num_rows($get_site_by_id);
 
mysql_select_db($database_birus_conn, $birus_conn);
$query_manager = "SELECT person.first_name,person.last_name,person.id ,user.id as user_id FROM person inner join user on(person.id=user.person_id)";
$manager = mysql_query($query_manager, $birus_conn) or die(mysql_error());
$row_manager = mysql_fetch_assoc($manager);
$totalRows_manager = mysql_num_rows($manager);
?>

 <?php 
 if(isset($_REQUEST["update"])){
			
			if(isset($_REQUEST["id"])){	
			mysql_select_db($database_birus_conn, $birus_conn);
			$query_update_user="update site set name='".$_REQUEST['name']."',
			site_manager='".$_REQUEST['site_manager']."',start_date='".$_REQUEST['start_date']."',
			completion_date='".$_REQUEST['completion_date']."'
			WHERE site.id='".$_REQUEST["id"]."'";
			$results_user=mysql_query($query_update_user,$birus_conn) or die(mysql_error());
			}
			
			if(isset($_REQUEST["location_id"])){
			mysql_select_db($database_birus_conn, $birus_conn);
			$query_update_contact="UPDATE location set plot_no='".$_REQUEST['plot_no']."', 
			town='".$_REQUEST['town']."',village='".$_REQUEST['village']."' WHERE location.id='".$_REQUEST["location_id"]."'";
			$results_contacts=mysql_query($query_update_contact,$birus_conn) or die(mysql_error());
			}

			redirect_birus("site_view","2");

	 }
 ?>
<div class="page_title"> 
</div>
<p><?php echo $_REQUEST["action"];?> Site: <?php echo $row_get_site_by_id['name']?></p>
<form action="<?php echo $editFormAction; ?>" method="POST" name="site_form" id="site_form">
  <table align="left">

    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Site Name</td>
      <td><input type="text" name="name" value="<?php echo$row_get_site_by_id['name'] ?>" size="32" /></td>
    </tr>
    
     <tr valign="baseline">
      <td nowrap="nowrap" align="left">Start Date</td>
      <td><script>DateInput('start_date', true, 'YYYY-MON-DD')</script></td>
    </tr>
   <tr valign="baseline">
      <td nowrap="nowrap" align="left">Expected Completion Date</td>
      <td><script>DateInput('completion_date', true, 'YYYY-MON-DD')</script></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Plot No:</td>
      <td><input type="text" name="plot_no" value="<?php echo$row_get_site_by_id['plot_no'] ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Town:</td>
      <td><input type="text" name="town" value="<?php echo$row_get_site_by_id['town'] ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Village:</td>
      <td><input type="text" name="village" value="<?php echo$row_get_site_by_id['village'] ?>" size="32" /></td>
    </tr> 
   <tr valign="baseline">
      <td nowrap="nowrap" align="left">&nbsp;</td>
      <td>
       <?php if(isset($_REQUEST['site_edit'])){	
		echo"<input name='update' type='submit' value='UPDATE' id='submit'/>";
		echo"<input type='hidden' name='MM_update' value='site_form' />";	
		echo"&nbsp;&nbsp;<a href='.?site_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";	
		}
		else{
			echo"<input name='save' type='submit' value='SAVE' id='submit'/>";
			echo"<input type='hidden' name='MM_insert' value='site_form' />";	
			echo"&nbsp;&nbsp;<a href='.?site_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";
			}
		?>
      </td>
    </tr>
  </table>
  <input type="hidden" name="id" value="<?php echo$row_get_site_by_id['id'] ?>" />
  <input type="hidden" name="location_id" value="<?php echo$row_get_site_by_id['location_id'] ?>" />
  <input type="hidden" name="record_status" value="active" />
  <input type="hidden" name="MM_insert" value="form1" />
  <input type="hidden" name="MM_insert" value="site_form" />
</form>
<?php
mysql_free_result($manager);
mysql_free_result($get_site_by_id);
?>
</div>