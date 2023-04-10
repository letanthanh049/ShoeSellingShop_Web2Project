<?php
	include_once('dataProvider.php');
	$dtP = new DataProvider();

	if (isset($_POST['detail'])) {
		$idDH = $_POST['idDH'];
		$select = "select * from donhang where idDH = $idDH";
		$select2 = "select sanpham.tensanpham, thuonghieu.tenthuonghieu, loaisanpham.tenloai, sanpham.size, sanpham.mau, chitietdonhang.soluong, chitietdonhang.giaca from chitietdonhang join sanpham join thuonghieu join loaisanpham where idDH = $idDH and chitietdonhang.idSP = sanpham.idSP and sanpham.idTH = thuonghieu.idTH and sanpham.idLSP = loaisanpham.idLSP";
		$result = $GLOBALS['dtP'] -> executeQuery($select);
		$result2 = $GLOBALS['dtP'] -> executeQuery($select2);
		$row = mysqli_fetch_assoc($result);
			$idKH = $row['idKH'];
			if (!is_null($row['idNV'])) $idNV = $row['idNV'];
			else $idNV = "-1";
			$selectKH = "SELECT * FROM `khachhang` WHERE `idKH` = $idKH";
			$selectNV = "SELECT * FROM `nhanvien` WHERE `idNV` = $idNV";
			$resultKH = $GLOBALS['dtP'] -> executeQuery($selectKH);
			$resultNV = $GLOBALS['dtP'] -> executeQuery($selectNV);
			$rowKH = mysqli_fetch_assoc($resultKH);
			$rowNV = mysqli_fetch_assoc($resultNV);
		$tenkhachhang = $rowKH['tenkhachhang'];
		if (empty($rowNV['tennhanvien'])) $tennhanvien = "";
		else $tennhanvien = $rowNV['tennhanvien'];
		$ngaytaodon = $row['ngaytaodon'];
		$tongtien = $row['tongtien'];
		$ngaydukien = $row['ngaygiaohangdukien'];
		$html1 = "<label class='form-control'>Mã đơn hàng: $idDH</label>
				 <label class='form-control'>Tên khách hàng: $tenkhachhang</label>
				 <label class='form-control'>Tên nhân viên xử lý đơn: $tennhanvien</label>
				 <label class='form-control'>Ngày tạo đơn: $ngaytaodon</label>
				 <label class='form-control'>Ngày giao hàng dự kiến: $ngaydukien</label>
				 <label class='form-control'>Tổng tiền: $tongtien</label>";
		$html2 = "";
		while($row2 = mysqli_fetch_assoc($result2)) {
			$tensanpham = $row2['tensanpham'];
			$tenthuonghieu = $row2['tenthuonghieu'];
			$tenloai = $row2['tenloai'];
			$size = $row2['size'];
			$mau = $row2['mau'];
			$soluong = $row2['soluong'];
			$giaca = $row2['giaca'];
			$html2 .= "<tr>
						<td>$tensanpham</td>
						<td>$tenthuonghieu</td>
						<td>$tenloai</td>
						<td>$size</td>
						<td>$mau</td>
						<td>$soluong</td>
						<td>$giaca</td>
					   </tr>";
		}
		echo $html1."^".$html2;
	}

	if (isset($_POST['click'])) {
		$start = $_POST['start'];
		$end = $_POST['end'];
		echo initTable($start, $end);
	}

	function initTable($s, $e) {
		if ($s == "" && $e == "") $select = "SELECT * FROM `donhang` WHERE trangthai = 1";
		else if ($s != "" && $e != "") $select = "SELECT * FROM `donhang` WHERE ngaytaodon >= '$s' AND ngaytaodon <= '$e'";
		$result = $GLOBALS['dtP'] -> executeQuery($select);
		$html = "";
		while($row = mysqli_fetch_assoc($result)) {
			$idDH = $row['idDH'];
			$idKH = $row['idKH'];
			if (!is_null($row['idNV'])) $idNV = $row['idNV'];
			else $idNV = "-1";
			$ngaytaodon = $row['ngaytaodon'];
			$idTT = $row['idTT'];
			$selectKH = "SELECT * FROM `khachhang` WHERE `idKH` = $idKH";
			$selectNV = "SELECT * FROM `nhanvien` WHERE `idNV` = $idNV";
			$selectTT = "SELECT * FROM `tinhtrang` WHERE `idTT` = $idTT";
			$resultKH = $GLOBALS['dtP'] -> executeQuery($selectKH);
			$resultNV = $GLOBALS['dtP'] -> executeQuery($selectNV);
			$resultTT = $GLOBALS['dtP'] -> executeQuery($selectTT);
			$rowKH = mysqli_fetch_assoc($resultKH);
			$rowNV = mysqli_fetch_assoc($resultNV);
			$rowTT = mysqli_fetch_assoc($resultTT);
			$tenkhachhang = $rowKH['tenkhachhang'];
			if (empty($rowNV['tennhanvien'])) $tennhanvien = "";
			else $tennhanvien = $rowNV['tennhanvien'];
			$tinhtrang = $rowTT['tinhtrang'];
			if ($idTT == 0) $color = "<tr style='background-color: rgba(185, 208, 230, 1.00);'>";
			else if ($idTT == 1) $color = "<tr style='background-color: rgba(0, 213, 255, 1.00);'>";
			else if ($idTT == 2 || $idTT == 3) $color = "<tr style='background-color: rgba(52, 178, 51, 0.60);'>";
			else if ($idTT == 4)  $color = "<tr style='background-color: rgba(235, 117, 108, 1.00);'>";
			$html .= $color;
			$html .= "<td class='my-checkbox'><input type='checkbox'></td>";
			$html .= "<td>$idDH</td>";
			$html .= "<td>$tenkhachhang</td>";
			$html .= "<td>$tennhanvien</td>";
			$html .= "<td>$ngaytaodon</td>";
			$html .= "<td>$tinhtrang</td>";
			$html .= "<td style='width: 18%;'>
					<div class='btnGroup'>
						<form method='post' style='display: inline'>
						<div style='display: none;'><input name='currentAc' id='currentAc' value=''></div>";
							if ($idTT == 0) {
						$html .= "<button class='btn btn-default' type='submit' name='accept' id='accept' value='$idDH'>Duyệt đơn</button>";
						$html .= "<span> </span><button class='btn btn-default' type='submit' name='cancel' id='cancel' value='$idDH'>Hủy đơn</button>
						</form>
					</div>
				</td>";}
						else if ($idTT == 1) {
						$html .= "<button class='btn btn-default' type='submit' name='deliver' id='deliver' value='$idDH'>Bàn giao vận chuyển</button>
						</form>
					</div>
				</td>";}
						else if ($idTT == 2) {
						$html .= "
						</form>
					</div>
				</td>";}
						else if ($idTT == 3) {
						$html .= "<button class='btn btn-default' type='submit' name='delete' id='delete' value='$idDH'>Xóa đơn</button>
						</form>
					</div>
				</td>";}
			$html .= "</tr>";
		}
		return $html;
	}
?>