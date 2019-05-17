<?php 
	session_start();
	unset($_SESSION['token']);
	unset($_SESSION['secret_data']);
	unset($_SESSION['name']);
	unset($_SESSION['type']);
	header("location: index.php");
?>