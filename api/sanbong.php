<?php
	include("../session.php");
	
	if (isset($_POST['action'])) {
		if ($_POST['action'] == 'view') {
			$sql = "SELECT * FROM san_bong ORDER BY ten";
			$rs = mysqli_query($db, $sql);
			$json_response = array();
			while($row = mysqli_fetch_row($rs)) {
				$r['ma_san'] = $row['0'];
				$r['ten_san'] = $row['1'];
				array_push($json_response, $r);
			}
			echo json_encode($json_response);
		}
		if ($_POST['action'] == 'add') {
			$ten_moi = trim($_POST['ten_moi']);
			
			$rs = mysqli_query($db, "SELECT * FROM san_bong WHERE LOWER(ten)=LOWER('$ten_moi')");
			$count = mysqli_num_rows($rs);
			if ($count > 0) {
				echo "Đã tồn tại sân '<b>".$ten_moi."</b>'!!!";
			} else	{
				$rs = mysqli_query($db, "INSERT INTO san_bong(ten) VALUES('$ten_moi')");
				if ($rs) {
					echo "Thêm sân ".$ten_moi." thành công!!!";
				}
			}
		}
		if ($_POST['action'] == 'edit') {
			$ma_san = $_POST['ma_san'];
			$ten_moi = trim($_POST['ten_moi']);
			
			$rs = mysqli_query($db, "SELECT * FROM san_bong WHERE LOWER(ten)=LOWER('$ten_moi')");
			$count = mysqli_num_rows($rs);
			if ($count > 0) {
				echo "Đã tồn tại sân '<b>".$ten_moi."</b>'!!!";
			} else {
				$sql = "UPDATE san_bong SET ten='$ten_moi' WHERE id='$ma_san'";
				$rs = mysqli_query($db, $sql);
				if ($rs) {
					echo "Đổi tên sân thành công!!!";
				}
			}
		}
		if ($_POST['action'] == 'del') {
			$ma_san = $_POST['ma_san'];
			$rs = mysqli_query($db, "DELETE FROM dat_san WHERE ma_san='$ma_san'");
			$rs = mysqli_query($db, "DELETE FROM san_bong WHERE id='$ma_san'");
			if ($rs) {
				echo "Xóa sân thành công!!!";
			}
		}
	}
	
	die;
?>