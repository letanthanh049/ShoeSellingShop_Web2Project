<?php
	include_once('dataProvider.php');
	$dtP = new DataProvider();
	
	if (isset($_POST['add'])) {
		if ($_POST['showImg'] == "images/") $url = "images/default-picture.png";
		else $url = $_POST['showImg'];
		$name = $_POST['lbName'];
		$type = $_POST['inpType'];
			$select1 = "SELECT tenloai FROM `loaisanpham` WHERE idLSP = $type";
			$result1 = $GLOBALS['dtP'] -> executeQuery($select1);
			$row1 = mysqli_fetch_assoc($result1);
			$tdata = $row1['tenloai'];
		$trademark = $_POST['inpTrademark'];
			$select2 = "SELECT tenthuonghieu FROM `thuonghieu` WHERE idTH = $trademark";
			$result2 = $GLOBALS['dtP'] -> executeQuery($select2);
			$row2 = mysqli_fetch_assoc($result2);
			$tmdata = $row2['tenthuonghieu'];
		$describe = $_POST['lbDescribe'];
		$size = $_POST['lbSize'];
		$color = $_POST['inpColor'];
			if ($color == 1) $color = "Trắng";
			if ($color == 2) $color = "Đen";
			if ($color == 3) $color = "Đỏ";
			if ($color == 4) $color = "Tím";
			if ($color == 5) $color = "Vàng";
			if ($color == 6) $color = "Cam";
			if ($color == 7) $color = "Hồng";
			if ($color == 8) $color = "Xanh da trời";
			if ($color == 9) $color = "Xanh lá";
			if ($color == 10) $color = "Xám";
		$price = $_POST['lbPrice'];
		$amount = $_POST['lbAmount'];
		if ($amount > 0) $status = 1; else $status = 2;
		$id = substr($tmdata, 0, 2) . substr($tdata, 0, 1) . $name . $size . $_POST['inpColor'];
		
		
		///check xem coi có trùng sản phẩm không nếu trùng thì + thêm số lượng còn không thì thêm mới
		$select = "SELECT * FROM sanpham WHERE idSP = '$id'";
		$result = $GLOBALS['dtP'] -> executeQuery($select);
		$row = mysqli_fetch_assoc($result);
		if (empty($row['idSP'])) {
		$insert = "INSERT INTO `sanpham`
					(`idSP`,`idLSP`,`idTH`,`tensanpham`,`motasanpham`,`mau`,`size`,`giaca`,`soluongCL`,`hinhanh`,`trangthai`,`visible`)
					VALUES 
					('$id', '$type', $trademark, '$name', '$describe', '$color', '$size', '$price', '$amount', '$url', '$status', 1)";
		} else if ($id == $row['idSP']) {
		$insert = "UPDATE sanpham SET
						soluongCL = soluongCL + $amount,
						giaca = $price";
		if ($describe != "") $insert .= ", mota = '".$describe."'";
		if ($url != "images/default-picture.png") $insert .= ", hinhanh = '".$url."'";
		$insert .=		",trangthai = $status
						WHERE idSP = '$id';";
		}
			
			
		if (($GLOBALS['dtP'] -> executeQuery($insert)) == false) {
			echo $insert;
		} else  echo 1;
	}

	
	if (isset($_POST['fix'])) {
		$id = $_POST['idSP'];
		$url = $_POST['showImg'];
		$name = $_POST['lbName'];
		$type = $_POST['inpType'];
			$select1 = "SELECT tenloai FROM `loaisanpham` WHERE idLSP = $type";
			$result1 = $GLOBALS['dtP'] -> executeQuery($select1);
			$row1 = mysqli_fetch_assoc($result1);
			$tdata = $row1['tenloai'];
		$trademark = $_POST['inpTrademark'];
			$select2 = "SELECT tenthuonghieu FROM `thuonghieu` WHERE idTH = $trademark";
			$result2 = $GLOBALS['dtP'] -> executeQuery($select2);
			$row2 = mysqli_fetch_assoc($result2);
			$tmdata = $row2['tenthuonghieu'];
		$describe = $_POST['lbDescribe'];
		if ($describe != "") $describe = $_POST['lbDescribe'];
		else {
			$select = "SELECT motasanpham FROM `sanpham` WHERE idSP = '$id'";
			$result = $GLOBALS['dtP'] -> executeQuery($select);
			$row = mysqli_fetch_assoc($result);
			$describe = $row['motasanpham'];
		}
		$size = $_POST['lbSize'];
		$color = $_POST['inpColor'];
			if ($color == 1) $color = "Trắng";
			if ($color == 2) $color = "Đen";
			if ($color == 3) $color = "Đỏ";
			if ($color == 4) $color = "Tím";
			if ($color == 5) $color = "Vàng";
			if ($color == 6) $color = "Cam";
			if ($color == 7) $color = "Hồng";
			if ($color == 8) $color = "Xanh da trời";
			if ($color == 9) $color = "Xanh lá";
			if ($color == 10) $color = "Xám";
		$price = $_POST['lbPrice'];
		$amount = $_POST['lbAmount'];
		$status = $_POST['inpStatus'];
		$newid = substr($tmdata, 0, 2) . substr($tdata, 0, 1) . $name . $size . $_POST['inpColor'];
		$update = "UPDATE sanpham SET
					idSP = '$newid',
					tensanpham = '$name',
					idLSP = $type,
					idTH = $trademark,
					motasanpham = '$describe',
					size = '$size',
					mau = '$color',
					giaca = $price,
					soluongCL = $amount,
					hinhanh = '$url',
					trangthai = $status
				WHERE idSP = '$id'";
		
		
		if (($GLOBALS['dtP'] -> executeQuery($update)) == false) {
			echo $update;
		} else echo 1;
	}

	
	if (isset($_POST['del'])) {
		$id = $_POST['idSP'];
		$delete = "UPDATE sanpham SET visible = 0 WHERE idSP = '$id'";
		
		if (($GLOBALS['dtP'] -> executeQuery($delete)) == false) {
			echo $delete;
		} else echo 1;
	}
		


?>