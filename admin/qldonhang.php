<?php
	include_once('class/orderHandling2.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Quản lý đơn hàng</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<!--Icons-->
<script src="js/lumino.glyphs.js"></script>
	
<!--MY FILE-->
<link href="css/mycss.css" rel="stylesheet">
	  

<link href="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js">
<script src="js/sweetalert.min.js"></script>
<!--<script src="js/jquery.validate.min.js"></script>-->
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
				<li class="active">Quản lý đơn hàng</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Quản lý đơn hàng</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Danh sách đơn hàng</div>
					<div class="panel panel-heading" style="width: 100%; height: auto; display: inline-block; margin: auto;">
						<div class="col-lg-3" style="display: inline-block;">
							<label>Từ:</label>
							<input type="date" name="lbStart" id="lbStart">
						</div>
						<div class="col-lg-3" style="display: inline-block;">
							<label>Đến:</label>
							<input type="date" name="lbEnd" id="lbEnd">
						</div>
						<div class="col-lg-4" style="display: inline-block;">
							<button class="btn btn-default" name="confirmButton" id="confirmButton">Xác nhận</button>
						</div>
						<div class="col-lg-2" style="display: inline-block;">
							<button class="btn btn-default" name="showDetailButton" id="showDetailButton">Xem chi tiết</button>
						</div>
					</div>
					<fieldset class="panel panel-footer" id="orderDetail" style="display: none; width: 90%; margin-left: 30px; border: 1px solid rgba(120, 120, 120, 0.5); background-clip: padding-box;">
						<legend>Chi tiết đơn hàng</legend>
						<div id="information" style="display: inline-block; width: 30%;">
							
						</div>
						<div style="border: 2px groove rgba(120, 120, 120, 0.5); border-radius: 5px; display: inline-block; width: auto; margin-left: 2%; vertical-align: top;">
						<div style="position: relative; max-height: 200px; overflow-y: scroll;">
							<table class="table table-hover fixed-table-container" id="tableDetail">
								<thead style="position: sticky; top: 0px;">
									<th style="padding-left: 5px">Tên sản phẩm</th>
									<th style="padding-left: 5px">Thương hiệu</th>
									<th style="padding-left: 5px">Loại sản phẩm</th>
									<th style="padding-left: 5px">Size</th>
									<th style="padding-left: 5px">Màu</th>
									<th style="padding-left: 5px">Số lượng</th>
									<th style="padding-left: 5px">Giá tiền</th>
								</thead>
								<tbody id="detail-body">
									
								</tbody>
							</table>
						</div>
						</div>
						<button class="form-control btn btn-primary" id="close" style="display: block; width: 10%; margin: auto;">Đóng</button>
					</fieldset>
					<div class="panel panel-body">
						<div id="listDH">
						<div style="border: 2px groove rgba(120, 120, 120, 0.5); width: 100%; border-radius: 5px; display: inline-block;">
							<div style="position: relative; max-height: 510px; overflow-y: scroll;">
								<table class="table table-hover fixed-table-container" id="tableDH">
									<thead style="position: sticky; top: 0px;">
										<th style="padding-left: 5px"></th>
										<th style="padding-left: 5px">ID</th>
										<th style="padding-left: 5px">Tên khách hàng</th>
										<th style="padding-left: 5px">Nhân viên</th>
										<th style="padding-left: 5px">Ngày tạo</th>
										<th style="padding-left: 5px">Tình trạng</th>
										<th></th>
									</thead>
									<tbody id="default-body">
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
		
		
		
		function checkboxEvent() {
			$('.my-checkbox').on('change', function() {
				var pos = $(this).closest('tr').find('td').eq(1).html();
				for (let i=0; i<$(this).closest('tbody').find('tr').length; i++) 
					if ($(this).closest('tbody').find('tr').eq(i).find('td').eq(1).html() != pos) 
						$(this).closest('tbody').find('tr').eq(i).find('td').eq(0).find('input').attr('checked', false);
			})
		}
		
		$('#confirmButton').on('click', function() {
			var start = $('#lbStart').val();
			var end = $('#lbEnd').val();
			let Status = 1; 
			if (start > end) Status = 0;
			if (start != 0 && end == 0) Status = 0;
			if (start == 0 && end != 0) Status = 0;
			if (Status == 1)
				$.ajax({
					url: "class/orderHandling.php",
					type: "POST",
					data: {
						click: '',
						start: start,
						end: end
					},
					success: function(data) {
							$('#default-body').html(data);
							setTimeout(function() {checkboxEvent();}, 400);
						}
				});
			else if (Status == 0) swal({title: "Lỗi dữ liệu!", text: "Khoảng thời gian không hợp lệ", icon:"warning"})
		})
		console.log($('#abc').html());
		$('#showDetailButton').on('click', function() {
			var id = -1;
			for (let i=0; i<$('#tableDH').find('tbody').find('tr').length; i++) 
				if ($('#tableDH').find('tbody').find('tr').eq(i).find('td').eq(0).find('input').is(':checked')) {
					id = $('#tableDH').find('tbody').find('tr').eq(i).find('td').eq(1).html();
					break;
				}
			
			if (id != -1)
				$.ajax({
					url: "class/orderHandling.php",
					type: "POST",
					data: {
						detail: '',
						idDH: id,
					},
					success: function(data){
						var result = data.split("^");
						$('#information').html(result[0]);
						$('#detail-body').html(result[1]);
						$('#orderDetail').attr('style', 'display: block; width: 90%; margin-left: 30px; border: 1px solid rgba(120, 120, 120, 0.5); background-clip: padding-box;');
					}
				})
			else swal("Hãy chọn đơn hàng cần xem");
		})
	</script>
</body>

</html>
