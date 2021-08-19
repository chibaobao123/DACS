<title>Khách Hàng</title>
<script src="https://kit.fontawesome.com/93ec6d166b.js" crossorigin="anonymous"></script>
<?php
	include("session.php");
	include("header.php");
?>
<style>
body {
	background-color: #d1dcde;	
	
}
#formSearch{
	float: right;
}
.addCusBar input[type=text] {
	height:25px;
    border: 1px solid #ccc;  
}

#tblKhachHang{margin-top:0;}
#tblKhachHang table{width:50%;}
#tblKhachHang table td{vertical-align:top;}
</style>
<div class="addCusBar" style="margin:0px 0 25px 0;">
	<!-- Tên: <input type='text' id='ten-moi' placeholder="Họ và tên"/> 
	Số điện thoại: <input id='sdt-moi' type='text' placeholder="Số điện thoại "/> 
	: <input id='sdt-moi' type='text' placeholder="Số điện thoại "/> 
	Số điện thoại: <input id='sdt-moi' type='text' placeholder="Số điện thoại "/> 
	<button id='btn-add' class="btn btn-light border border-dark text-center p-0 mb-1" style='height: 25px; width: 70px'>Thêm</button>  -->
	<div class="searchBar" style="float:right">
		<input style=' width:250px; height: 30px;' type="text" placeholder="Tìm kiếm...." name="val_search" value=""/>
		<button id='btn-search' class="btn btn-light border border-dark mb-1"  name='submit' value= 'Tìm kiếm' style='height: 30px; width: 70px'><i class="fas fa-search"></i></button>
	</div>
	
</div>

<div id='hold'>
	
	<div id='tblKhachHang'></div>
</div>

