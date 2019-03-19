<?php
	session_start();
	function getCartCount(){
		return array_sum($_SESSION['cart']);
	}

	function getCartTotal(){
		$total = 0;
		foreach($_SESSION['cart'] as $id => $quantity){
			$total += $_SESSION['cart'][$id];
		}
		return array_sum($_SESSION['cart']);
	}

	$item_id = $_POST['item_id']; 
	$item_quantity = $_POST['item_quantity']; 
	$update_flag = false;

	if($item_quantity == "0"){
		unset($_SESSION['cart'][$item_id]);
	} else {
		if(isset($_SESSION['cart'][$item_id] )){
			$update_flag = $_POST['update_flag'];
			if($update_flag){
				$_SESSION['cart'][$item_id] = $item_quantity;
			} else{
				$_SESSION['cart'][$item_id] += $item_quantity;
			}
		
		} else {
			$_SESSION['cart'][$item_id] = $item_quantity;
		
		}
	}

	echo getCartCount();

?>