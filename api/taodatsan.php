<?php
	include("../session.php");
	
	$ma_kh = $_POST['ma_kh'];
	$ma_san = $_POST['ma_san'];
	$bat_dau = $_POST['bat_dau'];
	$ket_thuc = $_POST['ket_thuc'];
	$don_gia = $_POST['don_gia'];
	
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
			echo "Đặt sân thành công!!!";
		} else {
			echo "Đặt sân thất bại!!!".$sql_insert;
		}
	}

	die;
?>