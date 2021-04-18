<?php
	define('CONFIG_FILE', 'config/config.php');
	define('DB_SERVER', 'localhost:3306');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'quanlysanbong');
	$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	mysqli_set_charset($db, 'UTF8');
?>