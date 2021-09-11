var g_bat_dau = "";
var g_ket_thuc = "";
const THONG_BAO = "Nhấn Enter để cập nhật, Esc để hủy!!!";
const LOADING_ORDERS = "Đang tải danh sách...";
const LOADING_TIMETBL = "Đang tải bảng...";
const HEADING_LOI_KH = "Tên/Số điện thoại chưa hợp lệ!!! ";
const HEADING_LOI_INPUT = "Lỗi nhập liệu";
const MSG_TEN_SDT = "- Tên phải có ít nhất 7 ký tự chữ cái không dấu.<br />- Số điện thoại phải đủ 10 số.<br/>- Số điện thoại phải bắt đầu bằng số '0'!!!";
const MSG_CHI_NHAP_SO = "Chỉ được nhập số!!!";
const MSG_CHI_NHAP_CHU = "Chỉ được nhập chữ cái không dấu!!!";
const MSG_SDT_0 = "Số điện thoại phải bắt đầu với số '0'.";

function getDsKhachHang() {
	$.ajax({
		url: "/quanlysanbong/api/dskhachhangForUser.php",
		type: "GET",
		cache: false,
		data: {
			action: "view"
		},
		success: function(json) {
			var data = $.parseJSON(json);
			$("#datsan_kh_foruser").html("");
			for (var i = 0; i < data.length; i++) {
				$("#datsan_kh_foruser").append(new Option(data[i].username + " (" + data[i].email + ")", data[i].id));
			}
		},
		error: function() {
			alert("Khong the lay danh sach khach hang!!!");
		}
	});
}

function veTimeTable(str) {
	var j2 = $.parseJSON(str);
	var data = {};
	var san_ids = [];
	var ten_sans = [];
	var gia = [];

	$.ajax({
		url: "/quanlysanbong/api/sanbong.php",
		type: "POST",
		data: {
			action: "view"
		},
		cache: false,
		success: function(j1) {
			var d = $.parseJSON(j1);
			for (var i = 0; i < d.length; i++) {
				san_ids.push(d[i].ma_san);
				ten_sans.push(d[i].ten_san);
				gia.push(d[i].gia);
				data[i] = {}; // new object
				data[i]["" + d[i].ten_san] = []; // new array
				var obj = {};
				var k = 0;
				var found = false;
				for (j = 0; j < j2.length; j++) {
					if (j2[j].ma_san == d[i].ma_san) {
						var t = extractHourAndMins(j2[j].bat_dau) + "-" + extractHourAndMins(j2[j].ket_thuc);
						obj[k++] = t;
						found = true;
					}
				}
				if (found) {
					data[i]["" + d[i].ten_san].push(obj);
				}
			}
			
			var obj = {
				// Beginning Time
				startTime: "05:00",
				// Ending Time
				endTime: "21:00",
				// Time to divide(minute)
				divTime: "15",
				// Time Table
				shift: data,
				// Other options
				option: {
					// workTime include time not displaying
					workTime: true,
					bgcolor: ["#00FFFF"],
					useBootstrap: false,
				}
			};

			var instance = new TimeTable(obj);
			$(".time_table").html("");
			instance.init(".time_table");
			caidatnutDatsan(san_ids, ten_sans, gia);
		}
	});
}

function tinhtiendatsan() {
	
	var dongia = parseInt($("#datsan_dongia").text());
	if (dongia == "0") {
		$("#datsan_tongtien").html("0đ");
		return;
	}
	var giobatdau = $("#datsan_batdau_gio").val();
	var gioketthuc = $("#datsan_ketthuc_gio").val();
	var phutbatdau = $("#datsan_batdau_phut").val();
	var phutketthuc = $("#datsan_ketthuc_phut").val();
	var start = parseFloat(giobatdau) + parseFloat(phutbatdau)/60;
	var end = parseFloat(gioketthuc) + parseFloat(phutketthuc)/60;
	var mins = (end - start) * 60;
	var tien = mins * dongia;
	$("#datsan_phut").html(mins);
	$("#datsan_tongtien").html(formatMoney(tien) + "đ");
}

