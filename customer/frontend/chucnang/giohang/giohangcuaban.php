<div id="cart-wrapper">
	<a href="" class="cart">
		<a href="index.php?page=giohang"><img class="shopcart" src="./image/cart-main.png" style="width: 40px; height:40px;" /></a>
		<span id="cartCount"><?php if(isset($_SESSION['giohang'])){echo count($_SESSION['giohang']);}else{echo 0;} ?></span>
	</a>
</div>
