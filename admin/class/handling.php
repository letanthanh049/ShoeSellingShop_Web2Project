<?php
	include_once('dataProvider.php');
	$dtP = new DataProvider();

	function output( $array ) {
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}



/*--- 		thêm tài khoản khách hàng		---*/
	function addTKKH($id, $username, $date) {
		$insert = "INSERT INTO taikhoan(idTK, idNQ, tendangnhap, matkhau, ngaytao, trangthai) 
				   VALUES ('$id',
						   '2',
						   '$username',
						   '123',
						   '$date',
						   '1');";
		$GLOBALS['dtP'] -> executeQuery($insert);
	}


/*--- 		thêm tài khoản nhân viên		---*/
	function addTKNV($id, $username, $date) {
		$insert = "INSERT INTO taikhoan(idTK, idNQ, tendangnhap, matkhau, ngaytao, trangthai) 
				   VALUES ('$id',
						   '3',
						   '$username',
						   '123',
						   '$date',
						   '1');";
		$GLOBALS['dtP'] -> executeQuery($insert);
	}


/*--- 		thêm tài khoản tùy chọn		---*/
	function addTK() {
		$username = $_POST['Tendangnhap'];
		$password = $_POST['Matkhau'];
		$date = date('Y/m/d');
		$role = $_POST['Quyenhan'];
		$select = "SELECT COUNT(idTK) FROM `taikhoan`";
		$result = $GLOBALS['dtP'] -> executeQuery($select);
		$row = mysqli_fetch_array($result);
		$id = $username . strval($row['COUNT(idTK)']); 
		$status = $_POST['Trangthai'];
		$insert = "INSERT INTO taikhoan(idTK, idNQ, tendangnhap, matkhau, ngaytao, trangthai) 
				   VALUES ('$id',
						   '$role',
						   '$username',
						   '$password',
						   '$date',
						   '$status');";
		$GLOBALS['dtP'] -> executeQuery($insert);
	}


/*--- 		thêm khách hàng		---*/
	function addKH($con) {
		
	}


/*--- 		thêm nhân viên		---*/
	function addNV() {
		$select = "SELECT * FROM `nhanvien` ORDER BY idNV DESC LIMIT 1;";
		$result = $GLOBALS['dtP'] -> executeQuery($select);
		$row = mysqli_fetch_array($result);
		$idNV = $row['idNV'] + 1;
		$ten = $_POST['Hoten'];
		$date = date('Y/m/d');
		$idTK = 'NV'.$idNV;
		$email = $_POST['Email'];
		$sdt = $_POST['Sdt'];
		$luongcanban = $_POST['Luongcanban'];
		$username = substr($email, 0, strpos($email, "@"));
		addTKNV($idTK, $username, $date);
		$insert = "INSERT INTO nhanvien (idNV, idTK, tennhanvien, email, sdt, luongcanban, ngayvao, trangthai)
				   VALUES (
						'$idNV',
						'$idTK',
						'$ten',
						'$email',
						'$sdt',
						'$luongcanban',
						'$date',
						'1'
				  );";
		$GLOBALS['dtP'] -> executeQuery($insert);
	}






/*--- 		thêm loại sản phẩm		---*/
	function addLSP() {
		$select = "SELECT * FROM `loaisanpham` ORDER BY idLSP DESC LIMIT 1;";
		$result = $GLOBALS['dtP'] -> executeQuery($select);
		$row = mysqli_fetch_assoc($result);
		$id = $row['idLSP'] + 1;
		$name = $_POST['TenLSP'];
		$status = $_POST['Trangthai'];
		$insert = "INSERT INTO loaisanpham (`idLSP`, `tenloai`, `trangthai`) 
				VALUES ('$id','$name','$status');";
		$GLOBALS['dtP'] -> executeQuery($insert);
	}
		
		
/*--- 		sửa thông tin tài khoản		---*/
	function fixTK($id) {
		$username = $_POST['Tendangnhap'];
		$password = $_POST['Matkhau'];
		$date = $_POST['Ngaytao'];
		$role = $_POST['Quyenhan'];
		$status = $_POST['Trangthai'];
		$update = "UPDATE taikhoan SET
				taikhoan.idNQ = '$role',
				taikhoan.tendangnhap = '$username',
				taikhoan.matkhau = '$password',
				taikhoan.ngaytao = '$date',
				taikhoan.trangthai = '$status'
				WHERE taikhoan.idTK = '$id';";
		$GLOBALS['dtP'] -> executeQuery($update);
	}


