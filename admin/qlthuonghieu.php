<?php
	include_once('class/handling.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Quản lý thương hiệu</title>

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
				<li class="active">Quản lý thương hiệu</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Quản lý thương hiệu</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Danh sách thương hiệu</div>
					
					<div class="panel panel-body">
						<div style="border: 2px groove rgba(120, 120, 120, 0.5); border-radius: 5px; width: 48%; display: inline-block;">
						<div style="position: relative; max-height: 510px; overflow-y: scroll;">
							<table class="table table-hover fixed-table-container" id="tableTH">
								<thead style="position: sticky; top: 0px;">
									<th style="padding-left: 5px">ID</th>
									<th style="padding-left: 5px">Tên thương hiệu</th>
									<th style="padding-left: 5px">Trạng thái</th>
									<th></th>
								</thead>
								<tbody>
									<?php
										include_once('class/initTable.php');
										$init = new initTable();
										$init -> initTH();
									?>
								</tbody>
							</table>
						</div>
						</div>
						
						<div style="width: 48%; display: inline-block; vertical-align: top; margin-left: 30px;">
							<fieldset class="panel panel-footer" id="formTH" style="display: block; border: 1px solid rgba(120, 120, 120, 0.5); background-clip: padding-box;">
								<legend>Bảng chỉnh sửa</legend>
								<form action="qlthuonghieu.php" method="post" role="form" id="innerForm">
									<div class="form-group">
										<label>Tên thương hiệu</label>
										<input class="form-control" style="width: 50%" type="text" name="Tenthuonghieu" id="lbName" placeholder="Nhập tên thương hiệu"/>
										<div id="errorName" style="display: none;">Vui lòng nhập đầy đủ tên thương hiệu</div>
									</div>
									<div class="form-group" style="width: 30%">
										<label>Trạng thái</label>
										<select class="form-control" name="Trangthai" id="inpStatus">
											<option value="1">Hoạt động</option>
											<option value="2">Vô hiệu hóa</option>
										</select>
									</div>
									<button class="btn btn-primary btnConfirm" type="submit" name="addTH-btn" id ="addTH-btn" value="">Thêm</button>
									<button class="btn btn-primary btnConfirm" type="submit" name="delTH-btn" id ="delTH-btn" value="">Xóa</button>
								</form>
							</fieldset>
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
	<script src="js/qlthuonghieu.js"></script>
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