function caidatnutDatsan(san_ids, ten_sans, gia) {
	$(".btnDatSan").each(function(i) {
		$(this).attr("ma_san", san_ids[i]);
		$(this).attr("ten_san", ten_sans[i]);
		$(this).attr("gia", gia[i]);
		$(this).attr("title", "id=" + san_ids[i]);
	});
	
	$(".btnDatSan").click(function() {
		$("#datsan_tensan").attr("ma_san", $(this).attr("ma_san"));
		$("#datsan_tensan").html($(this).attr("ten_san"));
		$("#datsan_dongia").html($(this).attr("gia"));
		var ngay_dat = getCurrentFormattedDate();
		$(".datsan_ngaydat").html(ngay_dat);
		$(".ngay_dat").html(ngay_dat);
		getDsKhachHang();
		$("#formDatSan").css("display","block");
		$("#grayscreen").css("display","block");
		tinhtiendatsan();
	});

	$("#datsan_batdau_gio, #datsan_batdau_phut").change(function() {
		var giobatdau = parseInt($("#datsan_batdau_gio").val());
		var phutbatdau = parseInt($("#datsan_batdau_phut").val());
		var phutketthuc = phutbatdau + 15;

		var gioketthuc = giobatdau;
		if (phutketthuc == 60) {
			gioketthuc++;
			phutketthuc = 0;
		}
		$("#datsan_ketthuc_gio").val(gioketthuc);
		$("#datsan_ketthuc_phut").val(phutketthuc);

		$("#datsan_ketthuc_gio option").each(function(i, e) {
			var gkt = parseInt($(e).val());
			if (gkt < gioketthuc) {
				e.disabled = true;
			} else {
				e.disabled = false;
			}
		});
		tinhtiendatsan();
	});
	
	$("#datsan_ketthuc_gio").change(function() {
		tinhtiendatsan();
	});
	
	$("#datsan_ketthuc_phut").change(function() {
		var giobatdau = parseInt($("#datsan_batdau_gio").val());
		var phutbatdau = parseInt($("#datsan_batdau_phut").val());
		var gioketthuc = parseInt($("#datsan_ketthuc_gio").val());
		var phutketthuc = parseInt($("#datsan_ketthuc_phut").val());
		if (giobatdau == gioketthuc) {
			if (phutketthuc <= phutbatdau) {
				phutketthuc = phutbatdau + 15;
				$("#datsan_ketthuc_phut").val(phutketthuc);
			}
		}
		tinhtiendatsan();
	});
}

function resetTables(){
	$(".ds_datsan").html(LOADING_ORDERS);
	$(".time_table").html(LOADING_TIMETBL);
}

function xemDsDatSan(day) {
	//console.log("day=" + day);
	resetTables();
	$.ajax({
		url: "/quanlysanbong/api/xemDatSanForUser.php",
		type: "GET",
		cache: false,
		data: {
			action: "xemdatsan",
			day: day
		},
		success: function(json) {
			console.log(json);
			var data = $.parseJSON(json);
			$(".tieudeds").html(getCurrentFormattedDate());
			
			veTableDatSan(data);
			checkInputs();
			
		},
		error: function() {
			alert("Khong the lay du lieu dat san!!!");
		}
	});
}

function xemDsDatSan_2(day) {
	//console.log("day=" + day);
	resetTables();
	$.ajax({
		url: "/quanlysanbong/api/xemDatSanForUser.php",
		type: "GET",
		cache: false,
		data: {
			action: "xemdatsan_2",
			day: day
		},
		success: function(json) {
			console.log(json);
			$(".tieudetime").html(getCurrentFormattedDate());
			checkInputs();
			veTimeTable(json);
		},
		error: function() {
			alert("Khong the lay du lieu dat san!!!");
		}
	});
}

function xemDoanhThu(start, end) {
	$.ajax({
		url: "/quanlysanbong/api/xemdatsan.php",
		type: "GET",
		cache: false,
		data: {
			action: "xemdoanhthu",
			start: start,
			end: end
		},
		success: function(json) {
			//console.log(json);
			var data = $.parseJSON(json);
			veTableDatSan(data);
		},
		error: function() {
			alert("Khong the xem doanh thu!!!");
		}
	});
}

