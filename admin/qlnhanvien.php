<?php
	include_once('class/handling.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Quản lý khách hàng</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<!--Icons-->
<script src="js/lumino.glyphs.js"></script>
	
<!--MY FILE-->
<link href="css/mycss.css" rel="stylesheet">
	  

<script src="js/sweetalert.min.js"></script>
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
				<li class="active">Quản lý nhân viên</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Quản lý nhân viên</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Danh sách nhân viên</div>
					
					<fieldset class="panel panel-footer" id="formNV" style="display: none; width: 50%; margin-left: 30px; border: 1px solid rgba(120, 120, 120, 0.5); background-clip: padding-box;">
						<legend>Thông tin nhân viên</legend>
						<form action="qlnhanvien.php" method="post" role="form" id="innerForm">
							<div class="form-group">
								<label>Họ tên</label>
								<input class="form-control" style="width: 50%" type="text" name="Hoten" id="lbName" placeholder="Nhập họ tên"/>
								<div id="errorName" style="display: none;">Vui lòng nhập đầy đủ họ tên nhân viên</div>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input class="form-control" style="width: 50%" type="email" name="Email" id="lbEmail" placeholder="Nhập email"/>
								<div id="errorEmail" style="display: none;">Vui lòng nhập Email nhân viên</div>
							</div>
							<div class="form-group">
								<label>Số điện thoại</label>
								<input class="form-control" style="width: 50%" type="text" name="Sdt" id="lbNum" placeholder="Nhập số điện thoại"/>
							</div>
							<div class="form-group" id="Date">
								<label>Ngày vào</label>
								<input class="form-control" style="width: 50%" type="date" name="Ngayvao" id="inpDate"/>
							</div>
							<div class="form-group">
								<label>Lương căn bản</label>
								<input class="form-control" style="width: 50%" type="text" name="Luongcanban" id="lbSalary" placeholder="Nhập lương"/>
							</div>
							<div class="form-group" id="Status">
								<label>Trạng thái</label>
								<select class="form-control" style="width: 50%" name="Trangthai" id="inpStatus">
									<option value="1">Còn làm việc</option>
									<option value="2">Đã nghỉ làm</option>
								</select>
							</div>
							<button class="btn btn-primary" type="submit" name="" id="btnConfirm" value="">Xác nhận</button>
						</form>
					</fieldset>
					
					<div class="panel panel-body">
						<div style="margin-bottom: 10px;"> 
							<button class="btn btn-default" style="margin-left: 93%;" id="toggle-add">Thêm</button>
						</div>
						<div style="border: 2px groove rgba(120, 120, 120, 0.5); border-radius: 5px; ">
						<div style="position: relative; max-height: 510px; overflow-y: scroll;">
							<table class="table table-hover fixed-table-container" id="tableNV">
								<thead style="position: sticky; top: 0px;">
									<th style="padding-left: 5px">ID</th>
									<th style="padding-left: 5px">Tên nhân viên</th>
									<th style="padding-left: 5px">Email</th>
									<th style="padding-left: 5px">Số điện thoại</th>
									<th style="padding-left: 5px">Ngày vào</th>
									<th style="padding-left: 5px">Lương căn bản</th>
									<th style="padding-left: 5px">Trạng thái</th>
									<th></th>
								</thead>
								<tbody>
									<?php
										include_once('class/initTable.php');
										$init = new initTable();
										$init -> initNV();
									?>
								</tbody>
							</table>
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
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/bootstrap-table.js"></script>
	<script src="js/qlnhanvien.js"></script>
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
