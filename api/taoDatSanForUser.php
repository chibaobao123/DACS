<?php
	include("../session.php");
	include '../PHPMailer/class.smtp.php';
	include '../PHPMailer/class.phpmailer.php'; 
	
	$ma_kh = $_POST['ma_kh'];
	$ma_san = $_POST['ma_san'];
	$bat_dau = $_POST['bat_dau'];
	$ket_thuc = $_POST['ket_thuc'];
	$don_gia = $_POST['don_gia'];
	$ten_san = $_POST['ten_san'];

	$name_user = $_SESSION['login_user'];
	$sql_emails = mysqli_query($db,"SELECT * FROM tai_khoan WHERE username = '$name_user'");
	$row = $sql_emails->fetch_assoc();
	
	
	$sql_checkDuplicate = "SELECT * FROM dat_san WHERE dat_san.ma_san=$ma_san AND (('$bat_dau' <= dat_san.bat_dau AND '$ket_thuc' >= dat_san.bat_dau) OR ('$bat_dau' >= dat_san.bat_dau AND '$bat_dau' <= dat_san.ket_thuc))";
	$rs = mysqli_query($db, $sql_checkDuplicate);
	$count = 0;
	if ($rs) {
		$count = mysqli_num_rows($rs);
	}
	
	if ($count != 0) {
		echo "Có ".$count." đặt sân bị trùng! Mỗi đặt sân phải cách nhau ít nhất 15 phút!";
	} else {
		$sql_insert = "INSERT INTO dat_san(ma_kh, ma_san, bat_dau, ket_thuc, da_thanh_toan, don_gia) VALUES ('$ma_kh','$ma_san','$bat_dau','$ket_thuc', '0','$don_gia')";
		$query = mysqli_query($db, $sql_insert);
		if ($query) {

			$email = $row['email'];

			$nFrom = "Sân bóng đá mini";    //mail duoc gui tu dau, thuong de ten cong ty ban
			$mFrom = 'baobao631999@gmail.com';  //dia chi email cua ban 
			$mPass = 'Baobaochi123';       //mat khau email cua ban
			$nTo = 'Khách hàng đặt sân'; //Ten nguoi nhan
			$mTo =  "$email";   //dia chi nhan mail
			$mail             = new PHPMailer();
			$body             = "<h1>Xác nhận đặt sân thành công</h1> <br/> Xin chào $name_user, <br/> Bạn đã đặt sân: <br/> Mã sân: $ma_san <br/> Tên sân: $ten_san <br/> Thời gian bắt đầu: $bat_dau <br/> Thời gian kết thúc: $ket_thuc <br/> Nêu bạn muốn hủy sân, đặt lại sân bạn có thể truy cập <a href='http://localhost/quanlysanbong/forUser/userPage.php'>tại đây</a> <br/> Bên mình chỉ có thể giữ sân 15p <br/> hotline: 0708469531 <br/> Chân thành cảm ơn. ";   // Noi dung email
			$title = 'Cấp lại mật khẩu mới Hệ thống quản lý công văn, văn bản';   //Tieu de gui mail
			$mail->IsSMTP();             
			$mail->CharSet  = "utf-8";
			$mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
			$mail->SMTPAuth   = true;    // enable SMTP authentication
			$mail->SMTPSecure = "ssl";   // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";    // sever gui mail.
			$mail->Port       = 465;         // cong gui mail de nguyen
			
			// xong phan cau hinh bat dau phan gui mail
			$mail->Username   = $mFrom;  // khai bao dia chi email
			$mail->Password   = $mPass;              // khai bao mat khau
			$mail->SetFrom($mFrom, $nFrom);
			$mail->AddReplyTo('baobao631999@gmail.com', 'Admin'); //khi nguoi dung phan hoi se duoc gui den email nay
			$mail->Subject    = $title;// tieu de email 
			$mail->MsgHTML($body);// noi dung chinh cua mail se nam o day.
			$mail->AddAddress($mTo, $nTo);

			// thuc thi lenh gui mail 
			if($mail->Send()) {
				echo "Mail xác nhận đã được gửi cho bạn !!!";
					
			} else {
					
				echo "Mail gửi không thành công !!!";
			}

			
		} else {
			echo "Đặt sân thất bại!!!".$sql_insert;
		} 
	}

	die;
?>