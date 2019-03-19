<?php 
	session_start();
	require_once "connect.php";
	$name = $_POST['name'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	$image = "../assets/images/" . $_FILES['image_path']['name'];
	$category_id = $_POST['category_id'];

	move_uploaded_file($FILES['image_path']['tmp_name'], $image);
	$new_item = "INSERT INTO items (name, description, price, image_path, category_id) VALUES ('$name', '$description', '$price', '$image', '$category_id');";

	$_SESSION['message'] = "Product was successfully added!";

	mysqli_query($conn, $new_item);
	mysqli_close($conn);
	header("Location: ../views/product.php");
 ?>