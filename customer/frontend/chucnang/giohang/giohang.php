<div id="cart">
    <h2 class="h2-bar">giỏ hàng của bạn</h2>
    <?php  
        if (isset($_SESSION['giohang'])) {
            if(isset($_POST['sl'])){
                foreach ($_POST['sl'] as $idSP => $sl) {
                    if($sl==0){
                        unset($_SESSION['giohang'][$idSP]);
                    }else if($sl>0){
                        $_SESSION['giohang'][$idSP] = $sl;
                    }
                }
            }
            $arrid=array();
            foreach ($_SESSION['giohang'] as $idSP => $so_luong) {
                $arrid[]=$idSP;
            }
            $strid=implode(',', $arrid);
        $sql="SELECT * FROM sanpham WHERE idSP IN($strid) ORDER BY idSP DESC";
        $query=mysqli_query($conn,$sql);
    ?>
    <form id="giohang" method="post">
    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:40%">Sản phẩm</th>
                <th style="width:10%">Giá</th>
                <th style="width:10%">Số lượng</th>
                <th style="width:30%" class="text-center">Tổng tiền</th>
                <th style="width:10%"></th>
            </tr>
        </thead>
        <!-- Product Item -->
        <?php  
            $totalPriceAll=0;
         //   if (!$query) {
          //      printf("Error: %s\n", mysqli_error($con));
            //    exit();
           // }
            while ($row=mysqli_fetch_array($query,MYSQLI_ASSOC)) {
               // print_r ($row);
                $totalPrice=$row['giaca']*$_SESSION['giohang'][$row['idSP']];
        ?>
        <tbody>
            <tr>
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-2 hidden-xs"><img src="../../image/giay-the-thao.png" alt="..." class="img-responsive"/></div>
                        <div class="col-sm-10">
                            <h4><?php echo $row['tensanpham'] ?></h4>
                        </div>
                    </div>
                </td>
                <td data-th="Price"><?php echo $row['giaca'] ?></td>
                <td data-th="Quantity">
                    <input name="sl[<?php echo $row['idSP']; ?>]" type="number" min="0" class="form-control text-center" value="<?php echo $_SESSION['giohang'][$row['idSP']]; ?>">
                </td>
                <td data-th="Subtotal" class="text-center"><span></span><?php echo $totalPrice ?></td>
                <td class="actions" data-th="">
                    <a href="chucnang/giohang/xoahang.php?idSP=<?php echo $row['idSP'] ?>">Xóa</a>
                </td>
            </tr>
        </tbody>
        <?php  
            $totalPriceAll+=$totalPrice;
            }
        ?>        
        <!-- End Product Item -->
        <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong>Total <span><?php echo $totalPriceAll ?></span></strong></td>
            </tr>
            <tr>
                <td>
                    <a href="index.php?page=1" class="btn btn-warning">Tiếp tục mua hàng</a>
                    <a onclick="document.getElementById('giohang').submit();" href="#" class="btn btn-info">Cập nhật giỏ hàng</a>

                </td>
                <td colspan="2" class="hidden-xs">
                    <a class="btn btn-default" href="chucnang/giohang/xoahang.php?idSP=0">Xóa hết sản phẩm</a>  
                </td>
                <td class="hidden-xs text-center"><strong>Tổng tiền giỏ hàng: <span><?php echo $totalPriceAll ?></span></strong></td>
                <button id="btnThanhToanThanhCong" style="width:100% ;display:none;" class="btn-success btn order-submit">ĐẶT HÀNG THÀNH CÔNG</button>
                <?php if(isset($_SESSION['giohang']) && !empty($_SESSION['giohang'])){
							if(isset($_SESSION['tendangnhap']) && !empty($_SESSION['tendangnhap']))
								echo '<td><a href="index.php?page=hoanthanh" onclick="thanhtoan(\''.$_SESSION['tendangnhap'].'\'); thanhToanThanhCong();" class="btn btn-success btn-block">Thanh toán</a></td>';
								else echo '<button style="width:100%; text-transform: uppercase"  class="btn btn-success btn-block"><a href="http://localhost/qlgiaythethao/customer/frontend/chucnang/dangnhap/dangnhap.php" style="color:white;">Vui lòng đăng nhập để tiến hành thanh toán</button>';
						}
							?>
            </tr>
        </tfoot>
    </table>
    </form>
    <?php  
        }else{
            echo '<script> alert("không có sản phẩm nào trong giả hàng!");</script>';
        }
    ?>

</div>