<?php
        include("footer.php");
    ?>
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
					html += "<h1>Danh sách khách hàng</h1>"
					html += "<table class='mytable' style='width: 100%;text-align: center;background-color:white;'>";
					html += "<thead><tr><th>STT</th><th>Tên khách hàng</th><th>Username</th><th>Số điện thoại</th><th>Email</th><th>Công cụ</th></tr></thead>";
					for (let i = 0; i < data.length; i++) {
						html += "<tr>";
						html += "<td>"+(i+1)+"</td><td>" + data[i].ten + "</td><td class='username'>" + data[i].username + "</td><td>" + data[i].sdt + "</td><td>" + data[i].email + 
						"</td><td><center><button class='btn-edit btn' ma_kh='" + data[i].id +"' order='" + (i + 1) + "'><i class='fas fa-edit'></i></button>"+
						"<button class='btn-del btn' ma_kh='" + data[i].id +"' order='" + (i + 1) + "'><i class='fas fa-trash-alt'></i></button></center></td>";
						html += "</tr>";
					}
					html += "</table>";
					$("#tblKhachHang").html(html);
					$(".btn-del").click(function(){
						var ma_kh = $(this).attr("ma_kh");
						var username = $('.username').text();
						var xac_nhan = confirm("Bạn có chắc muốn xóa không?");
							if (xac_nhan) {
								xoaKh(ma_kh, username);
							}
					});
					

					$(".btn-edit").click(function() {
						$(this).attr("disabled", "disabled");
						var order = $(this).attr("order");
						var ma_kh = $(this).attr("ma_kh");
						var row = $(".mytable tr")[order];
				
						var ten = $(row).find("td")[1];
						var ten_value = $(ten).text();
						$(ten).html("<input style='background:yellow;width:100%' id='ten-" + order + "' type='text' value='" + ten_value + "' /><br /><span class='thongbao'>" + THONG_BAO + "</span>");
						$("#ten-" + order).focus();

						// var username = $(row).find("td")[2];
						// var username_value = $(username).text();
						// $(username).html("<input style='background:yellow;width:100%' id='username-" + order + "' type='text' value='" + username_value + "' />");

						var sdt = $(row).find("td")[3];
						var sdt_value = $(sdt).text();
						$(sdt).html("<input style='background:yellow;width:100%' id='sdt-" + order + "' type='text' value='" + sdt_value + "' />");

						var email = $(row).find("td")[4];
						var email_value = $(email).text();
						$(email).html("<input style='background:yellow;width:100%' id='email-" + order + "' type='text' value='" + email_value + "' />");


						$("#ten-" + order + ", #sdt-" + order + ", #email-" + order).keyup(function(e) {
							if (e.keyCode == 27) {	// ESC
								$(ten).find(".thongbao").remove();
								$(ten).html(ten_value);
								// $(username).html(username_value);
								$(sdt).html(sdt_value);
								$(email).html(email_value);
								$($(".btn-edit")[order - 1]).removeAttr("disabled");
							}
							if (e.keyCode == 13) {	// ENTER
								var ten_moi = $("#ten-" + order).val();
								// var username_moi = $("#username-" + order).val();
								var sdt_moi = $("#sdt-" + order).val();
								var email_moi = $("#email-" + order).val();
								if ((ten_moi != ten_value || sdt_moi != sdt_value || email_moi != email_value) && kiemtraten(ten_moi) && kiemtrasdt(sdt_moi) && kiemtraten(email_moi)) {
									suaKhachHang(ma_kh, ten_moi, sdt_moi, email_moi);
									$(ten).html(ten_moi);
									// $(username).html(username_moi);
									$(sdt).html(sdt_moi);
									$(email).html(email_moi);
									$(ten).find(".thongbao").remove();
									$($(".btn-edit")[order - 1]).removeAttr("disabled");
								}
							}
						});
						
					});
					
				},
				error: function() {
					thongbaoloi("Khong the lay danh sach khach hang!!!");
				}
			});
		}
		
		$("#btn-search").on('click', function(){
			var val_search = $('input[name="val_search"]').val();

			console.log(val_search);

			$.ajax({
				type:'get',
				url:'./api/search.php?search='+val_search,
				data: {search:val_search},
				dataType: "json",
				success: function(response) {
					console.log('SUCCESS');
					console.table(response);
					
					// var obj = JSON.parse(response);
					let html = searchTableItem(response);

					$("#tblKhachHang").html(html);
					$("#holdSearch").css("display","block");

				},
				error: function(result) {
					console.log('ERROR');
					console.log(result);
					

				}
			});
		});


		function searchTableItem(data){
			
				let html = "";
				html += "<h1>Danh sách khách hàng</h1>"
					html += "<table class='mytable' style='width: 100%;text-align: center;background-color:white;'>";
					html += "<thead><tr><th>STT</th><th>Tên khách hàng</th><th>Username</th><th>Số điện thoại</th><th>Email</th><th>Công cụ</th></tr></thead>";
					$.each( data, function( key, value ) {
					html += "<tr>";
					html += "<td>"+(key+1)+"</td><td>" + value.ten + "</td><td>" + value.username +  "</td><td>" + value.sdt + "</td><td>" + value.email + 
					"</td><td><center><button class='btn-edit btn' ma_kh='" + value.id +"' order='" + (key + 1) + "'><i class='fas fa-edit'></i></button>"+
					"<button class='btn-del btn' ma_kh='" + value.id +"' order='" + (key + 1) + "'><i class='fas fa-trash-alt'></i></button></center></td>";
					html += "</tr>";
				})
				html += "</table>";

				return html;
			
		}

		function xoaKh(ma_kh,username){
			$.ajax({
			url: "/quanlysanbong/api/dskhachhang.php",
			type: "POST",
			cache: false,
			data: {
				action: "del",
				ma_kh: ma_kh,
				username : username,
			},
			success: function(msg) {
				thongbaotot(msg);
				tailaitrang();
			}
		});
		}

		function suaKhachHang(ma_kh, ten_moi, sdt_moi, email_moi) {
			$.ajax({
				url: "/quanlysanbong/api/dskhachhang.php",
				type: "POST",
				cache: false,
				data: {
					action: "edit",
					ma_kh: ma_kh,
					ten_moi : ten_moi,
					sdt_moi : sdt_moi,
					email_moi : email_moi,
					// username_moi : username_moi,
				},
				success: function(msg) {
					console.log(msg);
					if (msg.includes("đã tồn tại")) {
						thongbaoloi(msg);
						tailaitrang();
						console.log(msg);
					} else {
						thongbaotot(msg);
						tailaitrang();
						console.log(msg);
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