<?php
	include("../session.php");

	if (isset($_GET['action'])) {
		$sql = "";
		if ($_GET['action']=='xemdatsan') {
			$day = $_GET['day'];
			$sql = "SELECT khach_hang.ten as 'ten_kh', khach_hang.sdt, san_bong.ten, dat_san.bat_dau, dat_san.ket_thuc, dat_san.id, dat_san.da_thanh_toan, dat_san.don_gia, dat_san.ma_san FROM dat_san, khach_hang, san_bong WHERE dat_san.ma_kh=khach_hang.id AND dat_san.ma_san=san_bong.id AND (dat_san.bat_dau BETWEEN '$day 00:00:00' AND '$day 23:59:59') ORDER BY san_bong.ten, dat_san.bat_dau";
		} else if ($_GET['action']=='xemdoanhthu') {
			$bat_dau = $_GET['start'];
			$ket_thuc = $_GET['end'];
			$sql = "SELECT khach_hang.ten as 'ten_kh', khach_hang.sdt, san_bong.ten, dat_san.bat_dau, dat_san.ket_thuc, dat_san.id, dat_san.da_thanh_toan, dat_san.don_gia, dat_san.ma_san FROM dat_san, khach_hang, san_bong WHERE dat_san.ma_kh=khach_hang.id AND dat_san.ma_san=san_bong.id AND (dat_san.bat_dau BETWEEN '$bat_dau 00:00:00' AND '$ket_thuc 23:59:59') ORDER BY dat_san.bat_dau";
		}

		$rs = mysqli_query($db, $sql);
		$json_response = array();
		
		while($row = mysqli_fetch_row($rs)) {
			$r['ten_kh'] = $row['0'];
			$r['sdt'] = $row['1'];
			$r['ten_san'] = $row['2'];
			$r['bat_dau'] = $row['3'];
			$r['ket_thuc'] = $row['4'];
			$r['datsan_id'] = $row['5'];
			$r['da_thanh_toan'] = $row['6'];
			$r['don_gia'] = $row['7'];
			$r['ma_san'] = $row['8'];
			array_push($json_response, $r);
		}
		echo json_encode($json_response);
	}
	
		// ket thuc tra ve du lieu, stop khong chay tiep
		die;
?>