<?php 
require_once "connect.php";
$id = $_GET['id'];
$cancel_order_query = "UPDATE orders SET status_id = 3 WHERE id = $id;";
mysqli_query($conn, $cancel_order_query);
header("Location: ../views/orders.php");
 ?>