function veTableDatSan(data) {
	var html = "";
	html += "<table class='mytable' style='width:100%; text-align: center;'>";
	html += "<thead><tr><th>#</th><th>Tên KH</th><th>SĐT</th><th>Sân</th><th>Bắt đầu</th><th>Kết thúc</th><th>Phút</th><th>Đơn giá (đồng/phút)</th><th>Tiền</th><th>Đã thanh toán</th><th>Hủy đặt sân</th></tr></thead>";
	var tong_tien = 0;
	var da_thanh_toan = 0;
	var chua_thanh_toan = 0;
	for (var i = 0; i < data.length; i++) {
		var thanh_toan = data[i].da_thanh_toan;
		if (thanh_toan == "1") {
			var status = "<img src='../images/passed.png' />";
		} else {
			var status = "<img src='../images/failed.png' />";
		}
		html += "<tr>";
		html += "<td >" + (i + 1) + "</td>";
		html += "<td class='ten_kh'>" + data[i].ten_kh + "</td>";
		html += "<td class='sdt'>" + data[i].sdt + "</td>";
		html += "<td class='ten_san'>" + data[i].ten_san + "</td>";
		html += "<td class='bat_dau'>" + data[i].bat_dau + "</td>";
		html += "<td class='ket_thuc'>" + data[i].ket_thuc + "</td>";
		
		var don_gia = data[i].don_gia;
		var start = toDateTime(data[i].bat_dau);
		var end = toDateTime(data[i].ket_thuc);
		var mins = (Math.abs(end - start)/1000)/60;
		var money = mins * don_gia;
		
		if (thanh_toan == "1") {
			da_thanh_toan += money;
		} else {
			chua_thanh_toan += money;
		}
		tong_tien += money;
		html += "<td>" + mins + "</td>";
		html += "<td>" + formatMoney(don_gia) + "</td>";
		if (thanh_toan == "1") {
			html += "<td style='font-weight:bold;color:green;'>" + formatMoney(money) + "</td>";
		} else {
			html += "<td style='font-weight:bold;color:red;'>" + formatMoney(money) + "</td>";
		}
		html += "<td><center>" + status + "</center></td>";
		
		
		html += "<td><center><button class='btnXoaDatSan btn btn-light border border-dark' datsan_id='" + data[i].datsan_id + "' bat_dau='" + data[i].bat_dau + "'><i class='fas fa-times text-danger'></i></button></center></td>";
		html += "</tr>";
	}
	html += "</table>";
	$(".ds_datsan").html(html);

	$(".btnXoaDatSan").click(function() {
		var date = new Date();
		var hoursNow = date.getHours();

		var ngayPresent = date.getDate();
		var thangPresent = date.getMonth();
		var namPresent = date.getFullYear();
		
		var datsan_id = $(this).attr("datsan_id");
		var bat_dau = $(this).attr("bat_dau");

		var dateBatDau = bat_dau.split(" ");
		var ngayThangNam = dateBatDau[0].split("-");
		var giobatdau = dateBatDau[1].split(":");

		var gio = giobatdau[0];
		var ngay = ngayThangNam[2];
		var thang = ngayThangNam[1];
		var nam = ngayThangNam[0];

		var checkHours = parseInt(gio) - parseInt(hoursNow);

		var checkNgay = parseInt(ngay) - parseInt(ngayPresent);
		var checkThang = parseInt(thang) - 1 - parseInt(thangPresent);
		var checkNam = parseInt(nam) - parseInt(namPresent);

		console.log(checkHours,checkNgay,checkThang,checkNam)

		if( checkNgay < 0 && checkThang < 0 && checkNam < 0) {
			thongbaoloi("Đã quá thời gian hủy đặt sân!!! ");
		} else if (checkNgay == 0 && checkThang == 0 && checkNam == 0 && checkHours <= 0 ) {
			thongbaoloi("Đã quá thời gian hủy đặt sân!!!")
		} else if(checkNgay == 0 && checkThang == 0 && checkNam == 0 &&  checkHours < 2) {
			thongbaoloi("Bạn chỉ được hủy đặt sân cách giờ đặt 2 tiếng !!!");
		} else if(checkThang > 0 && checkNam >= 0  || checkNam > 0 || checkNgay > 0 && checkThang == 0 && checkNam == 0 || checkNgay == 0 && checkThang == 0 && checkNam == 0 && checkHours >= 0) {
			
				xoaDatSan(datsan_id);

		}
		
		console.log(checkNgay, checkThang, checkNam, checkHours )
	});
}	

function xoaDatSan(datsan_id) {
	$.ajax({
		url: "/quanlysanbong/api/xoaDatSanForUser.php",
		type: "POST",
		cache: false,
		data: {
			datsan_id : datsan_id,
		},
		success: function(msg) {
			console.log(msg);
			if(msg == '1'){
				thongbaotot("Yêu cầu hủy đặt sân của bạn đang chờ xác nhận");
			} else {
				thongbaoloi(msg + ' bạn vui lòng liên hệ với Admin để mở lại cho bạn nhé !!! ' );
			}
		},
		error: function() {
			thongbaoloi("Khong the xoa dat san!!!");
		}
	});
}

function thanhToanDatSan(datsan_id) {
	$.ajax({
		url: "/quanlysanbong/api/thanhtoandatsan.php",
		type: "POST",
		cache: false,
		data: {
			datsan_id: datsan_id
		},
		success: function(msg) {
			if (g_bat_dau == "" && g_ket_thuc == "") {
				xemDsDatSan(getCurrentFormattedDate());
			} else {
				xemDoanhThu(g_bat_dau, g_ket_thuc);
			}
		}
	});
}

