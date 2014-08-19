<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="scripts/jquery-1.6.1.min.js" type="text/javascript"></script>
<script src="scripts/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="scripts/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
<script src="scripts/jquery.dataTables.pagination.js" type="text/javascript"></script>
<link href="css/demo_table_jui.css" rel="stylesheet" type="text/css" />
<style type="text/css">
/* BeginOAWidget_Instance_2586523: #dataTable */

	@import url("css/custom/south-street/jquery.ui.all.css");
	#dataTable {padding: 0;margin:0;width:100%;}
	#dataTable_wrapper{width:100%;}
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
		"bScrollCollapse": true,
		"sScrollY": "100%",
		"bAutoWidth": true,
		"bPaginate": true,
		"sPaginationType": "full_numbers", //full_numbers,two_button
		"bStateSave": true,
		"bInfo": true,
		"bFilter": true,
		"iDisplayLength": 100,
		"bLengthChange": true,
		"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
	});
} );
		
// EndOAWidget_Instance_2586523
</script>
<table cellpadding="0" cellspacing="0" border="0" id="dataTable">
  <thead>
    <tr>
      <th>Rendering engine</th>
      <th>Browser</th>
      <th>Platform(s)</th>
      <th>Engine version</th>
      <th>CSS grade</th>
    </tr>
  </thead>
  <tbody>
    <!--Loop start, you could use a repeat region here-->
    <tr>
      <td>Trident</td>
      <td>Internet
        Explorer 4.0</td>
      <td>Win 95+</td>
      <td>4</td>
      <td>X</td>
    </tr>
    <tr>
      <td>Trident</td>
      <td>Internet
        Explorer 5.0</td>
      <td>Win 95+</td>
      <td>5</td>
      <td>C</td>
    </tr>
    <tr>
      <td>Trident</td>
      <td>Internet
        Explorer 5.5</td>
      <td>Win 95+</td>
      <td>5.5</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Trident</td>
      <td>Internet
        Explorer 6</td>
      <td>Win 98+</td>
      <td>6</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Trident</td>
      <td>Internet Explorer 7</td>
      <td>Win XP SP2+</td>
      <td>7</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Trident</td>
      <td>AOL browser (AOL desktop)</td>
      <td>Win XP</td>
      <td>6</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Gecko</td>
      <td>Firefox 1.0</td>
      <td>Win 98+ / OSX.2+</td>
      <td>1.7</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Gecko</td>
      <td>Firefox 1.5</td>
      <td>Win 98+ / OSX.2+</td>
      <td>1.8</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Gecko</td>
      <td>Firefox 2.0</td>
      <td>Win 98+ / OSX.2+</td>
      <td>1.8</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Gecko</td>
      <td>Firefox 3.0</td>
      <td>Win 2k+ / OSX.3+</td>
      <td>1.9</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Gecko</td>
      <td>Camino 1.0</td>
      <td>OSX.2+</td>
      <td>1.8</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Gecko</td>
      <td>Camino 1.5</td>
      <td>OSX.3+</td>
      <td>1.8</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Gecko</td>
      <td>Netscape 7.2</td>
      <td>Win 95+ / Mac OS 8.6-9.2</td>
      <td>1.7</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Gecko</td>
      <td>Netscape Browser 8</td>
      <td>Win 98SE+</td>
      <td>1.7</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Gecko</td>
      <td>Netscape Navigator 9</td>
      <td>Win 98+ / OSX.2+</td>
      <td>1.8</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Gecko</td>
      <td>Mozilla 1.0</td>
      <td>Win 95+ / OSX.1+</td>
      <td>1</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Gecko</td>
      <td>Mozilla 1.1</td>
      <td>Win 95+ / OSX.1+</td>
      <td>1.1</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Gecko</td>
      <td>Mozilla 1.2</td>
      <td>Win 95+ / OSX.1+</td>
      <td>1.2</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Gecko</td>
      <td>Mozilla 1.3</td>
      <td>Win 95+ / OSX.1+</td>
      <td>1.3</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Gecko</td>
      <td>Mozilla 1.4</td>
      <td>Win 95+ / OSX.1+</td>
      <td>1.4</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Gecko</td>
      <td>Mozilla 1.5</td>
      <td>Win 95+ / OSX.1+</td>
      <td>1.5</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Gecko</td>
      <td>Mozilla 1.6</td>
      <td>Win 95+ / OSX.1+</td>
      <td>1.6</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Gecko</td>
      <td>Mozilla 1.7</td>
      <td>Win 98+ / OSX.1+</td>
      <td>1.7</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Gecko</td>
      <td>Mozilla 1.8</td>
      <td>Win 98+ / OSX.1+</td>
      <td>1.8</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Gecko</td>
      <td>Seamonkey 1.1</td>
      <td>Win 98+ / OSX.2+</td>
      <td>1.8</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Gecko</td>
      <td>Epiphany 2.20</td>
      <td>Gnome</td>
      <td>1.8</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Webkit</td>
      <td>Safari 1.2</td>
      <td>OSX.3</td>
      <td>125.5</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Webkit</td>
      <td>Safari 1.3</td>
      <td>OSX.3</td>
      <td>312.8</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Webkit</td>
      <td>Safari 2.0</td>
      <td>OSX.4+</td>
      <td>419.3</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Webkit</td>
      <td>Safari 3.0</td>
      <td>OSX.4+</td>
      <td>522.1</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Webkit</td>
      <td>OmniWeb 5.5</td>
      <td>OSX.4+</td>
      <td>420</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Webkit</td>
      <td>iPod Touch / iPhone</td>
      <td>iPod</td>
      <td>420.1</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Webkit</td>
      <td>S60</td>
      <td>S60</td>
      <td>413</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Presto</td>
      <td>Opera 7.0</td>
      <td>Win 95+ / OSX.1+</td>
      <td>-</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Presto</td>
      <td>Opera 7.5</td>
      <td>Win 95+ / OSX.2+</td>
      <td>-</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Presto</td>
      <td>Opera 8.0</td>
      <td>Win 95+ / OSX.2+</td>
      <td>-</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Presto</td>
      <td>Opera 8.5</td>
      <td>Win 95+ / OSX.2+</td>
      <td>-</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Presto</td>
      <td>Opera 9.0</td>
      <td>Win 95+ / OSX.3+</td>
      <td>-</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Presto</td>
      <td>Opera 9.2</td>
      <td>Win 88+ / OSX.3+</td>
      <td>-</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Presto</td>
      <td>Opera 9.5</td>
      <td>Win 88+ / OSX.3+</td>
      <td>-</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Presto</td>
      <td>Opera for Wii</td>
      <td>Wii</td>
      <td>-</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Presto</td>
      <td>Nokia N800</td>
      <td>N800</td>
      <td>-</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Presto</td>
      <td>Nintendo DS browser</td>
      <td>Nintendo DS</td>
      <td>8.5</td>
      <td>C/A<sup>1</sup></td>
    </tr>
    <tr>
      <td>KHTML</td>
      <td>Konqureror 3.1</td>
      <td>KDE 3.1</td>
      <td>3.1</td>
      <td>C</td>
    </tr>
    <tr>
      <td>KHTML</td>
      <td>Konqureror 3.3</td>
      <td>KDE 3.3</td>
      <td>3.3</td>
      <td>A</td>
    </tr>
    <tr>
      <td>KHTML</td>
      <td>Konqureror 3.5</td>
      <td>KDE 3.5</td>
      <td>3.5</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Tasman</td>
      <td>Internet Explorer 4.5</td>
      <td>Mac OS 8-9</td>
      <td>-</td>
      <td>X</td>
    </tr>
    <tr>
      <td>Tasman</td>
      <td>Internet Explorer 5.1</td>
      <td>Mac OS 7.6-9</td>
      <td>1</td>
      <td>C</td>
    </tr>
    <tr>
      <td>Tasman</td>
      <td>Internet Explorer 5.2</td>
      <td>Mac OS 8-X</td>
      <td>1</td>
      <td>C</td>
    </tr>
    <tr>
      <td>Misc</td>
      <td>NetFront 3.1</td>
      <td>Embedded devices</td>
      <td>-</td>
      <td>C</td>
    </tr>
    <tr>
      <td>Misc</td>
      <td>NetFront 3.4</td>
      <td>Embedded devices</td>
      <td>-</td>
      <td>A</td>
    </tr>
    <tr>
      <td>Misc</td>
      <td>Dillo 0.8</td>
      <td>Embedded devices</td>
      <td>-</td>
      <td>X</td>
    </tr>
    <tr>
      <td>Misc</td>
      <td>Links</td>
      <td>Text only</td>
      <td>-</td>
      <td>X</td>
    </tr>
    <tr>
      <td>Misc</td>
      <td>Lynx</td>
      <td>Text only</td>
      <td>-</td>
      <td>X</td>
    </tr>
    <tr>
      <td>Misc</td>
      <td>IE Mobile</td>
      <td>Windows Mobile 6</td>
      <td>-</td>
      <td>C</td>
    </tr>
    <tr>
      <td>Misc</td>
      <td>PSP browser</td>
      <td>PSP</td>
      <td>-</td>
      <td>C</td>
    </tr>
    <tr>
      <td>Other browsers</td>
      <td>All others</td>
      <td>-</td>
      <td>-</td>
      <td>U</td>
    </tr>
    <!--Loop end-->
  </tbody>
</table>
</body>
</html>