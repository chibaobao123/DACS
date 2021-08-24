<?php
	include("../config/config.php");
	session_start();

	if (!isset($_SESSION['login_user'])) {
		header("location:../login.php");
		die();
	}; 

	// if (isset($_SESSION['login_user'])) {
	// 	if($_SESSION['admin_number'] == 1) {
	// 		header("location:index.php");
	// 	} else {
	// 		header("location:userPage.php");
	// 	}
	// };

?>