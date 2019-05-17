<?php 
	session_start();
	unset($_SESSION['token']);
	unset($_SESSION['secret_data']);
	unset($_SESSION['name']);
	unset($_SESSION['type']);
	unset($_SESSION['bill']);
	header("location: index.php");
?>