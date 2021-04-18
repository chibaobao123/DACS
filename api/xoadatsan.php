<?php
	include("../session.php");
	
	$datsan_id = $_POST['datsan_id'];

	$sql = "DELETE FROM dat_san WHERE id=$datsan_id";
	mysqli_query($db, $sql);
	die;
?>