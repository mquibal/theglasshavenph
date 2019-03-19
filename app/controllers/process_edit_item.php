<?php 
session_start();
require_once "connect.php";

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$category_id = $_POST['category_id'];

if(isset($_FILES['image']) && $_FILES['image']['size'] > 0){
	$image = "../assets/images/" . $_FILES['image']['name'];
	move_uploaded_file($_FILES['image']['tmp_name'], $image);
}

$update_item_query = "UPDATE items SET name = '$name', description = '$description', price = '$price', image_path = '$image', category_id = '$category_id' WHERE id = $id;";
mysqli_query($conn, $update_item_query);
mysqli_close($conn);
header("Location: ../views/product.php")


 ?>
