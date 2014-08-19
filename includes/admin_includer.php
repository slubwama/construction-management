<script type="text/javascript" src="jQuery/Calender/calendarDateInput.js"></script>
<div class="admin_wrap">
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= ".?" . htmlentities($_SERVER['QUERY_STRING']);
}
?>
<?php 
include"includes/more_functions.php";

if(isset($_SESSION["admin"])){
		
			if(isset($_REQUEST['unit_of_measure_view'])){
						include"includes/unit_of_measure/view.php";
						}		
			else if(isset($_REQUEST['unit_of_measure_add'])  || isset($_REQUEST['unit_of_measure_edit'])){
						include"includes/unit_of_measure/form.php";
						}		
			else if(isset($_REQUEST['item_view'])){
					include"includes/item/view.php";
					}
					
			else if(isset($_REQUEST['item_add'])  || isset($_REQUEST['item_edit'])){
					include"includes/item/form.php";
					}
					
			else if(isset($_REQUEST['site_view'])){
					include"includes/site/view.php";
					}
			else if(isset($_REQUEST['site_add'])  || isset($_REQUEST['site_edit'])){
					include"includes/site/form.php";
					}
						
			else if(isset($_REQUEST['user_view'])){
						include"includes/user/view.php";
						}
			else if(isset($_REQUEST['user_add'])  || isset($_REQUEST['user_edit'])){
						include"includes/user/form.php";
						}
						
			else if(isset($_REQUEST['role_view'])){
					include"includes/role/view.php";
					}
					
				else if(isset($_REQUEST['role_add'])  || isset($_REQUEST['role_edit'])){
					include"includes/role/form.php";
					}
					
				else if(isset($_REQUEST['activity_view'])){
					include"includes/activity/view.php";
					}
					
				else if(isset($_REQUEST['activity_add'])  || isset($_REQUEST['activity_edit'])){
					include"includes/activity/form.php";
					}
					
					
				else if(isset($_REQUEST['site_activity_view'])){
					include"includes/site_activity/view.php";
					}
					
				else if(isset($_REQUEST['site_activity_add'])  || isset($_REQUEST['site_activity_edit'])){
					include"includes/site_activity/form.php";
					}

				else{
					include"includes/settings.php";
					}
}
					
else if(isset($_SESSION["head_of_construction"])){
	 
			 if(isset($_REQUEST['main_store_view'])){
					include"includes/main_store/view.php";
					}
		else if(isset($_REQUEST['main_store_item_view'])){
					include"includes/main_store/per_item_view.php";
					}		
					
					
		//Supplier			
		else if(isset($_REQUEST['supplier_view'])){
					include"includes/supplier/view.php";
			}
					
		else if(isset($_REQUEST['supplier_add'])  || isset($_REQUEST['supplier_edit'])){
					include"includes/supplier/form.php";
		}
			
			// Purchase Request Approval		
			else if(isset($_REQUEST['purchase_req_approve_view'])){
					include"includes/purchase_req/approve/view.php";
					}

			else if(isset($_REQUEST['purchase_req_approved_view'])){
					include"includes/purchase_req/approve/approved_view.php";
					}
					
			else if(isset($_REQUEST['purchase_req_declined_view'])){
					include"includes/purchase_req/approve/declined_view.php";
					}
					
			else if(isset($_REQUEST['purchase_receipt_approve_view'])){
					include"includes/purchase_req/approve/receipt_view.php";
					}
            else if(isset($_REQUEST['purchase_receipt_approved_view'])){
					include"includes/purchase_req/approve/receipt_approved_view.php";
					}
			else if(isset($_REQUEST['purchase_receipt_declined_view'])){
					include"includes/purchase_req/approve/receipt_declined_view.php";
			}
					
			else if(isset($_REQUEST['pr_item_approve_view'])){
					include"includes/pr_item/approve/view.php";
					}
					
			else if(isset($_REQUEST['pr_item_recieve'])){
					include"includes/pr_item/receive/form.php";
					}
			
			// Purchase Receive

			
			// Site To Site Request Approval	
			
			else if(isset($_REQUEST['site_to_site_req_hoc_approve_view'])){
			include"includes/site_to_site_req/approve/hoc_view.php";
			}
			
		else if(isset($_REQUEST['site_to_site_req_hoc_approved_view'])){
			include"includes/site_to_site_req/approve/hoc_approved_view.php";
			}
			
			else if(isset($_REQUEST['site_to_site_approve_item_view'])){
			include"includes/site_to_site_req_item/approve/view.php";
			}						
					
			else if(isset($_REQUEST['site_to_site_item_issue_approved_view'])){
			include"includes/site_to_site_item_issue/approved_view.php";
			
			}		
			// Site Request Approval		
			else if(isset($_REQUEST['site_req_hoc_approve_view'])){
			include"includes/site_req/approve/hoc_view.php";
			}
			
		else if(isset($_REQUEST['site_req_hoc_approved_view'])){
			include"includes/site_req/approve/hoc_approved_view.php";
			}
			
			else if(isset($_REQUEST['site_approve_item_view'])){
			include"includes/site_req_item/approve/view.php";

			}

			else{
					include"includes/head_of_construction.php";
				}
}

