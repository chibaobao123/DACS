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
				$row = "SELECT admin_number FROM tai_khoan WHERE username='$username'";
				$result = $db->query($row);
				$rss = mysqli_fetch_assoc($result);
				if ($rss['admin_number'] == 0){
					$_SESSION['admin_number'] = 0;
					$_SESSION['login_user'] = $username;
					echo "0";
				} else {
					$_SESSION['admin_number'] = 1;
					$_SESSION['login_user'] = $username;
					echo '1';
				}
			} else {
				echo "Tên đăng nhập hoặc mật khẩu không đúng!";
			}
		}
	}
?>
