<?php 
	if (isset($_SESSION['tendangnhap'])){
?>

    <div id="login">
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="./chucnang/dangnhap/dangxuat.php"><span class="glyphicon glyphicon-log-in"></span> Xin chào <?php echo $_SESSION['tendangnhap']; ?> / Logout</a>
            </li>
        </ul>
    </div>
 <?php  
}else{
?>
    <div id="login">
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="./chucnang/dangnhap/register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
            </li>
            <li>
                <a href="./chucnang/dangnhap/dangnhap.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>
            </li>
        </ul>
    </div>
<?php
}
?>
