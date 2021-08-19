<?php
	include("../session.php");
	
	$datsan_id = $_POST['datsan_id'];
    $note = $_POST['noteCancle'];
	$user = $_SESSION['login_user'];
	$noteCancle = $user.' đã yêu cầu hủy sân';

	$sql = "UPDATE dat_san SET note = '$noteCancle'  WHERE id = '$datsan_id' ";
	mysqli_query($db, $sql);
	die;
?>