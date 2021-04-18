<?php
	include("../config/config.php");
	
	if (isset($_POST['action'])) {
		if ($_POST['action'] == 'doimatkhau') {
			$u = $_POST['username'];
			$p = $_POST['password'];
			$rs = mysqli_query($db, "UPDATE tai_khoan SET password='$p' WHERE username='$u'");
			if ($rs) {
				echo "Đổi mật khẩu thành công!!!";
			} else {
				echo "Đổi mật khẩu thành thất bại!!!";
			}
		}
		if ($_POST['action'] == 'sosanhmatkhau') {
			$u = $_POST['username'];
			$p = $_POST['password'];
			$rs = mysqli_query($db, "SELECT password FROM tai_khoan WHERE username='$u'");
			$row = mysqli_fetch_row($rs);
			if ($row['0'] == $p) {
				echo "Mật khẩu giống nhau!!!";
			}
		}
	}
	die;
?>