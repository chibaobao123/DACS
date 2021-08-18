<!doctype html>
<html lang="en">
    <head>
        <title>Đăng ký người dùng</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <link rel="shortcut icon" type="image/png" href="favicon.png"/>
        <link rel="stylesheet" type="text/css" href="css/common.css" />
        <link rel="stylesheet" type="text/css" href="lib/toast/jquery.toast.min.css" />


        <style>
            body {
                height: 100%;
                background-attachment: fixed;
                background-image: url('./picture/bg-login.jpg');    
                background-repeat: no-repeat;
		        background-size: cover;
                
            }
            #regisForm{
		position: absolute;
		margin: auto;
		top: 80px;
		right: 0;
		bottom: 0;
		left: 0;
		width: 500px;
		height: 650px;
		padding: 10px;
		border: 1px solid #000;
		border-radius: 10px;
		background: #ddd; 
		display: inline-block;
		
	}
	
	#regisForm form .input{
		width:100%;
		height:40px;
		margin: 5px 0;
	}
	
	.regisBtn{
		padding-top:auto;
		text-align:center;
        width: 100%;
	}
	.regisBtn input{
		height:50px;
        width: 100%;
	}
        </style>
    </head>
  <body>
     <section class="header">
         <!-- Just an image -->
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand d-flex" href="./login.php" >
                <i class="fas fa-arrow-circle-left" style="margin-right:10px; font-size:35px;" ></i>
                <span class="text-left text-white px-3">Quay về trang đăng nhập</span>
            </a>
        </nav>
     </section> 
    
     <section class="form_regis">
        <div id="regisForm">
            <form class="form_1">
                <h2 style="text-align:center;">Đăng ký người dùng</h2>
                <label for="ten" >
                    <span style="font-size:16px; ">
                        <b>Họ và tên:</b>
                    </span>
                </label>
                <input type="text" class="input" id="ten" name="ten" placeholder="Nhập họ và tên"/>
                
                <label for="email">
                    <span style="font-size:16px;">
                        <b>Email:</b>
                    </span>
                </label>
                <input type="text" class="input" id="email" name="email" placeholder="Nhập Email"/>
                
                <label for="email">
                    <span style="font-size:16px;">
                        <b>Bạn là:</b>
                    </span>
                </label> <br />

                <input type="radio" id="user" name="btnRadio" value="0">
                <span for="user">người dùng</span><br />
                <input type="radio" id="adimin" name="btnRadio" value="1">
                <span for="adimin">Quản lý</span><br />
                
                <div id="check_pass " class="d-none">
                        <label for='pass_admin' >
                            <span style='font-size:16px;'>
                                <b>Mã Admin:</b>
                            </span>
                        </label>
                        <input type='text' class='input' id='pass_admin' name='pass_admin' placeholder='Nhập mật khẩu của Admin'/>
                </div>

                <label for="sdt">
                    <span style="font-size:16px;">
                        <b>Số điện thoại:</b>
                    </span>
                </label>
                <input type="text" class="input" id="sdt" name="sdt" placeholder="Nhập số điện thoại"/>
                
                <label for="matkhau_1">
                    <span style="font-size:16px;">
                        <b>Mật khẩu:</b>
                    </span>
                </label>
                <input type="password" class="input" id="matkhau_1" name="matkhau_1" placeholder="Nhập mật khẩu"/>

                <label for="matkhau_2">
                    <span style="font-size:16px;">
                        <b>Xác nhận mật khẩu:</b>
                    </span>
                </label>
                <input type="password" class="input" id="matkhau_2" name="matkhau_2" placeholder="Nhập lại mật khẩu"/>

            </form>
            <div class="regisBtn my-3">
                <button id='btnDangKy' class="btn btn-primary  btn-block"type="button" value="Đăng ký" >Đăng ký</button>
            </div>
            
            <form class="form_2 d-none">
                <label for="matkhau_2">
                    <span style="font-size:16px;">
                        <b>Mật khẩu Admin:</b>
                    </span>
                </label>
                <input type="password" class="input" id="matkhau_3" name="matkhau_3" placeholder="Nhập mật khẩu"/>

                <button id='btnDangKy_1' class="btn btn-primary  btn-block"type="button" value="Đăng ký" >Xác nhận</button>
            </form>

        </div>   
     </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="./lib/jquery-3.4.1.js"></script>
    <script src="./lib/time_table/createjs.min.js"></script>
    <script src="./lib/time_table/TimeTable.js"></script>
    <script src="./lib/date_picker/moment.min.js"></script>
    <script src="./lib/date_picker/daterangepicker.min.js"></script>
    <script src="./lib/toast/jquery.toast.min.js"></script>
    <script src="./lib/chosen/chosen.jquery.js"></script>
    <script src="./lib/common.js"></script>
    <script src="https://kit.fontawesome.com/93ec6d166b.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            $('#btnDangKy').click(function() {
                var mk1 = $("#matkhau_1").val().trim();
                var mk2 = $("#matkhau_2").val().trim();
                var sdt = $("#sdt").val();
                var email = $("#email").val();
                var ten = $("#ten").val();
                var num

                var checkbox = document.getElementsByName("btnRadio");
                for (var i = 0; i < checkbox.length; i++){
                    if (checkbox[i].checked === true){
                        num = checkbox[i].value;
                    
                    }
                }

                console.log(mk1,mk2, email, sdt, ten, num);

		        if (mk1 != mk2) {
                    thongbaoloi("Hai mật khẩu bạn nhập không giống nhau!!!");
                    return;
                } 

                if(kiemtraten(ten) && kiemtraemail(email) && kiemtramatkhau(mk1) && kiemtrasdt(sdt) ){
                    $.ajax({
                        url: "./api/dangky.php",
                        type: "POST",
                        cache: false,
                        data: {
                            action : "kiemtraemail",
                            ten : ten,
                            email : email,
                            password: mk1,
                            sdt : sdt,
                        },
                        success: function(msg) {
                            console.log(msg);
                            if(msg == "Email này đã tồn tại!!!"){
                                thongbaoloi(msg);   
                            }
                            else if(msg == 'Số điện thoại này đã tồn tại!!!'){
                                thongbaoloi(msg);
                            }
                             else {
                                checkAdmin(ten, email, mk1, sdt, num); 
                                console.log('thành công');
                            }
                        }
			        });
                }

                function checkAdmin(ten, email, mk1, sdt, num) {
                    if (num == 0) {
                        regisUser(ten, email, mk1, sdt, num);
                    } else if (num == 1) {
                        $('.form_2').removeClass("d-none");
                        $(".form_1").addClass(" d-none");
                        $(".regisBtn").addClass(" d-none");
                        $("#btnDangKy_1").click(function () {
                            var pass = $("#matkhau_3").val();
                            if( pass == "123456789"){
                                regisUser(ten, email, mk1, sdt, num);
                            } else {
                                thongbaoloi("Mật khẩu sai vui lòng nhập lại !!!");
                            }
                        })
                    } else {
                        thongbaoloi("Đăng ký thất bại!!!");
                    }
                }

                function regisUser(ten, email, mk1, sdt, num){
                    $.ajax({
                        url: "./api/dangky.php",
                        type: "POST",
                        cache: false,
                        data: {
                            action : "regisUser",
                            ten : ten,
                            email : email,
                            password: mk1,
                            sdt : sdt,
                            num : num,
                        },
                        success: function(msg) {
                            console.log(msg);
                            if (msg == 'Đăng ký thất bại!!!'){
                                thongbaoloi(msg);
                             } 
                            else {
                                location.href = './login.php';
                            }
                        }
			        });
                }

            })
        });
    </script>

</body>
</html>

