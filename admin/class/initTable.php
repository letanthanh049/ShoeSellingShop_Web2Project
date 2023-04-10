<?php
	include_once('class/dataProvider.php');
	$dtP = new DataProvider();

	class initTable {
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		///*Tạo danh sách nhân viên*/
		//
		function initNV() {
			$select = "SELECT * FROM nhanvien WHERE trangthai = 1 OR trangthai = 2";
			$result = $GLOBALS['dtP'] -> executeQuery($select);
			while($row = mysqli_fetch_assoc($result)) {
					$id = $row['idNV'];
					$name = $row['tennhanvien'];
					$email = $row['email'];
					$phoneNum = $row['sdt'];
					$date = $row['ngayvao'];
					$salary = $row['luongcanban'];
					if ($row['trangthai'] == 1)
					$status = "Còn làm việc"; else if ($row['trangthai'] == 2) $status = "Đã nghỉ làm";
					echo "<tr>";
					echo "<td>$id</td>";
					echo "<td>$name</td>";
					echo "<td>$email</td>";
					echo "<td>$phoneNum</td>";
					echo "<td>$date</td>";
					echo "<td>$salary</td>";
					echo "<td>$status</td>";
					echo "<td style='width: 150px;'>
							<div class='btnGroup'>
									<button class='btn btn-default toggle-fix' type='button' name='toggle-fix' value='$id'>Sửa</button>
								<form method='post' style='display: inline'>
									<button class='btn btn-default toggle-del' type='button' name='delNV-btn' value='$id'>Xóa</button>
								</form>
							</div>
						</td>";
					echo "</tr>";
			}
		}
		
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		///*Tạo danh sách tài khoản*/
		//
		function initTK() {
			$select = "SELECT * FROM `taikhoan`";
			$result = $GLOBALS['dtP'] -> executeQuery($select);
			while($row = mysqli_fetch_assoc($result)) {
					$id = $row['idTK'];
					$username = $row['tendangnhap'];
					$password = $row['matkhau'];
					$datecreate = $row['ngaytao'];
					if ($row['idNQ'] == 1) $role = "admin";
					else if ($row['idNQ'] == 2) $role = "Khách hàng";
					else if ($row['idNQ'] == 3) $role = "Nhân viên";
					if ($row['trangthai'] == 1) $status = "Hoạt động"; 
					else if ($row['trangthai'] == 2) $status = "Bị vô hiệu"; 
					echo "<tr>";
					echo "<td>$id</td>";
					echo "<td>$username</td>";
					echo "<td style='-webkit-text-security: disc;'>$password</td>";
					echo "<td>$datecreate</td>";
					echo "<td>$role</td>";
					echo "<td>$status</td>";
					echo "<td style='width: 200px;'>
							<div class='btnGroup'>
									<button class='btn btn-default toggle-fix' type='button' name='toggle-fix' value='$id'>Sửa</button>
								<form method='post' style='display: inline'>";
									if ($row['trangthai'] == 1) 
								echo "<button class='btn btn-default toggle-lock' type='submit' name='lockTK-btn' value='$id'>Vô hiệu hóa</button>";
								else if ($row['trangthai'] == 2)
								echo "<button class='btn btn-default toggle-unlock' type='submit' name='unlockTK-btn' value='$id'>Kích hoạt</button>
								</form>
							</div>
						</td>";
					echo "</tr>";
			}
		}
		
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		///*Tạo danh sách sản phẩm*/
		//
		function initSP($choice) {
			if ($choice == 1) {
				echo	"<select class='form-control' style='width: 30%' name='inpType' id='inpType'>";
				$select = "SELECT * FROM `loaisanpham` WHERE `loaisanpham`.`trangthai` = 1";
				$result = $GLOBALS['dtP'] -> executeQuery($select);
				while ($row = mysqli_fetch_assoc($result)) {
					$id = $row['idLSP'];
					$name = $row['tenloai'];
					echo	"<option value='$id'>$name</option>";
				}
				echo	"</select>";
			}
			if ($choice == 2) {
				echo	"<select class='form-control' style='width: 30%' name='inpTrademark' id='inpTrademark'>";
				$select = "SELECT * FROM `thuonghieu` WHERE `thuonghieu`.`trangthai` = 1";
				$result = $GLOBALS['dtP'] -> executeQuery($select);
				while ($row = mysqli_fetch_assoc($result)) {
					$id = $row['idTH'];
					$name = $row['tenthuonghieu'];
					echo	"<option value='$id'>$name</option>";
				}
				echo	"</select>";
			}
			if ($choice == 3) {
				$select1 = "SELECT * FROM `sanpham` WHERE visible = 1";
				$select2 = "SELECT tenloai FROM `loaisanpham` WHERE idLSP = ";
				$select3 = "SELECT tenthuonghieu FROM `thuonghieu` WHERE idTH = ";
				$result = $GLOBALS['dtP'] -> executeQuery($select1);
				$index = 0;
				while($row = mysqli_fetch_assoc($result)) {
						$index++;
						$image = $row['hinhanh'];
						$id = $row['idSP'];
						$name = $row['tensanpham'];
						$result2 = $GLOBALS['dtP'] -> executeQuery($select2 . $row['idLSP']);
						$row2 = mysqli_fetch_assoc($result2); 
						$type = $row2['tenloai'];
						$result3 = $GLOBALS['dtP'] -> executeQuery($select3 . $row['idTH']);
						$row3 = mysqli_fetch_assoc($result3); 
						$trademark = $row3['tenthuonghieu'];
						$size = $row['size'];
						$color = $row['mau'];
						$price = $row['giaca'];
						$describe = $row['motasanpham'];
						$amount = $row['soluongCL'];
						if ($row['trangthai'] == 1) $status = "Còn hàng"; 
						else if ($row['trangthai'] == 2) $status = "Hết hàng"; 
						echo "<tr>";
						echo "<td><p>$index</p></td>";
						echo "<td style='width: 180px; text-align: center;'>$id<img class='zoom' src='$image'></td>";
						echo "<td><p>$name</p></td>";
						echo "<td><p>$type</p></td>";
						echo "<td><p>$trademark</p></td>";
						echo "<td><p>$size</p></td>";
						echo "<td><p>$color</p></td>";
						echo "<td><p>$price</p></td>";
						echo "<td><p>$amount</p></td>";
						echo "<td style='display: none;'><p>$describe</p></td>";
						echo "<td><p>$status</p></td>";
						echo "<td style='width: 140px;'>
								<div class='btnGroup'>
										<button class='btn btn-default' type='button' name='toggle-fix' id='toggle-fix' value='$id'>Sửa</button>
									<form method='post' style='display: inline'>
										<button class='btn btn-default' type='button' name='toggle-del' id='toggle-del' value='$id'>Xóa</button>
									</form>
								</div>
							</td>";
						echo "</tr>";
				}
			}
		}
		
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		///*Tạo danh sách thương hiệu*/
		//
		function initTH() {
			$select = "SELECT * FROM `thuonghieu`";
			$result = $GLOBALS['dtP'] -> executeQuery($select);
			while($row = mysqli_fetch_assoc($result)) {
					$id = $row['idTH'];
					$name = $row['tenthuonghieu'];
					if ($row['trangthai'] == 1) $status = "Hoạt động"; 
					else if ($row['trangthai'] == 2) $status = "Vô hiệu hóa"; 
					echo "<tr>";
					echo "<td>$id</td>";
					echo "<td>$name</td>";
					echo "<td>$status</td>";
					echo "<td style='width: 150px;'>
							<div class='btnGroup'>
									<button class='btn btn-default' type='button' id='btn-select' value='$id'>Chọn</button>
								<form method='post' style='display: inline'>";
									if ($row['trangthai'] == 1) 
								echo "<button class='btn btn-default' type='submit' name='hideTH-btn' value='$id'>Ẩn</button>";
								else if ($row['trangthai'] == 2)
								echo "<button class='btn btn-default' type='submit' name='showTH-btn' value='$id'>Hiện</button>
								</form>
							</div>
						</td>";
					echo "</tr>";
			}
		}
		
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		///*Tạo danh sách loại sản phẩm*/
		//
		function initLSP() {
			$select = "SELECT * FROM `loaisanpham`";
			$result = $GLOBALS['dtP'] -> executeQuery($select);
			while($row = mysqli_fetch_assoc($result)) {
					$id = $row['idLSP'];
					$name = $row['tenloai'];
					if ($row['trangthai'] == 1) $status = "Hoạt động"; 
					else if ($row['trangthai'] == 2) $status = "Bị vô hiệu"; 
					echo "<tr>";
					echo "<td>$id</td>";
					echo "<td>$name</td>";
					echo "<td>$status</td>";
					echo "<td style='width: 150px;'>
							<div class='btnGroup'>
									<button class='btn btn-default' type='button' id='btn-select' value='$id'>Chọn</button>
								<form method='post' style='display: inline'>";
									if ($row['trangthai'] == 1) 
								echo "<button class='btn btn-default' type='submit' name='hideLSP-btn' value='$id'>Ẩn</button>";
								else if ($row['trangthai'] == 2)
								echo "<button class='btn btn-default' type='submit' name='showLSP-btn' value='$id'>Hiện</button>
								</form>
							</div>
						</td>";
					echo "</tr>";
			}
		}
		
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		///*Tạo danh sách chương trình khuyến mãi*/
		//
		function initCTKM() {
			$select = "SELECT * FROM `ctkm`";
			$result = $GLOBALS['dtP'] -> executeQuery($select);
			while($row = mysqli_fetch_assoc($result)) {
					$id = $row['idCTKM'];
					$name = $row['tenchuongtrinh'];
					$discount = $row['giamgia'];
					$detail = $row['chitietchuongtrinh'];
					$date = $row['thoihan'];
					if ($row['trangthai'] == 1) $status = "Đang áp dụng"; 
					else if ($row['trangthai'] == 0) $status = "Chưa áp dụng"; 
					echo "<tr>";
					echo "<td>$id</td>";
					echo "<td>$name</td>";
					echo "<td>$discount</td>";
					echo "<td>$detail</td>";
					echo "<td>$date</td>";
					echo "<td>$status</td>";
					echo "<td style='width: 250px;'>
							<div class='btnGroup'>
									<button class='btn btn-default toggle-fix' type='button' name='toggle-fix' value='$id'>Sửa</button>
								<form method='post' style='display: inline'>";
									if ($row['trangthai'] == 1) 
								echo "<button class='btn btn-default toggle-apply' type='button' name='applyCTKM-btn' value='$id'>Gỡ chương trình</button>";
								else if ($row['trangthai'] == 0)
								echo "<button class='btn btn-default toggle-remove' type='button' name='removeCTKM-btn' value='$id'>Áp dụng chương trình</button>
								</form>
							</div>
						</td>";
					echo "</tr>";
			}
		}
		
		
		
		function initoptionTH() {
			$select = "select * from thuonghieu where trangthai = 1";
			$result = $GLOBALS['dtP'] -> executeQuery($select);
				echo "<option value='0'>Tất cả</option>";
			while ($row = mysqli_fetch_assoc($result)) {
				$id = $row['idTH'];
				$name = $row['tenthuonghieu'];
				echo "<option value='$id'>$name</option>";
			}
		}
		function initoptionLSP() {
			$select = "select * from loaisanpham where trangthai = 1";
			$result = $GLOBALS['dtP'] -> executeQuery($select);
				echo "<option value='0'>Tất cả</option>";
			while ($row = mysqli_fetch_assoc($result)) {
				$id = $row['idLSP'];
				$name = $row['tenloai'];
				echo "<option value='$id'>$name</option>";
			}
		}
	}
?>