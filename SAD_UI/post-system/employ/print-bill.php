<?php 
    session_start();
    error_reporting(0);
    if($_SESSION['token'] == "" && $_SESSION['type'] != 3){
        echo "<script>alert('Đăng nhập lại');location.href='../'</script>";
    }
    
    $_GET['read'] = "payment";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    	$_GET['point'] = $_SESSION['point'];
      $_GET['emp_id'] = $_SESSION['id'];
      $_GET['total'] = $_SESSION['total'];
      $url = "http://localhost/api/v1/branch/branch.php?token=".isset($_GET['token'])."&read=".$_GET['read']."&phone=".$_POST['phone']."&point=".$_GET['point']."&emp_id=".$_GET['emp_id']."&total=".$_GET['total']."";
      $client = curl_init($url);
      curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
      $response = curl_exec($client);
      $result= json_decode($response);
      echo "<script>alert('Đã thanh toán hóa đơn');location.href='index.php'</script>";     
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
  <title>POST -SYSTEM</title>
  <link rel="icon" href="../front-end/img/vlu_logo.ico" type="img">
  <link rel="stylesheet" type="text/css" href="../front-end/css/bill.css">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="picture">
        <img src="../front-end/img/VLU-Logo.png" id="logo">
      </div>
      <div class="info">
        <label>Tổng tiền</label>
        <input type="number" value="<?php echo $_SESSION['total']?>" readonly>
      </div>
      <div>
        <form action="" method="post">
          <div class="bill">
            <label>Nhập số điện thoại</label>
            <input type="number" name="phone">
          </div>
          <div class="btn-payment">
            <button onclick="window.location.href='index.php';">Hủy</button>
            <input type="submit" value="Thanh toán hóa đơn">
          </div>
        </form>
      </div>
      <div class="not-yet">
        <a href="add-customer.php">Chưa có tài khoản khách hàng</a><br>
      </div>
      
    </div>
  </div>
</body>
</html>