function formatMoney(num) {
	return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

function getCurrentFormattedDate() {
	var ngay = $(".datsan_ngaydat").val().split("/");
	var ngay_dat = ngay[2] + "-" + ngay[0] + "-" + ngay[1];
	return ngay_dat;
}

function getToday() {
	var today = new Date();
	return today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
}

function toDateTime(s) {
	// 2019-05-06 19:00:00
	var r = s.split(" ");
	
	var t1 = r[0].split("-");
	var year = t1[0];
	var month = t1[1] - 1;
	var day = t1[2];
	
	var t2 = r[1].split(":");
	var hour = t2[0];
	var minute = t2[1];
	var second = t2[2];
	
	//console.log(year + "," + month + "," + day + "," + hour + "," + minute + "," + second);
	return new Date(year, month, day, hour, minute, second);
}

function extractHourAndMins(s) {
	// 2019-05-06 19:00:00
	var r = s.split(" ");
	
	var t = r[1].split(":");
	var hour = t[0];
	var min = t[1];
	return hour + ":" + min;
}

function kiemtraten(ten) {
	if (ten == "" || ten.length < 7) {
		thongbaoloi(HEADING_LOI_KH, MSG_TEN_SDT);
		return false;
	}
	return true;
}

function kiemtrasdt(sdt) {
	if (sdt == "" || sdt.length < 10) {
		thongbaoloi(HEADING_LOI_KH, MSG_TEN_SDT);
		return false;
	}
	return true;
}

function kiemtratensan(ten) {
	if (ten == "") {
		thongbaoloi(HEADING_LOI_INPUT, "Tên sân không được để trống!");
		return false;
	}
	return true;
}

function kiemtramatkhau(mk) {
	if (mk.trim() == "") {
		thongbaoloi("Mật khẩu không được bỏ trống!!!");
		return false;
	}
	if (mk.trim().length < 6) {
		thongbaoloi("Mật khẩu phải nhiều hơn 6 ký tự!!!");
		return false;
	}

	return true;
}

function thongbao(msg) {
	$.toast({
		heading: 'Thông báo',
		text: msg,
		loader: false,
		icon: 'info'
	});
};

function thongbaotot(msg) {
	$.toast({
		heading: 'Thành công!!!',
		text: msg,
		loader: false,
		icon: 'success'
	});
};

function thongbaoloi(msg) {
	$.toast({
		heading: 'Lỗi',
		text: msg,
		loader: false,
		icon: 'error'
	});
};

function thongbaoloi(heading, msg) {
	$.toast({
		heading: heading,
		text: msg,
		loader: false,
		icon: 'error'
	});
};

function tailaitrang() {
	setTimeout(function() {location.reload();}, 1000);
}

function checkInputs() {
	$("input[type='text']").keypress(function(e) {
		var key = e.keyCode;
		var id = $(this).attr("id");
		var len = $(this).val().length;

		if (len == 0) {
			if (key == 32) {
				e.preventDefault();
			}
		}
		if (id.includes("ten")) {
			if (len >= 23) {
				e.preventDefault();
			}
			// allow only alphabet characters
			if ((key < 97 || key > 122) && (key < 65 || key > 90) && (key != 32) && (key != 13)) {
				thongbaoloi(HEADING_LOI_INPUT, MSG_CHI_NHAP_CHU);
				e.preventDefault();
			}
		}
		if (id.includes("sdt")) {
			if (len == 0) {
				// the first number must be '0'
				if (key != 48 && key != 13) {
					thongbaoloi(HEADING_LOI_INPUT, MSG_SDT_0);
					e.preventDefault();
				}
			}
			// allow only 10 characters for phone number
			if (len >= 10) {
				e.preventDefault();
			}
			// allow only numbers
			if ((key < 48 || key > 57) && (key != 13)) {
				thongbaoloi(HEADING_LOI_INPUT, MSG_CHI_NHAP_SO);
				e.preventDefault();
			}
		}
		if (id.includes("dongia")) {
			if (len >= 6) {
				e.preventDefault();
			}
			// allow only alphabet characters
			if (key < 48 || key > 57) {
				thongbaoloi(HEADING_LOI_INPUT, MSG_CHI_NHAP_SO);
				e.preventDefault();
			}
		}
	});
	
	$("input[type='text']").keyup(function(e) {
		var key = e.keyCode;
		var id = $(this).attr("id");
		if (id.includes("dongia")) {
			if ((key >= 48 && key <= 57) || key == 8) {
				tinhtiendatsan();
			}
		}
	});
}