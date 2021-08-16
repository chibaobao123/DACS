<?php
	session_start();
	
	if (isset($_SESSION['login_user'])) {
		// Ngược lại nếu đã đăng nhập
		$admin_number = $_SESSION['admin_number'];
		// Kiểm tra quyền của người đó có phải là admin hay không
		if ($admin_number == "1") {
			// Nếu không phải admin thì xuất thông báo
			header("location:../index.php");
			die();
		 } else {
			header("location:./userPage.php");
			die();
		}
	}
?>
<title>Đăng nhập</title>
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<link rel="stylesheet" type="text/css" href="css/common.css" />
<script src="lib/jquery-3.4.1.js"></script>
<link rel="stylesheet" type="text/css" href="lib/toast/jquery.toast.min.css" />
<script src="lib/toast/jquery.toast.min.js"></script>
<script src="lib/common.js"></script>
<style>
	body{
		background-image: url("../picture/bg-login.jpg");
		background-repeat: no-repeat;
		background-size: cover;
	}
	#loginForm{
		position: absolute;
		margin: auto;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		width: 500px;
		height: 340px;
		padding: 10px;
		border: 1px solid #000;
		border-radius: 5px;
		background: #ddd; 
		display: inline-block;
		
	}
	
	#loginForm form input{
		width:100%;
		height:40px;
		margin: 10px 0;
	}
	
	.loginBtn{
		float: right; 
		padding-top:auto;
		text-align:center;
	}
	.loginBtn input{
		height:50px;
	}
</style>

<div id="loginForm">
	<form>
		<h2 style="text-align:center;">QUẢN LÝ SÂN BÓNG ĐÁ</h2>
		<label for="ten" >
			<span style="font-size:25px; ">
				<b>Tài khoản:</b>
			</span>
		</label>
		<input type="text" id="ten" name="ten" placeholder="Nhập tên tài khoản"/>

		<label for="matkhau">
			<span style="font-size:25px;">
				<b>Mật khẩu:</b>
			</span>
		</label>
		<input type="password" id="matkhau" name="matkhau" placeholder="Nhập mật khẩu"/>	
	</form>
	<div class="loginBtn">
		<input id='btnLogin' type="button" value="Đăng nhập" >
	</div>
	
</div>

<script>
$(document).ready(function() {
	checkInputs();
	$("#btnLogin").click(function() {
		
		var u = $("#ten").val().trim();
		var p =  $("#matkhau").val().trim();
		
		if (u == "" || p == "") {
			thongbaoloi("Tên đăng nhập/Mật khẩu không được bỏ trống!!!");
			return;
		}
		
		$.ajax({
			url: "/quanlysanbong/api/dangnhap.php",
			type: "POST",
			cache: false,
			data: {
				action: "dangnhap",
				username: u,
				password: p
			},
			success: function(msg) {
				console.log(msg)
				if (msg == "1") {
					location.href = 'index.php';
					console.log(msg);
				} else if (msg == "0") {
					location.href = './forUser/userPage.php';
				} else {
					thongbaoloi(msg);
				}
				
			}
		});
	});
});
</script>
