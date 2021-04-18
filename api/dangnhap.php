<?php
	include("../config/config.php");
	session_start();
	
	if (isset($_POST['action'])) {
		if ($_POST['action'] == 'dangnhap') {
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$sql = "SELECT id FROM tai_khoan WHERE username='$username' AND password='$password'";
			$rs = mysqli_query($db, $sql);
			$count = mysqli_num_rows($rs);
			
			if ($count == 1) {
				$_SESSION['login_user'] = $username;
				echo "Đăng nhập thành công";
			} else {
				echo "Tên đăng nhập hoặc mật khẩu không đúng!";
			}
		}
	}
?>