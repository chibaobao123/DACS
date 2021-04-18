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
		url: "/quanlysanbong/api/dskhachhang.php",
		type: "GET",
		cache: false,
		data: {
			action: "view"
		},
		success: function(json) {
			var data = $.parseJSON(json);
			$("#datsan_kh").html("");
			for (var i = 0; i < data.length; i++) {
				$("#datsan_kh").append(new Option(data[i].ten + " (" + data[i].sdt + ")", data[i].id));
			}
			$("#datsan_kh").chosen();
			$("#datsan_kh").trigger('chosen:updated');
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
			$("#time_table").html("");
			instance.init("#time_table");
			caidatnutDatsan(san_ids, ten_sans);
		}
	});

/*
	for (var i = 0; i < 8; i++) {
		data[i] = {}; // new object
		data[i]["Sân số " + (i + 1)] = []; // new array
		var obj = {};
		var k = 0;
		var found = false;
		for (j = 0; j < json.length; j++) {
			if (json[j].ma_san == (i + 1)) {
				var t = extractHourAndMins(json[j].bat_dau) + "-" + extractHourAndMins(json[j].ket_thuc);
				obj[k++] = t;
				found = true;
			}
		}
		if (found) {
			data[i]["Sân số " + (i + 1)].push(obj);
		}
	}
	console.log(data);*/
}

function tinhtiendatsan() {
	var dongia = $("#datsan_dongia").val();
	if (dongia == "") {
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

function caidatnutDatsan(san_ids, ten_sans) {
	$(".btnDatSan").each(function(i) {
		$(this).attr("ma_san", san_ids[i]);
		$(this).attr("ten_san", ten_sans[i]);
		$(this).attr("title", "id=" + san_ids[i]);
	});
	
	$(".btnDatSan").click(function() {
		$("#datsan_tensan").attr("ma_san", $(this).attr("ma_san"));
		$("#datsan_tensan").html($(this).attr("ten_san"));
		var ngay_dat = getCurrentFormattedDate();
		$("#datsan_ngaydat").html(ngay_dat);
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
	$("#ds_datsan").html(LOADING_ORDERS);
	$("#time_table").html(LOADING_TIMETBL);
}

function xemDsDatSan(day) {
	//console.log("day=" + day);
	resetTables();
	$.ajax({
		url: "/quanlysanbong/api/xemdatsan.php",
		type: "GET",
		cache: false,
		data: {
			action: "xemdatsan",
			day: day
		},
		success: function(json) {
			var data = $.parseJSON(json);
			$("#tieudeds").html(getCurrentFormattedDate());
			$("#tieudetime").html(getCurrentFormattedDate());
			veTableDatSan(data);
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
	html += "<table class='mytable'>";
	html += "<thead><tr><th>#</th><th>Tên KH</th><th>SĐT</th><th>Sân</th><th>Bắt đầu</th><th>Kết thúc</th><th>Phút</th><th>Đơn giá (/phút)</th><th>Tiền</th><th>Đã thanh toán</th><th>Thanh toán</th><th>Xóa</th></tr></thead>";
	var tong_tien = 0;
	var da_thanh_toan = 0;
	var chua_thanh_toan = 0;
	for (var i = 0; i < data.length; i++) {
		var thanh_toan = data[i].da_thanh_toan;
		if (thanh_toan == "1") {
			var status = "<img src='images/passed.png' />";
		} else {
			var status = "<img src='images/failed.png' />";
		}
		html += "<tr>";
		html += "<td>" + (i + 1) + "</td>";
		html += "<td>" + data[i].ten_kh + "</td>";
		html += "<td>" + data[i].sdt + "</td>";
		html += "<td>" + data[i].ten_san + "</td>";
		html += "<td>" + data[i].bat_dau + "</td>";
		html += "<td>" + data[i].ket_thuc + "</td>";
		
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
		html += "<td>" + formatMoney(don_gia) + "đ</td>";
		if (thanh_toan == "1") {
			html += "<td style='font-weight:bold;color:green;'>" + formatMoney(money) + "đ</td>";
		} else {
			html += "<td style='font-weight:bold;color:red;'>" + formatMoney(money) + "đ</td>";
		}
		html += "<td><center>" + status + "</center></td>";
		if (thanh_toan == "0") {
			html += "<td><button class='btnThanhToan' datsan_id='" + data[i].datsan_id + "'>Thanh toán</button></td>";
		} else {
			html += "<td><button disabled class='btnThanhToan' datsan_id='" + data[i].datsan_id + "'>Thanh toán</button></td>";
		}
		
		html += "<td><button class='btnXoaDatSan' datsan_id='" + data[i].datsan_id + "'>Xóa</button></td>";
		html += "</tr>";
	}
	html += "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><b>Đã thanh toán</b></td><td style='font-weight:bold;color:green;'>" + formatMoney(da_thanh_toan) + "đ</td><td></td><td></td><td></td></tr>";
	html += "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><b>Chưa thanh toán</b></td><td style='font-weight:bold;color:red;'>" + formatMoney(chua_thanh_toan) + "đ</td><td></td><td></td><td></td></tr>";
	html += "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><b>Tổng tiền</b></td><td style='font-weight:bold;color:blue;'>" + formatMoney(tong_tien) + "đ</td><td></td><td></td><td></td></tr>";
	html += "</table>";
	$("#ds_datsan").html(html);
	
	$(".btnThanhToan").click(function() {
		var xac_nhan = confirm("Thanh toán đặt sân?");
		if (xac_nhan) {
			var datsan_id = $(this).attr("datsan_id");
			thanhToanDatSan(datsan_id);
		}
	});
	
	$(".btnXoaDatSan").click(function() {
		var xac_nhan = confirm("Bạn có thật sự muốn xóa đặt sân?");
		if (xac_nhan) {
			xoaDatSan($(this).attr("datsan_id"));
		}
		
	});
}

function xoaDatSan(datsan_id) {
	$.ajax({
		url: "/quanlysanbong/api/xoadatsan.php",
		type: "POST",
		cache: false,
		data: {
			datsan_id : datsan_id
		},
		success: function(msg) {
			if (g_bat_dau == "" && g_ket_thuc == "") {
				xemDsDatSan(getCurrentFormattedDate());
			} else {
				xemDoanhThu(g_bat_dau, g_ket_thuc);
			}
		},
		error: function() {
			alert("Khong the xoa dat san!!!");
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
	var ngay = $("#datepicker").val().split("/");
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