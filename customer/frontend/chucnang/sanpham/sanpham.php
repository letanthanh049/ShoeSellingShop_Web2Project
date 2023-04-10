<?php  
  

  $sql="SELECT * FROM sanpham ORDER BY idSP ASC LIMIT 0,9";
  $query=mysqli_query($conn, $sql);

  
?>




<div class="products">
	<h2 class="h2-bar">Sản phẩm</h2>
	<div class="row">
		<?php 
			while ($row = mysqli_fetch_array($query)){
		?>
		<div class="col-md-4 col-sm-6 product-item text-center">
			<a href="index.php?page=chitietsp&idSP=<?php echo $row['idSP']; ?>"><img width="150" height="144" src="<?php echo $row['hinhanh']; ?>"></a>
			<h3><a href="index.php?page=chitietsp&idSP=<?php echo $row['idSP']; ?>"><?php echo $row['tensanpham']; ?> </a></h3>
			<p>Màu: <?php echo $row['mau']; ?></p>
			<p>Size:<?php echo $row['size']; ?></p>
			<p>Thương hiệu:<?php 
		
		echo $row['idTH']; ?></p>
			<p>Số lượng:<?php echo $row['soluongCL']; ?></p>
			<p>Trạng thái: <?php echo $row['trangthai']; ?></p>
			<p class="price"><?php echo $row['giaca']; ?>VNĐ</p>
		</div>
		<?php 
		}
		?>

		