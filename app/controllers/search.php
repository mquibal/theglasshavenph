<?php 
	session_start();
	require_once "connect.php";

	$search = $_POST['search'];
	$data = "";
	$sql = "SELECT * FROM items WHERE name LIKE '%".$search."%'";

	$result = mysqli_query($conn, $sql);

 	if (mysqli_num_rows($result) > 0){
 		while($items = mysqli_fetch_assoc($result)){
 			$data .= "
 				<div class=row>
 				  <div class='col-lg-4 col-md-4 col-sm-6 mt-4'>        
              		<img id='catalog_product' data-togle='modal' data-target='#modalCenter' . 'items[id]' src='$items[image_path]';'width=225px height=330px'>
                  </div></div>";
 		}
 	} else {
 		$data = "No Products Found";
 	}

 	echo $data;

 ?>