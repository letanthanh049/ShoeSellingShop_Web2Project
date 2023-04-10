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

	if ($pageNum != 0) {
	echo "<div class='pagination'>
			  <a id='backPage'>&laquo;</a>";
	for($i=1; $i<=$pageNum; $i++)
	echo	 "<a class='pageLink' id=".$i.">".$i."</a>";		  
	echo 	 "<a id='forwardPage'>&raquo;</a>
		</div>";
	}
?>