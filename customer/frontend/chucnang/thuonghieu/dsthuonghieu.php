<?php

    $idTH=$_GET['idTH'];
    $sqlth="SELECT * FROM thuonghieu WHERE idTH=$idTH";
    $queryth= mysqli_query($conn, $sqlth);
    $rowth=mysqli_fetch_array($queryth);
    
    if(isset($_GET['page'])){
        $page=$_GET['page'];
    }
    else{
        $page =1;
    }
  
    $sql="SELECT * FROM sanpham WHERE idTH=$idTH ORDER BY idSP DESC  ";
    $query=mysqli_query($conn, $sql);

    
?>
<div class="products">
	<h2 class="h2-bar">Sản phẩm thuộc thương hiệu ===> <?php echo $rowth['tenthuonghieu'];?></h2>
	<div class="row">
		<?php 
			while ($row = mysqli_fetch_array($query)){
		?>
		<div class="col-md-4 col-sm-6 product-item text-center">
			<a href="index.php?page=chitietsp&idSP=<?php echo $row['idSP']; ?>"><img width="80" height="144" src="../../image/giay-the-thao.png"></a>
			<h3><a href="index.php?page=chitietsp&idSP=<?php echo $row['idSP']; ?>"><?php echo $row['tensanpham']; ?> </a></h3>
			<p>Màu: <?php echo $row['mau']; ?></p>
			<p>Size:<?php echo $row['size']; ?></p>
			<p>Thương hiệu:<?php echo $rowth['tenthuonghieu'];?></p>
			<p>Số lượng:<?php echo $row['soluongCL']; ?></p>
			<p>Trạng thái: <?php echo $row['trangthai']; ?></p>
			<p class="price"><?php echo $row['giaca']; ?>VNĐ</p>
		</div>
		<?php 
		}
		?>

