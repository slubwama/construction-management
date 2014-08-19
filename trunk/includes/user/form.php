<?php get_main_menu("admin")?>

   <br/>
   <div style="width:90%; margin-left:auto; margin-right:auto;">
    <div class="form_title">

            <?php echo $_REQUEST["action"];?> user <?php echo $row_get_branch_by_id['name']?>
    </div>
    <div class="box"> 

<?php
mysql_select_db($database_birus_conn, $birus_conn);
$query_get_person_last_insert = "SELECT id FROM person";
$get_person_last_insert = mysql_query($query_get_person_last_insert, $birus_conn) or die(mysql_error());
$row_get_person_last_insert = mysql_fetch_assoc($get_person_last_insert);
$totalRows_get_person_last_insert = mysql_num_rows($get_person_last_insert);

mysql_select_db($database_birus_conn, $birus_conn);
$query_role = "SELECT * FROM `role`";
$role = mysql_query($query_role, $birus_conn) or die(mysql_error());
$row_role = mysql_fetch_assoc($role);
$totalRows_role = mysql_num_rows($role);

mysql_select_db($database_birus_conn, $birus_conn);
$query_site = "SELECT * FROM site";
$site = mysql_query($query_site, $birus_conn) or die(mysql_error());
$row_site = mysql_fetch_assoc($site);
$totalRows_site = mysql_num_rows($site);

