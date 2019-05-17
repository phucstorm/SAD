<?php 
	session_start();
	if($_SESSION['token'] == "" && $_SESSION['type'] != 3){
		echo "<script>alert('Đăng nhập lại');location.href='../'</script>";
	}
	unset($_SESSION['bill']);
	unset($_SESSION['total']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>POST -SYSTEM</title>
	<link rel="stylesheet" type="text/css" href="../front-end/css/design.css">
  	<link rel="icon" href="../front-end/img/vlu_logo.ico" type="img">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
</head>
<body style="background-color: steelblue">
  <a href="../logout.php"><img src="../front-end/img/logo.png" alt="logo" class="image-logo"></a>
<div class="container">
    <div class="box module-receipt" onclick="window.location='add-bill.php';">
        <h1> Hoá đơn </h1>
    </div>
    <div class="box module-customer" onclick="window.location='add-customer.php';">
        <h1> Khách hàng </h1>
    </div>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>