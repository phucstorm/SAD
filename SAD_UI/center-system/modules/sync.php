<?php
	session_start();
  if($_SESSION['token'] == "" && $_SESSION['type'] != 1){
    echo "<script>alert('Đăng nhập lại');location.href='../'</script>";
  }else{
  	$_GET['sync'] = "sync-product";
    $_GET['id'] = $_SESSION['id'];
    $url = "http://localhost/api/v1/synchronized/sync.php?sync=".isset($_GET['sync'])."&sync=".$_GET['sync']."";
    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($client);
    $result = json_decode($response);
    echo "<script>alert('Đồng bộ sản phẩm thành công');location.href='product.php'</script>";
  }

?>