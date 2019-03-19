<?php 
	session_start();
	unset($_SESSION['cart']);
	header("Location: ../views/cart.php")
 ?>