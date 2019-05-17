<?php 
	session_start();
	if($_SESSION['token'] == "" && $_SESSION['type'] != 3){
		echo "<script>alert('Đăng nhập lại');location.href='../'</script>";
	}
	$key = $_GET['key'];
	unset($_SESSION['bill'][$key]);
	$_SESSION['success'] = "Xóa sản phẩm trong giỏ hàng thành công";
	echo'<script>alert("Xóa sản phẩm thành công");location.href="add-bill.php";</script>"';
?>