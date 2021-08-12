<!doctype html>
<html lang="en">
  <head>
    <title>Trang chủ cho người dùng</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/common.css" />
    <link rel="stylesheet" type="text/css" href="../libForUser/time_table/TimeTable.css" />
    <link rel="stylesheet" type="text/css" href="../libForUser/date_picker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="../libForUser/toast/jquery.toast.min.css" />
    <link rel="stylesheet" type="text/css" href="../libForUser/chosen/chosen.css" />
    <link rel="shortcut icon" type="image/png" href="favicon.png"/>
    <?php
	    include("../session.php");
    ?>
    <style>
        body{
            background-color: #d1dcde;
        }

        .input-note{
            border: 1px solid #515556;
            border-radius: 20px 0 0 20px;
            border-right:none;
            margin:0;
        }
        .input-note:focus-visible{
            outline: none;
        }
        .btn-send-note{
            border: 1px solid #515556;
            border-radius: 0 20px 20px 0;
            border-left:none;
            background-color: white;
            
        }
        .btn-send-note:hover{
            background-color: white;
            color: #7cd2e2;
        }

        #formDatSan {
            position:absolute;
            margin:auto;
            top:0;
            right:0;
            bottom:0;
            left:0;
            width:450px;
            height:550px;
            z-index:100;
            background:#eee;
            padding:15px;
            border:0px solid #000;
            box-shadow:5px 5px 20px #000;
            display:none;
            border-radius:10px;
            background-color: #e1f5fe;
        }
        #formDatSan td{
            vertical-align:center;
            padding-top:5px;
        }

        #grayscreen {
            width:100%;
            height:500%;
            background:#333;
            opacity:0.7;z-index:99;
            display:none;
            position:absolute;
            left:0;
            top:0;
        }
        #datsan_themkhach {
            display:block;
        }
        
    </style>
  </head>
  <body>

    <header>
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="./userPage.php">
            <i class="fas fa-home" style="margin-right:10px; font-size:35px;"></i>
            </a>
            <form class="form-inline my-2 my-lg-0">
				<a class='nav-link text-light'  href='taiKhoanUser.php'><i class="fas fa-user" style="margin-right:10px"></i><?php echo $_SESSION['login_user']; ?></a>
				<button class="btn btn-danger p-0"><a class="nav-link text-dark p-1"  href='./logout.php'>Đăng xuất</a></button>
			</form>
        </nav>
    </header>

    <section class="datSan">
        <div class="datePicker" style="margin:45px 0 20px 0;display: flex;">
            <h2 style="margin-right:10px;">Ngày được chọn:</h2>
            <input type="text" class="datsan_ngaydat" style="text-align:center;align-self:center;height:30px;"/><br/>
        </div>

        <div >
            <b>DANH SÁCH ĐẶT SÂN NGÀY <span class='tieudeds'></span></b>	
        </div>
	
        <br />
        <br />

        <div class='ds_datsan' style="background-color:white;"></div>
        <br />
        <br />

        <b>TÌNH TRẠNG ĐẶT SÂN NGÀY <span class='tieudetime'></span></b><br /><br />

        <div class="time_table" style="background-color:white;"></div> <br />
    </section>

    <section class="formDatSan">
        <div id='grayscreen'></div>
        <div id='formDatSan'>
            <b style='font-size: 18px;'>ĐẶT SÂN</b><br />
            <br />
            <table>
                <tr>
                    <td>Sân:</td>
                    <td><span id='datsan_tensan' style='font-weight:bold;color:red;'></span></td>
                </tr>
                <tr>
                    <td>Khách hàng:</td>
                    <td><select id='datsan_kh' class='chosen'></select></td>
                </tr>
                <tr>
                    <td><input type="checkbox" id='chbThemKhach' /> Thêm khách mới?</td>
                    <td>
                        <div id='datsan_themkhach' class='disabled'>
                            <table>
                                <tr>
                                    <td>Tên</td>
                                    <td><input type='text' id='datsan_them_ten' /></td>
                                </tr>
                                <tr>
                                    <td>Số điện thoại</td>
                                    <td><input type='text' id='datsan_them_sdt' /></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button id='datsan_btnthemkh'>Thêm</button></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>CHỌN NGÀY: </b>
                    </td>
                    <td>
                        <span class='ngay_dat'></span><br/>
                    
                </tr>
                <tr>
                    <td>Bắt đầu:</td>
                    <td>
                        Giờ: 
                        <select id="datsan_batdau_gio">
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                        </select>
                        Phút:
                        <select id="datsan_batdau_phut">
                            <option value="0">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Kết thúc:</td>
                    <td>
                        Giờ: 
                        <select id='datsan_ketthuc_gio'>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                        </select>
                        Phút:
                        <select id="datsan_ketthuc_phut">
                            <option value="0">00</option>
                            <option value="15" selected>15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Tổng thời gian (phút):</td>
                    <td><span id='datsan_phut'></span></td>
                </tr>
                <tr>
                    <td>Đơn giá (/phút):</td>
                    <td><span type='text' id='datsan_dongia' size='5'></span>đ</td>
                </tr>
                <tr>
                    <td>Tổng tiền:</td>
                    <td><span id='datsan_tongtien' style='color:red;font-weight:bold;'>0đ</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td><br />
                        <button class='btn btn-primary' id='datsan_ok'>Đồng ý</button>
                        <button class='btn btn-primary' id='datsan_cancel'>Hủy</button>
                    </td>
                </tr>
            </table>
        </div>
    </section>
    
    <?php
        include("footer.php");
    ?>

    <!-- Optional JavaScript -->
    <script src="../libForUser/jquery-3.4.1.js"></script>
    <script src="../libForUser/time_table/createjs.min.js"></script>
    <script src="../libForUser/time_table/TimeTable.js"></script>
    <script src="../libForUser/date_picker/moment.min.js"></script>
    <script src="../libForUser/date_picker/daterangepicker.min.js"></script>
    <script src="../libForUser/toast/jquery.toast.min.js"></script>
    <script src="../libForUser/chosen/chosen.jquery.js"></script>
    <script src="../libForUser/common.js"></script>
    <script src="https://kit.fontawesome.com/93ec6d166b.js" crossorigin="anonymous"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script>
        $(document).ready(function() {
            
            xemDsDatSan(getToday());

            $('.datsan_ngaydat').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 2019,
                maxYear: parseInt(moment().format('YYYY'), 10)
            }, function(start, end, label) {
                xemDsDatSan(start.format("YYYY-MM-DD"));
            });
            
            
            function taoDatSan(ma_kh, ma_san, bat_dau, ket_thuc, don_gia, ten_san) {
                $.ajax({
                    url: "/quanlysanbong/api/taoDatSanForUser.php",
                    type: "POST",
                    cache: false,
                    data: {
                        ma_kh : ma_kh,
                        ma_san : ma_san,
                        bat_dau : bat_dau,
                        ket_thuc : ket_thuc,
                        don_gia : don_gia,
                        ten_san: ten_san,
                    },
                    success: function(msg) {
                        if (msg.includes("trùng")) {
                            thongbaoloi("Không thể tạo đặt sân", msg);
                        } else {
                            thongbaotot(msg);
                        }
                        console.log(msg);
                        xemDsDatSan(getCurrentFormattedDate());
                    },
                    error: function() {
                        thongbaoloi("Lỗi hệ thống!!");
                    }
                });
            }
            
            $("#datsan_ok").click(function() {
                // insert into database
                var ma_kh = $("#datsan_kh").val();
                var ma_san = $("#datsan_tensan").attr("ma_san");
                var ten_san = $("#datsan_tensan").text();
                var don_gia =parseInt($("#datsan_dongia").text());
                var ngay_dat = $(".datsan_ngaydat").text();
                var bat_dau_gio = $("#datsan_batdau_gio").val();
                var bat_dau_phut = $("#datsan_batdau_phut").val();
                var ket_thuc_gio = $("#datsan_ketthuc_gio").val();
                var ket_thuc_phut = $("#datsan_ketthuc_phut").val();
                var bat_dau = ngay_dat + " " + bat_dau_gio + ":" + bat_dau_phut + ":" + "00";
                var ket_thuc = ngay_dat + " " + ket_thuc_gio + ":" + ket_thuc_phut + ":" + "00";
                if (don_gia == "") {
                    $("#datsan_dongia").val("0");
                }
                taoDatSan(ma_kh, ma_san, bat_dau, ket_thuc, don_gia, ten_san);
                $("#formDatSan").css("display","none");
                $("#grayscreen").css("display","none");
            });
            
            $("#datsan_cancel").click(function() {
                $("#formDatSan").css("display","none");
                $("#grayscreen").css("display","none");
                $("#datsan_them_ten").val("");
                $("#datsan_them_sdt").val("");
            });

            $("#datsan_btnthemkh").click(function() {
                var ten = $("#datsan_them_ten").val();
                var sdt = $("#datsan_them_sdt").val();
                if (kiemtraten(ten) && kiemtrasdt(sdt)) {
                    themKhachHang(ten, sdt);
                }
            });
            
            $("#chbThemKhach").change(function() {
                if($(this).is(":checked")) {
                    $("#datsan_themkhach").removeClass("disabled");
                } else {
                    $("#datsan_themkhach").addClass("disabled");
                }
            });
            
            function themKhachHang(ten, sdt) {
            $.ajax({
                url: "/quanlysanbong/api/dskhachhang.php",
                type: "POST",
                cache: false,
                data: {
                    action: "add",
                    ten : ten,
                    sdt : sdt
                },
                success: function(msg) {
                    if (msg.includes("đã tồn tại")) {
                        thongbaoloi(msg);
                    } else {
                        $("#datsan_them_ten").val("");
                        $("#datsan_them_sdt").val("");
                        getDsKhachHang();
                    }
                },
                error: function() {
                    alert("Khong the them khach hang moi!!!");
                }
            });
            }
        });
    </script>
  </body>
</html>