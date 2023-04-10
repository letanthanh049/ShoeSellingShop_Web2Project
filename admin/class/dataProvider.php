<?php
class DataProvider
{
	
	public function connect()
	{
		include ('sqlcon.php');
		$conn=mysqli_connect($host,$user,$pass,$db);
		return $conn;
	}
	public static function executeQuery($sql)
	{
		include ('sqlcon.php');
			// 1. Tao ket noi CSDL
		if (!($connection = mysqli_connect($host, $user, $pass)))
			die ("Couldn't connect to localhost");
		if (!($select = mysqli_select_db($connection,$db)))
			echo "Couldn't connect to database";
		//2. Thiet lap font Unicode
		if (!(mysqli_query($connection,"set names 'utf8'")))
			echo "Couldn't set utf8";
		// Thuc thi cau truy van
		if (!($result = mysqli_query($connection,$sql))) {
			echo "Querry failed!"; 
			return false;
		}
//		// Dong ket noi CSDL
//		if (!(mysqli_close($connection)))
//			echo "couldn't close database";
		return $result;
	}
}
?>