<?php 
	$host = "db4free.net";
	$db_username = "glasshavenph";
	$db_password = "glasshavenph";
	$db_name = "glasshavenph";

	$conn = mysqli_connect($host,$db_username, $db_password, $db_name);
	
	if(!$conn) {
		die("Connection failed: " .mysqli_error($conn));
	}
 ?>