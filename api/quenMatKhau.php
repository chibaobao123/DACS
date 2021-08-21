<?php
include("../config/config.php");
include '../PHPMailer/class.smtp.php';
include '../PHPMailer/class.phpmailer.php'; 

if(isset($_POST['action']) && $_POST['action'] == 'sendPass'){
			$email = $_POST['mail_id'];

			$sql = "SELECT password_id FROM tai_khoan WHERE email='$email'";
			$rs = mysqli_query($db, $sql);
			$count = mysqli_num_rows($rs);


			if($count == 1){

				$rss = $rs->fetch_assoc();
				$pass = $rss['password_id']; 

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
					<th scope='row' style='padding:10px;border: 1px solid black;' >Email:</th>
					<td style='border: 1px solid black;padding:10px;'>$email</td>
				  </tr>
				  <tr style='border: 1px solid black;'>
					<th scope='row' style='padding:10px;'>Mật khẩu:</th>
					<td style='border: 1px solid black;padding:10px;'>$pass</td>
				  </tr>
				  </tbody>
				  </table>
				  <div>
					  <button style='background-color: #28a745; border-color: #28a745; border:none; padding:10px; border-radius:10px; '>
						  <a href=''http://localhost/quanlysanbong/login.php'' style='text-decoration: none; color:white; border:none'>Quay lại trang đăng nhập</a>
					  </button>
				  </div>"; // Noi dung email
	
				$title = 'Hệ thống xác nhận của Sân bóng mini';   //Tieu de gui mail
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
			}
		} else {
			echo "Gmail không tồn tại !!!";
		}
?>        