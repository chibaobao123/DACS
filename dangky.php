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
            .layouts {
                height: 100%;
                
            }

            .bg-layout {
                background-image: url('./picture/bg-3.png');  
            }
            .formRes{
                background: #293a3b;
            }

            #regisForm{
                width: 90%;
                height: 100%;
                padding: 10px;
		        color: white;
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
    </head>
  <body>
     <section class="header">
         <!-- Just an image -->
        <nav class="navbar navbar-dark bg-dark ">
            <a class="navbar-brand d-flex" href="./login.php" >
                <i class="fas fa-arrow-circle-left" style="margin-right:10px; font-size:35px;" ></i>
                <span class="text-left text-white px-3">Quay về trang đăng nhập</span>
            </a>
        </nav>
     </section> 

    <div class="container-fluid">
    <div class="row layout h-100 mb-0 pb-0">
        <div class="col-8 bg-layout">
        </div>
        <div class="col-4 formRes px-0">
            <div id="regisForm">
                <form class="form_1">
                    <h2 style="text-align:center;">Đăng ký người dùng</h2>
                    <label for="ten" >
                        <span style="font-size:16px; ">
                            <b>Họ và tên:</b>
                        </span>
                    </label>
                    <input type="text" class="input" id="ten" name="ten" placeholder="Nhập họ và tên"/>

                    <label for="username" >
                        <span style="font-size:16px; ">
                            <b>Username:</b>
                        </span>
                    </label>
                    <input type="text" class="input" id="username" name="username" placeholder="Nhập họ và tên"/>
                    
                    <label for="email">
                        <span style="font-size:16px;">
                            <b>Email:</b>
                        </span>
                    </label>
                    <input type="text" class="input" id="email" name="email" placeholder="Nhập Email"/>

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
                    <button id='btnDangKy' class="btn btn-primary  btn-block lightButton"type="button" value="Đăng ký" >Đăng ký
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>   
        </div>
    </div>
    </div>
    <footer class="container-fluid footer bg-dark">
        <div class="container text-center text-light pt-3 pb-3">
                ©2021 - Chí Bảo Bảo & Huỳnh Trịnh Thái Long & Phùng Ngọc Vũ Linh - HUTECH UNIVERSITY 
        </div>
    </footer>

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
                var u = $("#username").val();
     
                console.log(mk1,mk2, email, sdt, ten, u);

		        if (mk1 != mk2) {
                    thongbaoloi("Hai mật khẩu bạn nhập không giống nhau!!!");
                    return;
                } 

                if(kiemtraten(ten) && kiemtraemail(email) && kiemtramatkhau(mk1) && kiemtrasdt(sdt) && kiemtrausername(u)){
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
                            username : u,
                        },
                        success: function(msg) {
                            console.log(msg);
                            if(msg == "Tên tài khoản này đã tồn tại !!!"){
                                thongbaoloi(msg);   

                            }else if(msg == 'Email này đã tồn tại!!!'){
                                thongbaoloi(msg);

                            } else if(msg == 'Số điện thoại này đã tồn tại!!!'){
                                thongbaoloi(msg);

                            } else if(msg == 'hợp lệ'){
                                regisUser(ten, email, mk1, sdt, u); 
                                console.log('thành công');
                            }
                        }
			        });
                }

                

                function regisUser(ten, email, mk1, sdt, u){
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
                            u : u,
                        },
                        success: function(msg) {
                            console.log(msg);
                            if (msg == 'Đăng ký thất bại!!!'){
                                thongbaoloi(msg);
                             } 
                            else {
                                location.href = './login.php';
                                console.log("thành công")
                            }
                        }
			        });
                }

            })
        });
    </script>

</body>
</html>

