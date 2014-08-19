<?php get_main_menu("admin")?>
<?php
mysql_select_db($database_birus_conn, $birus_conn);
$query_role = "SELECT * FROM `role`";
$role = mysql_query($query_role, $birus_conn) or die(mysql_error());
$row_role = mysql_fetch_assoc($role);
$totalRows_role = mysql_num_rows($role);

$colname_user_by_id = "-1";
if (isset($_GET['user_id'])) {
  $colname_user_by_id = $_GET['user_id'];
}
mysql_select_db($database_birus_conn, $birus_conn);
$query_user_by_id = sprintf("SELECT * FROM `user` WHERE id = %s", GetSQLValueString($colname_user_by_id, "int"));
$user_by_id = mysql_query($query_user_by_id, $birus_conn) or die(mysql_error());
$row_user_by_id = mysql_fetch_assoc($user_by_id);
$totalRows_user_by_id = mysql_num_rows($user_by_id);

mysql_select_db($database_birus_conn, $birus_conn);
$query_user = "
SELECT person.first_name,
       person.last_name,
	   person.gender,
       role.name as role_name,
       contact.email,
       contact.phone_no,
       user.id as user_id,
	   user.username,
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
	   where user.record_status='active'
	   AND user.username!='root'
	   ";
$user = mysql_query($query_user, $birus_conn) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);
?>
<?php include"includes/table_settings.php"?>        
<?php
if(isset($_REQUEST['update'])){
	
	if(isset($_REQUEST['password']) && $_REQUEST['password']!=""){

		$password=$_REQUEST['password'];
		",password='".$_REQUEST['password']."'";
		}
		else{
			$password="";
			}

	$combination_update_query="UPDATE `combination_selection`.`user` SET `username` = '".$_REQUEST['username']."'".$password.",f_name='".$_REQUEST['f_name']."',l_name='".$_REQUEST['l_name']."',role_id='".$_REQUEST['role_id']."',gender='".$_REQUEST['gender']."' WHERE `user`.`id` ='".$_REQUEST['user_id']."'";
	$update_combination_results=mysql_query($combination_update_query,$birus_conn) or die(mysql_error());

	 if(mysql_affected_rows($birus_conn)>0){
	redirect_combination_sel("user=","2");
	}
}
 ?>  
 
 
<?php
 if($_REQUEST['user_delete']==true && $_REQUEST['id']!=""){
 
 $query_remove_record="update user set record_status='deactivated', deleted_by='".$loggedin_id."',  delete_date='".date("y-m-d")."' where user.id='".$_REQUEST["id"]."'";
 
 mysql_query($query_remove_record,$birus_conn) or die(mysql_error());
 if(mysql_affected_rows($birus_conn)>0){
	 redirect_delete("user_view","2",$_REQUEST["id"]);
	 }
 }
?>        
   <div>
  <a href="."><img src="images/back-button.png" width="30" height="30" title="Back" /></a><a href=".?user_add&action=Add">
  <img src="images/add-button.jpg" width="30" height="30" title="Add <?php echo $object_name ?>" /></a></div> 
  <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>UserName</th>
                    <th>Names</th>
                    <th>Role</th>
                    <th>Construction Site</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <!--Loop start, you could use a repeat region here-->
  <?php do{?>
    <!--Loop start, you could use a repeat region here-->
    <tr>
    <td><?php echo $row_user['user_id']?></td>
      <td><?php echo $row_user['username']?></td>
      <td><?php echo $row_user['first_name']." ".$row_user['last_name']?></td>
      <td><?php echo $row_user['role_name']?></td>
      <td><?php echo $row_user['site_name']?></td>
      <td><?php echo $row_user['email']?></td>
      <td><?php echo $row_user['phone_no']?></td>
           <td><a href=".?user_edit= true&amp;id=<?php echo $row_user['user_id']; ?>"><input name="" value="Edit" type="submit" id="edit_forms"/></a></td>
           <td><a href=".?user_view&user_delete=true&id=<?php echo $row_user['user_id']; ?>"><input name="" value="Delete" type="submit" id="delete_forms"/></a></td>
    </tr>
    <?php }while($row_user = mysql_fetch_assoc($user));?>
                  <!--Loop end-->
                </tbody>
              </table>
<?php
mysql_free_result($role);
mysql_free_result($user_by_id);
mysql_free_result($user);
?>