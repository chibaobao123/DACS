<?php
	include("../session.php");
	
	$datsan_id = $_POST['datsan_id'];

	$sql = "UPDATE dat_san SET da_thanh_toan=1 WHERE id=$datsan_id";
	mysqli_query($db, $sql);
	die;
?>