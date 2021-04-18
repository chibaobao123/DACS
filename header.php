<script src="lib/jquery-3.4.1.js"></script>
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="lib/time_table/TimeTable.css" />
<script src="lib/time_table/createjs.min.js"></script>
<script src="lib/time_table/TimeTable.js"></script>
<link rel="stylesheet" type="text/css" href="lib/date_picker/daterangepicker.css" />
<script src="lib/date_picker/moment.min.js"></script>
<script src="lib/date_picker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="lib/toast/jquery.toast.min.css" />
<script src="lib/toast/jquery.toast.min.js"></script>
<link rel="stylesheet" type="text/css" href="lib/chosen/chosen.css" />
<script src="lib/chosen/chosen.jquery.js"></script>
<script src="lib/common.js"></script>
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<style>
	.menuHeader a {
		padding-left: 20px;
		padding-right: 20px;
	}
</style>
<div class="menuHeader">
	<a class='nav' href='index.php' id='navHome'>Trang chủ</a> | <a class='nav' href='khachhang.php' id='navKH'>Khách hàng</a> | <a class='nav' id='navDT' href='doanhthu.php'>Doanh thu</a> | <a class='nav' href='san.php' id='navSB'>Sân Bóng</a> | <span class='nav' style='padding-left :20px'> Xin chào </span> <a href='taikhoan.php'><b><?php echo $_SESSION['login_user']; ?></b></a> (<a style='color:red;' href='logout.php'>Logout</a>)
</div>
<br />
<br />
<script>
$(document).ready(function() {
	if (window.location.pathname == "/quanlysanbong/index.php") {
		$("#navHome").css("color", "red");
	}
	if (window.location.pathname == "/quanlysanbong/khachhang.php") {
		$("#navKH").css("color", "red");
	}
	if (window.location.pathname == "/quanlysanbong/doanhthu.php") {
		$("#navDT").css("color", "red");
	}
	if (window.location.pathname == "/quanlysanbong/san.php") {
		$("#navSB").css("color", "red");
	}
});
</script>