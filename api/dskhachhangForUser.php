<?php
	
	include("../session.php");
	
	if (isset($_GET['action']) && $_GET['action'] == 'view') {
		$user = $_SESSION['login_user'];
		$sql = "SELECT * FROM tai_khoan where username = '$user'";
		$rs = mysqli_query($db, $sql);
		$json_response = array();
		
		while($row = mysqli_fetch_row($rs)) {
			$r['id'] = $row['0'];
			$r['username'] = $row['1'];
			$r['email'] = $row['4'];
			array_push($json_response, $r);
		}
		
		echo json_encode($json_response);
	}

	if (isset($_POST['action']) && $_POST['action'] == 'edit') {
		
		$ma_kh = $_POST['ma_kh'];
		$ten_moi = trim($_POST['ten_moi']);
		$sdt_moi = trim($_POST['sdt_moi']);

		$rs = mysqli_query($db, "SELECT * FROM khach_hang WHERE LOWER(ten)=LOWER('$ten_moi') AND id != $ma_kh");
		$trungten = false;
		if (mysqli_num_rows($rs) == 1) {
			$trungten = true;
			echo "Khách hàng <b>'".$ten_moi."'</b> đã tồn tại!!!";
		}
		
		$rs = mysqli_query($db, "SELECT * FROM khach_hang WHERE sdt='$sdt_moi' AND id != $ma_kh");
		$trungsdt = false;
		if (mysqli_num_rows($rs) == 1) {
			$trungsdt = true;
			echo " Số điện thoại <b>'".$sdt_moi."'</b> đã tồn tại!!!";
		}
		
		if (!$trungten && !$trungsdt) {
			$rs = mysqli_query($db, "UPDATE khach_hang SET ten='$ten_moi', sdt='$sdt_moi' WHERE id='$ma_kh'");
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
		$rs = mysqli_query($db, "DELETE FROM khach_hang WHERE id='$ma_kh'");
		$rs = mysqli_query($db, "DELETE FROM dat_san WHERE ma_kh='$ma_kh'");
		if ($rs) {
				echo "Xóa thành công!!!";
			}
	}
	
	die;
?>