<?php  
	$dbhost="localhost";
	$dbuser="root";
	$dbpass="";
	$dbname="qlgiaythethao_1.2";

	$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if($conn){
		$setLang=mysqli_query($conn, "SET NAMES 'utf8'");
	}
	else{
		die("kết nối thất bại!".mysqli_connect_error());
	}
?>