<?php 
  session_start();
  error_reporting(0);
  if($_SESSION['token'] == "" && $_SESSION['type'] != 3){
    echo "<script>alert('Đăng nhập lại');location.href='../'</script>";
  }
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $nam = $_POST['name'];
    $pho = $_POST['phone'];
    $dym = $_POST['bday'];
    $adr = $_POST['address'];
    $url = "http://localhost/api/v1/customer/customer.php?name=".$nam."&phone=".$pho."&bday=".$dym."&address=".$adr."";
    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($client);
    $result= json_decode($response);
    if($result->message == "false"){
      echo "<script>alert('Tạo khách hàng thành công');location.href='index.php'</script>";
    }else{
      echo "<script>alert('Khách hàng đã có')</script>";
    }
  }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>POST - SYSTEM</title>
  <link rel="icon" href="../front-end/img/vlu_logo.ico" type="img">
  <link rel="stylesheet" type="text/css" href="../front-end/css/customer.css">
</head>
<body>
  <form class="modal-content" action="" method="POST" enctype="multipart/form-data">
    <div class="container">
      <h1>Đăng ký khách hàng</h1>
      <hr>
      <label><b>Họ và tên </b></label>
      <input type="text" name="name" required>

      <label><b>Số điện thoại</b></label>
      <input type="number" name="phone" required>

      <label><b>Ngày sinh</b></label>
      <input type="date" name="bday" min="1900-01-02" required>

      <label><b>Địa chỉ</b></label>
      <input type="text" name="address" required>

      <div class="clearfix">
        <button type="button" class="cancelbtn" onclick="window.location.href='index.php'">Hủy</button>
        <button type="submit" class="signupbtn">Thêm</button>
      </div>
    </div>
  </form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</body>

</html>