<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quanlysanbong";
    $params = $_GET["search"];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM khach_hang WHERE admin_number='0' AND ten LIKE '%$params%'OR sdt LIKE '%$params%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $khachHang = array();

        while($row = mysqli_fetch_row($result)) {
			$r['id'] = $row['0'];
			$r['ten'] = $row['1'];
			$r['sdt'] = $row['2'];
			$r['email'] = $row['3'];
			$r['username'] = $row['4'];
			$r['admin_number'] = $row['5'];
			$r['soLanHuySan'] = $row['6'];
			array_push($khachHang, $r);
		}
        echo json_encode($khachHang);

    }
  $conn->close();
  
?>