else if(isset($_SESSION["main_store_keeper"])){
			 if(isset($_REQUEST['main_store_view'])){
					include"includes/main_store/view.php";
					}
				
					
				else if(isset($_REQUEST['main_store_item_view'])){
					include"includes/main_store/per_item_view.php";
					}
					
				else if(isset($_REQUEST['purchase_req_view'])){
					include"includes/purchase_req/request/view.php";
					}
					
				else if(isset($_REQUEST['purchase_req_add'])  || isset($_REQUEST['purchase_req_edit'])){
					include"includes/purchase_req/request/form.php";
					}
					
				else if(isset($_REQUEST['pr_item_view'])){
					include"includes/pr_item/request/view.php";
					}
					
				else if(isset($_REQUEST['pr_item_add'])  || isset($_REQUEST['pr_item_edit'])){
					include"includes/pr_item/request/form.php";
					}
					
			else if(isset($_REQUEST['site_req_issue_view'])){
					include"includes/site_req/issue/view.php";
					}
					
			else if(isset($_REQUEST['site_approve_item_view'])){
			include"includes/site_req_item/approve/view.php";

			}
					
			else if(isset($_REQUEST['site_req_issued_view'])){
					include"includes/site_req/issue/issued_view.php";
					}		
					
			else if(isset($_REQUEST['site_issue_item_view'])){
					include"includes/site_req_item/issue/view.php";
					}
					
			else if(isset($_REQUEST['site_req_item_issue'])){
					include"includes/site_req_item/issue/form.php";
					}
					
			else if(isset($_REQUEST['pr_item_approve_view'])){
					include"includes/pr_item/approve/view.php";
			}
			
			
			else if(isset($_REQUEST['purchase_req_recieve_view'])){
					include"includes/purchase_req/receive/view.php";
					}	
			else if(isset($_REQUEST['purchase_req_recieved_view'])){
					include"includes/purchase_req/receive/received_view.php";
					}
					
			else if(isset($_REQUEST['pr_item_recieve_view'])){
					include"includes/pr_item/receive/view.php";
					}
			else if(isset($_REQUEST['pr_item_recieve_view'])){
					include"includes/pr_item/receive/view.php";
					}
					
			else{
					include"includes/main_store_keeper.php";
				}
}

else if(isset($_SESSION["site_supervisor"])){
		   
		   if(isset($_REQUEST['site_store_view'])){
			include"includes/site_store/view.php";
			}
			
			else if(isset($_REQUEST['main_store_site_view'])){
					include"includes/main_store/site_view.php";
			}
				
			else if(isset($_REQUEST['site_store_item_view'])){
			
			include"includes/site_store/per_item_view.php";
			}
			else if(isset($_REQUEST['site_req_approve_view'])){
			include"includes/site_req/approve/view.php";
			}
			
			else if(isset($_REQUEST['site_approve_item_view'])){
			include"includes/site_req_item/approve/view.php";
			}
			
			else if(isset($_REQUEST['main_store_site_view'])){
					include"includes/main_store/site_view.php";
			}
			
			else if(isset($_REQUEST['site_item_issue_approve_view'])){
			include"includes/site_item_issue/approve_view.php";
			}
			
			else if(isset($_REQUEST['site_item_issue_approved_view'])){
			include"includes/site_item_issue/approved_view.php";
			}

			else if(isset($_REQUEST['site_to_site_req_approve_view'])){
			include"includes/site_to_site_req/approve/view.php";
			}
			
			else if(isset($_REQUEST['site_to_site_issue_approve_view'])){
			include"includes/site_to_site_req/approve/site_to_view.php";
			}
			
			
			else if(isset($_REQUEST['site_to_site_approve_item_view'])){
			include"includes/site_to_site_req_item/approve/view.php";

			}
			
			else if(isset($_REQUEST['site_to_site_item_issue_approve_view'])){
			include"includes/site_to_site_item_issue/approve_view.php";
			}
				
				else{
					include"includes/site_supervisor.php";
					}
	}
	
	
