<?php 
	require_once "connect.php";
	session_start();
	$id = $_GET['id'];
	$delete_item_query = "DELETE FROM items WHERE id = $id;";
	echo $delete_item_query;
	$result = mysqli_query($conn, $delete_item_query);
	if (!$result) {
		$_SESSION['message'] = "Item cannot be deleted. Transaction history is found.";
	} else {
		$_SESSION['message'] = "Item was successfully deleted!";
	}
	
	mysqli_close($conn);
	header("Location: ../views/product.php");
 ?>