/*--- 		sửa thông tin khách hàng		---*/
	function fixKH($con) {
		
	}


/*--- 		sửa thông tin nhân viên		---*/
	function fixNV($id) {
		$select = "SELECT * FROM `nhanvien` WHERE `nhanvien`.`idNV` = '$id';";
		$result = $GLOBALS['dtP'] -> executeQuery($select);
		$row = mysqli_fetch_array($result);
		$ten = $_POST['Hoten'];
		$email = $_POST['Email'];
		$sdt = $_POST['Sdt'];
		$date = $_POST['Ngayvao'];
		$luongcanban = $_POST['Luongcanban'];
		$status = $_POST['Trangthai'];
		
		$update = "UPDATE `nhanvien` SET 
				`nhanvien`.`tennhanvien` = '$ten', 
				`nhanvien`.`email` = '$email',
				`nhanvien`.`sdt` = '$sdt',
				`nhanvien`.`ngayvao` = '$date',
				`nhanvien`.`luongcanban` = '$luongcanban',
				`nhanvien`.`trangthai` = '$status'
				WHERE idNV = '$id'"; 
		$GLOBALS['dtP'] -> executeQuery($update);
	}



/*--- 		xóa thông tin khách hàng + tài khoản khách hàng		---*/
	function delKH($con) {
		
	}



/*--- 		xóa thông tin nhân viên + tài khoản nhân viên		---*/
	function delNV($id) {
		$select = "SELECT * FROM `nhanvien` WHERE `nhanvien`.`idNV` = '$id';";
		$result = $GLOBALS['dtP'] -> executeQuery($select);
		$row = mysqli_fetch_assoc($result);
		$idTK = $row['idTK'];
		
		
			$delete1 = "DELETE FROM `nhanvien` WHERE `nhanvien`.`idNV` = '$id'";
			$GLOBALS['dtP'] -> executeQuery($delete1);
			
			$delete2 = "DELETE FROM `taikhoan` WHERE `taikhoan`.`idTK` = '$idTK'";
			$GLOBALS['dtP'] -> executeQuery($delete2);
	}



/*--- 		xóa thương hiệu		---*/	
	function delTH($id) {
		$delete = "DELETE FROM `thuonghieu` WHERE `thuonghieu`.`idTH` = '$id'";
		$GLOBALS['dtP'] -> executeQuery($delete);
	}



/*--- 		xóa loại sản phẩm		---*/	
	function delLSP($id) {
		$delete = "DELETE FROM `loaisanpham` WHERE `loaisanpham`.`idLSP` = '$id'";
		$GLOBALS['dtP'] -> executeQuery($delete);
	}







/*--- 		kiểm tra và gọi function		---*/
	
/*---		Các hàm gọi cho giao diện nhân viên		---*/
	if(isset($_POST['addNV-btn'])) {
		addNV(); 
	} 
	
	if(isset($_POST['fixNV-btn'])) {
		$id = $_POST['fixNV-btn'];
		fixNV($id);
	} 

	if(isset($_POST['delNV-btn'])) {
		$id = $_POST['delNV-btn'];
		delNV($id);
	}
/*-----------------------------------------------------------------------------------------------*/



/*---		Các hàm gọi cho giao diện tài khoản		---*/
	if(isset($_POST['addTK-btn'])){
		addTK();
	}

	if(isset($_POST['fixTK-btn'])){
		$id = $_POST['fixTK-btn'];
		$sl = "SELECT * FROM taikhoan WHERE idTK = '$id'";
		$rs = $GLOBALS['dtP'] -> executeQuery($sl);
		$rw = mysqli_fetch_assoc($rs);
		if ($rw['tendangnhap'] != $_POST['currentAc']) fixTK($id);
		else echo "<script type='text/javascript'>alert('Tài khoản đang được sử dụng, không thể sửa đổi');</script>";
	}

	if(isset($_POST['lockTK-btn'])){
		$id = $_POST['lockTK-btn'];
		$update = "UPDATE taikhoan SET taikhoan.trangthai = 2 WHERE taikhoan.idTK = '$id'";
		$GLOBALS['dtP'] -> executeQuery($update);
	}

	if(isset($_POST['unlockTK-btn'])){
		$id = $_POST['unlockTK-btn'];
		$update = "UPDATE taikhoan SET taikhoan.trangthai = 1 WHERE taikhoan.idTK = '$id'";
		$GLOBALS['dtP'] -> executeQuery($update);
	}
