<?php 
	session_start();
	require_once 'connect.php';

	$username = $_POST['username'];
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$role_id = 2;

	$sql_query = "SELECT * FROM users WHERE username = '$username'";
	$result = mysqli_query($conn, $sql_query);
	if(mysqli_num_rows($result) > 0){
		die("user_exist");
	} else {
		$insert_query = "INSERT INTO users(username, password, firstname, lastname, email, address, role_id) VALUES ('$username', '$password', '$firstname', '$lastname', '$email', '$address', '$role_id');";
		$result = mysqli_query($conn, $insert_query);
	}
	$sql_query2 = "SELECT * FROM users WHERE username = '$username'";
	$result = mysqli_query($conn, $sql_query2);
	$user_info = mysqli_fetch_assoc($result);
	$_SESSION['user'] = $user_info;
	mysqli_close($conn);
	
 ?>