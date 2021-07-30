<title>Doanh Thu</title>

<?php
	include("session.php");
	include("header.php");
?>
<style type="text/css">
	body {
	background-color: #d1dcde;
}
</style>
<div class="datePicker" style="margin:45px 0 20px 0;display: flex;">
	<h2 style="margin-right:10px;">Chọn khoảng thời gian :</h2>
	<input type="text" id="datepicker" style="text-align:center;align-self:center;height:30px;"/><br/>
</div>
<br />
<span id='tieude'></span><br />
<br />
<div id='ds_datsan'></div><br />
<script>
$(document).ready(function() {
	
	$('#datepicker').daterangepicker({
	
	}, 
	function(start, end, label) {
		g_bat_dau = start.format("YYYY-MM-DD");
		g_ket_thuc = end.format("YYYY-MM-DD");
		$("#tieude").html("<b>Doanh thu từ ngày " + g_bat_dau + " đến " + g_ket_thuc + "</b>");
		xemDoanhThu(g_bat_dau, g_ket_thuc);
	});
});
</script>