<?php  
	session_start();
	if(isset($_SESSION['tendangnhap'])){
		session_destroy();
		header('location: http://localhost/qlgiaythethao/customer/frontend/index.php?page=1');
	}
	else{
		header('location: http://localhost/qlgiaythethao/customer/frontend/index.php?page=1');;
	}
?>