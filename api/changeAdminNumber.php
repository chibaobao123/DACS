<?php 

include("../config/config.php");


if (isset($_POST['action']) && $_POST['action']  == 'changeAdminNumber') 
{
    $username = $_POST['username'];
    $num = $_POST['num'];
    $ma_kh = $_POST['ma_kh'];

    $r = mysqli_query($db,"UPDATE tai_khoan SET admin_number='$num' WHERE username='$username'");
    $r = mysqli_query($db,"UPDATE khach_hang SET admin_number='$num' WHERE id='$ma_kh'");

    if($r){
        echo "Cập nhật thành công!!!";
    } else {
        echo "thất bại".$r;
    }

}

die;

?>