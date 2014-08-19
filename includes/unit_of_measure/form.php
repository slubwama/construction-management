<?php get_main_menu("admin")?>

   <br/>
   <div style="width:90%; margin-left:auto; margin-right:auto;">
    <div class="form_title">

            <?php echo $_REQUEST["action"];?> Activity<?php echo $row_get_branch_by_id['name']?>
    </div>
    <div class="box"> 
<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "unit_form")  && isset($_REQUEST["save"])) {
  $insertSQL = sprintf("INSERT INTO `unit_of_measure` (name, qty_in_kg, created_by, created_date, record_status) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['unit_name'], "text"),
					   GetSQLValueString($_POST['qty_in_kg'], "text"),
                       GetSQLValueString($loggedin_id, "int"),
                       GetSQLValueString(date("y-m-d"), "date"),
                       GetSQLValueString($_POST['record_status'], "text"));

  mysql_select_db($database_birus_conn, $birus_conn);
  $Result1 = mysql_query($insertSQL, $birus_conn) or die(mysql_error());

  if(mysql_affected_rows($birus_conn)){
	  redirect_birus("unit_of_measure_view","2");
	  }
}
  
  $colname_get_unit_of_measure_by_id = "-1";
if (isset($_GET['id'])) {
  $colname_get_unit_of_measure_by_id = $_GET['id'];
}
  
  mysql_select_db($database_birus_conn, $birus_conn);
$query_get_unit_of_measure_by_id = sprintf("SELECT * FROM unit_of_measure WHERE id = %s", GetSQLValueString($colname_get_unit_of_measure_by_id, "int"));
$get_unit_of_measure_by_id = mysql_query($query_get_unit_of_measure_by_id, $birus_conn) or die(mysql_error());
$row_get_unit_of_measure_by_id = mysql_fetch_assoc($get_unit_of_measure_by_id);
$totalRows_get_unit_of_measure_by_id = mysql_num_rows($get_unit_of_measure_by_id);
?>

<?php
if(isset($_REQUEST['update'])){
	
	$unit_of_measure_update_query="UPDATE unit_of_measure SET name='".$_REQUEST['unit_name']."', qty_in_kg='".$_REQUEST['qty_in_kg']."'  WHERE id='".$_REQUEST['unit_of_measure_id']."'";
	$update_unit_of_measure_results=mysql_query($unit_of_measure_update_query,$birus_conn) or die(mysql_error());

	 if(mysql_affected_rows($birus_conn)>0){
	redirect_birus("unit_of_measure_view","2");
	}
}
 ?> 
<form action="<?php echo $editFormAction; ?>" method="post" name="unit_form" id="unit_form">
  <table align="left">
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Unit Name:</td>
      <td><input type="text" name="unit_name" value="<?php echo $row_get_unit_of_measure_by_id["name"]?>" size="32" /></td>
    </tr> 
   <tr valign="baseline">
      <td nowrap="nowrap" align="left">Qty In Kgs:</td>
      <td><input type="text" name="qty_in_kg" value="<?php echo $row_get_unit_of_measure_by_id["qty_in_kg"]?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">&nbsp;</td>
      <td> <?php if(isset($_REQUEST['unit_of_measure_edit'])){	
		echo"<input name='update' type='submit' value='UPDATE' id='submit'/>";
		echo"<input type='hidden' name='MM_update' value='unit_form' />";
		echo"&nbsp;&nbsp;<a href='.?unit_of_measure_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";
		
		}
		else{
			echo"<input name='save' type='submit' value='SAVE' id='submit'/>";
			echo"<input type='hidden' name='MM_insert' value='unit_form' />";	
			echo"&nbsp;&nbsp;<a href='.?unit_of_measure_view'><input name='add' type='button' value='Cancel' id='submit'/></a>";
			}
		?></td>
    </tr>
  </table>
  <input type="hidden" name="unit_of_measure_id" value="<?php echo $row_get_unit_of_measure_by_id["id"]?>" size="32" />
  <input type="hidden" name="record_status" value="active" />
</form>
</div>