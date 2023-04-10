<?php
	session_start();
	include_once('dataProvider.php');

class login {
		function check_login($user, $pass) {
			$dtP = new DataProvider();
			$sql = "SELECT * FROM `taikhoan` WHERE `taikhoan`.`tendangnhap` = '$user' AND `taikhoan`.`matkhau` = '$pass' LIMIT 1";
			$row = mysqli_fetch_assoc($dtP -> executeQuery($sql));
			if (empty($row['tendangnhap']) || $row['idNQ'] == 2 || $row['trangthai'] == 2) {
				echo "<p style='color: red;'>Tài khoản không hợp lệ</p>";
			} else 
				header("location:http://localhost/qlgiaythethao/admin/index.php");
		}
}
?>