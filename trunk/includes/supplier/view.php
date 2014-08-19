<?php include "includes/notifications/headofconstruction.php"?>
<?php get_main_menu("headofconstruction", $notification)?>
<?php
mysql_select_db($database_birus_conn, $birus_conn);
$query_supplier = "SELECT supplier.name,
       person.first_name,
	   supplier.id,
       person.last_name,
	   location.village,
	   location.town,
	   person.created_date,
       person.gender,
       contact.email,
       contact.phone_no,
       user.username
  FROM    (   (   birus.supplier supplier
               INNER JOIN
                  birus.user user
               ON (supplier.created_by = user.id))
           INNER JOIN
              birus.person person
           ON (supplier.person_id = person.id))
       INNER JOIN
          birus.contact contact
       ON (contact.person_id = person.id)
	          INNER JOIN
          birus.location location
       ON (supplier.location_id = location.id)
	   
	   ";
$supplier = mysql_query($query_supplier, $birus_conn) or die(mysql_error());
$row_supplier = mysql_fetch_assoc($supplier);
$totalRows_supplier = mysql_num_rows($supplier);
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

	//$combination_update_query="UPDATE `combination_selection`.`supplier` SET `suppliername` = '".$_REQUEST['suppliername']."'".$password.",f_name='".$_REQUEST['f_name']."',l_name='".$_REQUEST['l_name']."',role_id='".$_REQUEST['role_id']."',gender='".$_REQUEST['gender']."' WHERE `supplier`.`id` ='".$_REQUEST['supplier_id']."'";
//	$update_combination_results=mysql_query($combination_update_query,$birus_conn) or die(mysql_error());

//	 if(mysql_affected_rows($birus_conn)>0){
	//redirect_combination_sel("supplier=","2");
	//}
}
 ?>          
 
  <a href="."><img src="images/back-button.png" width="30" height="30" title="Back" /></a><a href=".?supplier_add&action=Add">
  <img src="images/add-button.jpg" width="30" height="30" title="Add <?php echo $object_name ?>" /></a></div> 
  <div class="module_title" >Suppliers</div>
  <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Business Name</th>
                    <th>Location</th>
                    <th>Contact Names</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>Created By</th>
                    <th>Created Date</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <!--Loop start, you could use a repeat region here-->
  <?php do{?>
    <!--Loop start, you could use a repeat region here-->
    <tr>
    <td><?php echo $row_supplier['id']?></td>
      <td><?php echo $row_supplier['name']?></td>
      <td><?php echo $row_supplier['village']."-".$row_supplier['town']?></td>
      <td><?php echo $row_supplier['first_name']." ".$row_supplier['last_name']?></td>
      <td><?php echo $row_supplier['email']?></td>
      <td><?php echo $row_supplier['phone_no']?></td>
      <td><?php echo $row_supplier['username']?></td>
      <td><?php echo $row_supplier['created_date']?></td>
           <td><a href=".?supplier= &amp;supplier_edit= true&amp;id=<?php echo $row_supplier['id']; ?>"><input name="" value="Edit" type="submit" id="edit_forms"/></a></td>
                      <td><a href=".?supplier_delete&id=<?php echo $row_supplier['id']; ?>"><input name="" value="Delete" type="submit" id="delete_forms"/></a></td>
    </tr>
    <?php }while($row_supplier = mysql_fetch_assoc($supplier));?>
                  <!--Loop end-->
                </tbody>
              </table>
<?php
mysql_free_result($supplier);
?>