/*-----------------------------------------------------------------------------------------------*/



/*---		Các hàm gọi cho giao diện thương hiệu		---*/
	if(isset($_POST['addTH-btn'])) {
		$name = $_POST['Tenthuonghieu'];
		$select = "SELECT * FROM `thuonghieu` WHERE `thuonghieu`.`tenthuonghieu` = '$name';";
		$result = $GLOBALS['dtP'] -> executeQuery($select);
		$row = mysqli_fetch_assoc($result);
		
		if (!empty($row['tenthuonghieu'])) {
			echo '<script type="text/javascript">';
			echo 'setTimeout(function () { swal("Lỗi dữ liệu", "Thương hiệu đã tồn tại!", "error");';
			echo '}, 100);</script>'; 
		}
		if (empty($row['tenthuonghieu'])) addTH();
	}

	if(isset($_POST['hideTH-btn'])){
		$id = $_POST['hideTH-btn'];
		$update = "UPDATE thuonghieu SET thuonghieu.trangthai = 2 WHERE thuonghieu.idTH = '$id'";
		$GLOBALS['dtP'] -> executeQuery($update);
	}

	if(isset($_POST['showTH-btn'])){
		$id = $_POST['showTH-btn'];
		$update = "UPDATE thuonghieu SET thuonghieu.trangthai = 1 WHERE thuonghieu.idTH = '$id'";
		$GLOBALS['dtP'] -> executeQuery($update);
	}

	if(isset($_POST['delTH-btn'])) {
		$id = $_POST['delTH-btn'];
		$select = "SELECT * FROM `sanpham` WHERE `sanpham`.`idTH` = '$id'";
		$result = $GLOBALS['dtP'] -> executeQuery($select);
		$row = mysqli_fetch_assoc($result);
		if (empty($row)) delTH($id);
		else {
			echo '<script type="text/javascript">';
			echo 'setTimeout(function () { swal("Lỗi dữ liệu", "Thương hiệu này vẫn đang được sử dụng!", "error");';
			echo '}, 100);</script>'; 
		}
	}
/*-----------------------------------------------------------------------------------------------*/



/*---		Các hàm gọi cho giao diện loại sản phẩm		---*/
	if(isset($_POST['addLSP-btn'])) {
		$name = $_POST['TenLSP'];
		$select = "SELECT * FROM `loaisanpham` WHERE `loaisanpham`.`tenloai` = '$name'";
		$result = $GLOBALS['dtP'] -> executeQuery($select);
		$row = mysqli_fetch_assoc($result);
		
		if (!empty($row['tenloai'])) {
			echo '<script type="text/javascript">';
			echo 'setTimeout(function () { swal("Lỗi dữ liệu", "Loại sản phẩm này đã tồn tại!", "error");';
			echo '}, 100);</script>'; 
		}
		if (empty($row['tenloai'])) addLSP();
	}

	if(isset($_POST['hideLSP-btn'])){
		$id = $_POST['hideLSP-btn'];
		$update = "UPDATE loaisanpham SET loaisanpham.trangthai = 2 WHERE loaisanpham.idLSP = '$id'";
		$GLOBALS['dtP'] -> executeQuery($update);
	}

	if(isset($_POST['showLSP-btn'])){
		$id = $_POST['showLSP-btn'];
		$update = "UPDATE loaisanpham SET loaisanpham.trangthai = 1 WHERE loaisanpham.idLSP = '$id'";
		$GLOBALS['dtP'] -> executeQuery($update);
	}

	if(isset($_POST['delLSP-btn'])) {
		$id = $_POST['delLSP-btn'];
		$select = "SELECT * FROM `sanpham` WHERE `sanpham`.`idLSP` = '$id'";
		$result = $GLOBALS['dtP'] -> executeQuery($select);
		$row = mysqli_fetch_assoc($result);
		if (empty($row)) delLSP($id);
		else {
			echo '<script type="text/javascript">';
			echo 'setTimeout(function () { swal("Lỗi dữ liệu", "Loại sản phẩm này vẫn đang được sử dụng!", "error");';
			echo '}, 100);</script>'; 
		}
	}
/*-----------------------------------------------------------------------------------------------*/
?>