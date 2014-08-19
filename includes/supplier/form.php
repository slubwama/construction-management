 <?php include "includes/notifications/headofconstruction.php"?>
<?php get_main_menu("headofconstruction", $notification)?>
   <br/>
   <div style="width:90%; margin-left:auto; margin-right:auto;">
    <div class="form_title">

            <?php echo $_REQUEST["action"];?> user <?php echo $row_get_branch_by_id['name']?>
    </div>
    <div class="box"> 
<?php 
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "supplier_form") && isset($_REQUEST['save'])) {
	
		 $insertSQL = sprintf("INSERT INTO location (id, town, village, created_by, created_date, record_status) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['town'], "text"),
                       GetSQLValueString($_POST['village'], "text"),
                       GetSQLValueString($loggedin_id, "int"),
                       GetSQLValueString(date("y-m-d"), "date"),
                       GetSQLValueString($_POST['record_status'], "text"));
  mysql_select_db($database_birus_conn, $birus_conn);
  $Result1 = mysql_query($insertSQL, $birus_conn) or die(mysql_error());
   if(mysql_affected_rows($birus_conn)>0){
	
	mysql_select_db($database_birus_conn, $birus_conn);
	$query_get_location_last_insert = "SELECT id FROM location order by  `id`  desc LIMIT 1";
	$get_location_last_insert = mysql_query($query_get_location_last_insert, $birus_conn) or die(mysql_error());
	$row_get_location_last_insert = mysql_fetch_assoc($get_location_last_insert);
	
	
  $insertSQL = sprintf("INSERT INTO person (first_name, last_name, gender, created_by, created_date, record_status) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['first_name'], "text"),
                       GetSQLValueString($_POST['last_name'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($loggedin_id, "int"),
                       GetSQLValueString(date("y-m-d"), "date"),
                       GetSQLValueString($_POST['record_status'], "text"));

  mysql_select_db($database_birus_conn, $birus_conn);
  $Result1 = mysql_query($insertSQL, $birus_conn) or die(mysql_error());
  
  if(mysql_affected_rows($birus_conn)>0){
	
	  mysql_select_db($database_birus_conn, $birus_conn);
	$query_get_person_last_insert = "SELECT id FROM person order by  `id`  desc LIMIT 1";
	$get_person_last_insert = mysql_query($query_get_person_last_insert, $birus_conn) or die(mysql_error());
	$row_get_person_last_insert = mysql_fetch_assoc($get_person_last_insert);
	
	
	$query_supplier_add=sprintf("INSERT INTO supplier(additional_info,location_id,person_id, name, created_by, created_date, record_status) value(%s,%s,%s,%s,%s,%s,%s)",
	GetSQLValueString($row_get_location_last_insert['additional_info'],"text"),
	GetSQLValueString($row_get_location_last_insert['id'],"int"),
	GetSQLValueString($row_get_person_last_insert['id'],"int"),
	GetSQLValueString($_REQUEST['name'],"text"),
	GetSQLValueString($loggedin_id,"int"),
	GetSQLValueString(date("y-m-d"),"date"),
	GetSQLValueString($_POST['record_status'], "text"));
	
	mysql_query($query_supplier_add,$birus_conn) or die(mysql_error()); ;

	if(mysql_affected_rows($birus_conn)>0){
		
		
	if(mysql_affected_rows($birus_conn)>0){
	$query_contact_add=sprintf("INSERT INTO contact(person_id, email, phone_no, created_by, created_date, record_status) value(%s,%s,%s,%s,%s,%s)",
	GetSQLValueString($row_get_person_last_insert['id'],"int"),
	GetSQLValueString($_REQUEST['email'],"text"),
	GetSQLValueString($_REQUEST['phone_no'],"text"),
	GetSQLValueString($loggedin_id,"int"),
	GetSQLValueString(date("y-m-d"),"date"),
	GetSQLValueString($_POST['record_status'], "text"));
	
	mysql_query($query_contact_add,$birus_conn) or die(mysql_error());
	
	if(mysql_affected_rows($birus_conn)>0){
		redirect_birus("supplier_view","2");
		}
	}	
	}
  }
 }
}
?>


<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="left">
      <tr valign="baseline">
      <td nowrap="nowrap" align="left">Business Name</td>
      <td><input type="text" name="name" value="" size="32" /></td>
    </tr>
          <tr valign="baseline">
      <td nowrap="nowrap" align="left"><br /><br />Contact Person</td>
      <td></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">First Name:</td>
      <td><input type="text" name="first_name" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Last Name:</td>
      <td><input type="text" name="last_name" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Gender:</td>
      <td>
      <select name="gender">
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select>
      </td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Email</td>
      <td><input type="text" name="email" value="" size="32" /></td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Phone No.</td>
      <td><input type="text" name="phone_no" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Town:</td>
      <td><input type="text" name="town" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Village:</td>
      <td><input type="text" name="village" value="" size="32" /></td>
    </tr> 
    
    <tr valign="baseline">
      <td nowrap="nowrap" align="left"></td>
      
      <td>
      Addtitional Supplier Infor<br/>
      <textarea name="additional_info" cols="50" rows="20"></textarea></td>
    </tr> 
    
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">&nbsp;</td>
      <td><?php if(isset($_REQUEST['supplier_edit'])){	
		echo"<input name='update' type='submit' value='UPDATE' id='submit'/>";
		echo"<input type='hidden' name='MM_update' value='supplier_form' />";
		echo"&nbsp;&nbsp;<a href='.?supplier_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";
		
		}
		else{
			echo"<input name='save' type='submit' value='SAVE' id='submit'/>";
			echo"<input type='hidden' name='MM_insert' value='supplier_form' />";
			echo"&nbsp;&nbsp;<a href='.?supplier_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";	
			}
		?></td>
    </tr>
  </table>
  <input type="hidden" name="record_status" value="active" />
  <input type="hidden" name="MM_insert" value="supplier_form" />
</form>
</div>