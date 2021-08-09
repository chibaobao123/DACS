<title>Sân Bóng</title>
<?php
	include("session.php");
	include("header.php");
?>
<style type="text/css">
	body {
		background-color: #d1dcde;
	}
	
</style>
<div class="sanBong" style="margin:0px 0 20px 0;">
	Tên sân: <input type='text' id='ten_san'/> <button id='btnThem'>Thêm sân bóng</button>
</div>
<br />
<br />
<div id='listsanbong'></div>
<?php
        include("footer.php");
    ?>
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
			html += "<thead><tr><th>#</th><th>Tên sân bóng</th><th>Giá(/phút)</th><th>Chỉnh sửa</th></tr></thead>";
			for (var i = 0; i < data.length; i++) {
				html += "<tr>";
				html += "<td>" + (i + 1) + "</td>";
				html += "<td>" + data[i].ten_san + "</td>";
				html += "<td>" + data[i].gia + "</td>"
				html += "<td><button class='btnDoiten' ma_san='" + data[i].ma_san + "' order='" + (i + 1) + "'><i class='fas fa-edit'></i></button>";
				html += "<button class='btnXoa' ma_san='" + data[i].ma_san + "' order='" + (i + 1) + "'><i class='fas fa-trash-alt'></i></button></td>";
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

				var gia = $(row).find("td")[2];
				var gia_value = $(gia).text();
				$(gia).html("<input style='background:yellow;' type='text' value='" + gia_value + "' id='gia-" + order  + "'/><br /><span class='thongbao'>" + THONG_BAO + "</span>");

				
				
				$("#ten-" + order+ ",#gia-" + order).keyup(function(e) {
					if (e.keyCode == 27) {	// ESC
						$(ten).find(".thongbao").remove();
						$(ten).html(ten_value);
						$(gia).html(gia_value);
						$($(".btnDoiten")[order - 1]).removeAttr("disabled");
					}
					if (e.keyCode == 13) {	// ENTER
						var ten_moi = $("#ten-" + order).val();
						var gia_moi = $("#gia-" + order).val();
						
							$(ten).html(ten_moi);
							$(gia).html(gia_moi);
							suaSan(ma_san, ten_moi, gia_moi);
							$(ten).find(".thongbao").remove();
							$(gia).find(".thongbao").remove();
							$($(".btnDoiten")[order - 1]).removeAttr("disabled");
						
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
	
	function suaSan(ma_san, ten_moi, gia_moi) {
		$.ajax({
			url: "/quanlysanbong/api/sanbong.php",
			type: "POST",
			cache: false,
			data: {
				action: "edit",
				ma_san: ma_san,
				ten_moi: ten_moi,
				gia_moi: gia_moi
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