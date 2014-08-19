<script src="scripts/jquery-1.6.1.min.js" type="text/javascript"></script>
<script src="scripts/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="scripts/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
<script src="scripts/jquery.dataTables.pagination.js" type="text/javascript"></script>
<link href="css/demo_table_jui.css" rel="stylesheet" type="text/css" />
<style type="text/css">
/* BeginOAWidget_Instance_2586523: #dataTable */

	@import url("css/custom/south-street/jquery.ui.all.css");
	#dataTable {padding: 0;margin:0;width:80%;}
	#dataTable_wrapper{width:99%; margin-left:auto; margin-right:auto;}
	#dataTable_wrapper th {cursor:pointer} 
	#dataTable_wrapper tr.odd {color:#000000; background-color:#ffffff}
	#dataTable_wrapper tr.odd:hover {color:#ffffff; background-color:#0099ff}
	#dataTable_wrapper tr.odd td.sorting_1 {color:#000; background-color:#ffffff}
	#dataTable_wrapper tr.odd:hover td.sorting_1 {color:#000; background-color:#0099ff}
	#dataTable_wrapper tr.even {color:#000000; background-color:#0066ff}
	#dataTable_wrapper tr.even:hover, tr.even td.highlighted{color:#EEE; background-color:#0099ff}
	#dataTable_wrapper tr.even td.sorting_1 {color:#CCC; background-color:#0066ff}
	#dataTable_wrapper tr.even:hover td.sorting_1 {color:#FFF; background-color:#0099ff}
		
/* EndOAWidget_Instance_2586523 */
</style>
<script type="text/xml">
<!--
<oa:widgets>
  <oa:widget wid="2586523" binding="#dataTable" />
</oa:widgets>
-->
</script>
</head>

<body>
<script type="text/javascript">
// BeginOAWidget_Instance_2586523: #dataTable

$(document).ready(function() {
	oTable = $('#dataTable').dataTable({
		"bJQueryUI": true,
		"bScrollCollapse": false,
		"sScrollY": "350px",
		"bAutoWidth": true,
		"bPaginate": true,
		"sPaginationType": "full_numbers", //full_numbers,two_button
		"bStateSave": true,
		"bInfo": true,
		"bFilter": true,
		"iDisplayLength": 25,
		"bLengthChange": true,
		"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
	});
} );
		
// EndOAWidget_Instance_2586523
</script>