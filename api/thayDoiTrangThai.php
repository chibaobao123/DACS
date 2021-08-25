<?php
	include("../config/config.php");

    if (isset($_POST['action']) && $_POST['action'] == 'change') {
        $num = $_POST['num'];
        $u = $_POST['u'];

        $r = mysqli_query($db,"UPDATE khach_hang SET soLanHuySan='$num' WHERE username='$u'");
        if($r) {
            echo "Thành công";
        } else {
            echo "Thất bại";
        }
    }
?>