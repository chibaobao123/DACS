<title>Khách Hàng</title>
<script src="https://kit.fontawesome.com/93ec6d166b.js" crossorigin="anonymous"></script>
<?php
	include("session.php");
	include("header.php");
?>
<style>
body {
	background-color: #00bcd4;	
	
}
.addCusBar input[type=text] {
	height:25px;
    border: 1px solid #ccc;  
}
.addCusBar .btn-search {
	float: right;
	font-size: 22px;
	margin-left: 10px;
}
#tblKhachHang table{width:50%;}
#tblKhachHang table td{vertical-align:top;}
</style>
<div class="addCusBar">
	Tên: <input type='text' id='ten-moi' /> 
	Số điện thoại: <input id='sdt-moi' type='text' /> 
	<button id='btn-add'>Thêm</button>  
	<button class='btn-search'><i class="fas fa-search"></i></button>
	<input style='float: right; width:250px; height: 30px;' type="text" placeholder="Tìm kiếm...." name="val_search" value=""/>
</div>


<br />
<br />
<div id='holdSearch' style="display:none">
	<h1>Kết quả tìm kiếm</h1>
	<div id='searchPlace'></div>
</div>

<div id='hold'>
	<h1>Danh sách khách hàng</h1>
	<div id='tblKhachHang'></div>
</div>

<script>
	$(document).ready(function() {
		
		taoDsKhachHang();
		function taoDsKhachHang() {
			$.ajax({
				url: "/quanlysanbong/api/dskhachhang.php",
				type: "GET",
				cache: false,
				data: {
					action: "view",
				},
				success: function(json) {
					let data = $.parseJSON(json);
					let html = "";
					html += "<table class='mytable' style='width: 100%;text-align: center;background-color:white;'>";
					html += "<thead><tr><th>ID</th><th>Tên khách hàng</th><th>Số điện thoại</th><th>Sửa</th><th>Xóa</th></tr></thead>";
					for (let i = 0; i < data.length; i++) {
						html += "<tr>";
						html += "<td>" + data[i].id + "</td><td>" + data[i].ten + "</td><td>" + data[i].sdt + 
						"</td><td><center><button class='btn-edit' ma_kh='" + data[i].id +"' order='" + (i + 1) + "'>Sửa</button></center></td>"+
						"</td><td><center><button class='btn-del' ma_kh='" + data[i].id +"' order='" + (i + 1) + "'>Xóa</button></center></td>";
						html += "</tr>";
					}
					html += "</table>";
					$("#tblKhachHang").html(html);
					$(".btn-search").click(function(){
						var val_search = $(this).attr("val_search");
						$("#holdSearch").css("display","block");
						searchCus(val_search);
					})
					$(".btn-del").click(function(){
						var ma_kh = $(this).attr("ma_kh");
						var xac_nhan = confirm("Bạn có chắc muốn xóa không?");
							if (xac_nhan) {
								xoaKh(ma_kh);
							}
					});

					$(".btn-edit").click(function() {
						$(this).attr("disabled", "disabled");
						var order = $(this).attr("order");
						var ma_kh = $(this).attr("ma_kh");
						var row = $(".mytable tr")[order];
				
						var ten = $(row).find("td")[1];
						var ten_value = $(ten).text();
						$(ten).html("<input style='background:yellow;' id='ten-" + order + "' type='text' value='" + ten_value + "' /><br /><span class='thongbao'>" + THONG_BAO + "</span>");
						$("#ten-" + order).focus();

						var sdt = $(row).find("td")[2];
						var sdt_value = $(sdt).text();
						$(sdt).html("<input style='background:yellow;' id='sdt-" + order + "' type='text' value='" + sdt_value + "' />");

						$("#ten-" + order + ", #sdt-" + order).keyup(function(e) {
							if (e.keyCode == 27) {	// ESC
								$(ten).find(".thongbao").remove();
								$(ten).html(ten_value);
								$(sdt).html(sdt_value);
								$($(".btn-edit")[order - 1]).removeAttr("disabled");
							}
							if (e.keyCode == 13) {	// ENTER
								var ten_moi = $("#ten-" + order).val();
								var sdt_moi = $("#sdt-" + order).val();
								if ((ten_moi != ten_value || sdt_moi != sdt_value) && kiemtraten(ten_moi) && kiemtrasdt(sdt_moi)) {
									suaKhachHang(ma_kh, ten_moi, sdt_moi);
									$(ten).html(ten_moi);
									$(sdt).html(sdt_moi);
									$(ten).find(".thongbao").remove();
									$($(".btn-edit")[order - 1]).removeAttr("disabled");
								}
							}
						});
						checkInputs();
					});
					checkInputs();
				},
				error: function() {
					thongbaoloi("Khong the lay danh sach khach hang!!!");
				}
			});
		}
		function searchCus(val_search) {
			$.ajax({
				url: "/quanlysanbong/api/dskhachhang.php",
				type: "GET",
				cache: false,
				data: {
					action: "search",
					val_search: val_search,
				},
				success: function (json) {
					let data = $.parseJSON(json);
					let html = "";
					html += "<table class='searchPlace' style='width: 100%;text-align: center;background-color:white;'>";
					html += "<thead><tr><th>ID</th><th>Tên khách hàng</th><th>Số điện thoại</th><th>Sửa</th><th>Xóa</th></tr></thead>";
					for (let i = 0; i < data.length; i++) {
						html += "<tr>";
						html += "<td>" + data[i].id + "</td><td>" + data[i].ten + "</td><td>" + data[i].sdt + 
						"</td><td><center><button class='btn-edit' ma_kh='" + data[i].id +"' order='" + (i + 1) + "'>Sửa</button></center></td>"+
						"</td><td><center><button class='btn-del' ma_kh='" + data[i].id +"' order='" + (i + 1) + "'>Xóa</button></center></td>";
						html += "</tr>";
					}
					html += "</table>";
					$(".searchPlace").html(html);
				}
				
			})

		}
		function xoaKh(ma_kh){
			$.ajax({
			url: "/quanlysanbong/api/dskhachhang.php",
			type: "POST",
			cache: false,
			data: {
				action: "del",
				ma_kh: ma_kh,
			},
			success: function(msg) {
				thongbaotot(msg);
				tailaitrang();
			}
		});
		}

		function suaKhachHang(ma_kh, ten_moi, sdt_moi) {
			$.ajax({
				url: "/quanlysanbong/api/dskhachhang.php",
				type: "POST",
				cache: false,
				data: {
					action: "edit",
					ma_kh: ma_kh,
					ten_moi : ten_moi,
					sdt_moi : sdt_moi
				},
				success: function(msg) {
					if (msg.includes("đã tồn tại")) {
						thongbaoloi(msg);
						tailaitrang();
					} else {
						thongbaotot(msg);
						tailaitrang();
					}
				},
				error: function() {
					alert("Khong the cap nhat khach hang " + ma_kh + "!!!");
				}
				
			});
		}
		
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
						thongbaotot(msg);
						tailaitrang();
					}
				},
				error: function() {
					alert("Khong the them khach hang moi!!!");
				}
			});
		}

		$("#btn-add").click(function() {
			var ten_moi = $("#ten-moi").val();
			var sdt_moi = $("#sdt-moi").val();
			if (kiemtraten(ten_moi) && kiemtrasdt(sdt_moi)) {
				themKhachHang(ten_moi, sdt_moi);
				$("#ten-moi").val("");
				$("#sdt-moi").val("");
			}
		});
	});
</script>