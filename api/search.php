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

    $sql = "SELECT * FROM khach_hang WHERE ten LIKE '%$params%'OR sdt LIKE '%$params%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $khachHang = array();

        while($row = $result->fetch_assoc()) {
            array_push($khachHang, $row);
        }
        echo json_encode($khachHang);

    }
  $conn->close();
  
?>