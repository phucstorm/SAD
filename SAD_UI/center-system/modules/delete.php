<?php
	session_start();
  if($_SESSION['token'] == "" && $_SESSION['type'] != 1){
    echo "<script>alert('Đăng nhập lại');location.href='../'</script>";
  }else{
  	$_GET['product'] = "delete";
    $url = "http://localhost/api/v1/center/center.php?token=".isset($_GET['token'])."&product=".$_GET['product']."&id=".$_GET['id']."";
    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($client);
    $result = json_decode($response);
    echo "<script>alert('Xóa sản phẩm thành công');location.href='product.php'</script>";
  }

?>