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
<div class="datePicker" style="margin:5px 0 20px 0;display: flex;">
	<h2 style="margin-right:10px;">Chọn khoảng thời gian :</h2>
	<input type="text" id="datepicker" style="text-align:center;align-self:center;height:30px;"/><br/>
</div>

<br />
<span id='tieude'></span><br />
<br />
<div class='ds_datsan'></div><br />
<?php
        include("footer.php");
    ?>
<script>
$(document).ready(function() {
	
	var start = moment().subtract(29, 'days');
    var end = moment();

	function cb(start, end) {
	
		var g_bat_dau =  start._d.getFullYear() + "-" + (parseInt(start._d.getMonth())+1) + "-" + start._d.getDate();

	var g_ket_thuc = end._d.getFullYear() + "-" + (parseInt(end._d.getMonth()) + 1) + "-" + end._d.getDate();

		$("#tieude").html("<b>Doanh thu từ ngày <span class='g_bat_dau'>" + g_bat_dau + "</span> đến " +  "<span class='g_ket_thuc'>" + g_ket_thuc + "</span></b>");

		console.log( g_bat_dau, g_ket_thuc);

		xemDoanhThu(g_bat_dau, g_ket_thuc);
    }

	$('#datepicker').daterangepicker({
		startDate: start,
        endDate: end,
        ranges: {
           'Hôm nay': [moment(), moment()],
           'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           '7 ngày trước': [moment().subtract(6, 'days'), moment()],
           '30 ngày trước': [moment().subtract(29, 'days'), moment()],
           'Tháng này': [moment().startOf('month'), moment().endOf('month')],
           'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
	}, cb);

	cb(start, end);

	// function(start, end, label) {
	// 	g_bat_dau = start.format("YYYY-MM-DD");
	// 	g_ket_thuc = end.format("YYYY-MM-DD");
	// 	$("#tieude").html("<b>Doanh thu từ ngày " + g_bat_dau + " đến " + g_ket_thuc + "</b>");
	// 	xemDoanhThu(g_bat_dau, g_ket_thuc);
	// });
});
</script>