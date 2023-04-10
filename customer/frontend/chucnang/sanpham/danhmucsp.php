<?php
    $sql = "SELECT * FROM loaisanpham WHERE trangthai = 1";
    $query =mysqli_query($conn,$sql);
?>
<div id="menu-but" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </div>
	<div id="menu" class="sidebar collapse navbar-collapse">
	    <h2 class="h2-bar">danh mục sản phẩm</h2>
		<ul>
			<?php
                while($row = mysqli_fetch_array($query)) {
            ?>
                <?php if($row['trangthai']){
                    ?>
                <li class="ajaxlink"><a href="index.php?pagesp=danhsachsp&idLSP=<?php echo $row['idLSP']; ?>&page=1"> <?php echo $row['tenloai']; ?></a></li>
               
                <?php
                }
                else {
                    ?>
                <li><a href="index.php?pagesp=danhsachsp&idLSP=<?php echo $row['']; ?>&page=1"> <?php echo $row['']; ?></a></li>    
                <?php    
                }
                 ?>
            
            <?php
            }
            ?>
		</ul>
	</div>


            