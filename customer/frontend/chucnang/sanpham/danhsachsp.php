<div id="listSP">
<?php
include_once('../../admin/class/dataProvider.php');
$dtP = new DataProvider();

$idLSP=$_GET['idLSP'];
$sqldm="SELECT * FROM loaisanpham WHERE idLSP=$idLSP";
$resultdm = $dtP->executeQuery($sqldm);
$rowdm = mysqli_fetch_assoc($resultdm);
$tenloai= $rowdm['tenloai'];
echo "<h2 class='h2-bar'>Sản phẩm =======> $tenloai</h2>";
// $querydm= mysqli_query($conn, $sqldm);
// $rowdm=mysqli_fetch_array($querydm);

$select = "select count(idSP) from sanpham";
$result = $dtP->executeQuery($select);
$row = mysqli_fetch_assoc($result);
$total = $row['count(idSP)'];
$pageNum = $total / 6;
if ($pageNum > floor($pageNum)) $pageNum = floor($pageNum) + 1;
else if ($pageNum == floor($pageNum)) $pageNum = $pageNum;
$page  = 1;
(int)$curPos = ((int)$page - 1) * 6;
$query = "select * from sanpham where idLSP=$idLSP limit $curPos, 6";
$result_1 = $GLOBALS['dtP']->executeQuery($query);	
echo "<div class='col-lg-12 product-item text-center'>";
while ($row = mysqli_fetch_assoc($result_1)) {
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


// class show
// {
	
// 	function initList($pg)
// 	{
// 		$idLSP=$_GET['idLSP'];		
// 		$page  = $pg;
// 		(int)$curPos = ((int)$page - 1) * 6;
// 		$query = "select * from sanpham where idLSP=$idLSP limit $curPos, 6";
// 		$result = $GLOBALS['dtP']->executeQuery($query);	
// 		echo "<div class='col-lg-12 product-item text-center'>";
// 		while ($row = mysqli_fetch_assoc($result)) {
// 			$idSP = $row['idSP'];
// 			$hinhanh = $row['hinhanh'];
// 			$tensanpham = $row['tensanpham'];
// 			$mau = $row['mau'];
// 			$size = $row['size'];
// 			$soluong = $row['soluongCL'];
// 			$giaca = $row['giaca'];
// 			echo	"<div class='col-lg-4'>
// 					<a href='index.php?page=chitietsp&idSP=$idSP'><img width='150' height='144' src='$hinhanh'></a>
// 					<h3><a href='index.php?page=chitietsp&idSP=$idSP'>$tensanpham</a></h3>
// 					<p>Màu: $mau</p>
// 					<p>Size: $size</p>
// 					<p>Số lượng: $soluong</p>
// 					<p class='price'>$giaca VNĐ</p>
// 					</div>";
// 		}
// 		echo '</div>';
// 	}
// }

// if (isset($_GET["page_dm"])) {
	
// 	$p = new show();
// 	$p->initList($_GET["page_dm"]);
// }
?>
</div>
	<?php
	include_once('initPagination.php');
	?>

