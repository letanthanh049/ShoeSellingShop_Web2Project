<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Thống kê</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="css/mycss.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>


<script src="js/sweetalert.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/jquery.min.js"></script>
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
				<li class="active">Thống kê</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Thống kê</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12 col-md-5 col-sm-5">
				<div class="panel panel-default">
					<div class="panel panel-heading" style="width: 100%; display: inline-block; margin: auto;">
						<div class="col-lg-4" style="display: block;">
							<label style="margin-left: -20px">Theo:</label>
							<select name="inpChoice" id="inpChoice" style="height: 30px;">
								<option value="1">Tất cả</option>
								<option value="2">Thương hiệu</option>
								<option value="3">Loại sản phẩm</option>
								<option value="4">Sản phẩm bán chạy</option>
							</select>
							<select name="inpTrademark" id="inpTrademark" style="height: 30px; display: none;">
								<?php
									include_once('class/initTable.php');
									$p = new initTable();
									$p -> initoptionTH();
								?>
							</select>
							<select name="inpType" id="inpType"  style="height: 30px; display: none;">
								<?php
									include_once('class/initTable.php');
									$p = new initTable();
									$p -> initoptionLSP();
								?>
							</select>
						</div>
						<div class="col-lg-3" style="display: block;" id="div1">
							<label>Từ:</label>
							<input type="date" name="lbStart" id="lbStart">
						</div>
						<div class="col-lg-3" style="display: block;" id="div2">
							<label>Đến:</label>
							<input type="date" name="lbEnd" id="lbEnd">
						</div>
						<div class="col-lg-3" style="display: none;" id="div4">
							<label>Số sản phẩm:</label>
							<input type="text" name="lbAmount" id="lbAmount" style="width: 15%; height: 30px;">
						</div>
						<div class="col-lg-2" style="display: block;" id="div3">
							<button class="btn btn-default" name="confirmButton" id="confirmButton">Xác nhận</button>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
		
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div style="margin-bottom: 10px;"> 
							<label id="total" style="font-size: 30px; margin-left: 65%;"></label>
						</div>
						<div style="border: 2px groove rgba(120, 120, 120, 0.5); border-radius: 5px; display: none;" id="tableContainer">
						<div style="position: relative; max-height: 510px; overflow-y: scroll;">
							<table class="table table-hover fixed-table-container" id="tableTK">
							</table>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->		
		
	</div>	<!--/.main-->
	  

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
<!--	<script src="js/chart-data.js"></script>-->
	<script src="js/barchartData.js"></script>
<!--	<script src="js/easypiechart.js"></script>-->
<!--	<script src="js/easypiechart-data.js"></script>-->
	<script src="js/bootstrap-datepicker.js"></script>
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
