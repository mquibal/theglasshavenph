<?php 
require_once "connect.php";
$id = $_GET['id'];
$update_user_query = "SELECT role_id FROM users WHERE id = $id;";
$query_result = mysqli_query($conn, $update_user_query);
$user_role = mysqli_fetch_assoc($query_result);

if($user_role['role_id'] == 2) { 
	$update_role_query = "UPDATE users SET role_id = 1 WHERE id = $id;";
} else {
	$update_role_query = "UPDATE users SET role_id = 2 WHERE id = $id;";
}
mysqli_query($conn, $update_role_query);
header("Location: ../views/users.php");

?>