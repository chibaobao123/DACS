<?php
	include("../session.php");
?>
<title>Tài khoản</title>
<!-- Required meta tags -->
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/common.css" />
    <link rel="stylesheet" type="text/css" href="../lib/time_table/TimeTable.css" />
    <link rel="stylesheet" type="text/css" href="../lib/date_picker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="../lib/toast/jquery.toast.min.css" />
    <link rel="stylesheet" type="text/css" href="../lib/chosen/chosen.css" />
    <link rel="shortcut icon" type="image/png" href="favicon.png"/>
<style>
body {
	background-color: #d1dcde;	
	
}

</style>
<header>
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="./userPage.php">
            <i class="fas fa-home" style="margin-right:10px; font-size:35px;"></i>
            </a>
            <form class="form-inline my-2 my-lg-0">
				<a class='nav-link text-light'  href='taikhoan.php'><i class="fas fa-user" style="margin-right:10px"></i><?php echo $_SESSION['login_user']; ?></a>
				<button class="btn btn-danger p-0"><a class="nav-link text-dark p-1"  href='logout.php'>Đăng xuất</a></button>
			</form>
        </nav>
    </header>
<br />
<section class="thongTinKhachHang container">
    
</section>

<section class="footer mt-5 mb-0 pb-0">
    <?php
        include("footer.php");
    ?>
</section>
<!-- Optional JavaScript -->
	<script src="../lib/jquery-3.4.1.js"></script>
    <script src="../lib/time_table/createjs.min.js"></script>
    <script src="../lib/time_table/TimeTable.js"></script>
    <script src="../lib/date_picker/moment.min.js"></script>
    <script src="../lib/date_picker/daterangepicker.min.js"></script>
    <script src="../lib/toast/jquery.toast.min.js"></script>
    <script src="../lib/chosen/chosen.jquery.js"></script>
    <script src="../lib/common.js"></script>
    <script src="https://kit.fontawesome.com/93ec6d166b.js" crossorigin="anonymous"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script>
$(document).ready(function() {
	thongTinKhachHang();
	function thongTinKhachHang(){
		$.ajax({
				url: "../api/thongTinKhachHang.php",
				type: "GET",
				cache: false,
				data: {
					action: "view",
				},
				success: function(json) {
					let data = $.parseJSON(json);
					
					let html = "";
					html += "<h2 class='py-3'>Thông tin khách hàng</h2>";
					for (let i = 0; i < data.length; i++) {
						html += "<div class='row'>";
						html += "<div class='col-6 form-group'><label><b>Tên khách hàng</b></label><input id='ten' type='text' name='tai_khoan' class='form-control' value='" + data[i].ten + "' /></div>"
						html += "<div class='col-6 form-group'><label><b>Tài khoản</b></label><input id='username' type='text' name='tai_khoan' class='form-control' value='" + data[i].username + "' /></div></div>"
						html += "<div class='row'>";
						html += "<div class='col-6 form-group'><label><b>Số điện thoại</b></label><input id='sdt' type='text' name='tai_khoan' class='form-control' value='" + data[i].sdt + "' /></div>";
						html += "<div class='col-6 form-group'><label><b>Email</b></label><input id='gmail' type='text' name='tai_khoan' class='form-control' value='" + data[i].email + "' /></div></div>"
						html += "<div class='row'><div class='col-6 form-group'><label><b>Mật Khẩu mới</b></label><input id='matkhaumoi1' type='password' name='tai_khoan' class='form-control'/></div><div class='col-6 form-group'><label><b>Xác nhận mật khẩu mới</b></label><input id='matkhaumoi2' type='password' name='tai_khoan' class='form-control'/></div></div><div class='row'><div class='col-12 text-right'><button id='btnDoimatkhau' class='btn btn-success'>Cập nhật thông tin</button></div></div>"
					}
					$(".thongTinKhachHang").html(html);
					$("#btnDoimatkhau").click(function() {
						var ten = $('#ten').val();
						var username = $('#username').val();
						var sdt = $('#sdt').val();
						var gmail = $('#gmail').val();
						var mk1 = $("#matkhaumoi1").val().trim();
						var mk2 = $("#matkhaumoi2").val().trim();

						console.log(mk1, mk2, ten, username, sdt, gmail);
						
						if (mk1 != mk2) {
							thongbaoloi("Hai mật khẩu bạn nhập không giống nhau!!!");
							return;
						} 
						
						if (kiemtramatkhau(mk1) && kiemtrausername(username) && kiemtraemail(gmail) && kiemtrasdt(sdt) && kiemtraten(ten)) {
							$.ajax({
								url: "../api/thongTinKhachHang.php",
								type: "POST",
								cache: false,
								data: {
									action: "sosanhmatkhau",
									username: username,
									ten : ten,
									sdt : sdt,
									gmail : gmail,
									password: mk1,
								},
								success: function(msg) {
									//alert(msg);
									if (msg == "Mật khẩu giống nhau!!!") {
										thongbaoloi("Mật khẩu mới phải khác mật khẩu cũ!!!");
									} else {
										doimatkhau(username, ten, sdt, gmail, mk1);
									}
								}
							});

						}
					});
					
					function doimatkhau(username, ten, sdt, gmail, mk1) {
						$.ajax({
							url: "../api/matkhau.php",
							type: "POST",
							cache: false,
							data: {
								action: "doimatkhau",
								username: username,
								ten : ten,
								sdt : sdt,
								gmail : gmail,
								password: mk1,
							},
							success: function(msg) {
								//alert(msg);
								if (msg.includes("thành công")) {
									location.href ='../logout.php';
								}
							}
						});
					}
				}
		})			
	}
});
</script>