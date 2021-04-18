<?php
	include("session.php");
	include("header.php");
?>
<title>Tài khoản</title>
<br />
<table class='mytable'>
	<thead>
		<tr>
			<th colspan='2'>Quản lý tài khoản <span style='color:red;' id='tendangnhap'><?php echo $_SESSION['login_user'];?></span></th>
		</tr>
	</thead>
	<tr>
		<td>Mật khẩu mới:</td>
		<td><input id='matkhaumoi1' type='password' /></td>
	</tr>
	<tr>
		<td>Nhập lại khẩu mới:</td>
		<td><input id='matkhaumoi2' type='password' /></td>
	</tr>
	<tr>
		<td></td>
		<td><button id='btnDoimatkhau'>Thay đổi mật khẩu</button></td>
	</tr>
</table>

<script>
$(document).ready(function() {
	$("#btnDoimatkhau").click(function() {
		var mk1 = $("#matkhaumoi1").val().trim();
		var mk2 = $("#matkhaumoi2").val().trim();
		var u = $("#tendangnhap").text();
		
		if (mk1 != mk2) {
			thongbaoloi("Hai mật khẩu bạn nhập không giống nhau!!!");
			return;
		} 
		
		if (kiemtramatkhau(mk1)) {
			$.ajax({
				url: "/quanlysanbong/api/matkhau.php",
				type: "POST",
				cache: false,
				data: {
					action: "sosanhmatkhau",
					username: u,
					password: mk1
				},
				success: function(msg) {
					//alert(msg);
					if (msg == "Mật khẩu giống nhau!!!") {
						thongbaoloi("Mật khẩu mới phải khác mật khẩu cũ!!!");
					} else {
						doimatkhau(u, mk1);
					}
				}
			});

		}
	});
	
	function doimatkhau(username, password) {
		$.ajax({
			url: "/quanlysanbong/api/matkhau.php",
			type: "POST",
			cache: false,
			data: {
				action: "doimatkhau",
				username: username,
				password: password
			},
			success: function(msg) {
				//alert(msg);
				if (msg.includes("thành công")) {
					location.href = 'logout.php';
				}
			}
		});
	}
});
</script>