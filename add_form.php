<?php require_once('Connections/birus_conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_birus_conn, $birus_conn);
$query_supplier = "SELECT * FROM supplier";
$supplier = mysql_query($query_supplier, $birus_conn) or die(mysql_error());
$row_supplier = mysql_fetch_assoc($supplier);
$totalRows_supplier = mysql_num_rows($supplier);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
?>
<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO purchase_req (created_by, created_date, record_status) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['created_by'], "int"),
                       GetSQLValueString($_POST['created_date'], "date"),
                       GetSQLValueString($_POST['record_status'], "text"));

  mysql_select_db($database_birus_conn, $birus_conn);
  $Result1 = mysql_query($insertSQL, $birus_conn) or die(mysql_error());
  
  if(mysql_affected_rows($birus_conn)>0){
	  
	  if(!empty($_POST['item_id'])){
		foreach($_POST['item_id'] as $cnt => $item_id) {
			$sql = "INSERT INTO pr_item (item_id, pr_id,created_by, created_date, record_status) VALUES ('$item_id', '".$_POST['name'][$cnt]."');";
			$link->query($sql,$birus);
		}
	}
	  	
  }
}

	
?>

<html>
<head>
	<script type="text/javascript" src="js/auto_add_more.js"></script>
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record"></td>
    </tr>
  </table>
  <input type="hidden" name="created_by" value="">
  <input type="hidden" name="created_date" value="">
  <input type="hidden" name="record_status" value="">
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>	
</html>
<?php
mysql_free_result($supplier);
?>
