<?php  
    ob_start();
    session_start();
    include_once'../ketnoi.php';

    if(isset($_POST["submit"])){
      $tendangnhap = $_POST["tendangnhap"];
      $matkhau = $_POST["matkhau"];
      if(isset($tendangnhap)&&isset($matkhau)){
          $sql="SELECT * FROM taikhoan WHERE tendangnhap='$tendangnhap' and matkhau='$matkhau' ";
          $query= mysqli_query($conn, $sql);
          //if(isset($_POST["post"])){
           // if (!$row) {
          //    printf("Error: %s\n", mysqli_error($conn));
            //  exit();
           // }else{
            //$row=mysqli_fetch_array($query);
              $rows = mysqli_num_rows($query);
              // your code here
          
          // }
            if($rows>0){
              $_SESSION['tendangnhap']=$tendangnhap;
              $_SESSION['matkhau']=$matkhau;
              
            }
            else{
              echo '<center class="alert alert-danger">Tài khoản không tồn tại hoặc sai tên đăng nhập và mật khẩu</center>';
            }
          }
        
      }
    
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=tendangnhap], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>
<div style="margin-top: 10%;">
<h2 style="text-align: center;">Đăng Nhập</h2>
<?php  
  if(!isset($_SESSION['tendangnhap'])){
?>
<form method="post" style="width: 40%; margin: auto;">
  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="tendangnhap" placeholder="Enter Username" name="tendangnhap" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="matkhau" required>
        
    <button type="submit" name="submit">Đăng Nhập</button>
	<br>
	<span><a href="http://localhost/qlgiaythethao/customer/frontend/chucnang/dangnhap/register.php" style="margin-left: 10px">Chưa có tài khoản?</a></span>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <a href="../../index.php"><button type="button" class="cancelbtn">Cancel</button></a>
    <span class="psw">Quên<a href="#"  style="margin-left: 10px">Mật Khẩu?</a></span>
  </div>
</form>
</div>
<?php  
   }
  else{
      if ($row['idNQ']==1){
      } else {
        header('location: http://localhost/qlgiaythethao/customer/frontend/index.php?page=1');
	  }
    }
?>
</body>
</html>