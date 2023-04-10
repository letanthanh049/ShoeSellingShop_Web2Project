<?php  
	session_start();
	if(isset($_GET['idSP'])){
		$idSP=$_GET['idSP'];
		if($idSP==0){
			unset($_SESSION['giohang']);
		}else{
			unset($_SESSION['giohang'][$idSP]);
		}
	}
	header('location: ../../index.php?page=giohang');
?>