mysql_select_db($database_birus_conn, $birus_conn);
$query_user_by_id = sprintf("
SELECT person.first_name,
       person.last_name,
	   person.gender,
       role.name as role_name,
       contact.email,
       contact.phone_no,
       user.id as user_id,
	   user.role_id, 
	   user.site_id,
	   user.username,
	   person.id as person_id,
	   contact.id as contact_id,
       site.name as site_name
  FROM    (   (   (   birus.user user
                   INNER JOIN
                      birus.person person
                   ON (user.person_id = person.id))
               INNER JOIN
                  birus.role role
               ON (user.role_id = role.id))
           LEFT OUTER JOIN
              birus.site site
           ON (user.site_id = site.id))
       INNER JOIN
          birus.contact contact
       ON (contact.person_id = person.id)
	   WHERE user.record_status='active'
		AND   user.id = '".$_REQUEST['id']."'");
$user_by_id = mysql_query($query_user_by_id, $birus_conn) or die(mysql_error());
$row_user_by_id = mysql_fetch_assoc($user_by_id);
$totalRows_user_by_id = mysql_num_rows($user_by_id);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "user_form") && isset($_REQUEST['save'])) {
	 $user_id=$_SESSION["user_id"];
	
  $insertSQL = sprintf("INSERT INTO person (first_name, last_name, gender, created_by, created_date, record_status) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['first_name'], "text"),
                       GetSQLValueString($_POST['last_name'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString("", "int"),
                       GetSQLValueString(date("y-m-d"), "date"),
                       GetSQLValueString($_POST['record_status'], "text"));

  mysql_select_db($database_birus_conn, $birus_conn);
  $Result1 = mysql_query($insertSQL, $birus_conn) or die(mysql_error());
  
  if(mysql_affected_rows($birus_conn)>0){
	
	  mysql_select_db($database_birus_conn, $birus_conn);
	$query_get_person_last_insert = "SELECT id FROM person order by  `id`  desc LIMIT 1";
	$get_person_last_insert = mysql_query($query_get_person_last_insert, $birus_conn) or die(mysql_error());
	$row_get_person_last_insert = mysql_fetch_assoc($get_person_last_insert);
	
	$query_user_add=sprintf("INSERT INTO user(person_id, username, password, role_id,site_id, created_by, created_date, record_status) value(%s,%s,%s,%s,%s,%s,%s,%s)",
	GetSQLValueString($row_get_person_last_insert['id'],"int"),
	GetSQLValueString($_REQUEST['username'],"text"),
	GetSQLValueString(md5($_REQUEST['password']),"text"),
	GetSQLValueString($_REQUEST['role_id'],"int"),
	GetSQLValueString($_REQUEST['site_id'],"int"),
	GetSQLValueString($loggedin_id,"int"),
	GetSQLValueString(date("y-m-d"),"date"),
	GetSQLValueString($_POST['record_status'], "text"));
	
	mysql_query($query_user_add,$birus_conn) or die(mysql_error()); ;

	if(mysql_affected_rows($birus_conn)>0){
	$query_contact_add=sprintf("INSERT INTO contact(person_id, email, phone_no, created_by, created_date, record_status) value(%s,%s,%s,%s,%s,%s)",
	GetSQLValueString($row_get_person_last_insert['id'],"int"),
	GetSQLValueString($_REQUEST['email'],"text"),
	GetSQLValueString($_REQUEST['phone_no'],"text"),
	GetSQLValueString("","int"),
	GetSQLValueString(date("y-m-d"),"date"),
	GetSQLValueString($_POST['record_status'], "text"));
	
	mysql_query($query_contact_add,$birus_conn) or die(mysql_error());
	
	if(mysql_affected_rows($birus_conn)>0){
		redirect_birus("user_view","2");
		}
	}
	 }
}
?>
<?php 



?>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<?php 
if(!isset($_REQUEST["user_edit"])){
echo"
<script src='SpryAssets/SpryValidationPassword.js' type='text/javascript'></script>
<script src='SpryAssets/SpryValidationConfirm.js' type='text/javascript'></script>
<link href='SpryAssets/SpryValidationPassword.css' rel='stylesheet' type='text/css' />
<link href='SpryAssets/SpryValidationConfirm.css' rel='stylesheet' type='text/css' />
";
}
?>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
 
 <?php 
 if(isset($_REQUEST["update"])){
			
			if(isset($_REQUEST["id"])){
			mysql_select_db($database_birus_conn, $birus_conn);
			$query_update_user="update user set username='".$_REQUEST['username']."',
			role_id='".$_REQUEST['role_id']."',site_id='".$_REQUEST['site_id']."' WHERE user.id='".$_REQUEST["id"]."'";
			$results_user=mysql_query($query_update_user,$birus_conn) or die(mysql_error());
			}
		
			
			if(isset($_REQUEST["person_id"])){
			mysql_select_db($database_birus_conn, $birus_conn);
			$query_update_person="update person set first_name='".$_REQUEST['first_name']."', 
			gender='".$_REQUEST['gender']."' WHERE person.id='".$_REQUEST["person_id"]."'";
			$results_person=mysql_query($query_update_person,$birus_conn) or die(mysql_error());

			}
			
			if(isset($_REQUEST["contact_id"])){
			mysql_select_db($database_birus_conn, $birus_conn);
			$query_update_contact="UPDATE contact set phone_no='".$_REQUEST['phone_no']."', 
			email='".$_REQUEST['email']."' WHERE contact.id='".$_REQUEST["contact_id"]."'";
			$results_contacts=mysql_query($query_update_contact,$birus_conn) or die(mysql_error());
			}

			redirect_birus("user_view","2");

	 }
 ?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="left">
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">First Name:</td>
      <td><span id="sprytextfield1">
        <input type="text" name="first_name" value="<?php echo $row_user_by_id['first_name']?>" size="32" />
      <span class="textfieldRequiredMsg">Enter First Name.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Last Name:</td>
      <td><span id="sprytextfield2">
        <input type="text" name="last_name" value="<?php echo $row_user_by_id['last_name']?>" size="32" />
      <span class="textfieldRequiredMsg">Last Name is required.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Username:</td>
      <td><span id="sprytextfield3">
        <input type="text" name="username" value="<?php echo $row_user_by_id['username']?>" size="32" />
      <span class="textfieldRequiredMsg">Username is required.</span></span></td>
    </tr>
<?php 
if(!isset($_REQUEST["user_edit"])){
	echo"
	 <tr valign='baseline'>
      <td nowrap='nowrap' align='left'>Password:</td>
      <td><span id='sprypassword1'>
        <input type='password' name='password' value='' size='32' id='password'/>
      <span class='passwordRequiredMsg'>Password is required.</span></span></td>
    </tr>
     <tr valign='baseline'>
      <td nowrap='nowrap' align='left'>Comfirm:</td>
      <td><span id='spryconfirm1'>
        <input type='password' name='confirm_password' value='' size='32' />
       <span class='confirmRequiredMsg'>A value is required.</span><span class='confirmInvalidMsg'>The values don't match.</span></span></td>
    </tr>
	";
}
?>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Gender:</td>
      <td>
      <select name="gender">
        <option value="male" <?php if (!(strcmp("male", $row_user_by_id['gender']))) {echo "selected=\"selected\"";} ?>>Male</option>
        <option value="female" <?php if (!(strcmp("female", $row_user_by_id['gender']))) {echo "selected=\"selected\"";} ?>>Female</option>
      </select>
      </td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Role:</td>
      <td><select name="role_id">
        <?php
do {  
?>
        <option value="<?php echo $row_role['id']?>"<?php if (!(strcmp($row_role['id'], $row_user_by_id['role_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_role['name']?></option>
        <?php
} while ($row_role = mysql_fetch_assoc($role));
  $rows = mysql_num_rows($role);
  if($rows > 0) {
      mysql_data_seek($role, 0);
	  $row_role = mysql_fetch_assoc($role);
  }
?>
      </select></td>
    </tr>
    
        <tr valign="baseline">
      <td nowrap="nowrap" align="left">Site:</td>
      <td><span id="spryselect1">
        <select name="site_id">
          <option value="" <?php if (!(strcmp("", $row_user_by_id['site_id']))) {echo "selected=\"selected\"";} ?>>--------------------------</option>
          <?php
do {  
?>
          <option value="<?php echo $row_site['id']?>"<?php if (!(strcmp($row_site['id'], $row_user_by_id['site_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_site['name']?></option>
          <?php
} while ($row_site = mysql_fetch_assoc($site));
  $rows = mysql_num_rows($site);
  if($rows > 0) {
      mysql_data_seek($site, 0);
	  $row_site = mysql_fetch_assoc($site);
  }
?>
        </select>
</span></td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Email</td>
      <td><span id="sprytextfield4">
      <input type="text" name="email" value="<?php echo $row_user_by_id['email']; ?>" size="32" />
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span>        </td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Phone No.</td>
      <td><span id="sprytextfield5">
      <input type="text" name="phone_no" value="<?php echo $row_user_by_id['phone_no']; ?>" size="32" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">&nbsp;</td>
      <td><?php if(isset($_REQUEST['user_edit'])){	
		echo"<input name='update' type='submit' value='UPDATE' id='submit'/>";
		echo"<input type='hidden' name='MM_update' value='user_form' />";
		echo"&nbsp;&nbsp;<a href='.?user_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";
		
		}
		else{
			echo"<input name='save' type='submit' value='SAVE' id='submit'/>";
			echo"<input type='hidden' name='MM_insert' value='user_form' />";
			echo"&nbsp;&nbsp;<a href='.?user_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";	
			}
		?></td>
    </tr>
  </table>
  <input type="hidden" name="id" value="<?php echo $row_user_by_id['user_id']; ?>" size="32" />
  <input type="hidden" name="person_id" value="<?php echo $row_user_by_id['person_id']; ?>" size="32" />
    <input type="hidden" name="contact_id" value="<?php echo $row_user_by_id['contact_id']; ?>" size="32" />
  <input type="hidden" name="record_status" value="active" />
  <input type="hidden" name="MM_insert" value="user_form" />
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");

<?php
if(!isset($_REQUEST["user_edit"])){
echo"
var sprypassword1 = new Spry.Widget.ValidationPassword('sprypassword1');
var spryconfirm1 = new Spry.Widget.ValidationConfirm('spryconfirm1', 'password');
";
}
?>
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "email");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none");
</script>
<?php
mysql_free_result($get_person_last_insert);

mysql_free_result($role);

mysql_free_result($site);

mysql_free_result($user_by_id);
?>
</div>