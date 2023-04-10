<?php
	include_once('dataProvider.php');
	$dtP = new DataProvider();

	if (isset($_POST['accept'])) {
		$id = $_POST['accept'];
		$select = "select * from donhang where idDH = $id";
		$tennhanvien = $_POST['currentAc'];
		$sl = "select * from nhanvien where tennhanvien = $tennhanvien";
		$result = $GLOBALS['dtP'] -> executeQuery($select);
		$rs = $GLOBALS['dtP'] -> executeQuery($sl);
		$row = mysqli_fetch_assoc($result);
		$rw = mysqli_fetch_assoc($rs);
		$idNV = $rw['idNV'];
		$ngaytaodon = $row['ngaytaodon'];
		$ngaygiaohang = date('Y-m-d', strtotime('+7 days', strtotime($ngaytaodon)));
		$update = "update donhang set 
					idNV = $idNV,
					idTT = 1,
					ngaygiaohangdukien = '$ngaygiaohang' 
					where idDH = $id";
		$GLOBALS['dtP'] -> executeQuery($update);
	}

	if (isset($_POST['cancel'])) {
		$id = $_POST['cancel'];
		$update = "update donhang set idTT = 4 where idDH = $id";
		$GLOBALS['dtP'] -> executeQuery($update);
	}

	if (isset($_POST['deliver'])) {
		$id = $_POST['accept'];
		$update = "update donhang set idTT = 2 where idDH = $id";
		$GLOBALS['dtP'] -> executeQuery($update);
	}

	if (isset($_POST['delete'])) {
		$id = $_POST['delete'];
		$update = "update donhang set trangthai = 0 where idDH = $id";
		$GLOBALS['dtP'] -> executeQuery($update);
	}
?>