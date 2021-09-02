<?php
	include("../session.php");
	
	$datsan_id = $_POST['datsan_id'];
	$user = $_SESSION['login_user'];
	$noteCancle = $user.' đã yêu cầu hủy đặt sân';

	$sql_khachhang = mysqli_query($db,"SELECT * FROM khach_hang  WHERE username = '$user' ");
	$row = $sql_khachhang->fetch_assoc();

	if($row['soLanHuySan'] >= 5) {
		echo 'bạn đã hủy sân 5 lần !!!Bạn đã vượt quá số lần hủy sân!!!';
	} else {
		$soLanHuySan = $row['soLanHuySan'] + 1;

		$sql_khachhang = mysqli_query($db, "UPDATE khach_hang SET soLanHuySan = '$soLanHuySan'  WHERE username = '$user' ");

		$sql = "UPDATE dat_san SET note = '$noteCancle'  WHERE id = '$datsan_id' ";
		mysqli_query($db, $sql);
		
		echo '1';
	}
	
	die;
?>