else if(isset($_SESSION["site_store_keeper"])){
			
			if(isset($_REQUEST['site_store_view'])){
				include"includes/site_store/view.php";
				}
			else if(isset($_REQUEST['sites_store_view'])){
				include"includes/site_store/other_view.php";
				}
				
			else if(isset($_REQUEST['site_store_item_view'])){
				
				include"includes/site_store/per_item_view.php";
				}
				
	else if(isset($_REQUEST['main_store_site_view'])){
					include"includes/main_store/site_view.php";
			}
				
		else if(isset($_REQUEST['site_approve_item_view'])){
			include"includes/site_req_item/approve/view.php";
			}
					
		else if(isset($_REQUEST['site_req_view'])){
				include"includes/site_req/request/view.php";
			}
				
		else if(isset($_REQUEST['site_req_add'])  || isset($_REQUEST['site_req_edit'])){
				include"includes/site_req/request/form.php";
			}
		
		else if(isset($_REQUEST['site_req_item_view'])){
			include"includes/site_req_item/request/view.php";
			}
					
		else if(isset($_REQUEST['site_req_item_add'])  || isset($_REQUEST['site_req_item_edit'])){
			include"includes/site_req_item/request/form.php";
			}

		else if(isset($_REQUEST['site_item_issue_view'])){
			include"includes/site_item_issue/view.php";
			}
					
		else if(isset($_REQUEST['site_item_issue_add'])  || isset($_REQUEST['site_item_issue_edit'])){
			include"includes/site_item_issue/form.php";
			}	
			else if(isset($_REQUEST['site_to_site_approve_item_view'])){
			include"includes/site_to_site_req_item/approve/view.php";
			}
					
		else if(isset($_REQUEST['site_to_site_req_view'])){
				include"includes/site_to_site_req/request/view.php";
			}
				
		else if(isset($_REQUEST['site_to_site_req_add'])  || isset($_REQUEST['site_to_site_req_edit'])){
				include"includes/site_to_site_req/request/form.php";
			}			
					
		else if(isset($_REQUEST['site_to_site_req_item_view'])){
			include"includes/site_to_site_req_item/request/view.php";
			}		
		else if(isset($_REQUEST['site_to_site_req_item_add'])  || isset($_REQUEST['site_to_site_req_item_edit'])){
			include"includes/site_to_site_req_item/request/form.php";
			}
			
		else if(isset($_REQUEST['site_to_site_issue_view'])){
			include"includes/site_to_site_req/issue/view.php";
			}
			
		else if(isset($_REQUEST['site_to_site_issued_view'])){
			include"includes/site_to_site_req/issue/issued_view.php";
			}	
				
		else if(isset($_REQUEST['site_to_site_item_issue_view'])){
			include"includes/site_to_site_item/issue/view.php";
			}	
				
		else if(isset($_REQUEST['site_to_site_item_issue_add'])  || isset($_REQUEST['site_to_site_item_issue_edit'])){
			include"includes/site_to_site_item/issue/form.php";
			}	
			
		else if(isset($_REQUEST['site_to_site_req_issue_view'])){
				include"includes/site_to_site_req/issue/view.php";
				}
				
		else if(isset($_REQUEST['site_to_site_issue_item_view'])){
				include"includes/site_to_site_req_item/issue/view.php";
				}
				
		else if(isset($_REQUEST['site_to_site_req_item_issue'])){
				include"includes/site_to_site_req_item/issue/form.php";
		}
		
					else if(isset($_REQUEST['site_req_recieve_view'])){
					include"includes/site_req/receive/view.php";
				}
				
			else if(isset($_REQUEST['site_req_recieved_view'])){
					include"includes/site_req/receive/received_view.php";
				}				
			else if(isset($_REQUEST['site_recieve_item_view'])){
					include"includes/site_req_item/receive/view.php";
					}	
			else if(isset($_REQUEST['site_req_item_recieve'])){
					include"includes/site_req_item/receive/form.php";
					}
					
			else if(isset($_REQUEST['site_to_site_req_recieve_view'])){
					include"includes/site_to_site_req/receive/view.php";
					}
					
			else if(isset($_REQUEST['site_to_site_req_recieved_view'])){
					include"includes/site_to_site_req/receive/received_view.php";
					}
					
			else if(isset($_REQUEST['site_to_site_recieve_item_view'])){
					include"includes/site_to_site_req_item/receive/view.php";
					}
					
			else if(isset($_REQUEST['site_to_site_req_item_recieve'])){
					include"includes/site_to_site_req_item/receive/form.php";
					}
					
		else{
			include"includes/site_store_keeper.php";
			}
	}
	else{
		include"includes/tiles.php";
			}						
	if(isset($_REQUEST['logout'])){
		include"content/logout.php";
		}
?>
</div>