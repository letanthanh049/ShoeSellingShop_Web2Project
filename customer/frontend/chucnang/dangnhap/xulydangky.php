<?php
	include_once('../../../../admin/class/dataProvider.php');
	$dtP = new DataProvider();

	function addTKKH($id, $username, $password, $date) {
		$insert = "INSERT INTO taikhoan(idTK, idNQ, tendangnhap, matkhau, ngaytao, trangthai) 
				   VALUES ('$id',
						   '2',
						   '$username',
						   '$password',
						   '$date',
						   '1');";
		$GLOBALS['dtP'] -> executeQuery($insert);
	}
	
	if (isset($_POST['signup'])) {
		$tendangnhap = $_POST['tendangnhap'];
		$matkhau = $_POST['matkhau'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$select1 = "select * from taikhoan where tendangnhap = '$tendangnhap'";
		$select2 = "select * from khachhang where email = '$email'";
		$result1 = $GLOBALS['dtP'] -> executeQuery($select1);
		$result2 = $GLOBALS['dtP'] -> executeQuery($select2);
		$dupName = mysqli_fetch_assoc($result1);
		$dupEmail = mysqli_fetch_assoc($result2);
		if (!empty($dupName['tendangnhap'])) {
			echo 2; 
			exit();
		}
		if (!empty($dupEmail['email'])) {
			echo 3; 
			exit();
		}
		if (empty($dupName['tendangnhap']) && empty($dupEmail['email'])) {
			$sl = "SELECT * FROM `khachhang` ORDER BY idKH DESC LIMIT 1";
			$rs = $GLOBALS['dtP'] -> executeQuery($sl);
			$rw = mysqli_fetch_array($rs);
			$idKH = $rw['idKH'] + 1;
			$idTK = 'KH' . strval($idKH); 
			$date = date('Y/m/d');
			addTKKH($idTK, $tendangnhap, $matkhau, $date);
			$insertKH = "INSERT INTO khachhang (idKH, idTK, tenkhachhang, email, sdt)
				   VALUES (
						'$idKH',
						'$idTK',
						'$tendangnhap',
						'$email',
						'$phone'
				  );";
		if ($GLOBALS['dtP'] -> executeQuery($insertKH)) echo 1; else echo $insertKH;
		}
	}
?>