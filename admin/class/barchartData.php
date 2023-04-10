<?php
	include_once('dataProvider.php');
	$dtP = new DataProvider();

	if (isset($_POST['confirmButton'])) {
		$choice = $_POST['choice'];
		$trademark = $_POST['trademark'];
		$type = $_POST['type'];
		$start = $_POST['start'];
		$end = $_POST['end'];
		$amount = $_POST['amount'];
		$total = 0; //tổng tiền
		$html = "";
		if ($choice == 1) {
			$html .= "	<thead style='position: sticky; top: 0px;'>
							<th style='padding-left: 5px'>ID</th>
							<th style='padding-left: 5px'>Tên khách hàng</th>
							<th style='padding-left: 5px'>Tên nhân viên</th>
							<th style='padding-left: 5px'>Ngày tạo đơn</th>
							<th style='padding-left: 5px'>Tổng tiền</th>
						</thead>
						<tbody>";
			
			if ($start == 0 && $end == 0) {
				$s = date('Y-01-01');
				$e = date('Y-12-31');
				$select = "select * from donhang where ngaytaodon >= '$s' and ngaytaodon <= '$e' and idTT >= 1";
				$result = $GLOBALS['dtP'] -> executeQuery($select);
			}
			
			if ($start != 0 && $end != 0) {
				$select = "select * from donhang where ngaytaodon >= '$start' and ngaytaodon <= '$end' and idTT >= 1";
				$result = $GLOBALS['dtP'] -> executeQuery($select);
			}
			
			while ($row = mysqli_fetch_assoc($result)) {
				$idDH = $row['idDH'];
				$idKH = $row['idKH'];
				$sl1 = "select * from khachhang where idKH = '$idKH'";
				$rs1 = $GLOBALS['dtP'] -> executeQuery($sl1);
				$rw1 = mysqli_fetch_assoc($rs1);
				$tenkhachhang = $rw1['tenkhachhang'];
				$idNV = $row['idNV'];
				$sl2 = "select * from nhanvien where idNV = '$idNV'";
				$rs2 = $GLOBALS['dtP'] -> executeQuery($sl2);
				$rw2 = mysqli_fetch_assoc($rs2);
				$tennhanvien = $rw2['tennhanvien'];
				$ngaytaodon = $row['ngaytaodon'];
				$tongtien = $row['tongtien'];
				$total += $row['tongtien'];
				$html .= "<tr><td>$idDH</td>
						  <td>$tenkhachhang</td>
						  <td>$tennhanvien</td>
						  <td>$ngaytaodon</td>
						  <td>$tongtien</td></tr>";
			}
			$html .= "</tbody>";
			$r = mysqli_fetch_assoc($result);
			echo $html.",".$total;
		}
		
		if ($choice == 2) {
			if ($trademark == 0) {
				$html .= "	<thead style='position: sticky; top: 0px;'>
								<th style='padding-left: 5px'>ID</th>
								<th style='padding-left: 5px'>Tên thương hiệu</th>
								<th style='padding-left: 5px'>Số lượng</th>
								<th style='padding-left: 5px'>Tổng tiền</th>
							</thead>
							<tbody>";
				
				if ($start == 0 && $end == 0) {
					$s = date('Y-01-01');
					$e = date('Y-12-31');
					$select = "SELECT chitietdonhang.idDH, chitietdonhang.idSP, chitietdonhang.soluong, chitietdonhang.giaca, sanpham.idTH FROM donhang JOIN chitietdonhang JOIN sanpham WHERE donhang.idTT >= 1 AND sanpham.idSP = chitietdonhang.idSP AND chitietdonhang.idDH = donhang.idDH AND donhang.ngaytaodon >= '$s' AND donhang.ngaytaodon <= '$e'";
					$result = $GLOBALS['dtP'] -> executeQuery($select);
				}
				
				if ($start != 0 && $end != 0) {
					$select = "SELECT chitietdonhang.idDH, chitietdonhang.idSP, chitietdonhang.soluong, chitietdonhang.giaca, sanpham.idTH FROM donhang JOIN chitietdonhang JOIN sanpham WHERE donhang.idTT >= 1 AND sanpham.idSP = chitietdonhang.idSP AND chitietdonhang.idDH = donhang.idDH AND donhang.ngaytaodon >= '$start' AND donhang.ngaytaodon <= '$end'";
					$result = $GLOBALS['dtP'] -> executeQuery($select);
				}

				$sl = "SELECT * FROM `thuonghieu` WHERE trangthai = 1";
				$rs = $GLOBALS['dtP'] -> executeQuery($sl);
				while ($rw = mysqli_fetch_assoc($rs)) {
					$stt = $rw['idTH'];
					$tenthuonghieu = $rw['tenthuonghieu'];
					$soluong = 0; 
					$tongtien = 0;
					while ($row = mysqli_fetch_assoc($result)) {
						if ($row['idTH'] == $rw['idTH']) {
							$soluong += $row['soluong'];
							$tongtien += $row['giaca'];
						} 
					}
					//Phần mở rộng MySQL theo dõi con trỏ hàng nội bộ cho mỗi kết quả. Nó tăng con trỏ này sau mỗi lần gọi tới mysql_fetch_assoc () và là thứ cho phép bạn sử dụng vòng lặp while mà không chỉ định khi nào dừng. Nếu bạn định lặp lại một tập kết quả nhiều lần, bạn cần đặt lại con trỏ hàng nội bộ này về 0.
					mysqli_data_seek($result, 0);
					$total += $tongtien;
					$html .= "<tr><td>$stt</td>
								  <td>$tenthuonghieu</td>
								  <td>$soluong</td>
								  <td>$tongtien</td></tr>";
				}
				$html .= "</tbody>";
				echo $html.",".$total;
			}
			
			if ($trademark != 0) {
				$stt = 1;
				$html .= "	<thead style='position: sticky; top: 0px;'>
								<th style='padding-left: 5px'>STT</th>
								<th style='padding-left: 5px'>Ảnh</th>
								<th style='padding-left: 5px'>Tên sản phẩm</th>
								<th style='padding-left: 5px'>Số lượng</th>
								<th style='padding-left: 5px'>Tổng tiền</th>
							</thead>
							<tbody>";
				
				if ($start == 0 && $end == 0) {
					$s = date('Y-01-01');
					$e = date('Y-12-31');
					$select = "SELECT chitietdonhang.idSP, chitietdonhang.soluong, chitietdonhang.giaca, sanpham.idTH FROM donhang JOIN chitietdonhang JOIN sanpham WHERE donhang.idTT >= 1 AND sanpham.idSP = chitietdonhang.idSP AND chitietdonhang.idDH = donhang.idDH AND donhang.ngaytaodon >= '$s' AND donhang.ngaytaodon <= '$e' AND idTH = $trademark";
					$result = $GLOBALS['dtP'] -> executeQuery($select);
					
					//câu truy vấn này dùng để chọn ra những sản phẩm đã được bán lọc theo idTH và group by theo idSP (vì trong bảng chitiet_donhang 1 sản phẩm có thể mua nhiều lần gây trùng lặp nên dùng group để tránh điều đó)
					$sl = "SELECT chitietdonhang.idSP, sanpham.tensanpham, sanpham.hinhanh FROM donhang JOIN chitietdonhang JOIN sanpham WHERE donhang.idTT >= 1 AND sanpham.idSP = chitietdonhang.idSP AND chitietdonhang.idDH = donhang.idDH AND donhang.ngaytaodon >= '$s' AND donhang.ngaytaodon <= '$e' AND idTH = $trademark group by chitietdonhang.idSP";
					$rs = $GLOBALS['dtP'] -> executeQuery($sl);
				}
			
				if ($start != 0 && $end != 0) {
					$select = "SELECT chitietdonhang.idSP, chitietdonhang.soluong, chitietdonhang.giaca, sanpham.idTH FROM donhang JOIN chitietdonhang JOIN sanpham WHERE donhang.idTT >= 1 AND sanpham.idSP = chitietdonhang.idSP AND chitietdonhang.idDH = donhang.idDH AND donhang.ngaytaodon >= '$start' AND donhang.ngaytaodon <= '$end' AND idTH = $trademark";
					$result = $GLOBALS['dtP'] -> executeQuery($select);
					
					//câu truy vấn này dùng để chọn ra những sản phẩm đã được bán lọc theo idTH và group by theo idSP (vì trong bảng chitiet_donhang 1 sản phẩm có thể mua nhiều lần gây trùng lặp nên dùng group để tránh điều đó)
					$sl = "SELECT chitietdonhang.idSP, sanpham.tensanpham, sanpham.hinhanh FROM donhang JOIN chitietdonhang JOIN sanpham WHERE donhang.idTT >= 1 AND sanpham.idSP = chitietdonhang.idSP AND chitietdonhang.idDH = donhang.idDH AND donhang.ngaytaodon >= '$start' AND donhang.ngaytaodon <= '$end' AND idTH = $trademark group by chitietdonhang.idSP";
					$rs = $GLOBALS['dtP'] -> executeQuery($sl);
				}
			
				while ($rw = mysqli_fetch_assoc($rs)) {
					$url = $rw['hinhanh'];
					$idSP = $rw['idSP'];
					$tensanpham = $rw['tensanpham'];
					$soluong = 0; 
					$tongtien = 0;
					while ($row = mysqli_fetch_assoc($result)) 
						if ($row['idSP'] == $rw['idSP']) {
							$soluong += $row['soluong'];
							$tongtien += $row['giaca'];
						} 
					
					//Phần mở rộng MySQL theo dõi con trỏ hàng nội bộ cho mỗi kết quả. Nó tăng con trỏ này sau mỗi lần gọi tới mysql_fetch_assoc () và là thứ cho phép bạn sử dụng vòng lặp while mà không chỉ định khi nào dừng. Nếu bạn định lặp lại một tập kết quả nhiều lần, bạn cần đặt lại con trỏ hàng nội bộ này về 0.
					mysqli_data_seek($result, 0);
					$total += $tongtien;
					$html .= "<tr><td>$stt</td>
								  <td style='width: 180px; text-align: center;'>$idSP<img class='zoom' src='$url'></td>
								  <td>$tensanpham</td>
								  <td>$soluong</td>
								  <td>$tongtien</td></tr>";
					$stt = $stt + 1;
				}
				$html .= "</tbody>";
				echo $html.",".$total;
			}
		}
		
		if ($choice == 3) {
			if ($type == 0) {
				$html .= "	<thead style='position: sticky; top: 0px;'>
								<th style='padding-left: 5px'>ID</th>
								<th style='padding-left: 5px'>Loại sản phẩm</th>
								<th style='padding-left: 5px'>Số lượng</th>
								<th style='padding-left: 5px'>Tổng tiền</th>
							</thead>
							<tbody>";
				if ($start == 0 && $end == 0) {
					$s = date('Y-01-01');
					$e = date('Y-12-31');
					$select = "SELECT chitietdonhang.idDH, chitietdonhang.idSP, chitietdonhang.soluong, chitietdonhang.giaca, sanpham.idLSP FROM donhang JOIN chitietdonhang JOIN sanpham WHERE donhang.idTT >= 1 AND sanpham.idSP = chitietdonhang.idSP AND chitietdonhang.idDH = donhang.idDH AND donhang.ngaytaodon >= '$s' AND donhang.ngaytaodon <= '$e'";
					$result = $GLOBALS['dtP'] -> executeQuery($select);
				}
				if ($start != 0 && $end != 0) {
					$select = "SELECT chitietdonhang.idDH, chitietdonhang.idSP, chitietdonhang.soluong, chitietdonhang.giaca, sanpham.idLSP FROM donhang JOIN chitietdonhang JOIN sanpham WHERE donhang.idTT >= 1 AND sanpham.idSP = chitietdonhang.idSP AND chitietdonhang.idDH = donhang.idDH AND donhang.ngaytaodon >= '$start' AND donhang.ngaytaodon <= '$end'";
					$result = $GLOBALS['dtP'] -> executeQuery($select);
				}

				$sl = "SELECT * FROM `loaisanpham` WHERE trangthai = 1";
				$rs = $GLOBALS['dtP'] -> executeQuery($sl);
				while ($rw = mysqli_fetch_assoc($rs)) {
					$stt = $rw['idLSP'];
					$loaisanpham = $rw['tenloai'];
					$soluong = 0; 
					$tongtien = 0;
					while ($row = mysqli_fetch_assoc($result)) {
						if ($row['idLSP'] == $rw['idLSP']) {
							$soluong += $row['soluong'];
							$tongtien += $row['giaca'];
						} 
					}
					//Phần mở rộng MySQL theo dõi con trỏ hàng nội bộ cho mỗi kết quả. Nó tăng con trỏ này sau mỗi lần gọi tới mysql_fetch_assoc () và là thứ cho phép bạn sử dụng vòng lặp while mà không chỉ định khi nào dừng. Nếu bạn định lặp lại một tập kết quả nhiều lần, bạn cần đặt lại con trỏ hàng nội bộ này về 0.
					mysqli_data_seek($result, 0);
					$total += $tongtien;
					$html .= "<tr><td>$stt</td>
								  <td>$loaisanpham</td>
								  <td>$soluong</td>
								  <td>$tongtien</td></tr>";
				}
				$html .= "</tbody>";
				echo $html.",".$total;
			}
			
			if ($type != 0) {
				$stt = 1;
				$html .= "	<thead style='position: sticky; top: 0px;'>
								<th style='padding-left: 5px'>STT</th>
								<th style='padding-left: 5px'>Ảnh</th>
								<th style='padding-left: 5px'>Tên sản phẩm</th>
								<th style='padding-left: 5px'>Số lượng</th>
								<th style='padding-left: 5px'>Tổng tiền</th>
							</thead>
							<tbody>";
				
				if ($start == 0 && $end == 0) {
					$s = date('Y-01-01');
					$e = date('Y-12-31');
					$select = "SELECT chitietdonhang.idSP, chitietdonhang.soluong, chitietdonhang.giaca, sanpham.idTH FROM donhang JOIN chitietdonhang JOIN sanpham WHERE donhang.idTT >= 1 AND sanpham.idSP = chitietdonhang.idSP AND chitietdonhang.idDH = donhang.idDH AND donhang.ngaytaodon >= '$s' AND donhang.ngaytaodon <= '$e' AND idLSP = $type";
					$result = $GLOBALS['dtP'] -> executeQuery($select);
					
					//câu truy vấn này dùng để chọn ra những sản phẩm đã được bán lọc theo idLSP và group by theo idSP (vì trong bảng chitiet_donhang 1 sản phẩm có thể mua nhiều lần gây trùng lặp nên dùng group để tránh điều đó)
					$sl = "SELECT chitietdonhang.idSP, sanpham.tensanpham, sanpham.hinhanh FROM donhang JOIN chitietdonhang JOIN sanpham WHERE donhang.idTT >= 1 AND sanpham.idSP = chitietdonhang.idSP AND chitietdonhang.idDH = donhang.idDH AND donhang.ngaytaodon >= '$s' AND donhang.ngaytaodon <= '$e' AND idLSP = $type group by chitietdonhang.idSP";
					$rs = $GLOBALS['dtP'] -> executeQuery($sl);
				}
			
				if ($start != 0 && $end != 0) {
					$select = "SELECT chitietdonhang.idSP, chitietdonhang.soluong, chitietdonhang.giaca, sanpham.idTH FROM donhang JOIN chitietdonhang JOIN sanpham WHERE donhang.idTT >= 1 AND sanpham.idSP = chitietdonhang.idSP AND chitietdonhang.idDH = donhang.idDH AND donhang.ngaytaodon >= '$start' AND donhang.ngaytaodon <= '$end' AND idLSP = $type";
					$result = $GLOBALS['dtP'] -> executeQuery($select);
					
					//câu truy vấn này dùng để chọn ra những sản phẩm đã được bán lọc theo idLSP và group by theo idSP (vì trong bảng chitiet_donhang 1 sản phẩm có thể mua nhiều lần gây trùng lặp nên dùng group để tránh điều đó)
					$sl = "SELECT chitietdonhang.idSP, sanpham.tensanpham, sanpham.hinhanh FROM donhang JOIN chitietdonhang JOIN sanpham WHERE donhang.idTT >= 1 AND sanpham.idSP = chitietdonhang.idSP AND chitietdonhang.idDH = donhang.idDH AND donhang.ngaytaodon >= '$start' AND donhang.ngaytaodon <= '$end' AND idLSP = $type group by chitietdonhang.idSP";
					$rs = $GLOBALS['dtP'] -> executeQuery($sl);
				}
			
				while ($rw = mysqli_fetch_assoc($rs)) {
					$url = $rw['hinhanh'];
					$idSP = $rw['idSP'];
					$tensanpham = $rw['tensanpham'];
					$soluong = 0; 
					$tongtien = 0;
					while ($row = mysqli_fetch_assoc($result)) 
						if ($row['idSP'] == $rw['idSP']) {
							$soluong += $row['soluong'];
							$tongtien += $row['giaca'];
						} 
					
					//Phần mở rộng MySQL theo dõi con trỏ hàng nội bộ cho mỗi kết quả. Nó tăng con trỏ này sau mỗi lần gọi tới mysql_fetch_assoc () và là thứ cho phép bạn sử dụng vòng lặp while mà không chỉ định khi nào dừng. Nếu bạn định lặp lại một tập kết quả nhiều lần, bạn cần đặt lại con trỏ hàng nội bộ này về 0.
					mysqli_data_seek($result, 0);
					$total += $tongtien;
					$html .= "<tr><td>$stt</td>
								  <td style='width: 180px; text-align: center;'>$idSP<img class='zoom' src='$url'></td>
								  <td>$tensanpham</td>
								  <td>$soluong</td>
								  <td>$tongtien</td></tr>";
					$stt = $stt + 1;
				}
				$html .= "</tbody>";
				echo $html.",".$total;
			}
		}
		
		if ($choice == 4) {
			$stt = 1;
			$html .= "	<thead style='position: sticky; top: 0px;'>
								<th style='padding-left: 5px'>STT</th>
								<th style='padding-left: 5px'>Ảnh</th>
								<th style='padding-left: 5px'>Tên sản phẩm</th>
								<th style='padding-left: 5px'>Số lượng</th>
								<th style='padding-left: 5px'>Tổng tiền</th>
							</thead>
							<tbody>";
			$arr = array();
			$maxArr = array();
			$norArr = array();
			//Số lượng tối đa
			$max = 0;
			//Số tiền tối đa
			$maxMoney = 0;
			$select = "SELECT chitietdonhang.idSP, tensanpham FROM chitietdonhang JOIN sanpham JOIN donhang WHERE donhang.idTT >= 1 AND donhang.idDH = chitietdonhang.idDH AND chitietdonhang.idSP = sanpham.idSP group by idSP";
			$result = $GLOBALS['dtP'] -> executeQuery($select);
			//Khởi tạo chuỗi phần tử là các sản phẩm khác nhau (2 sản phẩm cùng tên khác id cũng tính là khác nhau)
			while($row = mysqli_fetch_assoc($result)) {
				$idSP = $row['idSP'];
				$arr[$idSP] = 0;
			}
			//Tính số lượng cho từng sản phẩm trong chuỗi
			$select = "SELECT * FROM chitietdonhang JOIN sanpham JOIN donhang WHERE donhang.idTT >= 1 AND donhang.idDH = chitietdonhang.idDH AND chitietdonhang.idSP = sanpham.idSP";	
			$result = $GLOBALS['dtP'] -> executeQuery($select);
			while ($row = mysqli_fetch_assoc($result)) {
				$idSP = $row['idSP'];
				$soluong = $row['soluong'];
				$arr[$idSP] += $soluong;
				$max = $arr[$idSP];
			}
			//Tìm ra sản phẩm có số lượng tối đa
			foreach ($arr as $key => $value) 
				if ($arr[$key] > $max) $max = $arr[$key];
			//Khới tạo chuỗi bao gồm các sản phẩm có cùng số lượng (max)
			foreach ($arr as $key => $value)
				if ($arr[$key] == $max) $maxArr[$key] = $max;
			//Xét nếu trong trường hợp có nhiều hơn 2 sản phẩm có cùng số lượng tối đa
			if (count($maxArr) > 1) {
				$select = "SELECT * FROM sanpham";
				$result = $GLOBALS['dtP'] -> executeQuery($select);
				//Tính xem giá cả của từng sản phẩm theo số lượng tối đa
				while ($row = mysqli_fetch_assoc($result)) 
					foreach ($maxArr as $key => $value)
						if ($key == $row['idSP']) $maxArr[$key] = $max * $row['giaca'];
				//Tìm số tiền cao nhất
				foreach ($maxArr as $key => $value)
					if ($maxArr[$key] > $maxMoney) $maxMoney = $maxArr[$key];
				//Kiểm tra xem số lượng sản phẩm bán chạy ($amount) có lớn hơn count($maxArr)
				if ($amount <= count($maxArr)) {
					for ($i = 0; $i<$amount; $i++) {
					$submaxMoney = 0;
						foreach ($maxArr as $key => $value) {
							$result = $GLOBALS['dtP'] -> executeQuery($select);
							if ($maxArr[$key] == $maxMoney) {
								while ($row = mysqli_fetch_assoc($result)) 
									if ($key == $row['idSP']) {
										$idSP = $row['idSP'];
										$url = $row['hinhanh'];
										$tensanpham = $row['tensanpham'];
										$soluong = $max;
										$tongtien = $maxMoney;
									$html .= "<tr><td>$stt</td>
									  <td style='width: 180px; text-align: center;'>$idSP<img class='zoom' src='$url'></td>
									  <td>$tensanpham</td>
									  <td>$soluong</td>
									  <td>$tongtien</td></tr>";
									}
								//reset lại con trỏ index về 0
								mysqli_data_seek($result, 0);
								$stt = $stt + 1;
							}
						}
						//set lại maxMoney thứ 2 vì maxMoney 1 đã in ra rồi
						foreach ($maxArr as $key => $value) {
							if ($maxArr[$key] < $maxMoney && $maxArr[$key] > $submaxMoney) $submaxMoney = $maxArr[$key];
						} 
					$maxMoney = $submaxMoney;
					}
				}
				if ($amount > count($maxArr)) {
					//Số lượng sản phẩm bán chạy còn lại sẽ thống kê từ các sản phẩm có số lượng dưới số lượng tối đa
					$subamount = $amount - count($maxArr);
					//Ưu tiên sắp xếp các sản phẩm trong chuỗi chứa sản phẩm có số lượng tối đa
					for ($i = 0; $i<count($maxArr); $i++) {
					$submaxMoney = 0;
						foreach ($maxArr as $key => $value) {
							$result = $GLOBALS['dtP'] -> executeQuery($select);
							if ($maxArr[$key] == $maxMoney) {
								while ($row = mysqli_fetch_assoc($result)) 
									if ($key == $row['idSP']) {
										$idSP = $row['idSP'];
										$url = $row['hinhanh'];
										$tensanpham = $row['tensanpham'];
										$soluong = $max;
										$tongtien = $maxMoney;
									$html .= "<tr><td>$stt</td>
									  <td style='width: 180px; text-align: center;'>$idSP<img class='zoom' src='$url'></td>
									  <td>$tensanpham</td>
									  <td>$soluong</td>
									  <td>$tongtien</td></tr>";
									}
								//reset lại con trỏ index về 0
								mysqli_data_seek($result, 0);
								$stt = $stt + 1;
							}
						}
						//set lại maxMoney thứ 2 vì maxMoney 1 đã in ra rồi
						foreach ($maxArr as $key => $value) {
							if ($maxArr[$key] < $maxMoney && $maxArr[$key] > $submaxMoney) $submaxMoney = $maxArr[$key];
						} 
					$maxMoney = $submaxMoney;
					}
					//Sắp xếp theo sản phẩm có số lượng dưới số lượng tối đa
					$submax = 0;
					for ($i = 0; $i<$subamount; $i++) {
						
					}
				}
			}
			//Xét trường hợp bình thường có đúng duy nhất 1 sản phẩm có số lượng tối đa
			if (count($maxArr) == 1) {
				
			}
			$html .= "</tbody>";
			echo $html.",".$max;
		}
	}
?>

