<?php
    $sql = "SELECT * FROM thuonghieu WHERE trangthai = 1";
    $query =mysqli_query($conn,$sql);
?>
<li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#">Thương hiệu<span class="caret"></span></a>
								<ul class="dropdown-menu">
                                    <?php
                                         while($row = mysqli_fetch_array($query)) {
                                    ?>
                                        <?php if($row['trangthai']){
                                        ?>
                                        <li ><a href="index.php?pageth=thuonghieu&idTH=<?php echo $row["idTH"];?>&page=1" style="font-weight: bold;"><?php echo $row["tenthuonghieu"]; ?></a></li>
                                        <?php
                                        }
                                        else {
                                        ?>
                                        <li ><a href="index.php?pageth=thuonghieu&idTH=<?php echo $row[""];?>&page=1" style="font-weight: bold;"><?php echo $row[""]; ?></a></li>        
                                        <?php
                                        }
                                        ?>
                                <?php
                                    }
                                    ?>
                                </ul>
							</li>