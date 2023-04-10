<div id="listSP">
<?php
include_once('../../admin/class/dataProvider.php');
$dtP = new DataProvider();

	$select = "";
	if (!isset($_GET['pagesp']) && !isset($_GET['pageth']) && !isset($_GET['pagetk'])) 
		if (isset($_GET['page'])) {
			if ($_GET['page'] == "gioithieu") $select = "select count(idSP) from sanpham where idSP = -1";
		 	if ($_GET['page'] == "lienhe") $select = "select count(idSP) from sanpham where idSP = -1";
		 	if ($_GET['page'] == "chitietsp") $select = "select count(idSP) from sanpham where idSP = -1";
			if ($_GET['page'] != "lienhe" && $_GET['page'] != "gioithieu" && $_GET['page'] != "chitietsp") 
				$select = "select count(idSP) from sanpham";
		}
	if (isset($_GET['pagesp']) || isset($_GET['pageth']) || isset($_GET['pagetk'])) {
			if (isset($_GET['pagesp'])) {
				$lsp = $_GET['idLSP'];
				$select = "select count(idSP) from sanpham where idLSP = $lsp";
			}
			if (isset($_GET['pageth'])) {
				$th = $_GET['idTH'];
				$select = "select count(idSP) from sanpham where idTH = $th";
			}
			if (isset($_GET['pagetk'])) {
				$text = $_GET['stext'];
				$select = "select count(idSP) from sanpham where tensanpham like '%$text%'";
			}
	}
	
	$result = $dtP -> executeQuery($select);
	$row = mysqli_fetch_assoc($result);
	$total = $row['count(idSP)'];
	$pageNum = $total / 6;
	if ($pageNum > floor($pageNum)) $pageNum = floor($pageNum) + 1;
	else if ($pageNum == floor($pageNum)) $pageNum = $pageNum;


		
if (isset($_GET["page"])) {
		$page  = $_GET['page'];
		$curPos = ($page - 1) * 6;
		$query = "";
		if (!isset($_GET['pagesp']) && !isset($_GET['pageth']) && !isset($_GET['pagetk'])) 
			if (isset($_GET['page'])) $query = "select * from sanpham limit $curPos, 6";
		if (isset($_GET['pagesp']) || isset($_GET['pageth']) || isset($_GET['pagetk'])) {
				if (isset($_GET['pagesp'])) {
					$lsp = $_GET['idLSP'];
					$query = "select * from sanpham where idLSP = $lsp limit $curPos, 6";
				}
				if (isset($_GET['pageth'])) {
					$th = $_GET['idTH'];
					$query = "select * from sanpham where idTH = $th limit $curPos, 6 ";
				}
				if (isset($_GET['pagetk'])) {
					$text = $_GET['stext'];
					$query = "select * from sanpham where tensanpham like '%$text%' limit $curPos, 6 ";
				}
		}
		$result = $GLOBALS['dtP']->executeQuery($query);

	
		echo "<h2 class='h2-bar'>Sản phẩm</h2>";
		echo "<div class='col-lg-12 product-item text-center'>";
		while ($row = mysqli_fetch_assoc($result)) {
			$idSP = $row['idSP'];
			$hinhanh = $row['hinhanh'];
			$tensanpham = $row['tensanpham'];
			$mau = $row['mau'];
			$size = $row['size'];
			$soluong = $row['soluongCL'];
			$giaca = $row['giaca'];
			echo	"<div class='col-lg-4'>
					<a href='index.php?page=chitietsp&idSP=$idSP'><img width='150' height='144' src='$hinhanh'></a>
					<h3><a href='index.php?page=chitietsp&idSP=$idSP'>$tensanpham</a></h3>
					<p>Màu: $mau</p>
					<p>Size: $size</p>
					<p>Số lượng: $soluong</p>
					<p class='price'>$giaca VNĐ</p>
					</div>";
		}
		echo '</div>';

}
?>
</div>