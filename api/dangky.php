<?php
	include("../config/config.php");
	
	if (isset($_POST['action'])) {
		if ($_POST['action'] == 'regisUser') {
			$p = $_POST['password'];
			$ten = $_POST['ten'];
			$email = $_POST['email'];
			$sdt = $_POST['sdt'];
			$num = $_POST['num'];

            $sql_tai_khoan = mysqli_query($db, "INSERT INTO tai_khoan (username,password_id,admin_number,email,sdt) VALUES ('$email',$p,$num,'$email','$sdt')");

            if($sql_tai_khoan){
                $sql_khach_hang = mysqli_query($db, "INSERT INTO khach_hang (ten,sdt,email,username) VALUES ('$ten','$sdt','$email','$email')");
                if($sql_khach_hang){
                    echo "Đăng ký thành công";
                }else{
                    echo "Đăng ký thất bại!!!";
                }
            } else {
                echo "Đăng ký thất bại!!!".$sql_tai_khoan;
            }
            
		}
		if ($_POST['action'] == 'kiemtraemail') {
			$email = $_POST['email'];
            $sdt = $_POST['sdt'];

            $rss = mysqli_query($db, "SELECT * FROM tai_khoan WHERE email='$email'");

            if (mysqli_num_rows($rss) > 0) {
                echo "Email này đã tồn tại!!!";
            }

            $rs = mysqli_query($db, "SELECT * FROM khach_hang WHERE sdt='$sdt'");

            if (mysqli_num_rows($rs) > 0) {
                echo "Số điện thoại này đã tồn tại!!!";
            }

		}
	}
	die;
?>