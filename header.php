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
<script src="https://kit.fontawesome.com/93ec6d166b.js" crossorigin="anonymous"></script>
<style>
	.menuHeader {
		position: fixed;
		top: -1px;
		width: 99%;
		background-color: #d1dcde;
		padding: 10px 0 10px 0;
		border-bottom: 1px solid #656666;
		border-right: 1px solid #656666;
		border-left: 1px solid #656666;
		border-radius: 5px;
	}

	.menuHeader a {
		padding-left: 30px;
		padding-right: 30px;
	}

	.menuHeader .taiKhoan .lk-logout a{
		color:#b0003a;
		text-decoration: none;
	}
	.menuHeader .taiKhoan .nav {
		color:black;
		text-decoration: none;
	}
	 .menuHeader .taiKhoan .lk-logout nav:hover {
		background-color: #e91e63;
		color: white;
	 }
	 .menuHeader .taiKhoan .lk-logout{
		background-color:#c5c1c1;
	 }
	 .menuHeader .taiKhoan .lk-logout:hover {
		background-color: #e91e63;

	 }
</style>
<div class="menuHeader">
	<a class='navHeader nav' href='index.php' id='navHome' style="margin-left:10px;"><i class="fas fa-home" style="margin-right:10px"></i> Trang chủ</a> 
	<a class='navHeader nav' href='khachhang.php' id='navKH'><i class="fas fa-address-book"style="margin-right:10px" ></i> Khách hàng</a>  
	<a class='navHeader nav' id='navDT' href='doanhthu.php'><i class="fas fa-cash-register" style="margin-right:10px"></i>Doanh thu</a> 
	<a class='navHeader nav' href='san.php' id='navSB'> <i class="fas fa-map" style="margin-right:10px"></i>Sân Bóng</a> 
	<div class='taiKhoan' style="float:right;    margin-right: 10px;s">
		<a class='nav'  href='taikhoan.php'><i class="fas fa-user" style="margin-right:10px"></i><?php echo $_SESSION['login_user']; ?></a>
		<div class='lk-logout' style="float:right; border:1px solid black; border-radius:5px;padding: 2px"><a  href='logout.php'>Đăng xuất</a></div>
	</div>
	
</div>
<br />
<br />
<script>
$(document).ready(function() {
	if (window.location.pathname == "/quanlysanbong/index.php") {
		$("#navHome").css("color", "#d81b60");
	}
	if (window.location.pathname == "/quanlysanbong/khachhang.php") {
		$("#navKH").css("color", "#d81b60");
	}
	if (window.location.pathname == "/quanlysanbong/doanhthu.php") {
		$("#navDT").css("color", "#d81b60");
	}
	if (window.location.pathname == "/quanlysanbong/san.php") {
		$("#navSB").css("color", "#d81b60");
	}
});
</script>