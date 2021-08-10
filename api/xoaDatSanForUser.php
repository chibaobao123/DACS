<?php
	include("../session.php");
	
	$datsan_id = $_POST['datsan_id'];
    $noteCancle = $_POST['noteCancle'];

	$sql = "UPDATE dat_san SET note = '$noteCancle'  WHERE id = '$datsan_id' ";
	mysqli_query($db, $sql);
	die;
?>