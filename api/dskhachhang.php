<?php
	include("../config/config.php");
	
	if (isset($_GET['action']) && $_GET['action'] == 'view') {
		$sql = "SELECT * FROM khach_hang ORDER BY ten";
		$rs = mysqli_query($db, $sql);
		$json_response = array();
		
		while($row = mysqli_fetch_row($rs)) {
			$r['id'] = $row['0'];
			$r['ten'] = $row['1'];
			$r['sdt'] = $row['2'];
			$r['email'] = $row['3'];
			$r['username'] = $row['4'];
			$r['admin_number'] = $row['5'];
			$r['soLanHuySan'] = $row['6'];
			array_push($json_response, $r);
		}
		
		echo json_encode($json_response);
	}

	if (isset($_POST['action']) && $_POST['action'] == 'edit') {
		
		$ma_kh = $_POST['ma_kh'];
		// $username_moi = $_POST['username_moi'];
		$ten_moi = trim($_POST['ten_moi']);
		$sdt_moi = trim($_POST['sdt_moi']);
		$email_moi = trim($_POST['email_moi']);

		$rs = mysqli_query($db, "SELECT * FROM khach_hang WHERE LOWER(ten)=LOWER('$ten_moi') AND id != $ma_kh");
		$trungten = false;
		if (mysqli_num_rows($rs) == 1) {
			$trungten = true;
			echo "Khách hàng <b>'".$ten_moi."'</b> đã tồn tại!!!";
		}
		
		// $rs = mysqli_query($db, "SELECT * FROM khach_hang WHERE LOWER(ten)=LOWER('$username_moi') AND id != $ma_kh");
		// $trungusername = false;
		// if (mysqli_num_rows($rs) == 1) {
		// 	$trungusername = true;
		// 	echo "Khách hàng <b>'".$username_moi."'</b> đã tồn tại!!!";
		// }

		$rs = mysqli_query($db, "SELECT * FROM khach_hang WHERE sdt='$sdt_moi' AND id != $ma_kh");
		$trungsdt = false;
		if (mysqli_num_rows($rs) == 1) {
			$trungsdt = true;
			echo " Số điện thoại <b>'".$sdt_moi."'</b> đã tồn tại!!!";
		}

		$rs = mysqli_query($db, "SELECT * FROM khach_hang WHERE email='$email_moi' AND id != $ma_kh");
		$trungemail = false;
		if (mysqli_num_rows($rs) == 1) {
			$trungemail = true;
			echo " Email <b>'".$sdt_moi."'</b> đã tồn tại!!!";
		}
		
		if (!$trungten && !$trungsdt) {
			$rs = mysqli_query($db, "UPDATE khach_hang SET ten='$ten_moi', sdt='$sdt_moi', email='$email_moi' WHERE id='$ma_kh'");
			echo "Khách hàng <b>'".$ten_moi."'</b> đã được cập nhật thành công!!!";
		}
	}

	if (isset($_POST['action']) && $_POST['action'] == 'add') {
		$ten = trim($_POST['ten']);
		$sdt = trim($_POST['sdt']);
		
		$rs = mysqli_query($db, "SELECT * FROM khach_hang WHERE LOWER(ten)=LOWER('$ten')");
		$trungten = false;
		if (mysqli_num_rows($rs) > 0) {
			$trungten = true;
			echo "Khách hàng <b>'".$ten."'</b> đã tồn tại!!!";
		}
		
		$rs = mysqli_query($db, "SELECT * FROM khach_hang WHERE sdt='$sdt'");
		$trungsdt = false;
		if (mysqli_num_rows($rs) > 0) {
			$trungsdt = true;
			echo " Số điện thoại <b>'".$sdt."'</b> đã tồn tại!!!";
		}
		
		if (!$trungten && !$trungsdt) {
			$rs = mysqli_query($db, "INSERT INTO khach_hang(ten, sdt) VALUES('$ten','$sdt')");
			echo "Khách hàng <b>'".$ten."</b> đã được thêm thành công!!!";
		}
	}

	if (isset($_POST['action']) && $_POST['action']  == 'del') 
	{
		$ma_kh = $_POST['ma_kh'];
		$username = $_POST['username'];

		$rs = mysqli_query($db, "DELETE FROM khach_hang WHERE id='$ma_kh'");
		$rs = mysqli_query($db, "DELETE FROM dat_san WHERE ma_kh='$ma_kh'");
		$rs = mysqli_query($db, "DELETE FROM tai_khoan WHERE username='$username'");
		if ($rs) {
				echo "Xóa thành công!!!";
			}
	}
	
	die;
?>