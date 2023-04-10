<?php  
    ob_start();
    session_start();
	include_once './chucnang/ketnoi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Shoe Store</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/style.css"> 


	
	<script src="js/sweetalert.min.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/jquery.min.js"></script>
	<style>
		.pagination {
		  display: inline-block;
		}

		.pagination a {
		  color: black;
		  float: left;
		  padding: 8px 16px;
		  text-decoration: none;
		}

		.pagination a.active {
		  background-color: #4CAF50;
		  color: white;
		}

		.pagination a:hover:not(.active) {background-color: #ddd;}
	</style>
</head>

<body>
	<div class="container">
		<!-- Header -->
		<div id="header">
			<nav class="navbar navbar-inverse">
				<div class="container-fruid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button> <a class="navbar-brand" style="color: aqua;" href="index.php?page=1">Shoe Lucky</a> </div>
					<div class="collapse navbar-collapse" id="myNavbar">
						<ul class="nav navbar-nav">
							<li class="active"><a href="index.php?page=1">Trang chủ</a></li>
							<li><a href="index.php?page=gioithieu">Giới thiệu</a></li>
							<li><a href="index.php?page=lienhe">Liên hệ</a></li>
							<?php
								include_once './chucnang/thuonghieu/thuonghieu.php';
							?>
						</ul>
						<!-------------search----------------->
						<?php 
							include_once './chucnang/timkiem/timkiem.php';
						?>
						<!-------------end search----------------->
						<!-------------login----------------->
						<?php 
							include_once './chucnang/dangnhap/login.php';
						?>

						<!-------------end login----------------->
						<!-------------cart----------------->
						<?php 
							include_once './chucnang/giohang/giohangcuaban.php';
						?>
						<!-------------end cart----------------->
						<?php
							if(isset($_GET['page'])){
								switch ($_GET['page']) {
									case 'danhsachtimkiem':
										echo '<link rel="stylesheet" href="css/danhsachtimkiem.css">';
										break;
									case 'danhsachsp':
										echo '<link rel="stylesheet" href="css/danhsachsp.css">';
										break;
									case 'chitietsp':
										echo '<link rel="stylesheet" href="css/chitietsp.css">';
										break;
									case 'giohang':
										echo '<link rel="stylesheet" href="css/giohang.css">';
										break;              
									case 'muahang':
										echo '<link rel="stylesheet" href="css/muahang.css">';
										break;
									case 'hoanthanh':
										echo '<link rel="stylesheet" href="css/hoanthanh.css">';
										break;
									}
								}

						?>
					</div>
				</div>
			</nav>
		</div>
		<!-- End Header -->
		<!-- Banner  -->
		<!-- End Banner -->
		<!-- Body -->
		<div id="body">
			<div class="row">
				<div class="col-md-3 col-sm-12 col-xs-12">
					<?php
						include_once "./chucnang/sanpham/danhmucsp.php";
						include_once "./chucnang/thongke/thongke.php";
					?>
					
				</div>
				<div class="col-md-9 col-sm-12 col-xs-12">
	<!--------------------------slide----------------->
					<?php
						include_once "./chucnang/slide/slide.php";
					?>
				</div>
					<div id="main">
						
						<?php
                            if(isset($_GET['page'])){
                                switch ($_GET['page']) {
									case 'danhsachtimkiem':
										include_once './chucnang/timkiem/danhsachtimkiem.php';
										break;
									case 'danhsachsp':
										include_once './chucnang/sanpham/danhsachsp.php';
										break;
									case 'thuonghieu':
										include_once './chucnang/thuonghieu/dsthuonghieu.php';
										break;
									case 'chitietsp':
										include_once './chucnang/sanpham/chitietsp.php';
										break;
									case 'giohang':
										include_once './chucnang/giohang/giohang.php';
										break;
									case 'muahang':
										include_once './chucnang/giohang/muahang.php';
										break;
									case 'hoanthanh':
										include_once './chucnang/giohang/hoanthanh.php';
										break;
									case 'gioithieu':
										include_once './chucnang/gioithieu/gioithieu.php';
										break;
									case 'lienhe':
										include_once './chucnang/lienhe/lienhe.php';
										break;
									case '1':
										include_once('ajaxPhp.php');
									break;
										
									}}
                            ?>
							<div>
							<?php
							include_once('initPagination.php');
							?></div>
                        </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- -------------------------------End Body -->	

		<!--===================== Footer -->
			
	<div class="container">
			<div id="footer">
				<div class="row">
					<div class="footer-main">
					<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="">
							<div class="ft-detail">
								<h4>Hỗ trợ khách hàng</h4>
								<ul class="no-bullets">
									<li><a href="#">Hướng dẫn mua hàng</a></li>
									<li><a href="#">Chính sách đổi trả</a></li>
									<li><a href="#">Chính sách bảo hành</a></li>
									<li><a href="#">Tin tuyển dụng</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="">
							<div class="ft-detail">
								<h4>Về chúng tôi</h4>
								<ul class="no-bullets">
									<li><a href="./intro/intro.html">Giới thiệu</a></li>
									<li><a href="#">Tuyển dụng</a></li>
									<li><a href="#">Bán hàng doanh nghiệp</a></li>
									<li><a href="#">Điều khoản sử dụng</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="">
							<div class="ft-detail">
								<h4>Phương thức thanh toán</h4>
								<ul class="no-bullets">
									<li><a href="#">VISA</a></li>
									<li><a href="#">MOMO</a></li>
									<li><a href="#">ZALO PAY</a></li>
									<li><a href="#">ATM</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="">
							<div class="ft-detail">
								<h4>Kết nối với chúng tôi</h4>
								<ul class="no-bullets">
									<li><a href="#">FACEBOOK</a></li>
									<li><a href="#">YOUTUBE</a></li>
									<li><a href="#">ZALO</a></li>
									<li><a href="#">INSTAGRAM</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
			<!-- --------------Footer -->
			
</div>
<script>
//Event cho nút phân trang
	//bấm vào trang bất kì
	function getPos() {
		var pos = "";
		<?php if (isset($_GET['pagesp'])) echo "pos = '".str_replace("<br/>", "", $_GET['pagesp'])."';";?>
		<?php if (isset($_GET['pageth'])) echo "pos = '".str_replace("<br/>", "", $_GET['pageth'])."';";?>
		<?php if (isset($_GET['pagetk'])) echo "pos = '".str_replace("<br/>", "", $_GET['pagetk'])."';";?>
		return pos;
	}
	
	function getID() {
		var id = "";
		<?php if (isset($_GET['idLSP'])) echo "id = '".str_replace("<br/>", "", $_GET['idLSP'])."';";?>
		<?php if (isset($_GET['idTH'])) echo "id = '".str_replace("<br/>", "", $_GET['idTH'])."';";?>
		<?php if (isset($_GET['stext'])) echo "id = '".str_replace("<br/>", "", $_GET['stext'])."';";?>
		return id;
	}
	
	
	
	$('.pageLink').on('click', function() {
		const idpage = $(this).attr('id');
		let link = "";
		const pos = getPos();
		const id = getID();
		if (pos == "") link = "http://localhost/qlgiaythethao/customer/frontend/index.php?page=";
		if (pos == "danhsachsp") {
			let lsp = getID();
			link = "http://localhost/qlgiaythethao/customer/frontend/index.php?pagesp=danhsachsp&idLSP="+lsp+"&page=";
		}
		if (pos == "thuonghieu") {
			let th = getID();
			link = "http://localhost/qlgiaythethao/customer/frontend/index.php?pageth=thuonghieu&idTH="+th+"&page=";
		}
		if (pos == "danhsachtimkiem"){
			let tk = getID();
			link = "http://localhost/qlgiaythethao/customer/frontend/index.php?pagetk=danhsachtimkiem&stext="+tk+"&page=";
		}
		
		if (pos == "danhsachsp") {
			$.ajax({
				url: 'ajaxPhp.php',
				type: 'GET',
				data: {
					page: idpage,
					pagesp: pos,
					idLSP: id
				},
				success: function (data) {
					$('#listSP').html(data);
					window.history.pushState('', null, link+idpage);
				}
			})
		}
		if (pos == "thuonghieu") {
			$.ajax({
				url: 'ajaxPhp.php',
				type: 'GET',
				data: {
					page: idpage,
					pageth: pos,
					idTH: id
				},
				success: function (data) {
					$('#listSP').html(data);
					window.history.pushState('', null, link+idpage);
				}
			})
		}
		if (pos == "danhsachtimkiem") {
			$.ajax({
				url: 'ajaxPhp.php',
				type: 'GET',
				data: {
					page: idpage,
					pagetk: pos,
					stext: id
				},
				success: function (data) {
					$('#listSP').html(data);
					window.history.pushState('', null, link+idpage);
				}
			})
		}
		if (pos == "") {
			$.ajax({
				url: 'ajaxPhp.php',
				type: 'GET',
				data: {
					page: idpage
				},
				success: function (data) {
					$('#listSP').html(data);
					window.history.pushState('', null, link+idpage);
				}
			})
		}
	})
	//bấm vào nút lùi 1 trang
	$('#backPage').on('click', function() {
		let idpage = window.location.href.substr(window.location.href.length-1);
		idpage = parseInt(idpage);
		if (idpage == 1) return false;
		let i = idpage - 1;
		let link = "";
		const pos = getPos();
		const id = getID();
		if (pos == "") link = "http://localhost/qlgiaythethao/customer/frontend/index.php?page=";
		if (pos == "danhsachsp") {
			let lsp = getID();
			link = "http://localhost/qlgiaythethao/customer/frontend/index.php?pagesp=danhsachsp&idLSP="+lsp+"&page=";
		}
		if (pos == "thuonghieu") {
			let th = getID();
			link = "http://localhost/qlgiaythethao/customer/frontend/index.php?pageth=thuonghieu&idTH="+th+"&page=";
		}
		if (pos == "danhsachtimkiem"){
			let tk = getID();
			link = "http://localhost/qlgiaythethao/customer/frontend/index.php?pagetk=danhsachtimkiem&stext="+tk+"&page=";
		}
		
		if (pos == "danhsachsp") {
			var page = "danhsachsp";
			$.ajax({
				url: 'ajaxPhp.php',
				type: 'GET',
				data: {
					page: i,
					pagesp: page,
					idLSP: id
				},
				success: function (data) {
					$('#listSP').html(data);
					window.history.pushState('', null, link+i);
				}
			})
		}
		if (pos == "thuonghieu") {
			var page = "thuonghieu";
			$.ajax({
				url: 'ajaxPhp.php',
				type: 'GET',
				data: {
					page: i,
					pageth: page,
					idTH: id
				},
				success: function (data) {
					$('#listSP').html(data);
					window.history.pushState('', null, link+i);
				}
			})
		}
		if (pos == "danhsachtimkiem") {
			var page = "danhsachtimkiem";
			$.ajax({
				url: 'ajaxPhp.php',
				type: 'GET',
				data: {
					page: i,
					pagetk: page,
					stext: id
				},
				success: function (data) {
					$('#listSP').html(data);
					window.history.pushState('', null, link+i);
				}
			})
		}
		if (pos == "") {
			var bwpage = idpage - 1;
			$.ajax({
				url: 'ajaxPhp.php',
				type: 'GET',
				data: {
					page: bwpage,
				},
				success: function (data) {
					$('#listSP').html(data);
					window.history.pushState('', null, link+bwpage);
				}
			})
		}
	})
	//bấm vào nút tiến lên 1 trang
	$('#forwardPage').on('click', function() {
		let idpage = window.location.href.substr(window.location.href.length-1);
		idpage = parseInt(idpage);
		if (idpage == $('.pagination a').length-2) return false;
		let i = idpage + 1;
		let link = "";
		const pos = getPos();
		const id = getID();
		if (pos == "") link = "http://localhost/qlgiaythethao/customer/frontend/index.php?page=";
		if (pos == "danhsachsp") {
			let lsp = getID();
			link = "http://localhost/qlgiaythethao/customer/frontend/index.php?pagesp=danhsachsp&idLSP="+lsp+"&page=";
		}
		if (pos == "thuonghieu") {
			let th = getID();
			link = "http://localhost/qlgiaythethao/customer/frontend/index.php?pageth=thuonghieu&idTH="+th+"&page=";
		}
		if (pos == "danhsachtimkiem"){
			let tk = getID();
			link = "http://localhost/qlgiaythethao/customer/frontend/index.php?pagetk=danhsachtimkiem&stext="+tk+"&page=";
		}
		
		if (pos == "danhsachsp") {
			var page = "danhsachsp";
			$.ajax({
				url: 'ajaxPhp.php',
				type: 'GET',
				data: {
					page: i,
					pagesp: page,
					idLSP: id
				},
				success: function (data) {
					$('#listSP').html(data);
					window.history.pushState('', null, link+i);
				}
			})
		}
		if (pos == "thuonghieu") {
			var page = "thuonghieu";
			$.ajax({
				url: 'ajaxPhp.php',
				type: 'GET',
				data: {
					page: i,
					pageth: page,
					idTH: id
				},
				success: function (data) {
					$('#listSP').html(data);
					window.history.pushState('', null, link+i);
				}
			})
		}
		if (pos == "danhsachtimkiem") {
			var page = "danhsachtimkiem";
			$.ajax({
				url: 'ajaxPhp.php',
				type: 'GET',
				data: {
					page: i,
					pagetk: page,
					stext: id
				},
				success: function (data) {
					$('#listSP').html(data);
					window.history.pushState('', null, link+i);
				}
			})
		}
		if (pos == "") {
			var fwpage = idpage + 1;
			$.ajax({
				url: 'ajaxPhp.php',
				type: 'GET',
				data: {
					page: fwpage
				},
				success: function (data) {
					$('#listSP').html(data);
					window.history.pushState('', null, link+fwpage);
				}
			})
		}
	})
	function thanhtoan(user){
		
		$.post('customer/frontend/chucnang/giohang/muahang.php',
			{'user':user},
			function(data){
				location='index.php?page=hoanthanh';
			})
	}
	async function thanhToanThanhCong() {
		document.getElementById("btnThanhToanThanhCong").style.display="block";
		let delayres = await delay(9000);
		document.getElementById("btnThanhToanThanhCong").style.display="none";
		}
</script>
</body>

</html>