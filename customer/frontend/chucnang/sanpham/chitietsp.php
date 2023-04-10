	<?php  
	$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    $idSP=$_GET['idSP'];
    $sql = "SELECT * FROM sanpham WHERE idSP='$idSP'";
    $query = mysqli_query($conn, $sql);
    $row= mysqli_fetch_assoc($query);
	$idTH = $row['idTH'];
	$sl = "select * from thuonghieu where idTH = $idTH";
	$rs = mysqli_query($conn, $sl);
	$rw = mysqli_fetch_assoc($rs);
?>

<div id="product">
    <h1></h1>
    <h2 class="h2-bar" ><=== Chi tiết Sản phẩm ===> </h2>
    <div id="prd-thumb" class="col-md-6 col-sm-12 col-xs-12 text-center">
        <img height="250px;" src="<?php echo $row['hinhanh']; ?>">
    </div>
    <div id="prd-intro" class="col-md-6 col-sm-12 col-xs-12">
        <h3><?php echo $row['tensanpham']; ?></h3>
        <p id="prd-price"><span class="sl">Giá sản phẩm:</span> <span class="sr"><?php echo $row['giaca']; ?> VNĐ</span></p>
        <p><span class="sl">Size:</span><?php echo $row['size']; ?></p>
        <p><span class="sl">Màu:</span><?php echo $row['mau']; ?></p>
        <p><span class="sl">Thương hiệu:</span><?php echo $rw['tenthuonghieu']; ?></p>
        <p><span class="sl">Số lượng:</span><?php echo $row['soluongCL']; ?></p>
        <a href="chucnang/giohang/themhang.php?idSP=<?php echo $row['idSP']; ?>"><button type="button" class="btn btn-danger">đặt mua</button></a>
    </div>
    <div id="prd-details" class="col-md-12 col-sm-12 col-xs-12 text-justify">
        <br>
		<div class="col-md-6 col-sm-12 col-xs-12">
			<label style="display: block;">Mô tả</label>
			<p>
				<?php echo $row['motasanpham']; ?>
			</p>
		</div>
    </div>
</div>
