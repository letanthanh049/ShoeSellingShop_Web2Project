<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<script src="../../js/sweetalert.min.js"></script>
<script src="../../js/jquery.validate.min.js"></script>
<script src="../../js/jquery.min.js"></script>
</head>
<body>
    <style> 
        form{
        max-width: 700px;
        width: 100%;
        background: #fff;
        padding: 25px 30px;
        border-radius: 5px;
        position: absolute;
        top: 30%;
        left: 50%;
        transform: translate(-50%,-50%);
    }
	.header{
		display: block;
		font-size: 25px;
		margin-bottom: 3%;
	}
    .form-group{
        margin-bottom: 10px;
    }
    .form-group input{
        height: 45px;
        width: 100%;
        outline: none;
        border-radius: 5px;
        border: 1px solid #ccc;
        padding-left: 15px;
        font-size: 16px;
        border-bottom-width: 2px;
        transition: all 0.3s ease;
    }
    .form-group input:focus,
    .form-group input:valid{
        border-color: #42bcd1;
    }
	.form-control{
		display: block;
		width: 250px;
		font-size: 20px;
		margin-bottom: 10px;
		margin: auto;
		text-align: left;
	}
    h1, h2, h3, h4, h5, h6 {
        color: #2B2D42;
        font-weight: 700;
        margin: 0 0 50px;
    }
    
    a {
        color: #2B2D42;
        font-weight: 500;
        -webkit-transition: 0.2s color;
        transition: 0.2s color;
    }
    
    a:hover, a:focus {
        color: #D10024;
        text-decoration: none;
        outline: none;
    }
    
    ul, ol {
        margin: 0;
        padding: 0;
        list-style: none
    }

    .btn {
        width: 20%;
        line-height: 2;
        outline: none;
        color: #fff;
        border: none;
        font-size: 18px;
        font-weight: 500;
        border-radius: 5px;
        margin-top: 20px;
        background: linear-gradient(135deg, #71b7e6, #3de9cc);
        cursor: pointer;
    }
    .btn:hover:hover{
        background: linear-gradient(-135deg, #71b7e6, #3de9cc);
    }
    </style>
<?php include_once('xulydangky.php');?>
<form method="post" action="register.php" style="text-align:center; margin-top: 5%;">
	<legend class="header">ĐĂNG KÝ TÀI KHOẢN</legend>
	<div class="form-group">
		<label class="form-control">Tên đăng nhập</label>
		<input style="width:250px"class="input" type="text" name="tendangnhap" id="tendangnhap" placeholder="Tên đăng nhập" >
	<br>
	<div style="display: none;" id="errorName">Vui lòng nhập tên đăng nhập</div>
	</div>
	<div class="form-group">
		<label class="form-control">Mật khẩu</label>
		<input style="width:250px"class="input" type="password" name="matkhau" id="matkhau" placeholder="Mật khẩu" /><br>
	<div style="display: none;" id="errorPass">Vui lòng nhập mật khẩu</div>
	</div>
	<div class="form-group">
		<label class="form-control">Email</label>
		<input style="width:250px"class="input" type="email" name="email" id="email" placeholder="Email" /><br>
	<div style="display: none;" id="errorEmail">Vui lòng nhập email</div>
	</div>
	<div class="form-group">
		<label class="form-control">Số điện thoại</label>
		<input style="width:250px"class="input" type="text" name="phone" id="phone" pattern="[0-9]{10}" value="" placeholder="Số điện thoại"/><br>
	</div>
	<button class="btn btn-danger" type="submit" name="dangky" id="dangky">Đăng ký</button>
</form>
<script src="../../js/jquery-3.1.1.min.js"></script>
<script type='text/javascript'>
	$('#dangky').on('click', function(e) {
		e.preventDefault();
		const Status = []; Status[0] = 1;  Status[1] = 1;  Status[2] = 1;  
		if ($('#tendangnhap').val() == "") {
			$('#errorName').attr('style', 'display: block; color: red;');
			Status[0] = 0;
		}
		
		if ($('#matkhau').val() == "") {
			$('#errorPass').attr('style', 'display: block; color: red;');
			Status[1] = 0;
		}
		
		if ($('#email').val() == "") {
			$('#errorEmail').attr('style', 'display: block; color: red;');
			Status[2] = 0;
		}
		
		if ($('#tendangnhap').val() != "") {
			$('#errorName').attr('style', 'display: none;');
			Status[0] = 1;
		}
		
		if ($('#matkhau').val() != "") {
			$('#errorPass').attr('style', 'display: none;');
			Status[1] = 1;
		}
		
		if ($('#email').val() != "") {
			$('#errorEmail').attr('style', 'display: none;');
			Status[2] = 1;
		}
		
		if (Status[0] == 1 && Status[1] == 1 && Status[2] == 1){
			$.ajax({
					url: "xulydangky.php",
					type: "POST",
					data: {
						signup: '',
						tendangnhap: $('#tendangnhap').val(),
						matkhau: $('#matkhau').val(),
						email: $('#email').val(),
						phone: $('#phone').val()
					},
					success: function(data) {	
						if (data == 1) {
							swal({
							  title: "Đăng ký tài khoản thành công",
							  text: "Tài khoản của bạn đã được đăng ký",
							  icon: "success",
					  		  buttons: {OK: true},
							})
							.then( (changeUrl) => {
								if (changeUrl) window.location.replace('http://localhost/qlgiaythethao/customer/frontend/chucnang/dangnhap/dangnhap.php');
							});
						} else if (data == 2) {
							swal({title: "Đăng ký tài khoản thất bại", text: "Tài khoản đã tồn tại", icon: "error"});
						} else if (data == 3) {
							swal({title: "Đăng ký tài khoản thất bại", text: "Email đã được sử dụng", icon: "error"});
						} else swal(data);
					},
			});
		}
	})
</script>
</body>
</html>

