<?php
	include("session.php");
	include("header.php");
?>
<title>Tài khoản</title>
<!-- Required meta tags -->
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/common.css" />
    <link rel="stylesheet" type="text/css" href="./libForAdmin_1/time_table/TimeTable.css" />
    <link rel="stylesheet" type="text/css" href="./libForAdmin_1/date_picker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="./libForAdmin_1/toast/jquery.toast.min.css" />
    <link rel="stylesheet" type="text/css" href="./libForAdmin_1/chosen/chosen.css" />
    <link rel="shortcut icon" type="image/png" href="favicon.png"/>
<style>
body {
	background-color: #d1dcde;	
}
</style>
<br />
<section class="changePassword conteainer-fluid p-5 m-5">
    <div class="container">
        <table class='mytable ' style="background-color:white;">
            <thead>
                <tr>
                    <th colspan='2'>Quản lý tài khoản: 
                        <span style='color:#e91e63;font-size: 25px;' id='tendangnhap'><?php echo $_SESSION['login_user'];?></span>
                    </th>
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
    </div>
</section>

<section class="footer">
    <?php
        include("footer.php");
    ?>
</section>
<!-- Optional JavaScript -->
	<script src="./libForAdmin_1/jquery-3.4.1.js"></script>
    <script src="./libForAdmin_1/time_table/createjs.min.js"></script>
    <script src="./libForAdmin_1/time_table/TimeTable.js"></script>
    <script src="./libForAdmin_1/date_picker/moment.min.js"></script>
    <script src="./libForAdmin_1/date_picker/daterangepicker.min.js"></script>
    <script src="./libForAdmin_1/toast/jquery.toast.min.js"></script>
    <script src="./libForAdmin_1/chosen/chosen.jquery.js"></script>
    <script src="./libForAdmin_1/common.js"></script>
    <script src="https://kit.fontawesome.com/93ec6d166b.js" crossorigin="anonymous"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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