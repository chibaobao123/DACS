<?php
	session_start();
	
	if (isset($_SESSION['login_user'])) {
		// Ngược lại nếu đã đăng nhập
		$admin_number = $_SESSION['admin_number'];
		// Kiểm tra quyền của người đó có phải là admin hay không
		if ($admin_number == "1") {
			// Nếu không phải admin thì xuất thông báo
			header("location:index.php");
			die();
		 } else {
			header("location:./forUser/userPage.php");
			die();
		}
	}
?>
<title>Quên Mật Khẩu</title>
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/93ec6d166b.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="css/common.css" />
<script src="lib/jquery-3.4.1.js"></script>
<link rel="stylesheet" type="text/css" href="lib/toast/jquery.toast.min.css" />
<script src="lib/toast/jquery.toast.min.js"></script>
<script src="lib/common.js"></script>
<style>
	body{
		background-image: url("./picture/bg-3.png");
		background-repeat: no-repeat;
		background-size: cover;
	}
	#loginForm{
		position: absolute;
		margin: auto;
		top: 100px;
		left: 250px;
		width: 500px;
		height: 400px;
		padding: 10px;
		border-radius: 5px;
		background: #293a3b; 
		display: inline-block;
		color: white;
		
	}
	
	#loginForm form input{
		width:100%;
		height:40px;
		margin: 10px 0;
	}
	
	.loginBtn{
		float: right; 
		padding-top:auto;
		text-align:center;
	}


	.lightButton{
    display: inline-block;
    position: relative;
    text-decoration: none;
    font-size: 16px;
    color: #2196f3;
    padding: 10px 20px;
    text-transform: uppercase;
    letter-spacing: 5px;
    overflow: hidden;
    transition: 0.2s;
    margin-right: 20px;
	border: none;
	background:none;
}
.lightButton:hover{
    color: #255784;
    background: #2196f3;
    box-shadow: 0 0 40px #2196f3,0 0 40px #2196f3,0 0 40px #2196f3,0 0 40px #2196f3;
    transition-delay: 1s;
}
.lightButton span{
    position: absolute;
    display: block;
}
.lightButton span:nth-child(1){
    top: 0;
    left: -100%;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, #2196f3);
}
.lightButton:hover span:nth-child(1){
    left: 100%;
    transition: 1s;
}
.lightButton span:nth-child(2){
    right: 0;
    top: -100%;
    width: 2px;
    height: 100%;
    background: linear-gradient(180deg, transparent, #2196f3);
}
.lightButton:hover span:nth-child(2){
    top: 100%;
    transition: 1s;
    transition-delay: 0.25s;
}
.lightButton span:nth-child(3){
    bottom: 0;
    right: -100%;
    width: 100%;
    height: 2px;
    background: linear-gradient(270deg, transparent, #2196f3);
}
.lightButton:hover span:nth-child(3){
    right: 100%;
    transition: 1s;
    transition-delay: 0.5s;
}
.lightButton span:nth-child(4){
    left: 0;
    bottom: -100%;
    width: 2px;
    height: 100%;
    background: linear-gradient(360deg, transparent, #2196f3);
}
.lightButton:hover span:nth-child(4){
    bottom: 100%;
    transition: 1s;
    transition-delay: 0.75s;
}

</style>
<section class="header">
         <!-- Just an image -->
        <nav class="navbar navbar-dark bg-dark">
			<div class="">
				<a class="navbar-brand d-flex" href="./login.php" >
                	<i class="fas fa-arrow-circle-left" style="margin-right:10px; font-size:35px;" ></i>
					<span class="text-left text-white px-3">Quay về trang đăng nhập</span>
				</a>
			</div>
			<form class="form-inline my-2 my-lg-0">

				<a class="navbar-brand d-flex" href="./dangky.php" >
					<span class="text-left text-white px-3">Tới trang đăng ký người dùng</span>
					<i class="fas fa-arrow-circle-right" style="margin-right:10px; font-size:35px;" ></i>
				</a>
    		</form>

        </nav>
     </section> 
<div id="loginForm" >
	<form class="quen_mk">
		<h2 class="my-3" style="text-align:center;">Cấp lại mật khẩu</h2>
		<label for="email_cap_mk" >
			<span style="font-size:25px; ">
				<b> Địa chỉ email:</b>
			</span>
		</label>
		<input type="text" id="email_cap_mk" name="email_cap_mk" placeholder="Nhập tài khoản email"/>
	</form>


	<div class="loginBtn">
		<button id='btnSend' class="lightButton" >
			Gửi mail
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</button>
		<button id='btnLogin_back' class="lightButton" >
			<a href="./login.php" >Quay lại đăng nhập<a>
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</button>
	</div>
	
</div>

<script>
$(document).ready(function() {
	$("#btnSend").click(function(){
		var mail_id = $('#email_cap_mk').val();
		console.log(mail_id);

		if(kiemtraemail(mail_id)){
				$.ajax({
				url: "/quanlysanbong/api/quenMatKhau.php",
				type: "POST",
				cache: false,
				data: {
					action: "sendPass",
					mail_id: mail_id,
				},
				success: function(msg) {
					console.log(msg);
					if(msg == 1)
					{
						thongbaotot("Kiểm tra mail và đăng nhập lại bạn nhé !!!");
					} 
					else if (msg == 2) 
					{
						thongbaoloi("Mail gửi không thành công !!! Có thể là do lỗi hệ thống bạn hãy thử lại nhé !!!");
					} 
					else if (msg == 3) 
					{
						thongbaoloi('Gmail không tồn tại !!!');
					} else {
						thongbaoloi('Lỗi hệ thống')
					}
				}
			})
		}
	});
})	
</script>
