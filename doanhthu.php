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

<!-- <div id="datepicker	" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 20%">
    <i class="fa fa-calendar"></i>&nbsp;
    <span></span> <i class="fa fa-caret-down"></i>
</div> -->

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
	
		var bat_dau =  start._d.getFullYear() + "-" + (parseInt(start._d.getMonth())+1) + "-" + start._d.getDate();

		var ket_thuc = end._d.getFullYear() + "-" +  (parseInt(end._d.getMonth()) + 1)  + "-" + end._d.getDate();

		$("#tieude").html("<b>Doanh thu từ ngày <span class='start'>" + bat_dau + "</span> đến " + ket_thuc + "</b>");

		console.log( bat_dau, ket_thuc, start, end);

		xemDoanhThu(bat_dau, ket_thuc);
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

	cb(start,end);

	// function(start, end, label) {
	// 	g_bat_dau = start.format("YYYY-MM-DD");
	// 	g_ket_thuc = end.format("YYYY-MM-DD");
	// 	$("#tieude").html("<b>Doanh thu từ ngày " + g_bat_dau + " đến " + g_ket_thuc + "</b>");
	// 	xemDoanhThu(g_bat_dau, g_ket_thuc);
	// });
});
</script>