<?php
	include_once('class/handling.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Quản lý sản phẩm</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<!--Icons-->
<script src="js/lumino.glyphs.js"></script>
	
<!--MY FILE-->
<link href="css/mycss.css" rel="stylesheet">
	  

<script src="js/sweetalert.min.js"></script>
<!--<script src="js/jquery.validate.min.js"></script>-->
<link href="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js">
<script src="js/jquery.min.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>
	
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Trang <span>quản lý</span></a>
				<ul class="user-menu" style="margin: 10px 10px 0 0">
					<li>
						<form method="post">
							<button type="submit" class="btn btn-primary" name="logout"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</button>
						</form>
					</li>
					<?php
						if (isset($_POST['logout'])) {
							session_destroy();
							header("location:http://localhost/qlgiaythethao/admin/login.php");
						}
					?>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
<!--
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
-->
		<ul class="nav menu">
			<?php
				include_once('class/checkrole.php');
				$p = new role();
				$url = $_SERVER['PHP_SELF'];
				$p -> check_role($url);
			?>
		</ul>

	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Quản lý sản phẩm</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Quản lý sản phẩm</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Danh sách sản phẩm</div>
					
					<fieldset class="panel panel-footer" id="formSP" style="display: none; width: 95%; margin: 0 auto; border: 1px solid rgba(120, 120, 120, 0.5); background-clip: padding-box;">
						<legend>Thông tin sản phẩm</legend>
						<form role="form" id="innerForm" enctype="multipart/form-data">
							<div class="form-group" style="width: 48%; display: inline-block; vertical-align: top;">
								<label>Chọn ảnh</label>
								<input class="form-control" style="width: 70%" type="file" name="fileToUpload" id="fileToUpload" accept="image/png,image/jpg,image/jpeg">
								<img class="displayImg" src="images/default-picture.png" name="showImg" id="showImg">
								<div style="width: 70%;">
								<buttton class="btn btn-default form-control" style="display: block; width: 20%; margin: auto; margin-top: 10px;" name="delImage" id="delImage">Xóa ảnh</buttton>
								</div>
								<div class="form-group" style="width: 75%; margin-top: 20px;">
									<label style="margin-left: 10px;">Mô tả</label>
									<textarea class="form-control" rows="7" cols="20" name="lbDescribe" id="lbDescribe"></textarea>
								</div>
							</div>
							<div class="form-group" style="width: 48%; display: inline-block;">
								<div class="form-group">
									<label>Tên sản phẩm</label>
									<input class="form-control" style="width: 60%" type='text' name='lbName' id='lbName' placeholder="Nhập tên sản phẩm">
									<div style="display: none;" id="errorName">Vui lòng nhập tên sản phẩm</div>
								</div>
								<div class="form-group">
									<label>Loại</label>
									<?php
										include_once('class/initTable.php');
										$init = new initTable();
										$init -> initSP(1);
									?>
								</div>
								<div class="form-group">
									<label>Thương hiệu</label>
									<?php
										include_once('class/initTable.php');
										$init = new initTable();
										$init -> initSP(2);
									?>
								</div>
								<div class="form-group">
									<label>Size</label>
									<input class="form-control" style="width: 60%" type='text' name='lbSize' id='lbSize' placeholder="Nhập Size sản phẩm">
									<div style="display: none;" id="errorSize">Vui lòng nhập size</div>
								</div>
								<div class="form-group">
									<label>Màu</label>
									<select class="form-control" style="width: 30%" name='inpColor' id='inpColor'>
										<option value='1'>Trắng</option>
										<option value='2'>Đen</option>
										<option value='3'>Đỏ</option>
										<option value='4'>Tím</option>
										<option value='5'>Vàng</option>
										<option value='6'>Cam</option>
										<option value='7'>Hồng</option>
										<option value='8'>Xanh da trời</option>
										<option value='9'>Xanh lá</option>
										<option value='10'>Xám</option>
									</select>
								</div>
								<div class="form-group">
									<label>Giá cả</label>
									<input class="form-control" style="width: 60%" type='text' name='lbPrice' id='lbPrice' placeholder="Nhập giá">
									<div style="display: none;" id="errorPrice">Vui lòng nhập giá</div>
								</div>
								<div class="form-group">
									<label>Số lượng</label>
									<input class="form-control" style="width: 60%" type='text' name='lbAmount' id='lbAmount' placeholder="Nhập số lượng">
								</div>
								<div class="form-group" id="Status">
									<label>Trạng thái</label>
									<select class="form-control" style="width: 20%" name='inpStatus' id='inpStatus'>
										<option value='1'>Còn hàng</option>
										<option value='2'>Hết hàng</option>
									</select>
								</div>
							</div>
							<div id="btnConfirm">
							<div style="width: 10%; margin: auto;">
								<div id="confirmFixButton">
								<button class="btn btn-primary" type="submit" name="confirmFix" id="confirmFix">Cập nhật</button>
								</div>
								<div id="confirmAddButton">
								<button class="btn btn-primary" type="submit" name="confirmAdd" id="confirmAdd">Xác nhận</button>
								</div>
							</div>
							</div>
						</form>
					</fieldset>
					
					<div class="panel panel-body">
						<div style="margin-bottom: 10px;"> 
							<button class="btn btn-default" style="margin-left: 93%;" name="toggle-add" id="toggle-add">Thêm</button>
						</div>
						<div id="listSP">
						<div style="border: 2px groove rgba(120, 120, 120, 0.5); border-radius: 5px;">
						<div style="position: relative; max-height: 510px; overflow-y: scroll;">
							<table class="table table-hover fixed-table-container tableSort" id="tableSP">
								<thead style="position: sticky; top: 0px;">
									<th style="padding-left: 5px">ID</th>
									<th style="padding-left: 5px">Hình ảnh</th>
									<th style="padding-left: 5px">Tên sản phẩm</th>
									<th style="padding-left: 5px">Loại</th>
									<th style="padding-left: 5px">Thương hiệu</th>
									<th style="padding-left: 5px">Size</th>
									<th style="padding-left: 5px">Màu</th>
									<th style="padding-left: 5px">Giá cả</th>
									<th style="padding-left: 5px">Số lượng</th>
									<th style="padding-left: 5px">Trạng thái</th>
									<th></th>
								</thead>
								<tbody class="tableFilter">
									<?php
										include_once('class/initTable.php');
										$init = new initTable();
										$init -> initSP(3);
									?>
								</tbody>
							</table>
						</div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
		
		
	</div><!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
<!--	<script src="js/chart-data.js"></script>-->
	<script src="js/easypiechart.js"></script>
<!--	<script src="js/easypiechart-data.js"></script>-->
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/bootstrap-table.js"></script>
	<script src="js/qlsanpham.js"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>
</body>

</html>
