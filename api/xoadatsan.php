<?php
	include("../session.php");
	include '../PHPMailer/class.smtp.php';
	include '../PHPMailer/class.phpmailer.php';
	
	$datsan_id = $_POST['datsan_id'];
	$sdt_kh = $_POST['sdt_kh'];

	$sql = "DELETE FROM dat_san WHERE id=$datsan_id";
	$del_bill = mysqli_query($db, $sql);

	if ($del_bill)
	{
		$sql_user = "SELECT * FROM khach_hang WHERE sdt=$sdt_kh";
		$result = mysqli_query($db, $sql_user);
		$row = $result->fetch_assoc();

		$email = $row['email'];

		$nFrom = "Sân bóng đá mini";    //mail duoc gui tu dau, thuong de ten cong ty ban
			$mFrom = 'baobao631999@gmail.com';  //dia chi email cua ban 
			$mPass = 'Baobaochi123';       //mat khau email cua ban
			$nTo = 'Khách hàng đặt sân'; //Ten nguoi nhan
			$mTo =  "$email";   //dia chi nhan mail
			$mail             = new PHPMailer();
			$body             = "
			<h1>Sân bóng đá mini, kính chào.</h1>
			<p>Đây là thông tin đặt sân của bạn.</p>
			<table style='text-align:justify;border: 1px solid black;border-collapse: collapse;margin-bottom:20px'>
			  <tbody>
			  <tr style='border: 1px solid black;'>
				<th scope='row' style='padding:10px;border: 1px solid black;' >Tên Khách hàng:</th>
				<td style='border: 1px solid black;padding:10px;'>$name_user</td>
			  </tr>
			  <tr style='border: 1px solid black;'>
				<th scope='row' style='padding:10px;'>Mã sân:</th>
				<td style='border: 1px solid black;padding:10px;'>$ma_san</td>
			  </tr>
			  <tr style='border: 1px solid black;'>
				<th scope='row' style='padding:10px;'>Tên sân:</th>
				<td style='border: 1px solid black;padding:10px;'>$ten_san</td>
			  </tr>
			  <tr style='border: 1px solid black;'>
				<th scope='row' style='padding:10px' >Thời gian bắt đầu:</th>
				<td style='border: 1px solid black;padding:10px'>$bat_dau</td>
			  </tr>
			  <tr style='border: 1px solid black;'>
				<th scope='row' style='padding:10px' >Thời gian kết thúc:</th>
				<td style='border: 1px solid black;padding:10px'>$ket_thuc</td>
			  </tr>
			  <tr style='border: 1px solid black;'>
				<th scope='row' style='padding:10px'>Hotline</th>
				<td style='border: 1px solid black;padding:10px'>0708469531</td>
			  </tr>
			  <tr style='border: 1px solid black;'>
				<th scope='row' style='padding:10px'>Địa chỉ</th>
				<td style='border: 1px solid black;padding:10px'> 221 Lý Thường Kiệt, Phường 9, Quận 11, Thành phố Hồ Chí Minh</td>
			  </tr>
			  </tbody>
			  </table>
			  <div>
				  <button style='background-color: #28a745; border-color: #28a745; border:none; padding:10px; border-radius:10px; '>
					  <a href=''http://localhost/quanlysanbong/login.php'' style='text-decoration: none; color:white; border:none'>Nếu bạn muốn đặt lại, hủy sân</a>
				  </button>
			  </div>";   // Noi dung email
			$title = 'Hệ thống xác nhận hủy đặt sân của Sân bóng mini';   //Tieu de gui mail
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
		echo "Hủy sân thất bại!!!";
	}

	

	die;
?>