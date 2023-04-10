<?php  
	session_start();
	$idSP=$_GET['idSP'];
	if (isset($_SESSION['giohang'][$idSP])) {
		$_SESSION['giohang'][$idSP]=$_SESSION['giohang'][$idSP]+1;
	}else{
		$_SESSION['giohang'][$idSP]=1;
	}
	header('location: ../../index.php?page=giohang');
?>