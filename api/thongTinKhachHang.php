<?php
	include("../session.php");
	
	if (isset($_GET['action']) && $_GET['action'] == 'view') {
        $user = $_SESSION['login_user'];

		$sql = "SELECT * FROM khach_hang WHERE username='$user'";
		$rs = mysqli_query($db, $sql);
		$json_response = array();
		
		while($row = mysqli_fetch_row($rs)) {
			$r['ten'] = $row['1'];
			$r['sdt'] = $row['2'];
			$r['email'] = $row['3'];
			$r['username'] = $row['4'];
			$r['admin_number'] = $row['5'];
			array_push($json_response, $r);
		}
		
		echo json_encode($json_response);
	}

    if (isset($_POST['action']) && $_POST['action'] == 'sosanhmatkhau'){
        $u = $_POST['username'];
        $p = $_POST['password'];
        $rs = mysqli_query($db, "SELECT password_id FROM tai_khoan WHERE username='$u'");
        $row = mysqli_fetch_row($rs);
        if ($row['0'] == $p) {
            echo "Mật khẩu giống nhau!!!";
        }
    }

    if (isset($_POST['action']) && $_POST['action'] == 'doimatkhau'){
        $u = $_POST['username'];
        $p = $_POST['password'];
        $ten = $_POST['ten'];
        $sdt = $_POST['sdt'];
        $gmail = $_POST['gmail
        '];

        $rs = mysqli_query($db, "UPDATE tai_khoan SET password_id='$p', username='$username', email='$gmail', sdt='$sdt'  WHERE username='$u'");

        $rs = mysqli_query($db, "UPDATE khach_hang SET username='$username', email='$gmail', sdt='$sdt', ten='$ten' WHERE username='$u'");

        if ($rs) {
            echo "Đổi mật khẩu thành công!!!";
        } else {
            echo "Đổi mật khẩu thành thất bại!!!";
        }
    }

    die;
?>    