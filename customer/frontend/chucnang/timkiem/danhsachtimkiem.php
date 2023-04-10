<?php
if(isset($_POST['stext'])){
        $stext=$_POST['stext']; 
    }else{
        $stext=$_GET['stext'];
    }
    //loai bo cac khoang trang dau va cuoi
    $stextNew=trim($stext);
    $arr_stextNew=explode(' ',$stextNew);
    $stextNew= implode('%', $arr_stextNew);
    $stextNew='%'.$stextNew.'%';
    $sql = "SELECT * FROM sanpham WHERE tensanpham LIKE ('$stextNew') ";
    $query = mysqli_query($conn, $sql);
?>
<div class="products">
    <h2 class="h2-bar search-bar">kết quả tìm được với từ khóa 
    <span>"<?php echo $stext; ?>"</span></h2>
    <div class="row">
        <?php  
            while($row=mysqli_fetch_array($query)) {
        ?>
        <div class="col-md-4 col-sm-8 product-item text-center">
			<a href="index.php?page=chitietsp&idSP=<?php echo $row['idSP']; ?>"><img width="150" height="144" src="<?php echo $row['hinhanh']?>"></a>
			<h3><a href="index.php?page=chitietsp&idSP=<?php echo $row['idSP']; ?>"><?php echo $row['tensanpham']; ?> </a></h3>
			<p>Màu: <?php echo $row['mau']; ?></p>
			<p>Size: <?php echo $row['size']; ?></p>
			<?php 
				$idTH = $row['idTH'];
				$sl = "select * from thuonghieu where idTH = $idTH";
				$rs = mysqli_query($conn, $sl);
				$rw = mysqli_fetch_assoc($rs);
				$tenthuonghieu = $rw['tenthuonghieu'];
			?>
			<p>Thương hiệu: <?php echo $rw['tenthuonghieu']; ?></p>
			<p>Số lượng: <?php echo $row['soluongCL']; ?></p>
			<p class="price"> <?php echo $row['giaca']; ?>VNĐ</p>
		</div>
        <?php  
            }
        ?>
    </div>
</div>