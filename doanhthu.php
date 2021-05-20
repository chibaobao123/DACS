<title>Doanh Thu	</title>

<?php
	include("session.php");
	include("header.php");
?>
<style type="text/css">
	body {
	background-color: #d1dcde;
}
</style>
<input type="text" id="datepicker"/><br/>
<br />
<span id='tieude'></span><br />
<br />
<div id='ds_datsan'></div><br />
<script>
$(document).ready(function() {
	
	$('#datepicker').daterangepicker({
	
	}, function(start, end, label) {
		g_bat_dau = start.format("YYYY-MM-DD");
		g_ket_thuc = end.format("YYYY-MM-DD");
		$("#tieude").html("<b>Doanh thu từ ngày " + g_bat_dau + " đến " + g_ket_thuc + "</b>");
		xemDoanhThu(g_bat_dau, g_ket_thuc);
	});
});
</script>