<?php
	session_start();
	include_once('dataProvider.php');

class role {
		function check_role($url) {
			$user = $_SESSION['username'];
			$pass = $_SESSION['password'];
			
			
				//kiểm tra xem có đăng nhập trước đó chưa nếu chưa thì trả về trang đăng nhập
			if ($_SESSION['username'] == NULL || $_SESSION['password'] == NULL) 
				header('location: http://localhost/qlgiaythethao/admin/login.php'); 
			else {
			$dtP = new DataProvider();
			$sql = "SELECT * FROM `taikhoan` WHERE `taikhoan`.`tendangnhap` = '$user' AND `taikhoan`.`matkhau` = '$pass' LIMIT 1";
			$row = mysqli_fetch_assoc($dtP -> executeQuery($sql));
			if ($row['idNQ'] == 3) { //nếu đăng nhập = tài khoản NV
				
					if ($url == '/qlgiaythethao/admin/index.php'){
						echo 
//					"<li class='active'><a href='#'><svg class='glyph'></svg> Dashboard</a></li>
					"<li><a href='qlsanpham.php'><svg class='glyph'></svg> Quản lý sản phẩm</a></li>
					<li><a href='qldonhang.php'><svg class='glyph'></svg> Quản lý đơn hàng</a></li>
					<li><a href='qlctkm.php'><svg class='glyph'></svg> Chương trình khuyến mãi</a></li>
					<li><a href='thongke.php'><svg class='glyph'></svg> Thống kê</a></li>
					<li role='presentation' class='divider'></li>
					<li><a href='#'><svg class='glyph stroked male-user'><use xlink:href='#stroked-male-user'></use></svg>$user</a></li>";
					} 

					if ($url == '/qlgiaythethao/admin/qlsanpham.php'){
						echo 
//					"<li><a href='index.php'><svg class='glyph'></svg> Dashboard</a></li>
					"<li class='active'><a href='#'><svg class='glyph'></svg> Quản lý sản phẩm</a></li>
					<li><a href='qldonhang.php'><svg class='glyph'></svg> Quản lý đơn hàng</a></li>
					<li><a href='qlctkm.php'><svg class='glyph'></svg> Chương trình khuyến mãi</a></li>
					<li><a href='thongke.php'><svg class='glyph'></svg> Thống kê</a></li>
					<li role='presentation' class='divider'></li>
					<li><a href='#'><svg class='glyph stroked male-user'><use xlink:href='#stroked-male-user'></use></svg>$user</a></li>";
					} 

					if ($url == '/qlgiaythethao/admin/qldonhang.php'){
						echo 
//					"<li><a href='index.php'><svg class='glyph'></svg> Dashboard</a></li>
					"<li><a href='qlsanpham.php'><svg class='glyph'></svg> Quản lý sản phẩm</a></li>
					<li class='active'><a href='#'><svg class='glyph'></svg> Quản lý đơn hàng</a></li>
					<li><a href='qlctkm.php'><svg class='glyph'></svg> Chương trình khuyến mãi</a></li>
					<li><a href='thongke.php'><svg class='glyph'></svg> Thống kê</a></li>
					<li role='presentation' class='divider'></li>
					<li><a href='#'><svg class='glyph stroked male-user'><use xlink:href='#stroked-male-user'></use></svg>$user</a></li>";
					} 

					if ($url == '/qlgiaythethao/admin/qlctkm.php'){
						echo 
//					"<li><a href='index.php'><svg class='glyph'></svg> Dashboard</a></li>
					"<li><a href='qlsanpham.php'><svg class='glyph'></svg> Quản lý sản phẩm</a></li>
					<li><a href='qldonhang.php'><svg class='glyph'></svg> Quản lý đơn hàng</a></li>
					<li class='active'><a href='#'><svg class='glyph'></svg> Chương trình khuyến mãi</a></li>
					<li><a href='thongke.php'><svg class='glyph'></svg> Thống kê</a></li>
					<li role='presentation' class='divider'></li>
					<li><a href='#'><svg class='glyph stroked male-user'><use xlink:href='#stroked-male-user'></use></svg>$user</a></li>";
					} 

					if ($url == '/qlgiaythethao/admin/thongke.php'){
						echo 
//					"<li><a href='index.php'><svg class='glyph'></svg> Dashboard</a></li>
					"<li><a href='qlsanpham.php'><svg class='glyph'></svg> Quản lý sản phẩm</a></li>
					<li><a href='qldonhang.php'><svg class='glyph'></svg> Quản lý đơn hàng</a></li>
					<li><a href='qlctkm.php'><svg class='glyph'></svg> Chương trình khuyến mãi</a></li>
					<li class='active'><a href='#'><svg class='glyph'></svg> Thống kê</a></li>
					<li role='presentation' class='divider'></li>
					<li><a href='#'><svg class='glyph stroked male-user'><use xlink:href='#stroked-male-user'></use></svg>$user</a></li>";
					} 
				
			}
			else {	//nếu đăng nhập = tài khoản ADMIN
				
					if ($url == '/qlgiaythethao/admin/index.php'){
						echo 
//					"<li class='active'><a href='#'><svg class='glyph'></svg> Dashboard</a></li>
					"<li><a href='qlnhanvien.php'><svg class='glyph'></svg> Quản lý nhân viên</a></li>
					<li><a href='qltaikhoan.php'><svg class='glyph'></svg> Quản lý tài khoản</a></li>
					<li><a href='qlsanpham.php'><svg class='glyph'></svg> Quản lý sản phẩm</a></li>
					<li><a href='qlthuonghieu.php'><svg class='glyph'></svg> Quản lý thương hiệu</a></li>
					<li><a href='qlloaisanpham.php'><svg class='glyph'></svg> Quản lý loại sản phẩm</a></li>
					<li><a href='qldonhang.php'><svg class='glyph'></svg> Quản lý đơn hàng</a></li>
					<li><a href='qlctkm.php'><svg class='glyph'></svg> Chương trình khuyến mãi</a></li>
					<li><a href='thongke.php'><svg class='glyph'></svg> Thống kê</a></li>
					<li role='presentation' class='divider'></li>
					<li><a href='#'><svg class='glyph stroked male-user'><use xlink:href='#stroked-male-user'></use></svg>$user</a></li>";
					}

					if ($url == '/qlgiaythethao/admin/qlnhanvien.php'){
						echo 
//					"<li><a href='index.php'><svg class='glyph'></svg> Dashboard</a></li>
					"<li class='active'><a href='#'><svg class='glyph'></svg> Quản lý nhân viên</a></li>
					<li><a href='qltaikhoan.php'><svg class='glyph'></svg> Quản lý tài khoản</a></li>
					<li><a href='qlsanpham.php'><svg class='glyph'></svg> Quản lý sản phẩm</a></li>
					<li><a href='qlthuonghieu.php'><svg class='glyph'></svg> Quản lý thương hiệu</a></li>
					<li><a href='qlloaisanpham.php'><svg class='glyph'></svg> Quản lý loại sản phẩm</a></li>
					<li><a href='qldonhang.php'><svg class='glyph'></svg> Quản lý đơn hàng</a></li>
					<li><a href='qlctkm.php'><svg class='glyph'></svg> Chương trình khuyến mãi</a></li>
					<li><a href='thongke.php'><svg class='glyph'></svg> Thống kê</a></li>
					<li role='presentation' class='divider'></li>
					<li><a href='#'><svg class='glyph stroked male-user'><use xlink:href='#stroked-male-user'></use></svg>$user</a></li>";
					}

					if ($url == '/qlgiaythethao/admin/qltaikhoan.php'){
						echo 
//					"<li><a href='index.php'><svg class='glyph'></svg> Dashboard</a></li>
					"<li><a href='qlnhanvien.php'><svg class='glyph'></svg> Quản lý nhân viên</a></li>
					<li class='active'><a href='#'><svg class='glyph'></svg> Quản lý tài khoản</a></li>
					<li><a href='qlsanpham.php'><svg class='glyph'></svg> Quản lý sản phẩm</a></li>
					<li><a href='qlthuonghieu.php'><svg class='glyph'></svg> Quản lý thương hiệu</a></li>
					<li><a href='qlloaisanpham.php'><svg class='glyph'></svg> Quản lý loại sản phẩm</a></li>
					<li><a href='qldonhang.php'><svg class='glyph'></svg> Quản lý đơn hàng</a></li>
					<li><a href='qlctkm.php'><svg class='glyph'></svg> Chương trình khuyến mãi</a></li>
					<li><a href='thongke.php'><svg class='glyph'></svg> Thống kê</a></li>
					<li role='presentation' class='divider'></li>
					<li><a href='#'><svg class='glyph stroked male-user'><use xlink:href='#stroked-male-user'></use></svg>$user</a></li>";
					}
				
					if ($url == '/qlgiaythethao/admin/qlsanpham.php'){
						echo 
//					"<li><a href='index.php'><svg class='glyph'></svg> Dashboard</a></li>
					"<li><a href='qlnhanvien.php'><svg class='glyph'></svg> Quản lý nhân viên</a></li>
					<li><a href='qltaikhoan.php'><svg class='glyph'></svg> Quản lý tài khoản</a></li>
					<li class='active'><a href='#'><svg class='glyph'></svg> Quản lý sản phẩm</a></li>
					<li><a href='qlthuonghieu.php'><svg class='glyph'></svg> Quản lý thương hiệu</a></li>
					<li><a href='qlloaisanpham.php'><svg class='glyph'></svg> Quản lý loại sản phẩm</a></li>
					<li><a href='qldonhang.php'><svg class='glyph'></svg> Quản lý đơn hàng</a></li>
					<li><a href='qlctkm.php'><svg class='glyph'></svg> Chương trình khuyến mãi</a></li>
					<li><a href='thongke.php'><svg class='glyph'></svg> Thống kê</a></li>
					<li role='presentation' class='divider'></li>
					<li><a href='#'><svg class='glyph stroked male-user'><use xlink:href='#stroked-male-user'></use></svg>$user</a></li>";
					}

					if ($url == '/qlgiaythethao/admin/qlthuonghieu.php'){
						echo 
//					"<li><a href='index.php'><svg class='glyph'></svg> Dashboard</a></li>
					"<li><a href='qlnhanvien.php'><svg class='glyph'></svg> Quản lý nhân viên</a></li>
					<li><a href='qltaikhoan.php'><svg class='glyph'></svg> Quản lý tài khoản</a></li>
					<li><a href='qlsanpham.php'><svg class='glyph'></svg> Quản lý sản phẩm</a></li>
					<li class='active'><a href='#'><svg class='glyph'></svg> Quản lý thương hiệu</a></li>
					<li><a href='qlloaisanpham.php'><svg class='glyph'></svg> Quản lý loại sản phẩm</a></li>
					<li><a href='qldonhang.php'><svg class='glyph'></svg> Quản lý đơn hàng</a></li>
					<li><a href='qlctkm.php'><svg class='glyph'></svg> Chương trình khuyến mãi</a></li>
					<li><a href='thongke.php'><svg class='glyph'></svg> Thống kê</a></li>
					<li role='presentation' class='divider'></li>
					<li><a href='#'><svg class='glyph stroked male-user'><use xlink:href='#stroked-male-user'></use></svg>$user</a></li>";
					}

					if ($url == '/qlgiaythethao/admin/qlloaisanpham.php'){
						echo 
//					"<li><a href='index.php'><svg class='glyph'></svg> Dashboard</a></li>
					"<li><a href='qlnhanvien.php'><svg class='glyph'></svg> Quản lý nhân viên</a></li>
					<li><a href='qltaikhoan.php'><svg class='glyph'></svg> Quản lý tài khoản</a></li>
					<li><a href='qlsanpham.php'><svg class='glyph'></svg> Quản lý sản phẩm</a></li>
					<li><a href='qlthuonghieu.php'><svg class='glyph'></svg> Quản lý thương hiệu</a></li>
					<li class='active'><a href='#'><svg class='glyph'></svg> Quản lý loại sản phẩm</a></li>
					<li><a href='qldonhang.php'><svg class='glyph'></svg> Quản lý đơn hàng</a></li>
					<li><a href='qlctkm.php'><svg class='glyph'></svg> Chương trình khuyến mãi</a></li>
					<li><a href='thongke.php'><svg class='glyph'></svg> Thống kê</a></li>
					<li role='presentation' class='divider'></li>
					<li><a href='#'><svg class='glyph stroked male-user'><use xlink:href='#stroked-male-user'></use></svg>$user</a></li>";
					}
				
					if ($url == '/qlgiaythethao/admin/qldonhang.php'){
						echo 
//					"<li><a href='index.php'><svg class='glyph'></svg> Dashboard</a></li>
					"<li><a href='qlnhanvien.php'><svg class='glyph'></svg> Quản lý nhân viên</a></li>
					<li><a href='qltaikhoan.php'><svg class='glyph'></svg> Quản lý tài khoản</a></li>
					<li><a href='qlsanpham.php'><svg class='glyph'></svg> Quản lý sản phẩm</a></li>
					<li><a href='qlthuonghieu.php'><svg class='glyph'></svg> Quản lý thương hiệu</a></li>
					<li><a href='qlloaisanpham.php'><svg class='glyph'></svg> Quản lý loại sản phẩm</a></li>
					<li class='active'><a href='#'><svg class='glyph'></svg> Quản lý đơn hàng</a></li>
					<li><a href='qlctkm.php'><svg class='glyph'></svg> Chương trình khuyến mãi</a></li>
					<li><a href='thongke.php'><svg class='glyph'></svg> Thống kê</a></li>
					<li role='presentation' class='divider'></li>
					<li><a href='#'><svg class='glyph stroked male-user'><use xlink:href='#stroked-male-user'></use></svg>$user</a></li>";
					}
				
					if ($url == '/qlgiaythethao/admin/qlctkm.php'){
						echo 
//					"<li><a href='index.php'><svg class='glyph'></svg> Dashboard</a></li>
					"<li><a href='qlnhanvien.php'><svg class='glyph'></svg> Quản lý nhân viên</a></li>
					<li><a href='qltaikhoan.php'><svg class='glyph'></svg> Quản lý tài khoản</a></li>
					<li><a href='qlsanpham.php'><svg class='glyph'></svg> Quản lý sản phẩm</a></li>
					<li><a href='qlthuonghieu.php'><svg class='glyph'></svg> Quản lý thương hiệu</a></li>
					<li><a href='qlloaisanpham.php'><svg class='glyph'></svg> Quản lý loại sản phẩm</a></li>
					<li><a href='qldonhang.php'><svg class='glyph'></svg> Quản lý đơn hàng</a></li>
					<li class='active'><a href='#'><svg class='glyph'></svg> Chương trình khuyến mãi</a></li>
					<li><a href='thongke.php'><svg class='glyph'></svg> Thống kê</a></li>
					<li role='presentation' class='divider'></li>
					<li><a href='#'><svg class='glyph stroked male-user'><use xlink:href='#stroked-male-user'></use></svg>$user</a></li>";
					}

					if ($url == '/qlgiaythethao/admin/thongke.php'){
						echo 
//					"<li><a href='index.php'><svg class='glyph'></svg> Dashboard</a></li>
					"<li><a href='qlnhanvien.php'><svg class='glyph'></svg> Quản lý nhân viên</a></li>
					<li><a href='qltaikhoan.php'><svg class='glyph'></svg> Quản lý tài khoản</a></li>
					<li><a href='qlsanpham.php'><svg class='glyph'></svg> Quản lý sản phẩm</a></li>
					<li><a href='qlthuonghieu.php'><svg class='glyph'></svg> Quản lý thương hiệu</a></li>
					<li><a href='qlloaisanpham.php'><svg class='glyph'></svg> Quản lý loại sản phẩm</a></li>
					<li><a href='qldonhang.php'><svg class='glyph'></svg> Quản lý đơn hàng</a></li>
					<li><a href='qlctkm.php'><svg class='glyph'></svg> Chương trình khuyến mãi</a></li>
					<li class='active'><a href='#'><svg class='glyph'></svg> Thống kê</a></li>
					<li role='presentation' class='divider'></li>
					<li><a href='#'><svg class='glyph stroked male-user'><use xlink:href='#stroked-male-user'></use></svg>$user</a></li>";
					}
				
			}
		}}
}
?>