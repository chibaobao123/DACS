<title>Sân Bóng</title>
<?php
	include("session.php");
	include("header.php");
?>
<style type="text/css">
	body {
		background-color: #00bcd4;
	}
	
</style>
Tên sân: <input type='text' id='ten_san'/> <button id='btnThem'>Thêm sân bóng</button><br />
<br />
<div id='listsanbong'></div>
<script>
$(document).ready(function() {
	
	checkInputs();
	$.ajax({
		url: "/quanlysanbong/api/sanbong.php",
		type: "POST",
		data: {
			action: "view"
		},
		cache: false,
		success: function(json) {
			var html = "";
			var data = $.parseJSON(json);
			html += "<table class='mytable' style='background-color: white;width: 70%;text-align: center;'>";
			html += "<thead><tr><th>#</th><th>Tên sân bóng</th><th>Đổi tên</th><th>Xóa</th></tr></thead>";
			for (var i = 0; i < data.length; i++) {
				html += "<tr>";
				html += "<td>" + (i + 1) + "</td>";
				html += "<td>" + data[i].ten_san + "</td>";
				html += "<td><button class='btnDoiten' ma_san='" + data[i].ma_san + "' order='" + (i + 1) + "'>Đổi tên</button></td>";
				html += "<td><button class='btnXoa' ma_san='" + data[i].ma_san + "' order='" + (i + 1) + "'>Xóa</button></td>";
				html += "</tr>";
			}
			html += "</table>";
			$("#listsanbong").html(html);
			
			
			$("#btnThem").click(function() {
				var ten_moi = $("#ten_san").val();
				if (kiemtratensan(ten_moi)) {
					themSan(ten_moi);
				}
			});

			$(".btnDoiten").click(function() {
				$(this).attr("disabled", "disabled");
				var ma_san = $(this).attr("ma_san");
				var order = $(this).attr("order");
				var row = $(".mytable tr")[order];
				var ten = $(row).find("td")[1];
				var ten_value = $(ten).text();
				$(ten).html("<input style='background:yellow;' type='text' value='" + ten_value + "' id='ten-" + order + "'/><br /><span class='thongbao'>" + THONG_BAO + "</span>");
				$("#ten-" + order).focus();
				checkInputs();
				
				$("#ten-" + order).keyup(function(e) {
					if (e.keyCode == 27) {	// ESC
						$(ten).find(".thongbao").remove();
						$(ten).html(ten_value);
						$($(".btnDoiten")[order - 1]).removeAttr("disabled");
					}
					if (e.keyCode == 13) {	// ENTER
						var ten_moi = $("#ten-" + order).val();
						if (ten_moi != ten_value && kiemtratensan(ten_moi)) {
							$(ten).html(ten_moi);
							suaSan(ma_san, ten_moi);
							$(ten).find(".thongbao").remove();
							$($(".btnDoiten")[order - 1]).removeAttr("disabled");
						}
					}
				});

			});
			
			$(".btnXoa").click(function() {
				var ma_san = $(this).attr("ma_san");
				//var order = $(this).attr("order");
				//var row = $(".mytable tr")[order];
				//var ten = $(row).find("td")[1];
				//var ten_value = $(ten).text();
				var xac_nhan = confirm("Xóa sân này sẽ xóa tất cả các đặt sân liên quan. Bạn có chắc muốn xóa không?");
				if (xac_nhan) {
					xoaSan(ma_san);
				}
			});
			
			
		}
	});
	
	function themSan(ten_moi) {
		$.ajax({
			url: "/quanlysanbong/api/sanbong.php",
			type: "POST",
			cache: false,
			data: {
				action: "add",
				ten_moi: ten_moi
			},
			success: function(msg) {
				if (msg.includes("tồn tại")) {
					thongbaoloi(msg);
				} else {
					thongbaotot(msg);
					tailaitrang();
				}
				
			}
		});
	}
	
	function suaSan(ma_san, ten_moi) {
		$.ajax({
			url: "/quanlysanbong/api/sanbong.php",
			type: "POST",
			cache: false,
			data: {
				action: "edit",
				ma_san: ma_san,
				ten_moi: ten_moi
			},
			success: function(msg) {
				if (msg.includes("tồn tại")) {
					thongbaoloi(msg);
					tailaitrang();
				} else {
					thongbaotot(msg);
					tailaitrang();
				}
			}
		});
	}
	
	function xoaSan(ma_san) {
		$.ajax({
			url: "/quanlysanbong/api/sanbong.php",
			type: "POST",
			cache: false,
			data: {
				action: "del",
				ma_san: ma_san
			},
			success: function(msg) {
				thongbaotot(msg);
				tailaitrang();
			}
		});
	}
});
</script>